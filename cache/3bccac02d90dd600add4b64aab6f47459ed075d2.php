

<?php $__env->startSection('content'); ?>

<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0 fw-bold"><?php echo e($drawing->name); ?></h3>
                </div>
                <div class="card-body">

                    

                    
                    <div class="text-center">
                        <H1 id="nipp">BELUM DIMULAI</H1>
                        <H2 id="name" class="fw-bold text-primary"></H2>
                        <H3 id="subarea"></H3>
                    </div>

                    
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-primary me-2" id="btn-start">MULAI</button>
                        
                        
                        <button class="btn btn-success" id="btn-winner">PEMENANG</button>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
<style>
    .timer {
        font-size: 5rem;
        font-weight: bold;
    }

    #nipp {
        font-size: 8rem;
    }

    #name {
        font-size: 5rem;
    }

    #subarea {
        font-size: 3rem;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
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
                url: "<?php echo e(url('participants/winner')); ?>/" + id, 
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

            //timerElement.textContent = seconds;

            // Shuffle the array and display one name
            //const shuffledNames = shuffleArray([...names]);
            //nameElement.textContent = shuffledNames[0];

            if (--timer < 0) {
                clearInterval(interval);
                clearInterval(randomNamesInternval);
                // Display the final name
                nippElement.textContent = shuffledNames[0].nipp;
                nameElement.textContent = shuffledNames[0].name;
                subareaElement.textContent = shuffledNames[0].subarea;
                updateWinner(shuffledNames[0].id)
                shuffledNames.splice(0, 1);
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
        <?php $__currentLoopData = $participants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $participant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        names.push({
            id: "<?php echo e($participant->id); ?>",
            nipp: "<?php echo e($participant->nipp); ?>",
            name: "<?php echo e($participant->name); ?>",
            subarea: "<?php echo e($participant->subarea); ?>",
        })
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        if(this.innerHTML == "MULAI")
        {   
            const countdownDuration = <?php echo e($drawing->duration); ?>;
            startCountdown(countdownDuration, names);
            this.innerHTML = "BERHENTI";
        }
        else 
        {
            this.innerHTML = "MULAI";
        }
        
        
    
    })
  

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\undian\views/home.blade.php ENDPATH**/ ?>