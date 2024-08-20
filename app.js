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

playBtn.addEventListener('click', () => {
    if(playBtn.className.includes('pause')){
        music.play();
    }
    else{
        music.pause();
    }
    playBtn.classList.toggle('pause');
    disk.classList.toggle('play');
})

// Heart
heart.addEventListener('click', () => {
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
})

//set up music
const setMusic = (i) => {
    seekBar.value = 0;
    let song = songs[i];
    currentMusic = i;
    music.src = song.path;
    
    songName.innerHTML = song.name;
    albumName.innerHTML = song.album;
    player.classList.add(song.album);
    albumName.classList.add(song.album);
    seekBar.classList.add(song.album);
    let prevMusic;
    if(flag==0){
        if(currentMusic >= 1){
            prevMusic=currentMusic-1;
        }
        else{
            prevMusic=songs.length-1;
        }
    }
    else{
        if(currentMusic == songs.length-1){
            prevMusic=0;
        }
        else{
            prevMusic=currentMusic+1;
        }
    }
    let prevSong = songs[prevMusic];
    if(prevSong.album!=song.album){
        player.classList.remove(prevSong.album);
        albumName.classList.remove(prevSong.album);
        seekBar.classList.remove(prevSong.album);
    }
    

    disk.style.backgroundImage = `url('${song.cover}')`
    currentTime.innerHTML = '00:00';
    
    setTimeout(() => {
        seekBar.max = music.duration;
        musicDuration.innerHTML = formatTime(music.duration);
    }, 400);   

    if((!heart.classList.contains(song.id)) && heart.classList.contains('display')){
        heart.classList.remove('display');
        song.liked=0;
    }
    if(heart.classList.contains(song.id) && (!heart.classList.contains('display'))){
        heart.classList.add('display');
        song.liked=1;
    }
}

setMusic(0);

const formatTime = (time) => {
    // console.log("The current time is: "+time);
    console.log("The total time left is: "+(music.duration-time));
    if(music.duration-time>0 && music.duration-time<1){
        console.log("YES");
        if(currentMusic >= songs.length-1){
            currentMusic = 0;
        }
        else{
            currentMusic++;
        }
        setMusic(currentMusic);
        playMusic();
    }
    else{
        console.log('NO');
    }
    
    let min = Math.floor(time/60);
    if(min<10){
        min = `0${min}`;
    }
    let sec = Math.floor(time%60);
    if(sec<10){
        sec = `0${sec}`;
    }
    console.log(min);
    console.log(sec);
    return `${min}:${sec}`;
}

//seek bar
setInterval(() => {
    seekBar.value = music.currentTime;
    currentTime.innerHTML = formatTime(music.currentTime);
}, 500)

seekBar.addEventListener('change', () => {
    music.currentTime = seekBar.value;
})

const playMusic = () => {
    music.play();
    playBtn.classList.remove('pause');
    disk.classList.add('play');
}



//forward and backward button
forwardBtn.addEventListener('click', () => {
    flag=0;
    if(currentMusic >= songs.length-1){
        currentMusic = 0;
    }
    else{
        currentMusic++;
    }
    setMusic(currentMusic);
    playMusic();
})

backwardBtn.addEventListener('click', () => {
    flag=1;
    if(currentMusic <= 0){
        currentMusic = songs.length-1;
    }
    else{
        currentMusic--;
    }
    setMusic(currentMusic);
    playMusic();
})

// if(music.currentTime == music.duration){
//     console.log("Here");
// }




