<?php
    session_start();

    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
        header("location: login.php");
    }
?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
            overflow: hidden;
        }

        header {
            z-index: 999;
            position: absolute;
            top: 0;
            left: 51%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: end;
            padding: 15px 200px;
            transition: 0.5s ease;
            text-decoration: none;
        }

        header .brand {
            color: #fff;
            font-size: 2em;
            font-weight: 700;
            text-transform: uppercase;
            text-decoration: none;
        }

        header .navigation {
            position: relative;
            text-decoration: none !important;
        }

        header .navigation .navigation-items a {
            position: relative;
            color: #fff;
            font-size: 1.2em;
            font-weight: 500;
            text-decoration: none !important;
            margin-left: 30px;
            transition: 0.3s ease;
        }

        header .navigation .navigation-items a:before {
            content: '';
            position: absolute;
            background: #fff;
            width: 100%;
            height: 0px;
            bottom: 0;
            left: 0;
            transition: 0.3s ease;
            text-decoration: none !important;
        }


        a:hover {
        color: white;
        text-decoration: none;
        cursor: pointer;
        }

        header .navigation .navigation-items a:hover {
            width: 100%;
            padding: 0.3em 1.1em;
            background: white;
            color: black;
        }

        section {
            padding: 100px 200px;
        }

        .home {
            position: relative;
            width: 100%;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            flex-direction: column;
            background: #000000;
        }

        .home .content {
            z-index: 888;
            color: #fff;
            width: 70%;
            margin-top: 50px;
            display: none;
        }

        .home .content.active {
            display: block;
        }

        .home .content h1 {
            font-size: 4em;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 5px;
            line-height: 75px;
            margin-bottom: 40px;
        }

        .home .content p {
            margin-bottom: 65px;
        }

        .content.intro::before {
            z-index: -4;
            content: '';
            position: absolute;
            background: rgba(22, 6, 6, 0.6);
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }

        .content.fearless::before {
            z-index: -4;
            content: '';
            position: absolute;
            background: rgba(103, 74, 16, 0.3);
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }

        .content.speak-now::before {
            z-index: -4;
            content: '';
            position: absolute;
            background: rgba(238, 30, 114, 0.28);
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }

        .content.red::before {
            z-index: -4;
            content: '';
            position: absolute;
            background: rgba(240, 96, 96, 0.3);
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }
        .content.reputation::before {
            z-index: -4;
            content: '';
            position: absolute;
            background: rgba(22, 6, 6, 0.6);
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }
        .content.nen::before {
            z-index: -4;
            content: '';
            position: absolute;
            background: rgba(96, 178, 240, 0.3);
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }
        .content.lover::before {
            z-index: -4;
            content: '';
            position: absolute;
            background: rgba(240, 96, 142, 0.3);
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }
        .content.folklore::before {
            z-index: -4;
            content: '';
            position: absolute;
            background: rgba(103, 74, 16, 0.3);
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }
        .content.evermore::before {
            z-index: -4;
            content: '';
            position: absolute;
            background: rgba(103, 74, 16, 0.3);
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }
        .content.midnights::before {
            z-index: -4;
            content: '';
            position: absolute;
            background: rgba(122, 96, 240, 0.3);
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }
        .home .content.intro a {
            background: #fff;
            padding: 7px 20px;
            color: #D13333;
            font-size: 1.6em;
            font-weight: 1800;
            text-decoration: none;
            transition: 0.5s ease;
            position: absolute;
            top: 77%;
            border-radius: 70%;
        }

        .home .content.fearless a {
            background: #fff;
            padding: 7px 20px;
            color: rgba(225, 140, 13, 0.99);
            font-size: 1.6em;
            font-weight: 800;
            text-decoration: none;
            transition: 0.5s ease;
            position: absolute;
            top: 77%;
        }

        .home .content.speak-now a {
            background: #fff;
            padding: 7px 20px;
            color: #e74b65;
            font-size: 1.6em;
            font-weight: 800;
            text-decoration: none;
            transition: 0.5s ease;
            position: absolute;
            top: 77%;
        }

        .home .content.red a {
            background: #fff;
            padding: 7px 20px;
            color: rgb(119, 19, 19);
            font-size: 1.6em;
            font-weight: 800;
            text-decoration: none;
            transition: 0.5s ease;
            position: absolute;
            top: 77%;
            left: 13%;
        }
        .home .content.nen a {
            background: #fff;
            padding: 7px 20px;
            color: #4d4a72;
            font-size: 1.6em;
            font-weight: 800;
            text-decoration: none;
            transition: 0.5s ease;
            position: absolute;
            top: 77%;
        }
        .home .content.reputation a {
            background: #fff;
            padding: 7px 20px;
            color: black;
            font-size: 1.6em;
            font-weight: 800;
            text-decoration: none;
            transition: 0.5s ease;
            position: absolute;
            top: 77%;
        }
        .home .content.lover a {
            background: #fff;
            padding: 7px 20px;
            color: magenta;
            font-size: 1.6em;
            font-weight: 800;
            text-decoration: none;
            transition: 0.5s ease;
            position: absolute;
            top: 77%;
        }
        .home .content.folklore a {
            background: #fff;
            padding: 7px 20px;
            color: rgba(225, 140, 13, 0.99);
            font-size: 1.6em;
            font-weight: 800;
            text-decoration: none;
            transition: 0.5s ease;
            position: absolute;
            top: 77%;
        }
        .home .content.evermore a {
            background: #fff;
            padding: 7px 20px;
            color: rgba(225, 140, 13, 0.99);
            font-size: 1.6em;
            font-weight: 800;
            text-decoration: none;
            transition: 0.5s ease;
            position: absolute;
            top: 77%;
        }
        .home .content.midnights a {
            background: #fff;
            padding: 7px 20px;
            color: rgb(39, 33, 97);
            font-size: 1.6em;
            font-weight: 800;
            text-decoration: none;
            transition: 0.5s ease;
            position: absolute;
            top: 77%;
        }

        .home .content a:hover{
            padding: 12px 30px;
            transition: 0.5s ease;
            font-size: 2em;
        }


        .home video {
            z-index: 000;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .slider-navigation {
            z-index: 888;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            transform: translateY(80px);
            margin-bottom: 12px;
            gap: 2%;
            height: 40px;
            width: 30%;
            position: absolute;
            top: 80%;
            left: 38%;
        }

        .slider-navigation .nav-btn {
            width: 13px;
            height: 13px;
            background: #fff;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 0 2px rgba(255, 255, 255, 0.5);
            transition: 0.3 ease;
        }

        .slider-navigation .nav-btn.active.intro {
            background: rgba(22, 6, 6, 0.98);
        }

        .slider-navigation .nav-btn.active.fearless {
            background: rgba(225, 154, 13, 0.99);
        }

        .slider-navigation .nav-btn.active.speak-now {
            background: #d57383;
        }

        .slider-navigation .nav-btn.active.red {
            background: red;
        }

        .slider-navigation .nav-btn.active.nen {
            background: #555172;
        }

        .slider-navigation .nav-btn.active.reputation {
            background: rgba(22, 6, 6, 0.98);
        }

        .slider-navigation .nav-btn.active.lover {
            background: magenta;
        }

        .slider-navigation .nav-btn.active.folklore {
            background: rgba(225, 140, 13, 0.99);
        }

        .slider-navigation .nav-btn.active.evermore {
            background: rgba(225, 140, 13, 0.99);
        }

        .slider-navigation .nav-btn.active.midnights {
            background: rgb(39, 33, 97);
        }

        .slider-navigation .nav-btn:not(:last-child) {
            margin-right: 20px;
        }

        .slider-navigation .nav-btn:hover {
            transform: scale(1.2);
        }

        .video-slide {
            position: absolute;
            width: 100%;
            clip-path: circle(0% at 0 50%);
        }

        .video-slide.active {
            clip-path: circle(150% at 0 50%);
            transition: 2s ease;
            transition-property: clip-path;
        }
        .temp {
            position: absolute;
            top: 73%;
            left: 16%;
            transform: translate(-50%, -50%);
            transform: rotate(270deg);
            cursor: pointer;
            overflow: visible;
        }

        .temp span {
            display: block;
            width: 60px;
            height: 50px;
            border-bottom: 6px solid white;
            border-right: 6px solid white;
            transform: rotate(45deg);
            margin: 0px;
            animation: animate 2s infinite;
        }

        .temp span:nth-child(2) {
            animation-delay: -0.2s;
        }

        .temp span:nth-child(3) {
            animation-delay: -0.4s;
        }

        @keyframes animate {
            0% {
                opacity: 0;
                transform: rotate(45deg) translate(-20px, -20px);
            }
            50% {
                opacity: 1;
            }
            100% {
                opacity: 0;
                transform: rotate(45deg) translate(20px, 20px);
            }
        }

    </style>
</head>

<body>
<header>
    <div class="navigation">
        <div class="navigation-items">
            <a href="http://localhost:8080/script_to_deploy/emotions_front/all_front.html">MoodSync Explore</a>
            <a href="http://localhost:8080/script_to_deploy/emotion_detect2.html" target="_blank">MoodSync Live</a>
            <a href="welcome.html">Logout</a>
        </div>
    </div>
</header>



    <section class="home">
        <video class="video-slide active" src="assets\welcome_page\intro.mp4" autoplay loop muted></video>
        <video class="video-slide" id="fearless" src="assets\welcome_page\fearless.mp4" autoplay loop muted></video>
        <video class="video-slide" id="speak-now" src="assets\welcome_page\speak-now.mp4" autoplay loop muted></video>
        <video class="video-slide" id="red" src="assets\welcome_page\red.mp4" autoplay loop muted></video>
        <video class="video-slide" id="nen" src="assets\welcome_page\1989.mp4" autoplay loop muted></video>
        <video class="video-slide" id="reputation" src="assets\welcome_page\reputation.mp4" autoplay loop muted></video>
        <video class="video-slide" id="lover" src="assets\welcome_page\lover.mp4" autoplay loop muted></video>
        <video class="video-slide" id="folklore" src="assets\welcome_page\folklore.mp4" autoplay loop muted></video>
        <video class="video-slide" id="evermore" src="assets\welcome_page\evermore.mp4" autoplay loop muted></video>
        <video class="video-slide" id="midnights" src="assets\welcome_page\midnights.mp4" autoplay loop muted></video>


        <div class="content active intro">
            <h1>TAYLOR SWIFT.</h1>
            <p>Taylor Swift, the iconic singer-songwriter, has mesmerized listeners with her heartfelt lyrics, captivating melodies, and unwavering authenticity. Having sold over 200 million records worldwide, Taylor Swift is one of the best-selling musicians of all time, released 9 original studio albums, 2 re-recorded studio albums, 5 extended plays (EP), 3 live albums, and 14 miscellaneous compilations. Swift’s career began with a record deal with Big Machine Records in 2005 and the release of her eponymous debut album the following year.<br>From her self-titled debut album to her most recent releases, we embark on a chronological journey through Taylor Swift’s musical catalogue. Join us as we explore the depth, emotion, and timeless melodies that have defined her career, uncovering the remarkable narrative woven within the tapestry of her albums. Discover the power and beauty of Taylor Swift’s discography as we navigate the Taylor Swift album order.</p>
            <div class="temp">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="content fearless">
            <h1>Fearless.</h1>
            <p>Making the transition from teen sensation to mature artist can be difficult, but an 18-year-old Taylor Swift did it with style on her second album, Fearless. The songs are filled with both angst and delight. Swift sails through the title track, “Hey Stephen,” and “You Belong With Me” with boundless joy, as guitars chime and beats bounce. These moments shine even brighter when paired with thoughtful songs like “Fifteen” and “White Horse.”
            <br>Fearless is the second studio album by Taylor Swift, released in 2008. It is a country pop album that features 13 tracks written or co-written by Swift, who also co-produced the album with Nathan Chapman. The album explores themes of romance, heartache, and aspirations, and is inspired by Swift’s teenage feelings. Fearless was a huge commercial and critical success, becoming the best-selling album of 2009 and the most-awarded album in country music history.
            </p>
            <a href="https://open.spotify.com/album/4hDok0OAJd57SGIT8xuWJH" target="_blank">Explore</a>
        </div>
        <div class="content speak-now">
            <h1>Speak Now.</h1>
            <p>Taylor Swift’s maturity and assertiveness shine through on Speak Now. Each song is inspired by a personal experience, ranging from unpredictable relationships (“Mine”) to a meticulously crafted response to a very public humiliation (“Innocent”). Swift demonstrates both strength and vulnerability, revealing an artist undergoing creative and personal transformation.

                <br> Speak Now is the third studio album by Taylor Swift, released in 2010. It is a country pop, pop rock, and power pop album that features 14 tracks written entirely by Swift, who also co-produced the album with Nathan Chapman. The album reflects Swift’s transition from adolescence into adulthood, and consists of confessional songs mostly about love and heartbreak that explore past relationships and confront her critics and adversaries. 
            </p>
            <a href="https://open.spotify.com/album/5AEDGbliTTfjOB8TSm1sxt" target="_blank">Explore</a>
        </div><div class="content red">
            <h1>Red.</h1>
            <p>Taylor Swift captures the essence of her fourth album in a primary color: it represents her taste for vengeance, her hot-blooded romantic streak, and the neon-lit pulse of a dance floor. The title track’s banjo pluck and acoustic ballad “All Too Well” will appeal to country fans, but glossy singles like “We Are Never Ever Getting Back Together” and “I Knew You Were Trouble” seem destined for a broader audience—one as vivid as the title suggests.
            <br>Red is the fourth studio album by Taylor Swift, released in 2012. It is a pop, country, and rock album that features 16 tracks written or co-written by Swift, who also co-produced the album with various collaborators. The album explores the intense and conflicting emotions that Swift felt during a turbulent romantic relationship, and is inspired by the color red as a symbol of passion, danger, and heartache.
            <a href="https://open.spotify.com/album/6kZ42qRrzov54LcAk4onW9" target="_blank">Explore</a>
        </div>
        <div class="content nen">
            <h1>1989.</h1>
            <p>Taylor Swift’s fifth studio album, inspired by the ’80s, is her first “official pop album,” with heavyweights like Max Martin, Shellback, Ryan Tedder, and Jack Antonoff contributing to a sleeker, glitzier sound. “Shake It Off” is reminiscent of OutKast’s own populist anthem “Hey Ya,” and there are echoes of Madonna, Cyndi Lauper, and Belinda Carlisle throughout. nen is a juggernaut, as brash and brilliant as Times Square’s lights.



            <br>1989 is the fifth studio album by Taylor Swift, released in 2014. It is a synth-pop album that features 13 tracks written or co-written by Swift, who also co-produced the album with Max Martin and others. The album marks Swift’s transition from country to pop music, and is inspired by the music and culture of the 1980s. The album explores themes of love, independence, and self-discovery, and is influenced by Swift’s personal experiences and relationships. 1989 was a huge commercial and critical success.
            </p>
            <a href="https://open.spotify.com/album/1o59UpKw81iHR0HPiSkJR0" target="_blank">Explore</a>
        </div>
        </div><div class="content reputation">
            <h1>Reputation.</h1>
            <p>You don’t have to hear Taylor Swift declare her old self dead—as she does on the explosive “Look What You Made Me Do”—to understand that her new reputation is both a warning shot to her detractors and a full-fledged artistic transformation. All of these songs have a newfound complexity: They’re dark and meaningful, catchy and lived-in, pointed and provocative, and they’re catchy and lived-in. On “End Game,” a languid hip-hop cut with Ed Sheeran and Future, she’s braggadocious, but then sassy and sensual on “…Ready for It?” and “I Did Something Bad.” However, songs like “Call It What You Want” and “Delicate” bring together Taylor’s many emotional layers and confront the dynamic between her celebrity and personal life: “My reputation’s never been worse/So, you must like me for me,” she says. It all adds up to a boundlessly energetic, soul-baring pop masterpiece—her most daring statement yet.
            </p>
            <a href="https://open.spotify.com/album/6DEjYFkNZh67HP7R9PSZvv" target="_blank">Explore</a>
        </div>
        </div><div class="content lover">
            <h1>Lover.</h1>
            <p>There’s a reason Taylor Swift sounds so assured and cool on Lover, her seventh and most free-spirited album to date. She’s in love—true, unwavering, starry-eyed, shout-it-from-the-rooftops love. This project comes 13 years after her eponymous debut album, and after a string of songs that felt like battle scars from public breakups and celebrity feuds. It comes across as clear-eyed, thick-skinned, and grown-up. It could be a sign that the 29-year-old has entered a new phase of her life: she’s now impressively private (she and her long-term boyfriend are rarely seen together in public), politically charged (this album finds her fighting for queer and women’s rights), and eager to see the big picture. <br>As a result, she’s never sounded more powerful or in command. On the Pride anthem “You Need to Calm Down,” she calls out dark-age bigots, on “The Man,” she mocks patriarchy, on “I Forgot That You Existed,” and on “ME!,” a duet with Panic! at the Disco’s Brendon Urie. At a disco.
            </p>
            <a href="https://open.spotify.com/album/1NAmidJlEaVgA3MpcPFYGq" target="_blank">Explore</a>
        </div>
        </div><div class="content folklore">
            <h1>Folklore.</h1>
            <p>It was only 11 months between the release of Lover and its surprise sequel, but it felt like an eternity. Folklore finds the 30-year-old singer-songwriter teaming up with The National’s Aaron Dessner and long-time collaborator Jack Antonoff for a set of ruminative and relatively lo-fi bedroom pop that’s worlds away from its predecessor. “I’m doing good, I’m on some new st,” Swift begins “the 1,” a sly hybrid of plaintive piano and her naturally bouncy delivery. Swift’s considerable energies, however, have been channeled into writing songs here that double as short stories and character studies, from Proustian flashbacks (“cardigan,” which bears shades of Lana Del Rey) to outcast widows (“the last great american dynasty”) and doomed relationships (“exile,” a heavy-hearted duet with Bon Iver’s Justin Vernon). It’s a work with a lot of texture and imagination. “Your braids like a pattern/Love you to the moon and to Saturn,” she sings on “seven,” a song about two friends planning a getaway. 
            </p>
            <a href="https://open.spotify.com/album/1pzvBxYgT6OVwJLtHkrdQK" target="_blank">Explore</a>
        </div>
        </div><div class="content evermore">
            <h1>Evermore.</h1>
            <p>Surprise-releasing a career-defining album in the midst of a paralyzing global pandemic is an admirable flex; doing it again barely five months later is a display of confidence and concentration so audacious that you have every right to feel personally chastised. Evermore, like folklore, is a collaboration with Aaron Dessner, Jack Antonoff, and Justin Vernon, taking advantage of cozy home-studio vibes for more bare-bones arrangements and bared-soul lyrics, casually intimate and narratively rich.
            <br>There is a larger guest roster here—HAIM appears on “no body, no crime,” which seems to place Este Haim in the center of a small-town murder mystery, while Dessner’s bandmates in The National appear on “coney island”—but they fit into the mood rather than distract from it.
            </p>
            <a href="https://open.spotify.com/track/3O5osWf1rSoKMwe6E9ZaXP" target="_blank">Explore</a>
        </div>
        </div><div class="content midnights">
            <h1>Midnights.</h1>
            <p>Taylor Swift’s tenth studio album is a concept album that takes place at night and is about thinking about yourself. This is a collection of music written in the middle of the night, a trip through nightmares and sweet dreams. For all of us who have tossed and turned and decided to keep the lanterns lit and keep looking, hoping that maybe, just maybe, when the clock strikes twelve, we’ll meet ourselves. The album was a commercial success everywhere it came out, setting new standards everywhere. The album sold more than 1.5 million copies in its first week in the US. This made it the fastest-selling album of the year and the best-performing album overall. “Anti-Hero” had ten singles in the top ten on the Billboard Hot 100 in a single week. “Lavender Haze,” “Snow on the Beach,” which featured Lana Del Rey, and “Bejewelled” also made it into the top ten. Swift plans to start the Eras Tour in 2023 to promote both Midnights and her album from before, 1989.
            </p>
            <a href="https://open.spotify.com/album/1fnJ7k0bllNfL1kVdNVW1A" target="_blank">Explore</a>
        </div>

        <div class="slider-navigation">
            <div class="nav-btn active intro"></div>
            <div class="nav-btn fearless"></div>
            <div class="nav-btn speak-now"></div>
            <div class="nav-btn red"></div>
            <div class="nav-btn nen"></div>
            <div class="nav-btn reputation"></div>
            <div class="nav-btn lover"></div>
            <div class="nav-btn folklore"></div>
            <div class="nav-btn evermore"></div>
            <div class="nav-btn midnights"></div>
        </div>
    </section>

    <script type="text/javascript">

        // JS for video slider navigation
        const btns = document.querySelectorAll(".nav-btn");
        const slides = document.querySelectorAll(".video-slide");
        const contents = document.querySelectorAll(".content");
        const temp = document.querySelectorAll(".temp");
        
        var sliderNav = function (manual) {
            btns.forEach((btn) => {
                btn.classList.remove("active");
            });
            slides.forEach((slide) => {
                slide.classList.remove("active");
            });
            contents.forEach((content) => {
                content.classList.remove("active");
            });

            btns[manual].classList.add("active");
            slides[manual].classList.add("active");
            contents[manual].classList.add("active");
        }

        btns.forEach((btn, i) => {
            btn.addEventListener("click", () => {
                console.log(i);
                sliderNav(i);
            })
        });

        temp.forEach((t, i) => {
            t.addEventListener("click", () => {
                btns.forEach((btn) => {
                    btn.classList.remove("active");
                    console.log("removed");
                });
                slides.forEach((slide) => {
                    slide.classList.remove("active");
                    console.log("removed");
                });
                contents.forEach((content) => {
                    content.classList.remove("active");
                    console.log("removed");
                });
                btns[1].classList.add("active");
                slides[1].classList.add("active");
                contents[1].classList.add("active");
            })
        });
        
    </script>
</body>

</html>