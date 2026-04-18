@include('header')

<!-- Content Wrapper. Contains page content -->
<style>
    .select2-container--default .select2-selection--single {
        padding-bottom: 29px;
    }

    .rotate-icon {
        transition: transform 0.3s ease-in-out;
    }

    .rotate {
        transform: rotate(180deg);
    }

    /* Hide body initially */
    .card-body {
        display: none;
        border-top: 1px solid #dee2e6;
        padding: 15px;
    }

    /* Flexbox for Bifurcation */
    .content-layout {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Align buttons to the right */
    .btn-group-custom {
        display: flex;
        gap: 10px;
    }

    .present-remove-btn{
        background: #f3f3f3;
    padding: 12px;
    margin: -8px;
    border-radius: 5px;
    }
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
    console.log(str);

    console.log(data);
    tbody = ``;
    $.each(data, function (key, val) {

        var accordian = `
        <div class="card card-primary card-outline">
                            <div class="card-header toggle-section">
                                <h5 class="mb-0 d-flex justify-content-between align-items-center w-100">
                                    ${(key+1)+'. '+val.song_title}
                                    <i class="fas fa-chevron-down rotate-icon"></i>
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="btn-group-custom present-remove-btn">
                                    <button  data-songid=${val.id} data-all_songsid='${str}' class="btn btn-primary presentSongBtn btn-sm">Present</button>

                                    <button data-id=${val.sid} class="btn btn-danger removeSongBtn btn-sm">Remove</button>
                                    <button data-songid=${val.id} class="btn btn-info editSongBtn btn-sm">Edit</button>
                                </div>
                                <br>
                                <div class="">`;

                                    $.each(JSON.parse(val.song_para), function (parakey, paraval) {
                                        accordian += `<pre style=" background: #f5f3f3;    border-radius: 5px; ">${paraval}</pre>`;

                                    });

                                    // <p>Content for section 1.</p>

                                    accordian +=`  </div>
                            </div>
                        </div>
        `;
        tbody += `<tr>`;
        // tbody += `<td>${key + 1}</td>`;
        tbody += `<td>${val.song_title}</td>`;
        tbody += `<td><button  style="width: auto;" data-songid=${val.id} type="button" class=" presentSongBtn btn btn-primary btn-block"><i class="fas fa-play"></i></button></td>`;
        tbody += `<td><button  style="width: auto;" data-id=${val.sid} type="button" class=" removeSongBtn btn btn-danger btn-block"><i class="fas fa-times"></i></button></td>`;
        tbody += `</tr>`;
        $('#accordion').append(accordian);

    });
    $('#song_tbody').append(tbody);
    $('#songlistcontent').show();
    $('.presentSongBtn').on('click', function () {

        var songid = $(this).data("songid");
        var all_songsid = $(this).data("all_songsid");
        var route = "{{ url('present-song') }}/" + songid+'/'+all_songsid;
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

        $(".toggle-section").click(function () {
            var cardBody = $(this).next(".card-body"); // Target the next card-body
            var icon = $(this).find(".rotate-icon");

            if (cardBody.is(":visible")) {
                cardBody.slideUp(); // Close current
                icon.removeClass("rotate"); // Reset icon
            } else {
                $(".card-body").slideUp(); // Close all other sections
                $(".rotate-icon").removeClass("rotate"); // Reset all icons

                cardBody.slideDown(); // Open clicked section
                icon.addClass("rotate"); // Rotate icon
            }
        });

    });
</script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>