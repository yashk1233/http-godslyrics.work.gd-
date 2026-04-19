<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Present Song</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, orientation=landscape">
    <!-- Google Fonts for Hindi and English -->
    <link href="https://fonts.googleapis.com/css2?family=Hind:wght@500;600;700&family=Noto+Sans+Devanagari:wght@500;700;800&family=Poppins:wght@500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<!-- jQuery -->
<script src='{{asset("plugins/jquery/jquery.min.js")}}'></script>
<!-- jQuery UI 1.11.4 -->
<!-- <script src='{{asset("plugins/jquery-ui/jquery-ui.min.js")}}'></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<style>
    body {
        margin: 0;
        background-color: #000;
        font-family: 'Poppins', sans-serif;
    }

    html, body {
        margin: 0; padding: 0; overflow: hidden; width: 100vw; height: 100vh;
        max-width: 100vw; max-height: 100vh; touch-action: none;
    }

    @media screen and (orientation: portrait) {
        body {
            overflow: hidden;
            width: 100vw; 
            height: 100vh;
            position: fixed;
        }
        .main {
            transform: rotate(90deg);
            transform-origin: top left;
            width: 100vh !important;
            height: 100vw !important;
            position: absolute;
            top: 0;
            left: 100vw;
        }
    }

    .main {
        /* A beautiful, dynamically selected background with custom opacity */
        background-image: linear-gradient(to bottom, rgba(0,0,0, {{ $bgOpacity }}), rgba(0,0,0, {{ min($bgOpacity + 0.3, 0.95) }})), url('{{ $bgUrl }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh; width: 100vw;
        display: flex; align-items: center; justify-content: center;
        position: relative;
    }

    .songContent {
        width: 95%;
        max-width: 1400px;
        text-align: center;
        z-index: 10;
        pointer-events: none; /* Let clicks pass through */
        animation: fadeIn 0.5s ease-in-out;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
    
    @keyframes slideUpFadeIn {
        0% { opacity: 0; transform: translateY(30px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    .animate-slide {
        animation: slideUpFadeIn 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
    }

    .songParaContent pre {
        font-family: 'Noto Sans Devanagari', 'Hind', 'Poppins', sans-serif;
        font-size: {{ $defaultFontSize }}px;
        font-weight: 700;
        color: #ffffff;
        white-space: pre-wrap;
        line-height: 1.5;
        margin: 0;
        text-shadow: 0 4px 24px rgba(0, 0, 0, 0.9), 0 2px 8px rgba(0,0,0,0.8);
        letter-spacing: 0.5px;
    }

    .pre-container {
        position: absolute; top: 0; height: 100%; width: 50%;
        cursor: pointer; -webkit-tap-highlight-color: transparent;
        user-select: none; outline: none; z-index: 20;
    }
    .left { left: 0; }
    .right { right: 0; }
    
    .nav-hint {
        position: absolute; top: 50%; transform: translateY(-50%);
        color: rgba(255,255,255,0.15); font-size: 4rem; pointer-events: none;
        transition: color 0.2s, transform 0.2s; z-index: 5;
    }
    .left:active ~ .left-hint { color: rgba(255,255,255,0.8); transform: translateY(-50%) scale(0.9); }
    .right:active ~ .right-hint { color: rgba(255,255,255,0.8); transform: translateY(-50%) scale(0.9); }
    .left-hint { left: 40px; }
    .right-hint { right: 40px; }

    /* Floating Action Button */
    .fab-container {
        position: absolute;
        top: 30px;
        right: 30px;
        z-index: 100;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }

    .fab {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.15); /* Very light visibility */
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        justify-content: center;
        align-items: center;
        color: rgba(255, 255, 255, 0.5);
        font-size: 1.2rem;
        cursor: pointer;
        transition: all 0.2s ease;
        -webkit-tap-highlight-color: transparent;
        outline: none;
    }
    
    .fab:active {
        transform: scale(0.9);
        background-color: rgba(255, 255, 255, 0.3);
    }

    .fab-menu {
        display: none;
        flex-direction: column;
        background-color: rgba(20, 20, 20, 0.9);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        margin-top: 12px;
        overflow: hidden;
        width: max-content;
        min-width: 180px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.5);
        transform-origin: top right;
        animation: scaleIn 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
    }

    .fab-menu.active {
        display: flex;
    }

    @keyframes scaleIn {
        from { opacity: 0; transform: scale(0.8); }
        to { opacity: 1; transform: scale(1); }
    }

    .fab-item {
        padding: 14px 18px;
        color: #e0e0e0;
        font-family: 'Poppins', sans-serif;
        font-size: 0.95rem;
        font-weight: 500;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        display: flex;
        align-items: center;
        gap: 12px;
        cursor: pointer;
        transition: background-color 0.2s;
        -webkit-tap-highlight-color: transparent;
        outline: none;
    }

    .fab-item i {
        font-size: 1.1rem;
        width: 20px;
        text-align: center;
        color: rgba(255, 255, 255, 0.7);
    }

    .fab-item:last-child {
        border-bottom: none;
    }

    .fab-item:active {
        background-color: rgba(255, 255, 255, 0.1);
    }
</style>

<body>
    <div class="main">

        <div class="pre-container left"></div>
        <div class="pre-container right"></div>
        
        <i class="fas fa-chevron-left nav-hint left-hint"></i>
        <i class="fas fa-chevron-right nav-hint right-hint"></i>

        <div class="songContent">
            <div class="songParaContent"></div>
        </div>

        <div class="fab-container">
            <div class="fab" id="fabButton">
                <i class="fas fa-ellipsis-h"></i>
            </div>
            <div class="fab-menu" id="fabMenu">
                <div class="fab-item" id="btnNextSong">
                    <i class="fas fa-step-forward"></i> Present Next Song
                </div>
                <div class="fab-item" id="btnCloseWindow">
                    <i class="fas fa-times"></i> Close Window
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="songData" value='@json($data)'>



</body>

</html>
<script>

    $(document).ready(function () {
       
        $('#fabButton').on('click', function(e) {
            e.stopPropagation();
            $('#fabMenu').toggleClass('active');
        });

        // Prevent click from propagating when clicking menu items
        $('.fab-menu').on('click', function(e) {
            e.stopPropagation();
        });

        // Close menu when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.fab-container').length) {
                $('#fabMenu').removeClass('active');
            }
        });

        $('#btnNextSong').on('click', function(e) {
            e.stopPropagation();
            $('#fabMenu').removeClass('active');
            
            var paramString = "{{ request()->segment(3) }}"; 
            if (paramString) {
                let paramArray = paramString.split(','); 
                let index = paramArray.indexOf("{{ request()->segment(2) }}");

                if (index !== -1 && index + 1 < paramArray.length) {
                    var route = "{{ url('present-song') }}/" + paramArray[index + 1] + '/' + paramString;
                    window.location.href = route; 
                } else {
                    alert("You are at the last scheduled song.");
                }
            } else {
                alert("This song is not part of a schedule.");
            }
        });

        $('#btnCloseWindow').on('click', function(e) {
            e.stopPropagation();
            $('#fabMenu').removeClass('active');
            
            if (window.history.length > 1) {
                window.close(); // Try closing first
                setTimeout(() => {
                    window.history.back();
                }, 100);
            } else {
                window.close();
                setTimeout(() => {
                    window.location.href = "{{ url('/') }}";
                }, 100);
            }
        });
        
    });

    window.onload = function () {
        setTimeout(function () {
            window.scrollTo(0, 1); // Scroll slightly down
        }, 100);
    };


    function lockOrientation() {
        if (screen.orientation) {
            screen.orientation.lock("landscape").catch(function (error) {
                console.log("Orientation lock failed:", error);
            });
        }
    }

    document.addEventListener("DOMContentLoaded", lockOrientation);

    var data = JSON.parse(document.getElementById("songData").value);

    var paraCount = 0;
    var totalParaCount = data.length;
    var customFontSize = null; // Store user's pinched font size

    function renderPara(index) {
        let styleAttr = customFontSize ? `style="font-size: ${customFontSize}px !important;"` : '';
        let $content = $('.songParaContent');
        
        $content.removeClass('animate-slide');
        void $content[0].offsetWidth; // trigger reflow to restart animation
        
        $content.html('<pre class="margin-zero" ' + styleAttr + '>' + data[index] + '</pre>');
        $content.addClass('animate-slide');
    }

    renderPara(paraCount);

    $('.left').on('click', function () {
        if (paraCount >= 1) {
            paraCount--;
            renderPara(paraCount);
        }
    });

    $('.right').on('click', function () {
        if (paraCount < (totalParaCount - 1)) {
            paraCount++;
            renderPara(paraCount);
        }
    });

    // --- Pinch to Zoom Font Logic ---
    let initialDistance = null;
    let initialFontSize = null;
    const mainElement = document.querySelector('.main');

    mainElement.addEventListener('touchstart', function(e) {
        if (e.touches.length === 2) {
            // Calculate starting distance between two fingers
            initialDistance = Math.hypot(
                e.touches[0].pageX - e.touches[1].pageX,
                e.touches[0].pageY - e.touches[1].pageY
            );
            const preElement = document.querySelector('.songParaContent pre');
            if (preElement) {
                initialFontSize = parseFloat(window.getComputedStyle(preElement).fontSize);
            }
        }
    }, {passive: false});

    mainElement.addEventListener('touchmove', function(e) {
        if (e.touches.length === 2) {
            e.preventDefault(); // Prevent native zoom/scroll

            if (initialDistance === null || initialFontSize === null) return;

            // Calculate new distance between fingers
            let currentDistance = Math.hypot(
                e.touches[0].pageX - e.touches[1].pageX,
                e.touches[0].pageY - e.touches[1].pageY
            );

            // Calculate scale ratio
            let scaleFactor = currentDistance / initialDistance;
            let newFontSize = initialFontSize * scaleFactor;

            // Limit bounds to avoid text becoming invisible or gigantic
            if (newFontSize < 16) newFontSize = 16;
            if (newFontSize > 250) newFontSize = 250;

            customFontSize = newFontSize; // Persist for next slide

            const preElement = document.querySelector('.songParaContent pre');
            if (preElement) {
                preElement.style.setProperty('font-size', customFontSize + 'px', 'important');
            }
        }
    }, {passive: false});

    mainElement.addEventListener('touchend', function(e) {
        if (e.touches.length < 2) {
            initialDistance = null;
            initialFontSize = null;
        }
    });

    // $('.right').dblclick(function(){
    //     var paramString = "{{ request()->segment(3) }}"; 
    //     let paramArray = paramString.split(','); 
    //     let index = paramArray.indexOf("{{ request()->segment(2) }}");

    //     // Check if index is valid and if index+1 exists
    //     if (index !== -1 && index + 1 < paramArray.length) {
    //         var route = "{{ url('present-song') }}/" + paramArray[index + 1] + '/' + paramString;
    //         window.location.href = route; 
    //         console.log(route);
    //     } else {
    //         console.log("Next index out of bounds or value not found in array.");
    //     }
        

    // });

    
    $('.main').on('click', function () {
        document.querySelector("body").requestFullscreen();

    });

    $('body .nav-item').on('click', function () {
        
        if ($('body').hasClass('sidebar-collapse')) {


            $('body').removeClass('sidebar-collapse')
            $(window).trigger('resize')
        } else {
            $('body').addClass('sidebar-collapse')
            $(window).trigger('resize')
        }

    });
   
   


</script>