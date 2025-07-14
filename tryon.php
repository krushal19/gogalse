<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>3D Try-On - GoGalse Optical</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f6f9;
            text-align: center;
        }
        #videoElement, #overlayCanvas {
            position: absolute;
            top: 0;
            left: 0;
        }
        .video-container {
            position: relative;
            display: inline-block;
        }
        .frames-list img {
            width: 80px;
            margin: 10px;
            cursor: pointer;
            border: 2px solid transparent;
            border-radius: 5px;
        }
        .frames-list img.selected {
            border-color: #1f3a52;
        }
    </style>
</head>
<body>

<?php include "head.php"; ?>

<h2 class="mt-4">Virtual 3D Try-On</h2>
<p>Turn on your camera and try different optical frames virtually!</p>

<div class="video-container">
    <video autoplay="true" id="videoElement" width="500" height="400"></video>
    <canvas id="overlayCanvas" width="500" height="400"></canvas>
</div>

<h5 class="mt-4">Choose a Frame to Try</h5>
<div class="frames-list d-flex justify-content-center flex-wrap">
    <img src="assets/frames/frame1.png" class="frame-img" alt="Frame 1">
    <img src="assets/frames/frame2.png" class="frame-img" alt="Frame 2">
    <img src="assets/frames/frame3.png" class="frame-img" alt="Frame 3">
    <img src="assets/frames/frame4.png" class="frame-img" alt="Frame 4">
</div>

<footer class="text-center text-white py-4" style="background-color:#1f3a52;">
    <p>&copy; 2025 GoGalse Optical</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/face-api.js"></script>
<script>
    const video = document.getElementById('videoElement');
    const canvas = document.getElementById('overlayCanvas');
    const ctx = canvas.getContext('2d');

    let selectedFrame = null;
    const frames = document.querySelectorAll('.frame-img');

    frames.forEach(frame => {
        frame.addEventListener('click', () => {
            frames.forEach(f => f.classList.remove('selected'));
            frame.classList.add('selected');
            selectedFrame = new Image();
            selectedFrame.src = frame.src;
        });
    });

    async function startCamera() {
        try {
            await faceapi.nets.tinyFaceDetector.loadFromUri('https://cdn.jsdelivr.net/npm/face-api.js/models');
            await faceapi.nets.faceLandmark68Net.loadFromUri('https://cdn.jsdelivr.net/npm/face-api.js/models');
            const stream = await navigator.mediaDevices.getUserMedia({ video: true });
            video.srcObject = stream;
        } catch (error) {
            alert('Could not access camera: ' + error);
        }
    }

    video.addEventListener('play', () => {
        const displaySize = { width: video.width, height: video.height };
        faceapi.matchDimensions(canvas, displaySize);

        setInterval(async () => {
            const detections = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions()).withFaceLandmarks();
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            if (detections.length > 0 && selectedFrame) {
                const landmark = detections[0].landmarks;
                const leftEye = landmark.getLeftEye();
                const rightEye = landmark.getRightEye();

                const eyeCenterX = (leftEye[0].x + rightEye[3].x) / 2;
                const eyeCenterY = (leftEye[0].y + rightEye[3].y) / 2;
                const eyeWidth = Math.abs(rightEye[3].x - leftEye[0].x) * 2;

                const frameWidth = eyeWidth * 2;
                const frameHeight = frameWidth / 2; // approximate frame ratio

                ctx.drawImage(selectedFrame, eyeCenterX - frameWidth / 2, eyeCenterY - frameHeight / 2, frameWidth, frameHeight);
            }
        }, 100);
    });

    startCamera();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
