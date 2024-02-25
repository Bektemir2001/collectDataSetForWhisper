<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ASR data collection</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h3 class="mb-4 mt-4 text-center">ASR data collection</h3>
    <div class="card">
        <div class="card-body">
            This is some text within a card body.
        </div>
    </div>

    <div class="container mt-5">
        <h3 class="text-center mb-4">Үн жаздыруу</h3>
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <button class="btn btn-primary" id="startBtn">Үн жаздырууну баштатуу</button>
                <button class="btn btn-danger" id="stopBtn" disabled>Үн жаздырууну токтотуу</button>
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <audio controls id="audioPlayer" class="col-md-6" style="display:none;"></audio>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
<script src="https://cdn.rawgit.com/mattdiamond/Recorderjs/08e7abd9/dist/recorder.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const startBtn = document.getElementById('startBtn');
        const stopBtn = document.getElementById('stopBtn');
        const audioPlayer = document.getElementById('audioPlayer');

        let recorder;
        let audioContext;

        startBtn.addEventListener('click', startRecording);
        stopBtn.addEventListener('click', stopRecording);

        async function startRecording() {
            startBtn.disabled = true;
            stopBtn.disabled = false;

            audioContext = new (window.AudioContext || window.webkitAudioContext)();
            const stream = await navigator.mediaDevices.getUserMedia({ audio: true });

            const input = audioContext.createMediaStreamSource(stream);
            recorder = new Recorder(input);

            recorder.record();
        }

        function stopRecording() {
            startBtn.disabled = false;
            stopBtn.disabled = true;

            recorder.stop();
            recorder.exportWAV(function (blob) {
                audioPlayer.src = URL.createObjectURL(blob);
                audioPlayer.style.display = 'block';
            });

            audioContext.close();
        }
    });

</script>
</body>
</html>
