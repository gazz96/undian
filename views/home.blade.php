@extends('layout')

@section('content')

<div id="canvas"></div>

<div class="d-flex justify-content-center align-items-center" style="height: calc(100vh - 83px); position: absolute; top: 0px; width: 100%; z-index: -1;">

    <div class="text-center w-100" style="z-index: 1">
        <H1 id="nipp">ARE YOU READY ?</H1>
        <H2 id="name" class="fw-bold text-primary"></H2>
        <H3 id="subarea"></H3>
    </div>

</div>

<div style="position: fixed; bottom: 0; border-top: 1px solid #ccc; z-index: 2; background: rgba(255, 255, 255, .5);" class="shadow-lg p-3 w-100 d-flex align-items-center justify-content-between">
    <h3 class="mb-0 fw-bold">{{$drawing->name}}</h3>
    <div>
        <button class="btn btn-lg btn-outline-primary me-2 rounded-pill px-4" id="btn-start">MULAI</button>
        <a href="" class="btn btn-lg btn-outline-primary me-2 rounded-pill px-4" onclick="return confirm('RESET???');">RESET</a>
        
        <button class="btn btn-lg btn-outline-primary me-2 rounded-pill px-4" data-bs-toggle="offcanvas" data-bs-target="#offcanvaswinner">PEMENANG</button>
        <button class="btn btn-lg btn-outline-primary me-2 rounded-pill " data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" title="Pengaturan">
            <span class="bi bi-gear"></span>
        </button>
    </div>
</div>



<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">PENGATURAN</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div class="mb-3">
        <label>BACKGROUND IMAGE</label>
        <input type="file" class="form-control form-custom-file" id="background-image-input"/>
    </div>
    
    <div class="mb-3">
        <label>WARNA FONT</label>
        <input type="color" class="form-control" id="color-text-input"/>
    </div>
  </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvaswinner">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">PEMENANG</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body p-0">
        <div class="p-3 sticky-top bg-white w-100 d-flex justify-content-between">
              <a class="btn btn-lg btn-outline-primary me-2 rounded-pill px-4 w-100" href="{{url('participants/download-winner/' . $drawing->id)}}" download>DOWNLOAD</a>
              <a class="btn btn-lg btn-outline-primary me-2 rounded-pill px-4 w-100" href="{{url('participants/reset-winner/' . $drawing->id)}}">RESET</a>
        </div>
        <div class="p-3">
        @foreach($winners as $winner)
            <div class="card mb-3">
                <div class="card-body">
                    <span class="badge bg-primary">PEMENANG {{$winner->winner}}</span>
                    <h3 class="mb-0 text-primary">{{ $winner->nipp }}</h3>
                    <p class="mb-0 fw-bold">{{$winner->name}}</p>
                    <p class="mb-0">{{$winner->subarea}}</p>
                </div>
            </div>
        @endforeach
       </div>
  </div>
</div>
    
@endsection

@section('header')

<style>

    body {
        height: 100vh;
        background-image: url('{{url($drawing->background)}}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .btn-primary {
        background-color: #11024d;
        color: #fff;
        border-color: #11024d;
    }
    
    .btn-outline-primary {
        border-color: #11024d;
        color: #11024d;
        border-width: 2px;
    }
    
    .btn-outline-primary:hover {
        background-color: #11024d;
        color: #fff;
        outline: 0 !important;
        border-color: #11024d;
    }
    
    .timer {
        font-size: 5rem;
        font-weight: bold;
    }

    #nipp {
        /*font-size: 19rem;*/
        font-size: calc(1rem + 22vw);
        line-height: calc(1rem + 15vw);
    }
    
    #nipp.active {
        font-size: calc(1rem + 30vw);
        line-height: calc(1rem + 25vw);
    }

    #name {
        font-size: 3rem;
    }

    #subarea {
        font-size: 2rem;
    }
    
    canvas {
      overflow-y: hidden;
      overflow-x: hidden;
      width: 100%;
      margin: 0;
      margin-top: -56px !important;
    }
</style>
@endsection

@section('footer')

<script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.5/dist/js.cookie.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
<script>
    
   
    var drumRollAudio = new Audio('assets/sounds/drum_roll.mp3');
    var popupConfettiAudio = new Audio('assets/sounds/pop_clapping.mp3')
    
    
    const possibleColors = [
      "DodgerBlue",
      "OliveDrab",
      "Gold",
      "Pink",
      "SlateBlue",
      "LightBlue",
      "Gold",
      "Violet",
      "PaleGreen",
      "SteelBlue",
      "SandyBrown",
      "Chocolate",
      "Crimson"
    ];
    

    function resetShuffleView()
    {
        const nippElement = document.getElementById('nipp');
        const nameElement = document.getElementById('name');
        const subareaElement = document.getElementById('subarea');
        
        nippElement.innerHTML = "";
        nameElement.innerHTML = "";
        subareaElement.innerHTML = "";
        
    }
    // Function to shuffle an array
    function shuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
        return array;
    }

    function updateWinner(id){
            
            btnStartElement.innerHTML = ('LOADING...')
            $.ajax({
                url: "{{url('participants/winner')}}/" + id, 
                success: function() {

                },
                error: function() {

                },
                complete: function() {
                    btnStartElement.innerHTML = ('MULAI')
                }
            })
        }

    // Countdown function
    function startCountdown(duration, names) {
        let timer = duration, seconds;

        
        const timerElement = document.getElementById('timer');
        const nippElement = document.getElementById('nipp');
        const nameElement = document.getElementById('name');
        const subareaElement = document.getElementById('subarea');
        
        var shuffledNames = shuffleArray([...names]);
        var temp = timer;

        

        const interval = setInterval(() => {
            seconds = parseInt(timer, 10);

            if (--timer < 0) {
                clearInterval(interval);
                clearInterval(randomNamesInternval);
                // Display the final name
                nippElement.textContent = shuffledNames[0].nipp;
                nameElement.textContent = shuffledNames[0].name;
                subareaElement.textContent = shuffledNames[0].subarea;
                updateWinner(shuffledNames[0].id)
                shuffledNames.splice(0, 1);
                drawConfetti();
                drumRollAudio.pause();
                popupConfettiAudio.play();
                $('#btn-start').remove();
            }
        }, 1000); // Update every 100 milliseconds

        const randomNamesInternval = setInterval(() => {
            seconds = parseInt(timer, 10);
            var shuffledNames = shuffleArray([...names]);
            nippElement.textContent = shuffledNames[0].nipp;
            
            
            if(btnStartElement.innerHTML == "MULAI")
            {
                clearInterval(interval);
                clearInterval(randomNamesInternval);
            }

        }, 100)
    }

    let btnStartElement = document.querySelector('#btn-start');
    btnStartElement.addEventListener('click', function(){
        const names = [];
        @foreach($participants as $participant)
        names.push({
            id: "{{$participant->id}}",
            nipp: "{{$participant->nipp}}",
            name: "{{$participant->name}}",
            subarea: "{{$participant->subarea}}",
        })
        @endforeach
    
        if(this.innerHTML == "MULAI")
        {   
            drumRollAudio.play();
            resetShuffleView();
            const countdownDuration = {{$drawing->duration}};
            startCountdown(countdownDuration, names);
            $('#nipp').addClass('active');
            this.innerHTML = "BERHENTI";
        }
        else 
        {
            
            this.innerHTML = "MULAI";
            drumRollAudio.pause();
        }
        
    })
    
    // let btnResetElement = document.querySelector('#btn-reset');
    // btnResetElement.addEventListener('click', function(){
    //     resetShuffleView();
    //     cancelAnimationFrame(animate);
    // })
 
    function drawConfetti() {
        const end = Date.now() + 15 * 1000;
    
        // go Buckeyes!
        const colors = ["#a864fd", "#29cdff", "#78ff44", "#ff718d", "#fdff6a"];
        
        (function frame() {
          confetti({
            particleCount: 2,
            angle: 60,
            spread: 55,
            origin: { x: 0 },
            colors: colors,
          });
        
          confetti({
            particleCount: 2,
            angle: 120,
            spread: 55,
            origin: { x: 1 },
            colors: colors,
          });
        
          if (Date.now() < end) {
            requestAnimationFrame(frame);
          }
        })();
    }
    
    let backgroundImageInput = document.querySelector('#background-image-input');
    
    $(document).on('change', '#background-image-input', function(){
        
     
        var backgroundUrl = URL.createObjectURL(this.files[0]);
        
        Cookies.set('backgroundURL', backgroundUrl, { expires: 7, secure: true })
        $('body').css({
            backgroundImage: `url('${backgroundUrl}')`,
            backgroundSize: 'cover',
            backgroundRepeat: 'no-repeat',
            backgroundPosition: 'center'
            
        })
    });

    
    $(document).on('change', '#color-text-input', function(){
        let textColor = $(this).val();
        Cookies.set('textColor', textColor, { expires: 7, secure: true })
        $('body').css('color', textColor);
    })
    
    
    function loadConfig()
    {
        const backgroundUrl = Cookies.get('backgroundURL'); 
        const textColor =  Cookies.get('textColor');
        
        $('body').css({
            backgroundImage: `url('${backgroundUrl}')`,
            backgroundSize: 'cover',
            backgroundRepeat: 'no-repeat',
            backgroundPosition: 'center',
            color: textColor
            
        })
    }
    
    
</script>

@endsection