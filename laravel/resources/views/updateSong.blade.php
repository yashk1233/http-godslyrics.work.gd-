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
                    <h1 class="m-0">Update Song</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Update Song</li>
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
                            <h3 class="ios-card-title">Update Song</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <form method="post" action="/update-song" id="quickForm" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="song_id" value="{{ $song->id }}">
                            <input type="hidden" name="redirect_to" value="{{ $redirect_to ?? '/view-songs' }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="news-title">Song Title</label>
                                            <input type="text" name="song_title" class="form-control ios-input" id="song-title"
                                                placeholder="Enter Song Title" value="{{ $song->song_title }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Song Category</label>
                                            <select class="form-control select2" multiple="multiple" name="category[]"
                                                id="category" data-placeholder="Select Category" style="width: 100%;">
                                                <option value="1" {{ in_array(1, $selectedCategories) ? 'selected' : '' }}>Pure Praise</option>
                                                <option value="2" {{ in_array(2, $selectedCategories) ? 'selected' : '' }}>Praise</option>
                                                <option value="3" {{ in_array(3, $selectedCategories) ? 'selected' : '' }}>Addoration</option>
                                                <option value="4" {{ in_array(4, $selectedCategories) ? 'selected' : '' }}>Worship</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Language</label>
                                            <select class="form-control select2" name="language" id="language"
                                                data-placeholder="Select Language" style="width: 100%;">
                                                <option disabled value="">Select Language</option>
                                                <option value="1" {{ $language == 1 ? 'selected' : '' }}>Hindi</option>
                                                <option value="2" {{ $language == 2 ? 'selected' : '' }}>English</option>
                                                <option value="3" {{ $language == 3 ? 'selected' : '' }}>Marathi</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <label>Song Para's</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="songParaSection">
                                            @php
                                                $paragraphs = json_decode($song->song_para, true) ?? [];
                                            @endphp
                                            @if(count($paragraphs) > 0)
                                                @foreach($paragraphs as $index => $para)
                                                    <div class="form-group para-container position-relative">
                                                        <textarea class="form-control ios-input song_para" rows="4" name="song_para[{{ $index }}]"
                                                            style=" margin-bottom: 20px; padding-right: 40px;" placeholder="Enter ...">{{ $para }}</textarea>
                                                        @if($index > 0)
                                                        <button type="button" class="btn btn-sm btn-danger remove-para position-absolute" style="top: 10px; right: 10px; border-radius: 50%; width: 30px; height: 30px; padding: 0; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 4px rgba(0,0,0,0.2);"><i class="fas fa-times"></i></button>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="form-group para-container position-relative">
                                                    <textarea class="form-control ios-input song_para" rows="4" name="song_para[0]"
                                                        style=" margin-bottom: 20px; padding-right: 40px;" placeholder="Enter ..."></textarea>
                                                </div>
                                            @endif
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
                                <button type="button" id="update-btn" class="ios-btn ios-btn-primary" style="width: 100%;">Update</button>
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
<script src="../../dist/js/adminlte.min.js"></script>

@if(session('response'))
<script>alert("{{ session('response') }}");</script>
@endif
<script>
    $(function () {
        var paraCounter = {{ count(json_decode($song->song_para, true) ?? []) }};
        if(paraCounter == 0) paraCounter = 1;

        $('.select2').select2({
            minimumResultsForSearch: Infinity
        }).on('select2:opening select2:closing', function( event ) {
            var $searchfield = $(this).parent().find('.select2-search__field');
            $searchfield.prop('disabled', true);
        });
        
        // Force readonly on any existing search fields to prevent mobile keyboard
        $('.select2-search__field').prop('readonly', true);

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
        $('#update-btn').on('click', function(e) {
            e.preventDefault();
            requirePin(function() {
                $('#quickForm').submit();
            });
        });
        
        $('#quickForm').validate({
            rules: {
                song_title: {
                    required: true,
                    maxlength: 225,
                    minlength: 5,
                },
                "category[]": {
                    required: true
                },
                language: {
                    required: true
                },
                ".song_para": {
                    required: true
                }
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

</script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
