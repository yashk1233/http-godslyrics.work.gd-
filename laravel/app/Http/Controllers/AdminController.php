<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SongMaster;
use App\Models\ScheduleSong;
use App\Models\SongMapping;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File; 
class AdminController extends Controller
{
    //
    public function index(){
        return View('dashboard');
    }
    public function admin(){
        return View('admin');
    }

    public function createNews(){
        return View('createNews');
    }
    public function ViewSongs(){
        return View('viewSongs');
    }

    public function SaveNewSong(Request $request){

        $validated = Validator::make($request->all(), [
            'song_title' => 'required',
            'song_para' => 'required',
            'category' => 'required',
            'language' => 'required',
        ]);
        if ($validated->fails()) {
            return redirect('/create-new-song')->with('response', 'Opps something went wrong ! Please try again');
        }

        $data = $validated->validated();
        // $data['song_category'] = json_encode(implode(',',$data['category']));
        // $data['song_language'] = $data['language'];
        $data['song_para'] = json_encode($data['song_para']);
    //    echo '<pre>';
    //    print_r($data);
    //    echo '</pre>';exit;
        
        $save_data = SongMaster::create($data);
        if($save_data->id > 0){
            $songMappingData = [];
            $songMappingKey = 0;
            foreach($data['category'] as $song_category){
                $songMappingData[$songMappingKey]['song_id'] = $save_data->id;
                $songMappingData[$songMappingKey]['song_category_id'] = $song_category;
                $songMappingData[$songMappingKey]['song_language_id'] = $data['language'];
                $songMappingData[$songMappingKey]['created_at'] = date('Y-m-d H:i:s');
                $songMappingKey++;
            }
            $saveMappingData = SongMapping::insert($songMappingData);
            if($saveMappingData){
                return redirect('/create-new-song')->with('response', 'Song created successfully');
            }else{
                return redirect('/create-new-song')->with('response', 'Opps something went wrong ! Please try again');
    
            }
           
        }else{
            return redirect('/create-new-song')->with('response', 'Opps something went wrong ! Please try again');
        }
        

    }

    public function listNews(){
        $newsData = DailyNews::all()->toArray();
       
        return view('listNews')->with('newsData',$newsData);
    }

    public function newsMaster(){

        $newsData = DailyNews::all()->toArray();
        return view('newsMaster')->with('newsData',$newsData);
    }

    public function editNews($id){
        $newsdata = DailyNews::where('news_id',$id)->get()->toArray()[0];
       return View('updateNews')->with('newsdata',$newsdata);
    }

    public function updatenews(Request $request){
        $id =  $request->news_id;

       

        $data['news_title'] = $request->news_title;
        $data['news_description'] = $request->news_description;
        $data['category'] = $request->category;
        $data['region'] = $request->region;
        $data['status'] = $request->status;
        $data['language'] = $request->language;
        $data['country'] = $request->country;
        $data['city'] = $request->city;

        if ($request->hasFile('news_banner_image')) {

            $file = $request->file('news_banner_image');
            $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $fileName = time() . '_' . 'news_banner.'.$extension;
            $filePath = $file->storeAs('uploads', $fileName, 'public');
            $data['news_banner_image'] = $filePath;
        }

        $item = DailyNews::where('news_id',$id);
        $old_file_path = $item->get()->toArray()[0]['news_banner_image'];
        unlink(public_path('storage/'.$old_file_path));

        $update = DailyNews::where('news_id',$id)->update($data);
        if($update){
            return redirect('/news-master')->with('response', 'News Updated Sucessfully');
        }else{
            return redirect('/news-master')->with('response', 'Opps something went wrong ! Please try again');

        }

        
    }

    public function delete_news($id){
        
        $item = DailyNews::where('news_id',$id);
        $file_path = $item->get()->toArray()[0]['news_banner_image'];
        
        $delete =  $item->delete();
        if($delete){
            unlink(public_path('storage/'.$file_path));
            return redirect('/news-master')->with('response', 'News Deleted Sucessfully');
        }else{
            return redirect('/news-master')->with('response', 'Opps something went wrong ! Please try again');

        }
    }

    public function createNewSong(){
        return View('createNewSong');
    }

    public function getSongsData(Request $request){


        $usersDetails = DB::table('song_master')
                    ->join('song_mapping', 'song_mapping.song_id', '=', 'song_master.id')
                    ->whereIn('song_mapping.song_language_id', (array) $request->language)
                    ->whereIn('song_mapping.song_category_id', (array) $request->category)
                    ->select('song_master.*')
                    ->groupBy('song_master.id')
                    ->orderBy('song_master.song_title', 'asc')
                    ->get();


        $msg = "This is a simple message.";
        return response()->json(array('msg'=> $usersDetails), 200);
    }

    public function presentSong($songId){

        $songDetails = DB::table('song_master')
        ->where('song_master.id', '=', $songId)
        ->select('song_master.*')
        ->groupBy('song_master.id')
        ->get()
        ->toArray()[0];

        $songPara = json_decode($songDetails->song_para);
        
        $activeBg = \App\Models\BackgroundImage::where('is_active', 1)->first();
        $bgUrl = $activeBg ? asset('storage/' . $activeBg->image_path) : asset("dist/img/gold_cross_bg.png");
        
        $defaultFontSize = \App\Models\Setting::where('key', 'default_font_size')->value('value') ?? '80';
        $bgOpacity = \App\Models\Setting::where('key', 'bg_opacity')->value('value') ?? '0.6';
        
        return View('presentSong')->with([
            'data' => $songPara, 
            'bgUrl' => $bgUrl,
            'defaultFontSize' => $defaultFontSize,
            'bgOpacity' => $bgOpacity
        ]);
    }

    public function scheduleSong(Request $request)
    {
        // Process the request data
        $song_id = $request->input('song_id');
        $data['song_id'] = $song_id;

        $save_data = ScheduleSong::create($data);

        if($save_data->id > 0){
            return response()->json([
                'message' => "Song Scheduled successful."
            ]);
        }else{
            return response()->json([
                'message' => "Something went wrong."
            ]);

        }

        // Example response
        
    }
    function listScheduleSong(){

        $data = DB::table('schedule_song')
        ->join('song_master', 'schedule_song.song_id', '=', 'song_master.id')
        // ->where('schedule_song.song_id', '=', $request->language)
        // ->whereIn('song_mapping.song_category_id', $request->category)
        ->select('schedule_song.id as sid', 'song_master.*')
        ->groupBy('song_master.id')
        ->orderBy('schedule_song.id')
        ->get()->toArray();
        return View('listScheduleSongs')->with('data',$data);;
    }

    public function removeScheduleSong(Request $request)
    {
        // Process the request data
        $id = $request->input('sid');

        $item = ScheduleSong::where('id',$id);
        
        $delete =  $item->delete();
        if($delete){
            return response()->json([
                'message' => "Song Removed successful."
            ]);
        }else{
            return response()->json([
                'message' => "Something went wrong."
            ]);

        }

        // Example response
        
    }

    public function removeAllScheduleSongs(Request $request)
    {
        $delete = ScheduleSong::truncate();
        
        return response()->json([
            'message' => "All Scheduled Songs Removed Successfully."
        ]);
    }

    public function editSong($id)
    {
        $song = SongMaster::find($id);
        $songMapping = SongMapping::where('song_id', $id)->get();
        
        $selectedCategories = $songMapping->pluck('song_category_id')->toArray();
        $language = $songMapping->first()->song_language_id ?? null;
        
        $redirect_to = url()->previous();
        if (str_contains($redirect_to, 'edit-song') || str_contains($redirect_to, 'update-song')) {
            $redirect_to = '/view-songs'; // Fallback to avoid infinite loops if validation fails
        }
        
        return view('updateSong')->with(compact('song', 'selectedCategories', 'language', 'redirect_to'));
    }

    public function updateSong(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'song_id' => 'required',
            'song_title' => 'required',
            'song_para' => 'required',
            'category' => 'required',
            'language' => 'required',
        ]);
        if ($validated->fails()) {
            return redirect()->back()->with('response', 'Opps something went wrong ! Please try again');
        }

        $data = $validated->validated();
        
        $song_id = $data['song_id'];
        $updateData = [
            'song_title' => $data['song_title'],
            'song_para' => json_encode($data['song_para'])
        ];
        
        $update_data = SongMaster::where('id', $song_id)->update($updateData);
        
        // delete old mappings
        SongMapping::where('song_id', $song_id)->delete();
        
        $songMappingData = [];
        $songMappingKey = 0;
        foreach($data['category'] as $song_category){
            $songMappingData[$songMappingKey]['song_id'] = $song_id;
            $songMappingData[$songMappingKey]['song_category_id'] = $song_category;
            $songMappingData[$songMappingKey]['song_language_id'] = $data['language'];
            $songMappingData[$songMappingKey]['created_at'] = date('Y-m-d H:i:s');
            $songMappingKey++;
        }
        SongMapping::insert($songMappingData);
        
        $redirect_to = $request->input('redirect_to', '/view-songs');
        return redirect($redirect_to)->with('response', 'Song updated successfully');
    }

    public function manageBackgrounds()
    {
        $backgrounds = \App\Models\BackgroundImage::orderBy('id', 'desc')->get();
        $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
        return view('manageBackgrounds')->with(compact('backgrounds', 'settings'));
    }

    public function saveSettings(Request $request)
    {
        // This method can be removed or kept as an alternate, but we'll remove it 
        // to consolidate logic in uploadBackground.
    }

    public function uploadBackground(Request $request)
    {
        $request->validate([
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'default_font_size' => 'nullable|numeric|min:20|max:250',
            'bg_opacity' => 'nullable|numeric|min:0|max:1',
        ]);

        if ($request->hasFile('background_image')) {
            $file = $request->file('background_image');
            $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $fileName = time() . '_' . 'bg.' . $extension;
            $filePath = $file->storeAs('backgrounds', $fileName, 'public');
            
            $is_active = \App\Models\BackgroundImage::count() == 0 ? 1 : 0;
            
            \App\Models\BackgroundImage::create([
                'image_path' => $filePath,
                'is_active' => $is_active
            ]);
        }

        if ($request->has('default_font_size')) {
            \App\Models\Setting::updateOrCreate(['key' => 'default_font_size'], ['value' => $request->default_font_size]);
        }
        
        if ($request->has('bg_opacity')) {
            \App\Models\Setting::updateOrCreate(['key' => 'bg_opacity'], ['value' => $request->bg_opacity]);
        }
        
        return redirect('/manage-backgrounds')->with('response', 'Settings & Background updated successfully');
    }

    public function setActiveBackground(Request $request)
    {
        $bg_id = $request->input('bg_id');
        \App\Models\BackgroundImage::query()->update(['is_active' => 0]);
        \App\Models\BackgroundImage::where('id', $bg_id)->update(['is_active' => 1]);
        
        return response()->json(['message' => 'Background set successfully.']);
    }

    public function deleteBackground($id)
    {
        $bg = \App\Models\BackgroundImage::find($id);
        if ($bg) {
            $file_path = public_path('storage/' . $bg->image_path);
            if (\Illuminate\Support\Facades\File::exists($file_path)) {
                unlink($file_path);
            }
            $bg->delete();
        }
        return redirect('/manage-backgrounds')->with('response', 'Background deleted successfully');
    }
}
    