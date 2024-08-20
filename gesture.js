// Copyright 2023 The MediaPipe Authors.
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//      http://www.apache.org/licenses/LICENSE-2.0
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.
import { GestureRecognizer, FilesetResolver, DrawingUtils } from "https://cdn.jsdelivr.net/npm/@mediapipe/tasks-vision@0.10.3";
const demosSection = document.getElementById("demos");
let gestureRecognizer;
let runningMode = "IMAGE";
let enableWebcamButton;
let webcamRunning = false;
const videoHeight = "360px";
const videoWidth = "480px";
// Before we can use HandLandmarker class we must wait for it to finish
// loading. Machine Learning models can be large and take a moment to
// get everything needed to run.
const createGestureRecognizer = async () => {
    const vision = await FilesetResolver.forVisionTasks("https://cdn.jsdelivr.net/npm/@mediapipe/tasks-vision@0.10.3/wasm");
    gestureRecognizer = await GestureRecognizer.createFromOptions(vision, {
        baseOptions: {
            modelAssetPath: "https://storage.googleapis.com/mediapipe-models/gesture_recognizer/gesture_recognizer/float16/1/gesture_recognizer.task",
            delegate: "GPU"
        },
        runningMode: runningMode
    });
    demosSection.classList.remove("invisible");
};
createGestureRecognizer();


let currentMusic = 0;
const music = document.querySelector('#audio');
let flag=0;
const seekBar = document.querySelector('.seek-bar');
const songName = document.querySelector('.music-name');
const albumName = document.querySelector('.album-name');
const disk = document.querySelector('.disk');
const currentTime = document.querySelector('.current-time');
const musicDuration = document.querySelector('.song-duration');
const playBtn = document.querySelector('.play-btn');
const forwardBtn = document.querySelector('.forward-btn');
const backwardBtn = document.querySelector('.backward-btn');
const heart = document.querySelector('.heart');
const player = document.querySelector('.music-name');



/********************************************************************
// Continuously grabbing image from webcam stream and detect it.
********************************************************************/
const video = document.getElementById("webcam");
const canvasElement = document.getElementById("output_canvas");
const canvasCtx = canvasElement.getContext("2d");
const gestureOutput = document.getElementById("gesture_output");
// Check if webcam access is supported.
function hasGetUserMedia() {
    return !!(navigator.mediaDevices && navigator.mediaDevices.getUserMedia);
}
// If webcam supported, add event listener to button for when user
// wants to activate it.
if (hasGetUserMedia()) {
    enableWebcamButton = document.getElementById("webcamButton");
    enableWebcamButton.addEventListener("click", enableCam);
}
else {
    console.warn("getUserMedia() is not supported by your browser");
}
// Enable the live webcam view and start detection.
function enableCam(event) {
    if (!gestureRecognizer) {
        alert("Please wait for gestureRecognizer to load");
        return;
    }
    if (webcamRunning === true) {
        webcamRunning = false;
        enableWebcamButton.innerText = "MaGe Mode";
        location.reload()
    }
    else {
        webcamRunning = true;
        enableWebcamButton.innerText = "Classic Mode";
        alert("MaGe Mode initiated");
    }
    // getUsermedia parameters.
    const constraints = {
        video: true
    };
    // Activate the webcam stream.
    navigator.mediaDevices.getUserMedia(constraints).then(function (stream) {
        video.srcObject = stream;
        video.addEventListener("loadeddata", predictWebcam);
    });
}
let lastVideoTime = -1;
let results = undefined;

let count_fist = 0;
let count_up = 0;
let count_down = 0;
let count_vic = 0;
let count_fin = 0;
let count_palm = 0;

const playMusic = () => {
    music.play();
    playBtn.classList.remove('pause');
    disk.classList.add('play');
}


async function predictWebcam() {
    const webcamElement = document.getElementById("webcam");
    // Now let's start detecting the stream.
    if (runningMode === "IMAGE") {
        runningMode = "VIDEO";
        await gestureRecognizer.setOptions({ runningMode: "VIDEO" });
    }
    let nowInMs = Date.now();
    if (video.currentTime !== lastVideoTime) {
        lastVideoTime = video.currentTime;
        results = gestureRecognizer.recognizeForVideo(video, nowInMs);
    }
    if (results.gestures.length > 0) {
        
        const categoryName = results.gestures[0][0].categoryName;
        const categoryScore = parseFloat(results.gestures[0][0].score * 100).toFixed(2);
        const handedness = results.handednesses[0][0].displayName;
        console.log(results.gestures[0][0].categoryName);

        if(categoryName=='Closed_Fist'){
            console.log("It's "+categoryName) 
            count_fist=count_fist+1
            console.log(count_fist)
            
        }
        if(count_fist==10){
            if(playBtn.className.includes('pause')){
                music.play();
            }
            else{
                music.pause();
            }
            playBtn.classList.toggle('pause');
            disk.classList.toggle('play');
            
        }

        if(categoryName=='Open_Palm'){
            console.log("It's "+categoryName) 
            count_palm=count_palm+1
            console.log(count_palm)
            
        }
        if(count_palm==10){
            window.close();
        }

        if(categoryName=='Thumb_Up'){
            console.log("It's "+categoryName) 
            count_up=count_up+1
            console.log(count_up)
            
        }
        if(count_up==10){
            flag=0;
            if(currentMusic >= songs.length-1){
                currentMusic = 0;
            }
            else{
                currentMusic++;
            }
            setMusic(currentMusic);
            playMusic();
            
        }


        if(categoryName=='Thumb_Down'){
            console.log("It's "+categoryName) 
            count_down=count_down+1
            console.log(count_down)
            
        }
        if(count_down==10){
            flag=1;
            if(currentMusic <= 0){
                currentMusic = songs.length-1;
            }
            else{
                currentMusic--;
            }
            setMusic(currentMusic);
            playMusic();
            
        }

        if(categoryName=='Victory'){
            console.log("It's "+categoryName) 
            count_vic=count_vic+1
            console.log(count_vic)
            
        }
        if(count_vic==10){
            let song = songs[currentMusic];
            if(heart.classList.contains(song.id)){
                heart.classList.remove(song.id);
                heart.classList.remove('display');
                song.liked=0;
            }
            else{
                heart.classList.add(song.id);
                heart.classList.add('display');
                // USE AN SQL DATABASE INSTEAD
                song.liked=1;
            }
            
        }
    }
    else {
       console.log('None Avail... RESET');
        count_fist=0;
        count_up = 0;
        count_down = 0;
        count_vic = 0;
        count_palm = 0;
    }
    // Call this function again to keep predicting when the browser is ready.
    if (webcamRunning === true) {
        window.requestAnimationFrame(predictWebcam);
    }
}