<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf_token" content="{{ csrf_token() }}" />
  <title>GodsLyrics</title>

  <!-- Google Font: Source Sans Pro -->
  <!-- <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href='{{asset("plugins/fontawesome-free/css/all.min.css")}}'>
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href='{{asset("plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css")}}'>
  <!-- iCheck -->
  <link rel="stylesheet" href='{{asset("plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}'>
  <!-- JQVMap -->
  <!-- <link rel="stylesheet" href='{{asset("plugins/jqvmap/jqvmap.min.css")}}'> -->
  <!-- Theme style -->
  <!-- <link rel="stylesheet" href='{{asset("dist/css/adminlte.min.css")}}'> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

  <!-- overlayScrollbars -->
  <!-- <link rel="stylesheet" href='{{asset("plugins/overlayScrollbars/css/OverlayScrollbars.min.css")}}'> -->
  <!-- Daterange picker -->
  <!-- <link rel="stylesheet" href='{{asset("plugins/daterangepicker/daterangepicker.css")}}'> -->
  <!-- summernote -->
  <!-- <link rel="stylesheet" href='{{asset("plugins/summernote/summernote-bs4.min.css")}}'> -->
  <link rel="stylesheet" href='{{asset("plugins/select2/css/select2.min.css")}}'>
  <!-- DataTables -->
  <!-- <link rel="stylesheet" href='{{asset("plugins/datatables-bs4/css/dataTables.bootstrap4.min.css")}}'>
  <link rel="stylesheet" href='{{asset("plugins/datatables-responsive/css/responsive.bootstrap4.min.css")}}'>
  <link rel="stylesheet" href='{{asset("plugins/datatables-buttons/css/buttons.bootstrap4.min.css")}}'> -->

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> <!-- FontAwesome for Icons -->
    



</head>
<style>
    /* iOS Global Styles */
    .ios-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06), 0 2px 8px rgba(0, 0, 0, 0.04);
        padding: 20px;
        margin-bottom: 16px;
        border: 1px solid rgba(0,0,0,0.02);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .ios-card:active {
        transform: scale(0.99);
    }
    .ios-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
        -webkit-tap-highlight-color: transparent;
    }
    .ios-card-title {
        font-weight: 700;
        font-size: 1.25rem;
        margin: 0;
        color: #1c1c1e;
        letter-spacing: -0.02em;
    }
    .ios-card-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    .ios-btn {
        border-radius: 12px;
        padding: 10px 16px;
        font-size: 0.9rem;
        font-weight: 600;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        cursor: pointer;
        transition: opacity 0.2s, transform 0.1s;
        flex: 1;
        min-width: 80px;
    }
    .ios-btn:active {
        opacity: 0.7;
        transform: scale(0.95);
    }
    .ios-btn-primary { background: #007aff; color: #fff; }
    .ios-btn-danger { background: #ff3b30; color: #fff; }
    .ios-btn-info { background: #34c759; color: #fff; } 
    .ios-btn-success { background: #ff9500; color: #fff; } /* Orange for schedule */
    .ios-btn i { font-size: 1.1rem; }
    
    .ios-card-actions-inline {
        display: flex;
        gap: 6px;
        flex-shrink: 0;
    }
    .ios-btn-small {
        border-radius: 50%;
        width: 34px;
        height: 34px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        cursor: pointer;
        transition: opacity 0.2s, transform 0.1s;
    }
    .ios-btn-small:active {
        opacity: 0.7;
        transform: scale(0.9);
    }
    .ios-btn-small i { font-size: 0.9rem; margin: 0; }
    
    /* Global form styling */
    .ios-input {
        border-radius: 14px;
        border: 1px solid #e5e5ea;
        padding: 12px 16px;
        font-size: 1rem;
        box-shadow: none;
    }
    .ios-input:focus {
        border-color: #007aff;
        box-shadow: 0 0 0 3px rgba(0, 122, 255, 0.1);
    }
    .select2-container--default .select2-selection--single,
    .select2-container--default .select2-selection--multiple {
        border-radius: 14px !important;
        border: 1px solid #e5e5ea !important;
        min-height: 46px;
    }
    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border-color: #007aff !important;
    }
    
    /* Select2 Multi-Select Tags (iOS Style) */
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #e5f1ff !important;
        border: 1px solid #cce5ff !important;
        border-radius: 12px !important;
        color: #007aff !important;
        font-weight: 500;
        padding: 2px 10px !important;
        margin-top: 6px !important;
        display: flex !important;
        align-items: center;
        flex-direction: row-reverse;
        box-shadow: none !important;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #007aff !important;
        margin-right: 0 !important;
        margin-left: 6px !important;
        border: none !important;
        font-weight: bold;
        font-size: 1.1rem;
        background: transparent !important;
        padding: 0 !important;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
        color: #0056b3 !important;
    }
    
    /* Navbar & App Background */
    body, .content-wrapper {
        background-color: #f2f2f7 !important;
    }
    .main-header.navbar {
        border-bottom: none !important;
        background-color: #f2f2f7 !important;
        box-shadow: none !important;
    }
    
    /* Page Title */
    .content-header h1 {
        font-weight: 800 !important;
        font-size: 2.2rem !important;
        letter-spacing: -0.04em;
        color: #1c1c1e;
        padding-left: 8px;
    }
    .breadcrumb {
        background: transparent !important;
        padding: 0 !important;
        margin-top: 10px;
        padding-left: 8px !important;
    }
    
    /* Select2 Dropdown Styling */
    .select2-dropdown {
        border: none !important;
        border-radius: 16px !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12), 0 4px 10px rgba(0,0,0,0.06) !important;
        overflow: hidden;
        margin-top: 4px;
    }
    .select2-results__option {
        padding: 12px 18px !important;
        font-size: 1rem;
        border-bottom: 1px solid rgba(0,0,0,0.04);
        transition: background-color 0.1s;
    }
    .select2-results__option--highlighted[aria-selected] {
        background-color: #007aff !important;
        color: white !important;
    }
    .select2-results__option[aria-selected="true"] {
        background-color: rgba(0, 122, 255, 0.08) !important;
        color: #007aff !important;
        font-weight: 600;
    }
    .select2-search--dropdown .select2-search__field {
        border-radius: 10px !important;
        border: 1px solid #e5e5ea !important;
        padding: 8px 12px !important;
        margin-bottom: 4px;
    }
    
    /* iOS Sidebar Styles */
    .main-sidebar {
        background-color: #ffffff !important;
        box-shadow: 4px 0 24px rgba(0,0,0,0.04) !important;
        border-right: 1px solid rgba(0,0,0,0.02);
    }
    .brand-link {
        color: #1c1c1e !important;
        border-bottom: 1px solid #f2f2f7 !important;
        padding-left: 20px;
    }
    .brand-text {
        font-weight: 800 !important;
        font-size: 1.4rem;
        letter-spacing: -0.02em;
    }
    .nav-sidebar .nav-link {
        color: #3a3a3c !important;
        border-radius: 14px !important;
        margin: 4px 12px !important;
        padding: 12px 16px !important;
        transition: all 0.2s ease;
        font-weight: 600;
    }
    .nav-sidebar .nav-link:hover, .nav-sidebar .nav-link.active {
        background-color: rgba(0, 122, 255, 0.08) !important;
        color: #007aff !important;
    }
    .nav-sidebar .nav-link i {
        color: inherit !important;
        font-size: 1.2rem;
        width: 28px;
    }
    /* iOS Sidebar Search */
    .form-control-sidebar {
        background-color: #f2f2f7 !important;
        border: none !important;
        border-radius: 12px 0 0 12px !important;
        color: #1c1c1e !important;
        padding-left: 16px;
        box-shadow: none !important;
    }
    .form-control-sidebar::placeholder {
        color: #8e8e93 !important;
    }
    .btn-sidebar {
        background-color: #f2f2f7 !important;
        border: none !important;
        border-radius: 0 12px 12px 0 !important;
        color: #8e8e93 !important;
        box-shadow: none !important;
    }
    .form-inline .input-group {
        width: calc(100% - 24px);
        margin: 10px 12px;
    }
    .nav-link[data-widget="pushmenu"] {
        color: #1c1c1e !important;
    }
    
    /* iOS PIN Modal */
    .ios-modal-overlay {
        position: fixed; top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0, 0, 0, 0.4); backdrop-filter: blur(4px);
        z-index: 9999; display: flex; align-items: center; justify-content: center;
        opacity: 0; transition: opacity 0.2s ease;
    }
    .ios-modal-overlay.show { opacity: 1; }
    .ios-modal {
        background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px);
        width: 270px; border-radius: 14px; text-align: center;
        overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        transform: scale(1.1); transition: transform 0.2s ease;
    }
    .ios-modal-overlay.show .ios-modal { transform: scale(1); }
    .ios-modal-header { padding: 20px 15px 15px; }
    .ios-modal-header h4 {
        font-size: 17px; font-weight: 600; margin: 0 0 5px; color: #000;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    }
    .ios-modal-header p {
        font-size: 13px; margin: 0; color: #000;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    }
    .ios-modal-body { padding: 0 15px 15px; }
    .ios-pin-input {
        width: 100%; background: #fff; border: 1px solid rgba(0,0,0,0.1);
        border-radius: 6px; padding: 6px; font-size: 16px; text-align: center; outline: none;
    }
    .ios-pin-input.error { animation: shake 0.4s; border-color: red; }
    .ios-modal-footer { display: flex; border-top: 1px solid rgba(0,0,0,0.2); }
    .ios-modal-btn {
        flex: 1; background: transparent; border: none; padding: 12px;
        font-size: 17px; color: #007aff; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        cursor: pointer;
    }
    .ios-modal-btn:active { background: rgba(0,0,0,0.05); }
    .ios-modal-btn-confirm { font-weight: 600; border-left: 1px solid rgba(0,0,0,0.2); }
    @keyframes shake {
        0%, 100% {transform: translateX(0);}
        25% {transform: translateX(-5px);}
        75% {transform: translateX(5px);}
    }
    
    /* iOS Style Range Slider */
    input[type=range].ios-slider {
      -webkit-appearance: none;
      width: 100%;
      background: transparent;
      margin: 10px 0;
    }
    
    input[type=range].ios-slider:focus {
      outline: none;
    }
    
    input[type=range].ios-slider::-webkit-slider-runnable-track {
      width: 100%;
      height: 6px;
      cursor: pointer;
      background: #e5e5ea;
      border-radius: 4px;
    }
    
    input[type=range].ios-slider::-webkit-slider-thumb {
      height: 28px;
      width: 28px;
      border-radius: 50%;
      background: #ffffff;
      cursor: pointer;
      -webkit-appearance: none;
      margin-top: -11px;
      box-shadow: 0 3px 8px rgba(0,0,0,0.15), 0 1px 1px rgba(0,0,0,0.16), 0 3px 1px rgba(0,0,0,0.1) inset;
      border: 1px solid rgba(0,0,0,0.04);
    }
    
    input[type=range].ios-slider::-moz-range-track {
      width: 100%;
      height: 6px;
      cursor: pointer;
      background: #e5e5ea;
      border-radius: 4px;
    }
    
    input[type=range].ios-slider::-moz-range-thumb {
      height: 28px;
      width: 28px;
      border-radius: 50%;
      background: #ffffff;
      cursor: pointer;
      box-shadow: 0 3px 8px rgba(0,0,0,0.15), 0 1px 1px rgba(0,0,0,0.16), 0 3px 1px rgba(0,0,0,0.1) inset;
      border: 1px solid rgba(0,0,0,0.04);
    }
</style>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src='{{asset("dist/img/AdminLTELogo.png")}}' alt="AdminLTELogo" height="60"
        width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link"></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <!-- <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li> -->

        <!-- Messages Dropdown Menu -->
        <!-- <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
            
              <div class="media">
                <img src='{{asset("dist/img/user1-128x128.jpg")}}' alt="User Avatar"
                  class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
             
              <div class="media">
                <img src='{{asset("dist/img/user8-128x128.jpg")}}' alt="User Avatar"
                  class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    John Pierce
                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">I got your message bro</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
             
              <div class="media">
                <img src='{{asset("dist/img/user3-128x128.jpg")}}' alt="User Avatar"
                  class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">The subject goes here</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
             
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li> -->
        <!-- Notifications Dropdown Menu -->
        <!-- <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li> -->
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li> -->
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{url('/')}}" class="brand-link">
        <!-- <img src='{{asset("dist/img/AdminLTELogo.png")}}' alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8"> -->
        <span class="brand-text">Gods Lyrics</span>
      </a>

      <!-- Sidebar -->
       <br>
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src='{{asset("dist/img/user2-160x160.jpg")}}' class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Yash Kakade</a>
          </div>
        </div> -->

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <li class="nav-item">
              <a href="{{url('create-new-song')}}" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Create New Song
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('view-songs')}}" class="nav-link">
                <i class="nav-icon far fa-image"></i>
                <p>
                  Songs
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('list-schedule-song')}}" class="nav-link">
                <i class="nav-icon far fa-image"></i>
                <p>
                  Schedueled Songs
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('manage-backgrounds')}}" class="nav-link">
                <i class="nav-icon fas fa-image"></i>
                <p>
                  Manage Backgrounds
                </p>
              </a>
            </li>
           
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>