<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Present Song</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, orientation=landscape">
    <!-- Google Fonts for Hindi (Mukta) and English (Poppins) -->
    <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@500;700;800&family=Poppins:wght@500;700;800&display=swap" rel="stylesheet">
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
        /* A beautiful, warm, heavenly open Bible background */
        background-image: linear-gradient(to bottom, rgba(20, 10, 5, 0.45), rgba(10, 5, 0, 0.85)), url('{{ asset("dist/img/bible_cross_bg.png") }}');
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

    .songParaContent pre {
        font-family: 'Mukta', 'Poppins', sans-serif;
        font-size: clamp(1.2rem, 6vmin, 3.5rem);
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
    </div>
    <input type="hidden" id="songData" value='@json($data)'>



</body>

</html>
<script>

    $(document).ready(function () {
       
        
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
        $('.songParaContent').html('<pre class="margin-zero" ' + styleAttr + '>' + data[index] + '</pre>');
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