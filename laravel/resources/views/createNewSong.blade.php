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
                    <h1 class="m-0">Create New Song</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Create New Song</li>
                    </ol>
                </div><!-- /.col -->
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="ios-card">
                        <div class="ios-card-header">
                            <h3 class="ios-card-title">Create New Song</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <form method="post" action="/save-new-song" id="quickForm" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="news-title">Song Title</label>
                                            <input type="text" name="song_title" class="form-control ios-input" id="song-title"
                                                placeholder="Enter Song Title">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Song Category</label>
                                            <select class="form-control select2" multiple="multiple" name="category[]"
                                                id="category" data-placeholder="Select Category" style="width: 100%;">
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

                                <label>Song Para's</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="songParaSection">
                                            <div class="form-group para-container position-relative">
                                                <textarea class="form-control ios-input song_para" rows="4" name="song_para[0]"
                                                    style=" margin-bottom: 20px; padding-right: 40px;" placeholder="Enter ..."></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12" style=" display: flex; justify-content: center; ">
                                        <button id="add_para" style="width: auto; min-width: 60px; padding: 6px 12px;" type="button"
                                            class="ios-btn ios-btn-info"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer" style="background: transparent; border-top: none;">
                                <button type="submit" class="ios-btn ios-btn-primary" style="width: 100%;">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
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
        var paraCounter = 1;

        $('.select2').select2();

        // //Initialize Select2 Elements
        // $('.select2bs4').select2({
        //     theme: 'bootstrap4'
        // })

        $('input[type="file"]').change(function (e) {
            var fileName = e.target.files[0].name;
            $('.custom-file-label').html(fileName);
        });
        $("#add_para").click(function () {
            $('#songParaSection').append(`
                <div class="form-group para-container position-relative">
                    <textarea class="form-control ios-input song_para" rows="4" name="song_para[${paraCounter}]" style=" margin-bottom: 20px; padding-right: 40px;" placeholder="Enter ..."></textarea>
                    <button type="button" class="btn btn-sm btn-danger remove-para position-absolute" style="top: 10px; right: 10px; border-radius: 50%; width: 30px; height: 30px; padding: 0; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 4px rgba(0,0,0,0.2);"><i class="fas fa-times"></i></button>
                </div>
            `);
            paraCounter++;
            jQuery.validator.addClassRules('song_para', {
                required: true /*,
                other rules */
            });
        });

        $(document).on('click', '.remove-para', function() {
            $(this).closest('.para-container').fadeOut(300, function() {
                $(this).remove();
            });
        });
        jQuery.validator.addClassRules('song_para', {
            required: true /*,
        other rules */
        });
        $('#quickForm').validate({
            rules: {
                song_title: {
                    required: true,
                    maxlength: 225,
                    minlength: 5,
                },
                news_description: {
                    required: true,
                    minlength: 3,
                    // maxlength: 500
                },
                "category[]": {
                    required: true
                },
                language: {
                    required: true
                },
                ".song_para": {
                    required: true
                },
                language: {
                    required: true
                },
                city: {
                    required: true
                },
                country: {
                    required: true
                },
                news_banner_image: {
                    required: true,
                    extension: "png|jpeg|jpg"
                },
            },
            messages: {
                email: {
                    required: "Please enter a email address",
                    email: "Please enter a valid email address"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                terms: "Please accept our terms"
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });

    // $('body .nav-item').on('click', function () {
        
    //     if ($('body').hasClass('sidebar-collapse')) {


    //         $('body').removeClass('sidebar-collapse')
    //         $(window).trigger('resize')
    //     } else {
    //         $('body').addClass('sidebar-collapse')
    //         $(window).trigger('resize')
    //     }

    // });
</script>


