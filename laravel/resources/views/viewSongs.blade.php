@include('header')

<!-- Content Wrapper. Contains page content -->
<style>
    .select2-container--default .select2-selection--single {
        padding-bottom: 29px;
    }
    .select2-container--default .select2-selection--multiple {
        border-radius: 12px !important;
        border: 1px solid #e5e5ea !important;
        min-height: 44px !important;
        padding-top: 4px !important;
        padding-left: 4px !important;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #e0f0ff !important;
        border: none !important;
        border-radius: 8px !important;
        color: #007aff !important;
        padding: 6px 10px !important;
        font-weight: 500 !important;
        font-size: 0.9rem !important;
        margin-top: 2px !important;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #007aff !important;
        margin-right: 6px !important;
        border-right: none !important;
    }
    
    .ios-list-group {
        background: #ffffff;
        border-radius: 14px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.03), 0 1px 4px rgba(0, 0, 0, 0.03);
        margin-bottom: 24px;
        border: 1px solid rgba(0,0,0,0.04);
    }
    .ios-list-row {
        padding: 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: transparent;
        transition: background-color 0.15s ease;
    }
    .ios-list-row:first-child {
        border-top-left-radius: 14px;
        border-top-right-radius: 14px;
    }
    .ios-list-row:last-child {
        border-bottom-left-radius: 14px;
        border-bottom-right-radius: 14px;
    }
    .ios-list-row:active {
        background-color: #f2f2f7;
    }
    .ios-icon-wrapper {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: linear-gradient(135deg, #e0f0ff 0%, #c2e0ff 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 16px;
        flex-shrink: 0;
        box-shadow: 0 2px 6px rgba(0, 122, 255, 0.15);
    }
    .ios-icon-wrapper i {
        color: #007aff;
        font-size: 1.2rem;
    }
    .ios-row-title {
        margin: 0;
        font-size: 1.1rem;
        font-weight: 600;
        color: #1c1c1e;
        letter-spacing: -0.015em;
    }
    .ios-row-subtitle {
        margin: 4px 0 0 0;
        font-size: 0.85rem;
        color: #8e8e93;
        font-weight: 400;
    }
    .ios-more-btn {
        background: #f2f2f7;
        border: none;
        border-radius: 50%;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #8e8e93;
        transition: all 0.2s;
    }
    .ios-more-btn:active {
        background: #e5e5ea;
        transform: scale(0.95);
    }
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Songs</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Song</li>
                    </ol>
                </div><!-- /.col -->
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="ios-card">
                <div class="ios-card-header" style="margin-bottom: 0; padding-bottom: 5px; border-bottom: 1px solid #f2f2f7;">
                    <h3 class="ios-card-title" style="font-weight: 700; color: #1c1c1e; font-size: 1.3rem;">Songs Filter</h3>
                </div>
                <div class="card-body" style="padding-top: 10px;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Song Category</label>
                                <select class="form-control select2" multiple="multiple" name="category[]" id="category"
                                    data-placeholder="Select Category" style="width: 100%;">
                                    <!-- <option selected="selected" disabled value="">Select Category</option> -->
                                    <option value="1">Pure Praise</option>
                                    <option value="2">Praise</option>
                                    <option value="3">Addoration</option>
                                    <option value="4">Worship</option>


                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Language</label>
                                <select class="form-control select2" multiple="multiple" name="language[]" id="language"
                                    data-placeholder="Select Language" style="width: 100%;">
                                    <option value="1">Hindi</option>
                                    <option value="2">English</option>
                                    <option value="3">Marathi</option>

                                </select>
                            </div>
                        </div>
                    </div>
                </div><!-- /.card-body -->
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content" id="songlistcontent" style="display: none;">
        <div class="container-fluid">
                <div id="song_tbody"></div>
        </div>
    </section>
</div>
@include('footer')


<!-- jquery-validation -->
<script src='{{asset("plugins/jquery-validation/jquery.validate.min.js")}}'></script>
<script src='{{asset("plugins/jquery-validation/additional-methods.min.js")}}'></script>
<!-- AdminLTE App -->




@if(session('response'))
<script>alert("{{ session('response') }}");</script>
@endif
<!-- AdminLTE for demo purposes -->
<!-- <script src="../../dist/js/demo.js"></script> -->
<script>
    $(function () {


        $('.select2').select2({
            minimumResultsForSearch: Infinity
        }).on('select2:opening select2:closing', function( event ) {
            var $searchfield = $(this).parent().find('.select2-search__field');
            $searchfield.prop('readonly', true);
        });
        
        // Force readonly on any existing search fields to prevent mobile keyboard
        $('.select2-search__field').prop('readonly', true);

        $('#category').on('change', function () {
            $('#language').val('').trigger('change');

        });  
        $('#language').on('change', function () {
            if($('#language').val() != null && $('#language').val() != ''){

                $('#song_tbody').empty();
                $.ajax({
                    url: '/get-songs-data',
                    method: 'post',
                    dataType: 'json',
                    "headers": { 'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content') },
                    data: {
                        category: $('#category').val(),
                        language: $('#language').val(),
                    },
                    success: function (data) {
                        data = data.msg;
                        tbody = `<div class="ios-list-group">`;
                        var all_songsid = data.map(function(val) { return val.id; }).join(',');
                        
                        $.each(data, function (key, val) {
                            var isLast = (key === data.length - 1) ? 'border-bottom: none;' : 'border-bottom: 1px solid #e5e5ea;';
                            var iosRow = `
                            <div class="ios-list-row" style="${isLast}">
                                <div style="display: flex; align-items: center; flex: 1; min-width: 0;">
                                    <div class="ios-icon-wrapper">
                                        <i class="fas fa-music"></i>
                                    </div>
                                    <div style="flex: 1; min-width: 0;">
                                        <h5 class="ios-row-title text-truncate">${val.song_title}</h5>
                                        <p class="ios-row-subtitle">Song #${val.id}</p>
                                    </div>
                                </div>
                                <div class="dropdown" style="flex-shrink: 0; margin-left: 12px;">
                                    <button class="ios-more-btn dropdown-toggle" type="button" id="dropdownMenuButton${val.id}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="box-shadow: none;">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right border-0" aria-labelledby="dropdownMenuButton${val.id}" style="border-radius: 14px; box-shadow: 0 10px 30px rgba(0,0,0,0.12); padding: 8px; min-width: 180px; margin-top: 8px;">
                                        <a class="dropdown-item presentSongBtn" href="#" data-songid="${val.id}" data-all_songsid="${all_songsid}" style="border-radius: 8px; padding: 10px 15px; font-weight: 500;">
                                            <i class="fas fa-play text-primary mr-2" style="width: 20px;"></i> Present
                                        </a>
                                        <a class="dropdown-item scheduleSongBtn" href="#" data-songid="${val.id}" style="border-radius: 8px; padding: 10px 15px; font-weight: 500;">
                                            <i class="fas fa-clock text-warning mr-2" style="width: 20px;"></i> Schedule
                                        </a>
                                        <div class="dropdown-divider my-1"></div>
                                        <a class="dropdown-item editSongBtn" href="#" data-songid="${val.id}" style="border-radius: 8px; padding: 10px 15px; font-weight: 500;">
                                            <i class="fas fa-edit text-info mr-2" style="width: 20px;"></i> Edit
                                        </a>
                                    </div>
                                </div>
                            </div>`;
                            tbody += iosRow;
                        });
                        tbody += `</div>`;
                        $('#song_tbody').append(tbody);
                        $('#songlistcontent').show();
                        $('.presentSongBtn').on('click', function (e) {
                            e.preventDefault();
                            var songid = $(this).data("songid");
                            var all_songsid = $(this).data("all_songsid");
                            var route = "{{ url('present-song') }}/" + songid;
                            window.open(route, '_blank');
                        });
                        $('.editSongBtn').on('click', function (e) {
                            e.preventDefault();
                            var songid = $(this).data("songid");
                            var route = "{{ url('edit-song') }}/" + songid;
                            window.open(route, '_self');
                        });
                        $('.scheduleSongBtn').on('click', function (e) {
                            e.preventDefault();
                            var songid = $(this).data("songid");
                            console.log(songid);
                            $.ajax({
                                url: "{{ url('schedule-song') }}",  // Route name
                                type: "POST",
                                data: {
                                    _token: "{{ csrf_token() }}", // Include CSRF token
                                    song_id: songid  // Example data
                                },
                                success: function (response) {
                                    alert(response.message); // Show response message
                                },
                                error: function (xhr) {
                                    console.log(xhr.responseText);
                                }
                            });
                        });
    
                        // do something with data returned
                    },
                    error: function (data) {
                        // handle error
                    }
                });
            }

            // Does some stuff and logs the event to the console
        });




    });

    $(document).ready(function () {
        $('body .nav-item:not(:has(.nav-treeview))').on('click', function () {

            if ($('body').hasClass('sidebar-collapse')) {


                $('body').removeClass('sidebar-collapse')
                $(window).trigger('resize')
            } else {
                $('body').addClass('sidebar-collapse')
                $(window).trigger('resize')
            }

        });

    });
</script>

