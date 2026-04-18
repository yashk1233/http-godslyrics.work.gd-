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
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Songs</h3>
                </div> <!-- /.card-body -->
                <div class="card-body">
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
                                <select class="form-control select2" name="language" id="language"
                                    data-placeholder="Select Language" style="width: 100%;">
                                    <option selected="selected" disabled value="">Select Language</option>
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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Songs List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="songlisttable" class="table table-bordered text-nowrap">
                            <thead>
                                <tr>
                                    <!-- <th>Sr.No</th> -->
                                    <th style="white-space: normal; width: 100%;">Song Name</th>
                                    <th style="white-space: nowrap;">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="song_tbody">

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->

                </div>
                <!-- /.card -->


                <!-- /.card -->
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
                            tbody += `<tr>`;
                            // tbody += `<td>${key + 1}</td>`;
                            tbody += `<td style="white-space: normal;">${val.song_title}</td>`;
                            tbody += `<td style="white-space: nowrap;">
                                <button data-songid=${val.id} data-all_songsid="${all_songsid}" type="button" class="presentSongBtn btn btn-primary btn-sm"><i class="fas fa-play"></i></button>
                                <button data-songid=${val.id} type="button" class="scheduleSongBtn btn btn-success btn-sm"><i class="fas fa-clock"></i></button>
                                <button data-songid=${val.id} type="button" class="editSongBtn btn btn-info btn-sm"><i class="fas fa-edit"></i></button>
                            </td>`;
                            tbody += `</tr>`;
                        });
                        $('#song_tbody').append(tbody);
                        $('#songlistcontent').show();
                        $('.presentSongBtn').on('click', function () {
                            var songid = $(this).data("songid");
                            var all_songsid = $(this).data("all_songsid");
                            var route = "{{ url('present-song') }}/" + songid + "/" + all_songsid;
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
