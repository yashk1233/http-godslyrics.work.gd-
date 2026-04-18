<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use ZipArchive;
use Exception;

class DatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Take a full database backup, zip it, and email it';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting database backup...');

        $database = env('DB_DATABASE');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $host = env('DB_HOST', '127.0.0.1');
        $port = env('DB_PORT', '3306');

        $emailTo = env('BACKUP_EMAIL_TO');
        if (empty($emailTo)) {
            $this->error('BACKUP_EMAIL_TO is not set in your .env file.');
            return;
        }

        $date = date('Y-m-d-H-i-s');
        $filename = "backup-{$database}-{$date}.sql";
        $zipFilename = "backup-{$database}-{$date}.zip";
        
        $backupDir = storage_path('app/backups');
        if (!File::exists($backupDir)) {
            File::makeDirectory($backupDir, 0755, true);
        }

        $sqlPath = $backupDir . '/' . $filename;
        $zipPath = $backupDir . '/' . $zipFilename;

        // Build mysqldump command
        // Note: You can override MYSQLDUMP_PATH in .env if it's not in your system PATH
        $mysqldumpPath = env('MYSQLDUMP_PATH', 'mysqldump');
        $passwordArg = empty($password) ? '' : " --password=\"" . $password . "\"";
        
        $command = sprintf(
            '%s --user="%s"%s --host="%s" --port="%s" "%s" > "%s"',
            $mysqldumpPath,
            $username,
            $passwordArg,
            $host,
            $port,
            $database,
            $sqlPath
        );

        $this->info('Running mysqldump...');
        exec($command, $output, $returnVar);

        if ($returnVar !== 0 || !File::exists($sqlPath) || filesize($sqlPath) === 0) {
            $this->error('Failed to create database backup. mysqldump returned code: ' . $returnVar);
            if (File::exists($sqlPath)) File::delete($sqlPath);
            return;
        }

        $this->info("Backup created: {$sqlPath}. Zipping...");

        // Zip the file
        $zip = new ZipArchive();
        if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {
            $zip->addFile($sqlPath, $filename);
            $zip->close();
            $this->info("Zipped successfully: {$zipPath}. Sending email...");
        } else {
            $this->error('Failed to create zip archive.');
            File::delete($sqlPath);
            return;
        }

        // Email the zip
        try {
            Mail::raw("Please find attached the database backup for {$database} on {$date}.", function ($message) use ($emailTo, $zipPath, $zipFilename) {
                $message->to($emailTo)
                        ->subject("Daily DB Backup: {$zipFilename}")
                        ->attach($zipPath);
            });
            $this->info("Backup email sent to {$emailTo}.");
        } catch (Exception $e) {
            $this->error('Failed to send email: ' . $e->getMessage());
        }

        // Cleanup files
        File::delete($sqlPath);
        File::delete($zipPath);
        
        $this->info('Cleanup complete. Backup task finished.');
    }
}
