<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>Document</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, orientation=landscape">

</head>
<!-- jQuery -->
<script src='{{asset("plugins/jquery/jquery.min.js")}}'></script>
<!-- jQuery UI 1.11.4 -->
<!-- <script src='{{asset("plugins/jquery-ui/jquery-ui.min.js")}}'></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<style>
    body {
        margin: 0;
    }

    html,
    body {
        margin: 0;
        padding: 0;
        overflow: hidden;
        /* Prevent scrolling */
        width: 100vw;
        height: 100vh;
        max-width: 100vw;
        max-height: 100vh;
        touch-action: none;
        /* Prevents accidental scrolling */
    }


    @media screen and (orientation: portrait) {
        body {
            transform: rotate(90deg);
            transform-origin: center;
            width: 100vh;
            height: 100vw;
            overflow: hidden;
            position: fixed;
        }
    }


    .main {
        background-image: url('{{ asset("dist/img/background.jpg") }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
        width: 100vw;
        object-fit: cover;


        /* position: relative; */
    }

    .songContent {
        /* position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%); */
        text-align: center;
        font-size: 2.3rem;
        font-weight: 700;
        color: white;
        text-shadow:
            -0.5px -0.5px 0 black,
            0.5px -0.5px 0 black,
            -0.5px 0.5px 0 black,
            0.5px 0.5px 0 black;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        position: relative;
        width: 100vw;
        height: 100vh;
        word-spacing: -3vh;
    }

    .margin-zero {
        margin: 0;
    }

    .songsClickSection {
        position: relative;
    }

    .pre-container {
        position: absolute;
        top: 0;
        width: 50%;
        height: 100%;
        cursor: pointer;
        -webkit-tap-highlight-color: transparent;
        /* Removes blue highlight on tap */
        -webkit-user-select: none;
        /* Prevents text selection */
        user-select: none;
        /* Prevents accidental text selection */
        outline: none;
        /* Removes focus outline */
    }

    .left {
        left: 0;
        /* background: rgba(255, 0, 0, 0); */
        /* Light red to visualize (remove later) */
    }

    .right {
        right: 0;
        /* background: rgba(0, 0, 255, 0); */
        /* Light blue to visualize (remove later) */
    }

    .content {
        position: relative;
        width: 100%;
        /* height: 100%; */
        padding: 50vh 0;
        box-sizing: border-box;
        text-align: center;
    }


    @media print {
        @page {
            size: landscape
        }
    }

    @media screen and (orientation: portrait) {
        body {
            transform: rotate(90deg);
            transform-origin: center;
            width: 100vh;
            height: 100vw;
            overflow: hidden;
            position: fixed;
        }
    }
</style>

<body>
    <div class="main">

        <div class="songContent">
            <div class="content">

                <div class="songParaContent" style=" padding-left: 20px; padding-right: 20px; ">

                </div>
                <div class="pre-container left"></div>
                <div class="pre-container right"></div>
            </div>
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

    console.log(data[0]);
    // $('.songContent').html(data[0]);
    $('.songParaContent').html('<pre class="margin-zero">' + data[0] + '</pre>');

    var paraCount = 0;
    var totalParaCount = data.length;

    $('.left').on('click', function () {

        if (paraCount >= 1) {
            $('.songParaContent').html('');
            paraCount--;
            $('.songParaContent').html('<pre class="margin-zero">' + data[paraCount] + '</pre>');
            // $('.songParaContent').html(data[paraCount]);


        }
        // paraCount 

    });
    $('.right').on('click', function () {
        if (paraCount < (totalParaCount - 1)) {
            $('.songParaContent').html('');
            paraCount++;

            $('.songParaContent').html('<pre class="margin-zero">' + data[paraCount] + '</pre>');

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