@include('header', ['mobile_title' => 'Schedule Songs'])

<!-- Content Wrapper. Contains page content -->
<style>
    .select2-container--default .select2-selection--single {
        padding-bottom: 29px;
    }

<style>
    .select2-container--default .select2-selection--single {
        padding-bottom: 29px;
    }

    .ios-list-group {
        background: #ffffff;
        border-radius: 14px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.03), 0 1px 4px rgba(0, 0, 0, 0.03);
        margin-bottom: 24px;
        border: 1px solid rgba(0,0,0,0.04);
    }
    .ios-list-row-container {
        background: transparent;
        transition: background-color 0.15s ease;
    }
    .ios-list-row-container:first-child {
        border-top-left-radius: 14px;
        border-top-right-radius: 14px;
    }
    .ios-list-row-container:last-child {
        border-bottom-left-radius: 14px;
        border-bottom-right-radius: 14px;
    }
    .ios-list-row {
        padding: 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
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
    .ios-more-btn.dropdown-toggle::after {
        display: none;
    }
    
    .ios-dark-dropdown {
        border-radius: 14px !important;
        box-shadow: 0 10px 40px rgba(0,0,0,0.3) !important;
        padding: 0 !important;
        min-width: 200px !important;
        margin-top: 8px !important;
        border: 1px solid rgba(255,255,255,0.1) !important;
        background: rgba(28, 28, 30, 0.95) !important;
        backdrop-filter: blur(20px) !important;
        -webkit-backdrop-filter: blur(20px) !important;
        overflow: hidden !important;
    }
    .ios-dark-item {
        padding: 16px 20px !important;
        font-weight: 500 !important;
        font-size: 1rem !important;
        color: #ffffff !important;
        display: flex !important;
        align-items: center !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
        transition: background-color 0.2s !important;
        background: transparent !important;
    }
    .ios-dark-item:last-child {
        border-bottom: none !important;
    }
    .ios-dark-item:hover, .ios-dark-item:active {
        background-color: rgba(255,255,255,0.15) !important;
        color: #ffffff !important;
    }
    .ios-dark-item i {
        font-size: 1.1rem !important;
        width: 28px !important;
        text-align: left;
        margin-right: 12px !important;
        color: #ffffff !important;
    }
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Schedule Songs</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Schedule Song</li>
                    </ol>
                </div><!-- /.col -->
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            
            <input type="hidden" id="songData" value='@json($data)'>

            <div class="row mb-3">
                <div class="col-md-12 d-flex ">
                    <a href="javascript:void(0)" id="removeAllSongsBtn" class="text-primary">Remove All Schedule</a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div id="accordion">

                        



                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->


    </section>


    <section class="content" id="songlistcontent" style="display: none;">
        <div class="container-fluid">


        </div>
    </section>
</div>
@include('footer')


<!-- jquery-validation -->
<script src='{{asset("plugins/jquery-validation/jquery.validate.min.js")}}'></script>
<script src='{{asset("plugins/jquery-validation/additional-methods.min.js")}}'></script>
<!-- AdminLTE App -->




<!-- AdminLTE for demo purposes -->
<!-- <script src="../../dist/js/demo.js"></script> -->
<script>
    $(function () {


        $('.select2').select2();

    });

    var data = JSON.parse(document.getElementById("songData").value);

    const arrayColumn = (array, column) => {
        return array.map(item => item[column]);
    };
    var songs_id = arrayColumn(data, 'id');
    var str = songs_id.join(',');
   
    tbody = `<div class="ios-list-group">`;
    $.each(data, function (key, val) {
        var isLast = (key === data.length - 1) ? 'border-bottom: none;' : 'border-bottom: 1px solid #e5e5ea;';
        var iosCard = `
        <div class="ios-list-row-container" style="${isLast}">
            <div class="ios-list-row">
                <div class="toggle-lyrics" style="cursor:pointer; display:flex; align-items:center; flex:1; min-width: 0;">
                    <div class="ios-icon-wrapper" style="width: 40px; height: 40px; margin-right: 14px;">
                        <i class="fas fa-music" style="font-size: 1.1rem;"></i>
                    </div>
                    <div style="flex: 1; min-width: 0; padding-right: 10px;">
                        <h5 class="ios-row-title text-truncate">${val.song_title}</h5>
                        <p class="ios-row-subtitle">Song #${key+1}</p>
                    </div>
                    <i class="fas fa-chevron-down text-muted rotate-icon" style="margin-right: 10px; font-size: 0.8rem;"></i>
                </div>
                <div class="ios-card-actions-inline" style="display: flex; align-items: center; flex-shrink: 0;">
                    <div class="dropdown">
                        <button class="ios-more-btn dropdown-toggle" type="button" id="dropdownMenuButton${val.id}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="box-shadow: none;">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right ios-dark-dropdown" aria-labelledby="dropdownMenuButton${val.id}">
                            <a class="dropdown-item ios-dark-item presentSongBtn" href="#" data-songid="${val.id}" data-all_songsid="${str}">
                                <i class="fas fa-step-forward"></i> Present
                            </a>
                            <a class="dropdown-item ios-dark-item editSongBtn" href="#" data-songid="${val.id}">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a class="dropdown-item ios-dark-item removeSongBtn" href="#" data-id="${val.sid}">
                                <i class="fas fa-trash-alt"></i> Remove
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ios-lyrics" style="display: none; padding: 0 16px 16px 16px; border-top: 1px dashed #e5e5ea; padding-top: 16px; margin: 0 16px;">
                <h6 style="margin-bottom: 12px; font-weight: 600; color: #1c1c1e; font-size: 1.05rem;">${val.song_title}</h6>`;
            
            $.each(JSON.parse(val.song_para), function (parakey, paraval) {
                iosCard += `<pre style="background: #f9f9f9; border-radius: 12px; padding: 12px; font-family: inherit; font-size: 0.95rem; border: 1px solid rgba(0,0,0,0.03); margin-bottom: 10px; color: #3a3a3c; white-space: pre-wrap;">${paraval}</pre>`;
            });

            iosCard +=`</div>
        </div>
        `;
        tbody += iosCard;
    });
    tbody += `</div>`;
    $('#accordion').append(tbody);
    $('#song_tbody').append(tbody);
    $('#songlistcontent').show();
    $('.presentSongBtn').on('click', function () {

        var songid = $(this).data("songid");
        var all_songsid = $(this).data("all_songsid");
        var route = "{{ url('present-song') }}/" + songid;
        if (all_songsid) {
            route += "/" + all_songsid;
        }
        window.open(route, '_blank');

    });
    $('.removeSongBtn').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data("id");

        requirePin(function() {
            $.ajax({
                url: "{{ url('remove-schedule-song') }}",  // Route name
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}", // Include CSRF token
                    sid: id  // Example data
                },
                success: function (response) {
                    alert(response.message, function() {
                        location.reload();
                    });
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }


            });
        });

    });
    
    $('#removeAllSongsBtn').on('click', function () {
        requirePin(function() {
            iosConfirm('Are you sure you want to remove ALL scheduled songs?', function() {
                $.ajax({
                    url: "{{ url('remove-all-schedule-songs') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        alert(response.message, function() {
                            location.reload();
                        });
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    });
    
    $('.editSongBtn').on('click', function (e) {
        e.preventDefault();
        var songid = $(this).data("songid");
        var route = "{{ url('edit-song') }}/" + songid;
        window.open(route, '_self');
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

        $(document).on("click", ".toggle-lyrics", function () {
            var cardBody = $(this).closest(".ios-list-row-container").find(".ios-lyrics");
            var icon = $(this).find(".rotate-icon");

            if (cardBody.is(":visible")) {
                cardBody.slideUp(250); 
                icon.removeClass("rotate"); 
            } else {
                $(".ios-lyrics").slideUp(250); 
                $(".rotate-icon").removeClass("rotate"); 

                cardBody.slideDown(250); 
                icon.addClass("rotate"); 
            }
        });

    });
</script>