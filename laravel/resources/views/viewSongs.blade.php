@include('header')

<!-- Content Wrapper. Contains page content -->
<style>
    .select2-container--default .select2-selection--single {
        padding-bottom: 29px;
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
                <div class="ios-card-header" style="margin-bottom: 0;">
                    <h3 class="ios-card-title">Songs Filter</h3>
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

<!-- Bootstrap 4 -->
<script src='{{asset("plugins/bootstrap/js/bootstrap.bundle.min.js")}}'></script>
<!-- jquery-validation -->
<script src='{{asset("plugins/jquery-validation/jquery.validate.min.js")}}'></script>
<script src='{{asset("plugins/jquery-validation/additional-methods.min.js")}}'></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>




@if(session('response'))
<script>alert("{{ session('response') }}");</script>
@endif
<!-- AdminLTE for demo purposes -->
<!-- <script src="../../dist/js/demo.js"></script> -->
<script>
    $(function () {


        $('.select2').select2();
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
                        tbody = ``;
                        var all_songsid = data.map(function(val) { return val.id; }).join(',');
                        
                        $.each(data, function (key, val) {
                            var iosCard = `
                            <div class="ios-card" style="padding: 16px;">
                                <div class="ios-card-header" style="margin-bottom: 0;">
                                    <h5 class="ios-card-title text-truncate" style="flex:1; margin-right: 10px; min-width: 0;">${(key+1)+'. '+val.song_title}</h5>
                                    <div class="ios-card-actions-inline">
                                        <button data-songid=${val.id} data-all_songsid="${all_songsid}" type="button" class="ios-btn-small ios-btn-primary presentSongBtn" title="Present">
                                            <i class="fas fa-play"></i>
                                        </button>
                                        <button data-songid=${val.id} type="button" class="ios-btn-small ios-btn-success scheduleSongBtn" title="Schedule">
                                            <i class="fas fa-clock"></i>
                                        </button>
                                        <button data-songid=${val.id} type="button" class="ios-btn-small ios-btn-info editSongBtn" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>`;
                            tbody += iosCard;
                        });
                        $('#song_tbody').append(tbody);
                        $('#songlistcontent').show();
                        $('.presentSongBtn').on('click', function () {
                            var songid = $(this).data("songid");
                            var all_songsid = $(this).data("all_songsid");
                            var route = "{{ url('present-song') }}/" + songid;
                            window.open(route, '_blank');
    
                        });
                        $('.editSongBtn').on('click', function () {
                            var songid = $(this).data("songid");
                            var route = "{{ url('edit-song') }}/" + songid;
                            window.open(route, '_self');
                        });
                        $('.scheduleSongBtn').on('click', function () {
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
        $('body .nav-item').on('click', function () {

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
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
