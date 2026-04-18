@include('header')

<!-- Content Wrapper. Contains page content -->
<style>
    .select2-container--default .select2-selection--single {
        padding-bottom: 29px;
    }

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
        transform: scale(0.98);
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
    .ios-btn-info i, .ios-btn-danger i, .ios-btn-primary i { font-size: 1.1rem; }
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Schedule Songs</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
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

<!-- Bootstrap 4 -->
<script src='{{asset("plugins/bootstrap/js/bootstrap.bundle.min.js")}}'></script>
<!-- jquery-validation -->
<script src='{{asset("plugins/jquery-validation/jquery.validate.min.js")}}'></script>
<script src='{{asset("plugins/jquery-validation/additional-methods.min.js")}}'></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>




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
    var str = songs_id.join([songs_id = ',']);
   
    tbody = ``;
    $.each(data, function (key, val) {

        var iosCard = `
        <div class="ios-card" style="padding: 16px;">
            <div class="ios-card-header" style="margin-bottom: 0;">
                <div class="toggle-lyrics" style="cursor:pointer; display:flex; align-items:center; flex:1; min-width: 0;">
                    <h5 class="ios-card-title text-truncate" style="flex:1; margin-right: 5px;">${(key+1)+'. '+val.song_title}</h5>
                    <i class="fas fa-chevron-down text-muted rotate-icon" style="margin-right: 10px; font-size: 0.8rem;"></i>
                </div>
                <div class="ios-card-actions-inline">
                    <button data-songid=${val.id} data-all_songsid='${str}' class="ios-btn-small ios-btn-primary presentSongBtn" title="Present">
                        <i class="fas fa-play"></i>
                    </button>
                    <button data-songid=${val.id} class="ios-btn-small ios-btn-info editSongBtn" title="Edit">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button data-id=${val.sid} class="ios-btn-small ios-btn-danger removeSongBtn" title="Remove">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </div>
            <div class="ios-lyrics" style="display: none; margin-top: 16px; border-top: 1px solid #f2f2f7; padding-top: 16px;">`;
            
            $.each(JSON.parse(val.song_para), function (parakey, paraval) {
                iosCard += `<pre style="background: #f9f9f9; border-radius: 12px; padding: 12px; font-family: inherit; font-size: 0.95rem; border: 1px solid rgba(0,0,0,0.03); margin-bottom: 10px; color: #3a3a3c; white-space: pre-wrap;">${paraval}</pre>`;
            });

            iosCard +=`</div>
        </div>
        `;
        $('#accordion').append(iosCard);

    });
    $('#song_tbody').append(tbody);
    $('#songlistcontent').show();
    $('.presentSongBtn').on('click', function () {

        var songid = $(this).data("songid");
        // var all_songsid = $(this).data("all_songsid");
        var route = "{{ url('present-song') }}/" + songid;
        window.open(route, '_blank');

    });
    $('.removeSongBtn').on('click', function () {
        var id = $(this).data("id");

        $.ajax({
            url: "{{ url('remove-schedule-song') }}",  // Route name
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}", // Include CSRF token
                sid: id  // Example data
            },
            success: function (response) {
                alert(response.message);
                location.reload(); // Show response message
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }


        });

    });
    
    $('#removeAllSongsBtn').on('click', function () {
        if(confirm('Are you sure you want to remove ALL scheduled songs?')) {
            $.ajax({
                url: "{{ url('remove-all-schedule-songs') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    alert(response.message);
                    location.reload();
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        }
    });
    
    $('.editSongBtn').on('click', function () {
        var songid = $(this).data("songid");
        var route = "{{ url('edit-song') }}/" + songid;
        window.open(route, '_self');
    });

    $(document).ready(function () {
        $('body .nav-item').on('click', function () {

            if ($('body').hasClass('sidebar-collapse')) {


                $('body').removeClass('sidebar-collapse')
                $(window).trigger('resize')
            } else {
                $('body').addClass('sidebar-collapse')
                $(window).trigger('resize')
            }

        });

        $(document).on("click", ".toggle-lyrics", function () {
            var cardBody = $(this).closest(".ios-card").find(".ios-lyrics");
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
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>