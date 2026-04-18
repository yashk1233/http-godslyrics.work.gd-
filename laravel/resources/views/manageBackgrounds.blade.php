@include('header')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Backgrounds</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <!-- Upload Form -->
            <div class="ios-card mb-4">
                <div class="ios-card-header">
                    <h3 class="ios-card-title">Global Settings & Upload Background</h3>
                </div>
                <div class="card-body">
                    <form id="settingsForm" method="post" action="/upload-background" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Default Font Size: <span id="font_size_val" class="font-weight-bold text-primary">{{ $settings['default_font_size'] ?? '80' }}</span>px</label>
                                    <input type="range" name="default_font_size" id="default_font_size" class="ios-slider" value="{{ $settings['default_font_size'] ?? '80' }}" min="20" max="250" step="1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Background Dark Opacity: <span id="opacity_val" class="font-weight-bold text-primary">{{ $settings['bg_opacity'] ?? '0.6' }}</span></label>
                                    <input type="range" name="bg_opacity" id="bg_opacity" class="ios-slider" value="{{ $settings['bg_opacity'] ?? '0.6' }}" min="0" max="1" step="0.05">
                                    <small class="text-muted d-block mt-2">Higher = Darker (0.6 is recommended)</small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label>Upload New Background Image (JPEG, PNG, JPG) - <span class="text-muted">Optional</span></label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="background_image" name="background_image" accept="image/*">
                                <label class="custom-file-label" for="background_image">Choose file to upload...</label>
                            </div>
                        </div>
                        <button type="button" id="save-btn" class="ios-btn ios-btn-primary mt-3">Save Settings & Upload</button>
                    </form>
                </div>
            </div>

            <!-- Existing Backgrounds -->
            <div class="ios-card">
                <div class="ios-card-header">
                    <h3 class="ios-card-title">Available Backgrounds</h3>
                </div>
                <div class="card-body p-0 pt-3">
                    <div class="d-flex flex-row flex-nowrap" style="overflow-x: auto; -webkit-overflow-scrolling: touch; padding: 0 20px 20px 20px; gap: 15px;">
                        @foreach($backgrounds as $bg)
                        <div style="flex: 0 0 280px; max-width: 280px;">
                            <div class="card h-100" style="border-radius: 16px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1); margin-bottom: 0; {{ $bg->is_active ? 'border: 3px solid #34c759;' : '' }}">
                                <img src="{{ asset('storage/' . $bg->image_path) }}" class="card-img-top" alt="Background" style="height: 180px; object-fit: cover;">
                                <div class="card-body text-center p-3 d-flex flex-column justify-content-end">
                                    @if($bg->is_active)
                                        <button class="ios-btn ios-btn-info w-100" disabled style="padding: 8px;">
                                            <i class="fas fa-check-circle"></i> Active
                                        </button>
                                    @else
                                        <button class="ios-btn ios-btn-primary w-100 mb-2 set-active-btn" data-id="{{ $bg->id }}" style="padding: 8px;">
                                            Set Active
                                        </button>
                                        <a href="/delete-background/{{ $bg->id }}" class="ios-btn ios-btn-danger w-100 delete-bg-btn" style="padding: 8px;">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                        @if(count($backgrounds) == 0)
                        <div class="col-12 text-center text-muted" style="flex: 1 1 auto;">
                            <p>No background images uploaded yet.</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>


        </div>
    </section>
</div>

@include('footer')

<script src='{{asset("plugins/bootstrap/js/bootstrap.bundle.min.js")}}'></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

@if(session('response'))
<script>alert("{{ session('response') }}");</script>
@endif

<script>
$(document).ready(function() {
    // Hamburger menu fix
    $('[data-widget="pushmenu"]').on('click', function(e) {
        e.preventDefault();
        if ($('body').hasClass('sidebar-collapse')) {
            $('body').removeClass('sidebar-collapse').removeClass('sidebar-closed').addClass('sidebar-open');
        } else {
            $('body').addClass('sidebar-collapse').addClass('sidebar-closed').removeClass('sidebar-open');
        }
    });

    // Secure Save Settings
    $('#save-btn').on('click', function(e) {
        e.preventDefault();
        requirePin(function() {
            $('#settingsForm').submit();
        });
    });

    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    // Slider UI updates
    $('#default_font_size').on('input', function() {
        $('#font_size_val').text($(this).val());
    });
    
    $('#bg_opacity').on('input', function() {
        $('#opacity_val').text(parseFloat($(this).val()).toFixed(2));
    });

    $('.set-active-btn').click(function() {
        let bgId = $(this).data('id');
        requirePin(function() {
            $.ajax({
                url: '/set-active-background',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    bg_id: bgId
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr) {
                    alert('Error setting active background');
                }
            });
        });
    });

    $('.delete-bg-btn').click(function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        requirePin(function() {
            window.location.href = url;
        });
    });
});
</script>
