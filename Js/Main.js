// Global Variables
const songplayer = document.querySelector('audio');
let mplaypause = document.getElementById('mainplaypause');
let volume = document.getElementById('volume');
let volumerange = document.getElementById('volumerange');
let progressbar = document.getElementById('progress');
let songrow = document.getElementById('songrow');
let repeat = document.querySelector('#icright img#repeat');
let forward10 = document.getElementById('forward');
let backward10 = document.getElementById('backward');
let next = document.getElementById('nextsong');
let previous = document.getElementById('previoussong');
let Ctime = document.getElementById('Currenttime');
let Dtime = document.getElementById('Durationtime');

// Inspect menu
 document.addEventListener('contextmenu', event => event.preventDefault());

// Key Control
document.addEventListener('keydown', function (event) {
    if (event.key === 'p' && !event.target.matches('input, textarea')) {
        event.preventDefault();
        if (currentSong.paused) {
            currentSong.play();
            mplaypause.src = 'Css/Icons/pause.png';
        } else {
            currentSong.pause();
            mplaypause.src = 'Css/Icons/play.png';
        }
    } else if (event.key === 'f' && !event.target.matches('input, textarea')) {
        toggleFullscreen();
    } else if (event.key === 'ArrowLeft' && !event.target.matches('input, textarea')) {
        currentSong.currentTime -= 5;
    } else if (event.key === 'ArrowRight' && !event.target.matches('input, textarea')) {
        currentSong.currentTime += 5;
    } else if (event.key === 'm' && !event.target.matches('input, textarea')) {
        if (currentSong.muted) {
            currentSong.muted = false;
            volume.src = 'Css/Icons/volume.png';
        } else {
            currentSong.muted = true;
            volume.src = 'Css/Icons/mute.png';
        }
    }
    else if (event.key == 'd' && !event.target.matches('input, textarea')) {
        document.body.style.background = 'Css/Background/Background.png';
    }
    else if (event.key === 'r' && !event.target.matches('input, textarea')) {
        currentSong.currentTime = 0;
    }
    else if (event.key === 'n' && !event.target.matches('input, textarea')) { // Next song
        document.getElementById('nextsong').click();
    } else if (event.key === 'b' && !event.target.matches('input, textarea')) { // Previous song
        document.getElementById('previoussong').click();
    } else if (event.key === 's' && !event.target.matches('input, textarea')) { // Shuffle
        document.getElementById('shuffle').click();
    } else if (event.key === '+' && !event.target.matches('input, textarea')) { // Increase volume
        event.preventDefault();
        currentSong.volume = Math.min(1, currentSong.volume + 0.1);
        volumerange.value = Math.min(100, parseInt(volumerange.value) + 10);
        if (volumerange.value != 0) {
            volume.src = 'Css/Icons/Volume.png';
            volume.style.transition = "all .5s ease";
        }
    } else if (event.key === '-' && !event.target.matches('input, textarea')) { // Decrease volume
        event.preventDefault();
        currentSong.volume = Math.max(0, currentSong.volume - 0.1);
        volumerange.value = Math.max(0, parseInt(volumerange.value) - 10);
        if (volumerange.value == 0) {
            volume.src = 'Css/Icons/mute.png';
            volume.style.transition = "all .5s ease";
        }
        else {
            volume.src = 'Css/Icons/Volume.png';
            volume.style.transition = "all .5s ease";
        }
    } else if (event.key === '8' || event.key === 'Numpad8' && !event.target.matches('input, textarea')) {
        window.scrollTo({ top: window.scrollY + window.innerHeight, behavior: 'smooth' });
    } else if (event.key === '2' || event.key === 'Numpad2' && !event.target.matches('input, textarea')) {
        window.scrollTo({ top: window.scrollY - window.innerHeight, behavior: 'smooth' });
    }
});

// Main Play/Pause
mplaypause.addEventListener('click', () => {
    if (currentSong && currentSong.paused) {
        currentSong.play();
        currentSong.parentElement.querySelector('i').classList.remove('fa-play-circle');
        currentSong.parentElement.querySelector('i').classList.add('fa-pause-circle');
        mplaypause.src = 'Css/Icons/pause.png';
        mplaypause.style.transition = "all .5s ease";
    } else if (currentSong) {
        currentSong.pause();
        currentSong.parentElement.querySelector('i').classList.remove('fa-pause-circle');
        currentSong.parentElement.querySelector('i').classList.add('fa-play-circle');
        mplaypause.src = 'Css/Icons/play.png';
        mplaypause.style.transition = "all .5s ease";
    }
    document.querySelector('.focus') = '';
});


// Volume icon
volume.addEventListener('click', () => {

    if ((!currentSong || currentSong.paused)) {
        volumerange.value = 100;
    } else {
        volume.src = volume.src.endsWith('mute.png') ? 'Css/Icons/volume.png' : 'Css/Icons/mute.png';
        volume.style.transition = "all .5s ease";
        if (volume.src.endsWith('mute.png')) {
            currentSong.muted = true;
        } else {
            currentSong.muted = false;
        }
    }
    if (volumerange.value === 0) {
        volume.src = volume.src.endsWith('volume.png') ? 'Css/Icons/mute.png' : 'Css/Icons/volume.png';
        volume.style.transition = "all .5s ease";
    }
});

// Volume Range
volumerange.addEventListener('change', () => {
    if ((!currentSong || currentSong.paused)) {
        volumerange.value = 100;
    } else {
        currentSong.volume = volumerange.value / 100;
    }
    if (volumerange.value == 0) {
        volumerange.value = 0;
        volume.src = volume.src.endsWith('volume.png') ? 'Css/Icons/mute.png' : 'Css/Icons/volume.png';
        volume.style.transition = "all .5s ease";
    }
    else {
        volume.src = 'Css/Icons/Volume.png';
        volume.style.transition = "all .5s ease";
    }
});

// Progress
progressbar.addEventListener('input', () => {
    if (currentSong) {
        currentSong.currentTime = (progressbar.value / 100) * currentSong.duration;
    }
});

setInterval(() => {
    if (!currentSong || !progressbar || isNaN(currentSong.duration)) return;
    const time = currentSong.currentTime;
    const duration = currentSong.duration;

    // Update time displays
    if (Ctime) Ctime.innerText = `${String(Math.floor(time / 60)).padStart(2, '0')}:${String(Math.floor(time % 60)).padStart(2, '0')}`;
    if (Dtime) Dtime.innerText = `${String(Math.floor(duration / 60)).padStart(2, '0')}:${String(Math.floor(duration % 60)).padStart(2, '0')}`;

    // Calculate percentage safely
    const percentage = (time / duration) * 100;
    progressbar.value = isFinite(percentage) ? percentage : 0;
    progressbar.style.background = `linear-gradient(to right, rgb(6, 146, 62) 0%, rgb(6, 146, 62) ${percentage}%, #434444 ${percentage}%, #434444 100%)`;

    // Check if song ended
    if (Math.floor(time) >= Math.floor(duration)) {
        progressbar.value = 0;
        mplaypause.src = 'Css/Icons/play.png';
        mplaypause.style.transition = "all .5s ease";

        const icon = currentSong.parentElement.querySelector('i');
        if (icon) {
            icon.classList.remove('fa-pause-circle');
            icon.classList.add('fa-play-circle');
        }

        if (repeat && repeat.title === 'RepeatOnce') {
            currentSong.currentTime = 0;
            currentSong.play();
            mplaypause.src = 'Css/Icons/pause.png';
            mplaypause.style.transition = "all .5s ease";
        } else if (next) {
            next.click();
        }
    }
}, 1000 / 60);

// Repeat Functionality
repeat.addEventListener('click', () => {
    if (currentSong) {
        currentSong.loop = false;
        if (repeat.src.includes('Repeat.png')) {
            repeat.src = 'Css/Icons/RepeatOnce.png';
            repeat.title = 'RepeatOnce';
            const repeatModeEl = document.getElementById('repeatmode');
            if (repeatModeEl) {
                repeatModeEl.innerText = 'RepeatOnce';
            }
            currentSong.loop = true;
            currentSong.onended = () => {
                currentSong.loop = false;
                repeat.src = 'Css/Icons/Repeat.png';
                repeat.title = 'RepeatAll';
                const repeatModeEl = document.getElementById('repeatmode');
                if (repeatModeEl) {
                    repeatModeEl.innerText = 'RepeatAll';
                }
                repeat.style.transition = "all .5s ease";
                next.click();
            }
        } else {
            repeat.src = 'Css/Icons/Repeat.png';
            repeat.title = 'RepeatAll';
            const repeatModeEl = document.getElementById('repeatmode');
            if (repeatModeEl) {
                repeatModeEl.innerText = 'RepeatAll';
            }
            currentSong.loop = false;
            currentSong.onended = () => {
                currentSong.loop = false;
                repeat.src = 'Css/Icons/Repeat.png';
                repeat.title = 'RepeatAll';
                const repeatModeEl = document.getElementById('repeatmode');
                if (repeatModeEl) {
                    repeatModeEl.innerText = 'RepeatAll';
                }
                repeat.style.transition = "all .5s ease";
                next.click();
            }
        }
        repeat.style.transition = "all .5s ease";
    }
    else {
        repeat.src = 'Css/Icons/Repeat.png';
        repeat.title = 'RepeatAll';
        const repeatModeEl = document.getElementById('repeatmode');
        if (repeatModeEl) {
            repeatModeEl.innerText = 'RepeatAll';
        }
        repeat.style.transition = "all .5s ease";
    }
});

// Skip 10+  functionality
forward10.addEventListener("click", () => {
    currentSong.currentTime += 5;
});

// Skip 10- functionality
backward10.addEventListener("click", () => {
    currentSong.currentTime -= 5;
});

function openSideMenu() {
    document.querySelector(".hamburger").style.display = "none";
    document.querySelector(".menu").style.transition = "1s";
    document.querySelector(".menu").style.transform = "translateX(10%)";
    document.querySelector(".left").style.transform = "translateX(0%)";
    document.querySelector(".left").style.transition = "1s";
    document.querySelector(".cross").style.display = "block";
    document.querySelector(".center").style.transition = "1s";
    document.querySelector(".center").style.left = "14%";
    document.querySelector(".center").style.width = "66%";
    document.querySelector(".right").style.transform = "translateX(0%)";
    document.querySelector(".right").style.transition = "1s";
}

function closeSideMenu() {
    document.querySelector(".hamburger").style.display = "block";
    document.querySelector(".left").style.transform = "translateX(-100%)";
    document.querySelector(".left").style.transition = "1s";
    document.querySelector(".menu").style.transform = "translateX(-100%)";
    document.querySelector(".menu").style.transition = "1s";
    document.querySelector(".cross").style.display = "none";
    document.querySelector(".center").style.transition = "1s";
    document.querySelector(".center").style.left = "-1%";
    document.querySelector(".center").style.width = "100%";
    document.querySelector(".right").style.transform = "translateX(100%)";
    document.querySelector(".right").style.transition = "1s";
}

// Select Row Play & Pause
let currentSong = null;
const clickCounts = new Map();

document.querySelectorAll('#songrow').forEach(row => {
    row.addEventListener('click', function () {
        // For Song
        const songId = this.querySelector('audio').id;
        let song = document.getElementById(songId);
        if (currentSong && currentSong !== song) {
            currentSong.pause();
            currentSong.currentTime = 0;
            currentSong.parentElement.querySelector('i').classList.replace('fa-pause-circle', 'fa-play-circle');
            mplaypause.src = 'Css/Icons/play.png';
            mplaypause.style.transition = "all .5s ease";
        }
        if (song.paused) {
            song.play();
            openSideMenu();
            this.classList.add('focus');
            this.querySelector('#songname').style.color = '#09a750';
            mplaypause.src = 'Css/Icons/pause.png';
            mplaypause.style.transition = "all .5s ease";
        } else {
            song.pause();
            this.classList.remove('focus');
            this.querySelector('#songname').style.color = this.classList.contains('focus') ? '#09a750' : 'White';
            this.querySelector('i').classList.replace('fa-pause-circle', 'fa-play-circle');
            mplaypause.src = 'Css/Icons/play.png';
            mplaypause.style.transition = "all .5s ease";
        }
        currentSong = song;
        document.querySelector('.playlist').src = 'Css/Icons/Add.png';
        document.querySelectorAll('#likeImage').forEach(el => {
            el.src = 'Css/Icons/Disliked.png';
        });
        document.querySelectorAll('#liketext').forEach(el => {
            el.innerText = 'Dislike';
        });
    });

    Array.from(document.querySelectorAll('#songrow')).forEach(el => {
        el.addEventListener('click', function () {
            document.querySelectorAll('#songrow').forEach(item => {
                if (item !== this) {
                    item.classList.remove('focus');
                    item.querySelector('#songname').style.color = 'White';
                }
            });
        });
    });
});
document.querySelectorAll('#songrow').forEach(row => {
    row.addEventListener('click', function () {
        // For Title & Artist
        const songName = this.querySelector('#songname');
        const minisongname = document.getElementById('minisongtitle');
        minisongname.innerText = songName.innerText;
        // For Cover
        let cover = this.querySelector('#songcover');
        let hovercoverimage = document.getElementById('hovercoverimage');
        let rightCoverImg = document.getElementById('rightcoverimage');
        let minicover = document.getElementById('minicover');
        rightCoverImg.src = cover.src;
        minicover.src = rightCoverImg.src;
        hovercoverimage.src = minicover.src;
        rightCoverImg.style.animation = "fadeIn 0.8s ease";
        minicover.style.animation = "fadeIn 0.8s ease";
        rightCoverImg.style.transition = "all 0.8s ease";
        minicover.style.transition = "all 0.8s ease";

        // For Right Side
        let ArtistName = this.querySelector('#artistname').innerText;
        let artistNames = ArtistName.split(',').map(name => name.trim());
        let artists = artistNames.map(name => `<a style='cursor:pointer; text-decoration: none; color: white;' href='Artists.php?Name=${name}'>${name}</a>`).join(', ');
        document.getElementById('miniartistname').innerHTML = artists;

        // Empty content to be filled with dynamically generated artist link + button pairs
        let artistContent = '';
        // Loop through each artist and create the link and button pair
        artistNames.forEach((name, index) => {
            // Generate the unique id for each artist
            // Append the pair (link + button) to the content
            artistContent += `<p class="artist-content">
                <span class="right-artist">
                    <a class="song-artist" id="songartist${index + 1}" href="Artists.php?name=${name}">${name}</a>
                    <button class="follow-btn" id="followbtn${index + 1}" onclick="ToggleFollow(this, '${name}')">Follow</button>
                </span>
            </p>`;
        });

        // Insert the generated HTML content into the page
        document.getElementById('Artistbox').innerHTML = artistContent;
        // Resize the content box to fit the new content
        let parent = document.getElementById('rightbottom');
        let contentHeight = document.getElementById('Artistbox').scrollHeight + 'px';
        let contentWidth = document.getElementById('Artistbox').scrollWidth + 'px';
        parent.style.transition = "height 0.5s ease-in-out, width 0.5s ease-in-out";
        parent.style.height = `calc(${contentHeight} + 0.5rem)`;
        parent.style.width = `calc(${contentWidth} + 6vw)`;
        // For Mini
        let index = 0;
        let artistList = artistNames.map((name, index) => {
            let link1 = `<a class='songartist' href='Artists.php?Name=${name.trim()}'>${name.trim()}</a>`;
            document.getElementById(`songartist${index + 1}`).innerHTML = link1; // Nth artist
        });
        // To display multiple artist of single song properly
        document.querySelectorAll(`.songartist${index + 1}`).forEach(artist => {
            let noOfArtists = artist.parentElement.childElementCount;
            if (noOfArtists > 1) {
                artist.parentElement.style.display = 'flex';
                artist.parentElement.style.flexWrap = 'wrap';
                artist.parentElement.style.flexDirection = 'column';
                artist.parentElement.style.height = `${noOfArtists * 1.5}rem`;
                artist.parentElement.style.width += "2vw";
            }
        });
    });
});

// Next Song
next.addEventListener('click', () => {
    if (currentSong) {
        let currentRow = document.querySelector('.focus');
        let allRows = document.querySelectorAll('#songrow');
        let currentIndex = Array.from(allRows).indexOf(currentRow);
        let nextIndex = (currentIndex + 1) % allRows.length;
        if (currentIndex === allRows.length) {
            alert("No Next Song This is Last Song");
        } else {
            allRows[nextIndex].click();
        }
    }
    else {
        currentSong = null;
    }
});

previous.addEventListener('click', () => {
    if (currentSong) {
        let currentRow = document.querySelector('.focus');
        let allRows = document.querySelectorAll('#songrow');
        let currentIndex = Array.from(allRows).indexOf(currentRow);
        let previousIndex = (currentIndex - 1 + allRows.length) % allRows.length;
        if (currentIndex === 0) {
            alert("No Previous Song This is First Song");
        } else {
            allRows[previousIndex].click();
        }
    }
    else {
        currentSong = null;
    }
});

// Shuffle
shuffle.addEventListener('click', () => {
    if (currentSong) {
        let allRows = Array.from(document.querySelectorAll('#songrow'));
        let currentIndex = allRows.indexOf(document.querySelector('.focus'));
        let randomIndex = Math.floor(Math.random() * allRows.length);
        while (randomIndex === currentIndex) {
            randomIndex = Math.floor(Math.random() * allRows.length);
        }
        // Bring the selected row into view
        const selectedRow = allRows[randomIndex];
        selectedRow.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
        setTimeout(() => {
            selectedRow.click();
            selectedRow.classList.add('focus');
            selectedRow.style.transition = 'box-shadow 0.5s ease';
        }, 800);
    }
});

// For Fullscreen
function toggleFullscreen() {
    if (!document.fullscreenElement) {
        document.documentElement.requestFullscreen().catch(err => {
            alert(`Error attempting to enable full-screen mode: ${err.message || err}`);
        });
    } else {
        document.exitFullscreen();
    }
}

// For Follow button
function ToggleFollow(element, name) {
    element.disabled = true;
    element.innerText = element.innerText === 'Follow' ? 'Unfollow' : 'Follow';
    element.style.backgroundColor = element.innerText === 'Follow' ? '#04af6b' : '#03633d';
    setTimeout(() => element.disabled = false, 50);
}

// Change Background Image at Random
const sname = document.querySelector('.focus #songname')?.innerText;
document.getElementById('changebg').addEventListener('click', function changeBG() {

    fetch(`https://api.unsplash.com/photos/random?orientation=landscape&lang=en&size=20k&quality=high&client_id=JoGxZ1HXdKU9qRPbMVLrm-J-1yL--gGknvPdOsWd-28`)
        .then(response => response.json())
        .then(data => {
            const newBg = `url('${data.urls.regular}')`;
            document.body.style.backgroundImage = newBg;
        })
        .catch(error => console.error('Notice fetching image:', error));
});

// Change Background Image to Original/Default
document.addEventListener('keydown', function (event) {
    if (event.key === 'd') {
        document.body.style.backgroundImage = 'url("Css/Background/Background.png")';
    }
});

// Share on Social Media
function OnSocialmedia(social) {
    if (!social) return;

    const url = encodeURIComponent(window.location.href);
    const quote = encodeURIComponent(document.title);

    let openurl = "";
    const isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);

    switch (social.toLowerCase()) {
        case "facebook":
            openurl = `https://www.facebook.com/sharer/sharer.php?u=${url}&quote=${quote}`;
            break;
        case "twitter":
            openurl = `https://twitter.com/intent/tweet?url=${url}&text=${quote}`;
            break;
        case "linkedin":
            openurl = `https://www.linkedin.com/shareArticle?mini=true&url=${url}&title=${quote}`;
            break;
        case "whatsapp":
            openurl = isMobile ? `https://api.whatsapp.com/send?text=${quote} ${url}` :
                Swal.fire({
                    title: 'WhatsApp sharing is only supported on mobile devices.',
                    icon: 'error',
                    confirmButtonText: 'Ok',
                    customClass: {
                        container: 'swal-container-small',
                        popup: 'swal-popup-black',
                        title: 'swal-title-size'
                    },
                    allowOutsideClick: false
                });
            break;
        case "telegram":
            openurl = isMobile ? `https://t.me/share/url?url=${url}&text=${quote}` :
                Swal.fire({
                    title: 'Telegram sharing is only supported on mobile devices.',
                    icon: 'error',
                    confirmButtonText: 'Ok',
                    customClass: {
                        container: 'swal-container-small',
                        popup: 'swal-popup-black',
                        title: 'swal-title-size'
                    },
                    allowOutsideClick: false
                });
            break;
        case "github":
            openurl = `https://github.com/intent/hash?url=${url}`;
            break;
        case "instagram":
            if (isMobile) {
                openurl = `instagram://app`;
                setTimeout(() => {
                    window.location.href = "https://www.instagram.com";
                }, 500);
            } else {
                Swal.fire({
                    title: 'Instagram sharing is only supported on mobile devices.',
                    icon: 'error',
                    confirmButtonText: 'Ok',
                    customClass: {
                        container: 'swal-container-small',
                        popup: 'swal-popup-black',
                        title: 'swal-title-size'
                    },
                    allowOutsideClick: false
                });
            }
            break;
        case "skype":
            openurl = `https://web.skype.com/share?url=${url}`;
            break;
        case "snapchat":
            openurl = isMobile ? `https://www.snapchat.com/scan?attachmentUrl=${url}` :
                Swal.fire({
                    title: 'Snapchat sharing is only supported on mobile devices.',
                    icon: 'error',
                    confirmButtonText: 'Ok',
                    customClass: {
                        container: 'swal-container-small',
                        popup: 'swal-popup-black',
                        title: 'swal-title-size'
                    },
                    allowOutsideClick: false
                });
            break;
        case "pinterest":
            openurl = `https://pinterest.com/pin/create/button/?url=${url}&description=${quote}`;
            break;
        case "reddit":
            openurl = `https://www.reddit.com/submit?url=${url}&title=${quote}`;
            break;
        default:
            Swal.fire({
                title: 'Invalid Social Media',
                text: 'Please select a valid social media platform to share.',
                icon: 'error',
                confirmButtonText: 'Ok',
                customClass: {
                    container: 'swal-container-small',
                    popup: 'swal-popup-black',
                    title: 'swal-title-size'
                },
                allowOutsideClick: false
            });
            return;
    }

    if (openurl && typeof openurl === 'string') {
        window.open(openurl, "_Search", "width=600,height=400");
    }
}

