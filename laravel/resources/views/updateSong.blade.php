@include('header', ['mobile_title' => 'Update Song'])

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
                <div class="col-sm-12">
                    <h1 class="m-0">Update Song</h1>
                    <ol class="breadcrumb">
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
                    <div class="ios-card" style="padding: 0; overflow: hidden; background: transparent; box-shadow: none; border: none;">

                        <form method="post" action="/update-song" id="quickForm" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="song_id" value="{{ $song->id }}">
                            <input type="hidden" name="redirect_to" value="{{ $redirect_to ?? '/view-songs' }}">
                            <div class="card-body" style="padding: 0;">
                                <!-- Top Info Section -->
                                <div style="background: #ffffff; border-radius: 14px; padding: 16px 20px; margin-bottom: 24px; box-shadow: 0 2px 10px rgba(0,0,0,0.02); border: 1px solid rgba(0,0,0,0.04);">
                                    <div class="form-group" style="margin-bottom: 20px;">
                                        <label style="font-weight: 600; color: #1c1c1e; margin-bottom: 8px; display: block; font-size: 0.95rem;">Song Title</label>
                                        <input type="text" name="song_title" class="form-control ios-input" id="song-title" placeholder="Enter Song Title" value="{{ $song->song_title }}" style="font-size: 1.05rem; padding: 14px 16px; background: #f9f9f9; border: 1px solid #f2f2f7;">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group" style="margin-bottom: 20px;">
                                                <label style="font-weight: 600; color: #1c1c1e; margin-bottom: 8px; display: block; font-size: 0.95rem;">Song Category</label>
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
                                                <label style="font-weight: 600; color: #1c1c1e; margin-bottom: 8px; display: block; font-size: 0.95rem;">Language</label>
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
                                <div style="background: #ffffff; border-radius: 14px; padding: 16px 20px 20px; margin-bottom: 24px; box-shadow: 0 2px 10px rgba(0,0,0,0.02); border: 1px solid rgba(0,0,0,0.04);">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                                        <label style="font-weight: 600; color: #1c1c1e; margin: 0; font-size: 1.1rem;">Song Paragraphs</label>
                                    </div>
                                    
                                    <div id="songParaSection">
                                        @php
                                            $paragraphs = json_decode($song->song_para, true) ?? [];
                                        @endphp
                                        @if(count($paragraphs) > 0)
                                            @foreach($paragraphs as $index => $para)
                                                <div class="form-group para-container position-relative" style="margin-bottom: 16px;">
                                                    <textarea class="form-control ios-input song_para" rows="4" name="song_para[{{ $index }}]" style="background: #f9f9f9; border: 1px solid #f2f2f7; border-radius: 14px; padding: 16px; padding-right: 48px; font-size: 1.05rem; line-height: 1.5; resize: vertical; width: 100%; box-sizing: border-box;" placeholder="Enter paragraph text...">{{ $para }}</textarea>
                                                    @if($index > 0)
                                                    <button type="button" class="btn btn-sm btn-danger remove-para position-absolute" style="top: 12px; right: 12px; border-radius: 50%; width: 32px; height: 32px; padding: 0; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 6px rgba(255,59,48,0.3); border: none; background: #ff3b30;"><i class="fas fa-times" style="font-size: 0.9rem;"></i></button>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="form-group para-container position-relative" style="margin-bottom: 16px;">
                                                <textarea class="form-control ios-input song_para" rows="4" name="song_para[0]" style="background: #f9f9f9; border: 1px solid #f2f2f7; border-radius: 14px; padding: 16px; padding-right: 48px; font-size: 1.05rem; line-height: 1.5; resize: vertical; width: 100%; box-sizing: border-box;" placeholder="Enter paragraph text..."></textarea>
                                            </div>
                                        @endif
                                    </div>

                                    <button id="add_para" type="button" style="width: 100%; background: #e0f0ff; color: #007aff; border: none; border-radius: 12px; padding: 14px; font-weight: 600; font-size: 1.05rem; display: flex; align-items: center; justify-content: center; gap: 8px; cursor: pointer; transition: background 0.2s;">
                                        <i class="fas fa-plus-circle" style="font-size: 1.2rem;"></i> Add Paragraph
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
                <div class="form-group para-container position-relative" style="margin-bottom: 16px;">
                    <textarea class="form-control ios-input song_para" rows="4" name="song_para[${paraCounter}]" style="background: #f9f9f9; border: 1px solid #f2f2f7; border-radius: 14px; padding: 16px; padding-right: 48px; font-size: 1.05rem; line-height: 1.5; resize: vertical; width: 100%; box-sizing: border-box;" placeholder="Enter paragraph text..."></textarea>
                    <button type="button" class="btn btn-sm btn-danger remove-para position-absolute" style="top: 12px; right: 12px; border-radius: 50%; width: 32px; height: 32px; padding: 0; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 6px rgba(255,59,48,0.3); border: none; background: #ff3b30;"><i class="fas fa-times" style="font-size: 0.9rem;"></i></button>
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
