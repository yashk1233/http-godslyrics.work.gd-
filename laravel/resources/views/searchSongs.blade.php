@include('header', ['mobile_title' => 'Search Songs'])

<style>
    .ios-search-container {
        padding: 16px;
        background: #f2f2f7;
        margin-bottom: 20px;
        border-radius: 14px;
    }
    .ios-search-input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        background: #ffffff;
        border-radius: 12px;
        padding: 10px 14px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.05);
    }
    .ios-search-input-wrapper i {
        color: #8e8e93;
        margin-right: 10px;
        font-size: 1.1rem;
    }
    .ios-search-input {
        border: none;
        outline: none;
        width: 100%;
        font-size: 1.05rem;
        font-weight: 500;
        background: transparent;
        color: #1c1c1e;
    }
    .ios-search-input::placeholder {
        color: #8e8e93;
        font-weight: 400;
    }
    
    .ios-list-group {
        background: #ffffff;
        border-radius: 14px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.03), 0 1px 4px rgba(0, 0, 0, 0.03);
        margin-bottom: 24px;
        border: 1px solid rgba(0,0,0,0.04);
        overflow: hidden;
    }
    .ios-list-row {
        padding: 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: transparent;
        transition: background-color 0.15s ease;
        border-bottom: 1px solid #f2f2f7;
    }
    .ios-list-row:last-child {
        border-bottom: none;
    }
    .ios-list-row:active {
        background-color: #f2f2f7;
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
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Search Songs</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Search</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="ios-search-container">
                <div class="ios-search-input-wrapper">
                    <i class="fas fa-search"></i>
                    <input type="text" id="songSearch" class="ios-search-input" placeholder="Search by song title..." autocomplete="off">
                </div>
            </div>

            <div id="songlistcontent">
                <div id="song_tbody">
                    <!-- Songs will be populated here -->
                </div>
            </div>
        </div>
    </section>
</div>

@include('footer')

<script>
    $(document).ready(function () {
        function fetchSongs(query = '') {
            let $container = $('#song_tbody');
            
            if (query.trim() === '') {
                $container.empty();
                $container.append('<div class="text-center p-5"><i class="fas fa-search mb-3" style="font-size: 3rem; color: #e5e5ea;"></i><p style="color: #8e8e93;">Start typing to search for songs</p></div>');
                return;
            }

            $.ajax({
                url: '/get-songs-by-title',
                method: 'post',
                dataType: 'json',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content') },
                data: { search: query },
                success: function (data) {
                    let songs = data.msg;
                    let $container = $('#song_tbody');
                    $container.empty();

                    if (songs.length === 0) {
                        $container.append('<div class="text-center p-5"><p style="color: #8e8e93;">No songs found</p></div>');
                        return;
                    }

                    let listGroup = $('<div class="ios-list-group"></div>');
                    var all_songsid = songs.map(function(val) { return val.id; }).join(',');

                    $.each(songs, function (key, val) {
                        let iosRow = `
                        <div class="ios-list-row">
                            <div style="display: flex; align-items: center; flex: 1; min-width: 0;">
                                <div class="ios-icon-wrapper">
                                    <i class="fas fa-music"></i>
                                </div>
                                <div style="flex: 1; min-width: 0;">
                                    <h5 class="ios-row-title text-truncate">${val.song_title}</h5>
                                    <p class="ios-row-subtitle">Song #${val.id}</p>
                                </div>
                            </div>
                            <div class="dropdown" style="flex-shrink: 0; margin-left: 12px;">
                                <button class="ios-more-btn dropdown-toggle" type="button" id="dropdownMenuButton${val.id}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right ios-dark-dropdown" aria-labelledby="dropdownMenuButton${val.id}">
                                    <a class="dropdown-item ios-dark-item presentSongBtn" href="#" data-songid="${val.id}" data-all_songsid="${all_songsid}">
                                        <i class="fas fa-step-forward"></i> Present
                                    </a>
                                    <a class="dropdown-item ios-dark-item scheduleSongBtn" href="#" data-songid="${val.id}">
                                        <i class="fas fa-clock"></i> Schedule
                                    </a>
                                    <a class="dropdown-item ios-dark-item editSongBtn" href="#" data-songid="${val.id}">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </div>
                            </div>
                        </div>`;
                        listGroup.append(iosRow);
                    });

                    $container.append(listGroup);

                    // Re-bind click events
                    $('.presentSongBtn').on('click', function (e) {
                        e.preventDefault();
                        var songid = $(this).data("songid");
                        var all_songsid = $(this).data("all_songsid");
                        var route = "{{ url('present-song') }}/" + songid + '/' + all_songsid;
                        window.open(route, '_blank');
                    });

                    $('.editSongBtn').on('click', function (e) {
                        e.preventDefault();
                        var songid = $(this).data("songid");
                        window.open("{{ url('edit-song') }}/" + songid, '_self');
                    });

                    $('.scheduleSongBtn').on('click', function (e) {
                        e.preventDefault();
                        var songid = $(this).data("songid");
                        $.ajax({
                            url: "{{ url('schedule-song') }}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                song_id: songid
                            },
                            success: function (response) {
                                alert(response.message);
                            }
                        });
                    });
                }
            });
        }

        // Initial call to show placeholder
        fetchSongs('');


        // Search input event
        let typingTimer;
        $('#songSearch').on('input', function () {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(() => {
                fetchSongs($(this).val());
            }, 300);
        });

        // Sidebar toggle logic (consistent with other pages)
        $('body .nav-item:not(:has(.nav-treeview))').on('click', function () {
            if ($('body').hasClass('sidebar-collapse')) {
                $('body').removeClass('sidebar-collapse');
            } else {
                $('body').addClass('sidebar-collapse');
            }
            $(window).trigger('resize');
        });
    });
</script>
