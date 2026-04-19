@include('header', ['mobile_title' => 'Update Song'])

<!-- Content Wrapper. Contains page content -->
<style>
    .select2-container--default .select2-selection--single {
        padding-bottom: 29px;
    }
    .para-container {
        transition: all 0.3s ease;
    }
    .song_para {
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 1px solid #f2f2f7 !important;
        background: #f9f9f9 !important;
        box-shadow: inset 0 1px 2px rgb(0 0 0 / 11%) !important;
    }
    .song_para:focus {
        background: #ffffff !important;
        border-color: #007aff !important;
        box-shadow: 0 10px 25px rgba(0, 122, 255, 0.08), 0 0 0 4px rgba(0, 122, 255, 0.1) !important;
        transform: translateY(-4px) scale(1.01);
        z-index: 5;
    }
    .remove-para {
        transition: all 0.2s ease;
    }
    .remove-para:active {
        transform: scale(0.8);
    }
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header" style="padding-bottom: 0;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="m-0" style="font-weight: 800; font-size: 2.2rem; letter-spacing: -0.04em; color: #1c1c1e;">Update Song</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb" style="background: transparent; padding: 0; margin: 8px 0 20px 8px;">
                            <li class="breadcrumb-item"><a href="{{url('/')}}" style="color: #007aff;">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page" style="color: #8e8e93;">Update Song</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="ios-card" style="padding: 0; overflow: hidden; background: transparent; box-shadow: none; border: none;">

                        <form method="post" action="/update-song" id="quickForm" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="song_id" value="{{ $song->id }}">
                            <input type="hidden" name="redirect_to" value="{{ $redirect_to ?? '/view-songs' }}">
                            <div class="card-body" style="padding: 0;">
                                <!-- Top Info Section -->
                                <div style="background: #ffffff; border-radius: 18px; padding: 20px; margin-bottom: 24px; box-shadow: 0 4px 20px rgba(0,0,0,0.04); border: 1px solid rgba(0,0,0,0.01);">
                                    <div class="form-group" style="margin-bottom: 20px;">
                                        <label style="font-weight: 600; color: #8e8e93; margin-bottom: 8px; display: block; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.05em; padding-left: 4px;">Song Title</label>
                                        <input type="text" name="song_title" class="form-control ios-input" id="song-title" placeholder="Enter Song Title" value="{{ $song->song_title }}" style="font-size: 1.1rem; padding: 16px; background: #f9f9f9; border: 1px solid #f2f2f7; border-radius: 14px; font-weight: 500;">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group" style="margin-bottom: 20px;">
                                                <label style="font-weight: 600; color: #8e8e93; margin-bottom: 8px; display: block; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.05em; padding-left: 4px;">Song Category</label>
                                                <select class="form-control select2" multiple="multiple" name="category[]" id="category" data-placeholder="Select Category" style="width: 100%;">
                                                    <option value="1" {{ in_array(1, $selectedCategories) ? 'selected' : '' }}>Pure Praise</option>
                                                    <option value="2" {{ in_array(2, $selectedCategories) ? 'selected' : '' }}>Praise</option>
                                                    <option value="3" {{ in_array(3, $selectedCategories) ? 'selected' : '' }}>Addoration</option>
                                                    <option value="4" {{ in_array(4, $selectedCategories) ? 'selected' : '' }}>Worship</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group" style="margin-bottom: 0;">
                                                <label style="font-weight: 600; color: #8e8e93; margin-bottom: 8px; display: block; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.05em; padding-left: 4px;">Language</label>
                                                <select class="form-control select2" name="language" id="language" data-placeholder="Select Language" style="width: 100%;">
                                                    <option disabled value="">Select Language</option>
                                                    <option value="1" {{ $language == 1 ? 'selected' : '' }}>Hindi</option>
                                                    <option value="2" {{ $language == 2 ? 'selected' : '' }}>English</option>
                                                    <option value="3" {{ $language == 3 ? 'selected' : '' }}>Marathi</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Paragraphs Section -->
                                <div style="background: #ffffff; border-radius: 18px; padding: 20px; margin-bottom: 24px; box-shadow: 0 4px 20px rgba(0,0,0,0.04); border: 1px solid rgba(0,0,0,0.01);">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                                        <label style="font-weight: 700; color: #1c1c1e; margin: 0; font-size: 1.2rem; letter-spacing: -0.02em;">Song Paragraphs</label>
                                    </div>
                                    
                                    <div id="songParaSection">
                                        @php
                                            $paragraphs = json_decode($song->song_para, true) ?? [];
                                        @endphp
                                        @if(count($paragraphs) > 0)
                                            @foreach($paragraphs as $index => $para)
                                                <div class="form-group para-container position-relative" style="margin-bottom: 20px;">
                                                    <textarea class="form-control ios-input song_para" rows="4" name="song_para[{{ $index }}]" style="border-radius: 18px; padding: 18px; font-size: 1.15rem; line-height: 1.6; resize: vertical; width: 100%; box-sizing: border-box; font-weight: 400; color: #1c1c1e;" placeholder="Enter paragraph text...">{{ $para }}</textarea>
                                                    @if($index > 0)
                                                    <button type="button" class="btn btn-sm btn-danger remove-para position-absolute" style="top: -8px; right: -8px; z-index: 10; border-radius: 50%; width: 28px; height: 28px; padding: 0; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(255,59,48,0.3); border: none; background: #ff3b30;"><i class="fas fa-times" style="font-size: 0.8rem;"></i></button>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="form-group para-container position-relative" style="margin-bottom: 20px;">
                                                <textarea class="form-control ios-input song_para" rows="4" name="song_para[0]" style="border-radius: 18px; padding: 18px; font-size: 1.15rem; line-height: 1.6; resize: vertical; width: 100%; box-sizing: border-box; font-weight: 400; color: #1c1c1e;" placeholder="Enter paragraph text..."></textarea>
                                            </div>
                                        @endif
                                    </div>

                                    <button id="add_para" type="button" style="width: 100%; background: #f2f2f7; color: #007aff; border: none; border-radius: 14px; padding: 16px; font-weight: 600; font-size: 1.05rem; display: flex; align-items: center; justify-content: center; gap: 10px; cursor: pointer; transition: all 0.2s; box-shadow: inset 0 0 0 1px rgba(0,122,255,0.1);">
                                        <i class="fas fa-plus-circle" style="font-size: 1.3rem;"></i> Add Paragraph
                                    </button>
                                </div>
                            </div>
                            
                            <div class="card-footer" style="background: transparent; border-top: none; padding: 0 0 30px 0;">
                                <button type="button" id="update-btn" class="ios-btn ios-btn-primary" style="width: 100%; padding: 16px; font-size: 1.1rem; border-radius: 14px; font-weight: 600; box-shadow: 0 4px 14px rgba(0,122,255,0.3);">Update Song</button>
                            </div>
                        </form>
                    </div>
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
            $searchfield.prop('readonly', true);
        });
        
        // Force readonly on any existing search fields to prevent mobile keyboard
        $('.select2-search__field').prop('readonly', true);

        $('input[type="file"]').change(function (e) {
            var fileName = e.target.files[0].name;
            $('.custom-file-label').html(fileName);
        });
        $("#add_para").click(function () {
            $('#songParaSection').append(`
                <div class="form-group para-container position-relative" style="margin-bottom: 20px;">
                    <textarea class="form-control ios-input song_para" rows="4" name="song_para[${paraCounter}]" style="border-radius: 18px; padding: 18px; font-size: 1.15rem; line-height: 1.6; resize: vertical; width: 100%; box-sizing: border-box; font-weight: 400; color: #1c1c1e;" placeholder="Enter paragraph text..."></textarea>
                    <button type="button" class="btn btn-sm btn-danger remove-para position-absolute" style="top: -8px; right: -8px; z-index: 10; border-radius: 50%; width: 28px; height: 28px; padding: 0; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(255,59,48,0.3); border: none; background: #ff3b30;"><i class="fas fa-times" style="font-size: 0.8rem;"></i></button>
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
