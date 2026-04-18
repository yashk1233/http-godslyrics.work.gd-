@include('header')

<style>
    .ios-widget {
        border-radius: 28px !important;
        transition: transform 0.2s cubic-bezier(0.25, 0.46, 0.45, 0.94), box-shadow 0.2s ease !important;
        overflow: hidden;
        position: relative;
    }
    .ios-widget::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(180deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 100%);
        pointer-events: none;
    }
    .ios-widget:active {
        transform: scale(0.95) !important;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-4 mt-3">
                <div class="col-sm-12">
                    <h1 class="m-0" style="font-size: 2.5rem !important;">Home</h1>
                    <p class="text-muted" style="margin-left: 8px; font-size: 1.1rem; font-weight: 500;">Welcome to Gods Lyrics</p>
                </div>
            </div>
        </div>
    </div>
    
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                
                <!-- Scheduled Songs Widget -->
                <div class="col-md-4 col-sm-12 mb-4">
                    <a href="{{url('list-schedule-song')}}" style="text-decoration: none;">
                        <div class="ios-card ios-widget text-white" style="border: none; background: linear-gradient(135deg, #007aff, #0056b3); padding: 30px; display: flex; flex-direction: column; align-items: center; text-align: center; height: 200px; justify-content: center; box-shadow: 0 12px 30px rgba(0,122,255,0.3);">
                            <i class="fas fa-list-ul mb-3" style="font-size: 3.5rem;"></i>
                            <h4 style="font-weight: 800; margin: 0; letter-spacing: -0.02em;">Scheduled Songs</h4>
                        </div>
                    </a>
                </div>
                
                <!-- View Songs Widget -->
                <div class="col-md-4 col-sm-12 mb-4">
                    <a href="{{url('view-songs')}}" style="text-decoration: none;">
                        <div class="ios-card ios-widget text-white" style="border: none; background: linear-gradient(135deg, #34c759, #248a3d); padding: 30px; display: flex; flex-direction: column; align-items: center; text-align: center; height: 200px; justify-content: center; box-shadow: 0 12px 30px rgba(52,199,89,0.3);">
                            <i class="fas fa-music mb-3" style="font-size: 3.5rem;"></i>
                            <h4 style="font-weight: 800; margin: 0; letter-spacing: -0.02em;">Songs Library</h4>
                        </div>
                    </a>
                </div>
                
                <!-- Create Song Widget -->
                <div class="col-md-4 col-sm-12 mb-4">
                    <a href="{{url('create-new-song')}}" style="text-decoration: none;">
                        <div class="ios-card ios-widget text-white" style="border: none; background: linear-gradient(135deg, #ff9500, #cc7700); padding: 30px; display: flex; flex-direction: column; align-items: center; text-align: center; height: 200px; justify-content: center; box-shadow: 0 12px 30px rgba(255,149,0,0.3);">
                            <i class="fas fa-plus-circle mb-3" style="font-size: 3.5rem;"></i>
                            <h4 style="font-weight: 800; margin: 0; letter-spacing: -0.02em;">Create New Song</h4>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </section>
</div>
@include('footer')
<script src='{{asset("plugins/bootstrap/js/bootstrap.bundle.min.js")}}'></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>