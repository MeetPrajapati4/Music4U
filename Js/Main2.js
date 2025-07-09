// Initialize elements
const songplayer = document.querySelector('audio');
let mplaypause = document.getElementById('mainplaypause');
let volume = document.getElementById('volume');
let volumerange = document.getElementById('volumerange');
let progressbar = document.getElementById('progress');
let repeat = document.getElementById('repeat');
let forward10 = document.getElementById('forward');
let backward10 = document.getElementById('backward');
let next = document.getElementById('nextsong');
let previous = document.getElementById('previoussong');
let shuffle = document.getElementById('shuffle'); // Missing declaration
let Ctime = document.getElementById('Currenttime');
let Dtime = document.getElementById('Durationtime');

// Inspect menu
document.addEventListener('contextmenu', event => event.preventDefault());

// Global variable for current playing song
let currentSong = null;

// Flag to track when user is manually adjusting the progress bar
let isDraggingProgress = false;

// Key Control
document.addEventListener('keydown', function (event) {
    if (!currentSong) return; // Prevent errors when no song is selected

    if (event.key === 'p') {
        event.preventDefault();
        if (currentSong.paused) {
            currentSong.play();
            mplaypause.src = 'Css/Icons/pause.png';
        } else {
            currentSong.pause();
            mplaypause.src = 'Css/Icons/play.png';
        }
    } else if (event.key === 'f') {
        toggleFullscreen();
    } else if (event.key === 'ArrowLeft') {
        currentSong.currentTime -= 5;
    } else if (event.key === 'ArrowRight') {
        currentSong.currentTime += 5;
    } else if (event.key === 'm') {
        if (currentSong.muted) {
            currentSong.muted = false;
            volume.src = 'Css/Icons/volume.png';
        } else {
            currentSong.muted = true;
            volume.src = 'Css/Icons/mute.png';
        }
    }
    else if (event.key === 'd') {
        document.body.style.backgroundImage = 'url("Css/Background/Background.png")';
    }
    else if (event.key === 'r') {
        currentSong.currentTime = 0;
    }
    else if (event.key === 'n') { // Next song
        next.click();
    } else if (event.key === 'b') { // Previous song
        previous.click();
    } else if (event.key === 's') { // Shuffle
        shuffle.click();
    } else if (event.key === '+') { // Increase volume
        event.preventDefault();
        currentSong.volume = Math.min(1, currentSong.volume + 0.1);
        volumerange.value = Math.min(100, parseInt(volumerange.value) + 10);
        if (volumerange.value > 0) {
            volume.src = 'Css/Icons/volume.png';
            volume.style.transition = "all .5s ease";
        }
    } else if (event.key === '-') { // Decrease volume
        event.preventDefault();
        currentSong.volume = Math.max(0, currentSong.volume - 0.1);
        volumerange.value = Math.max(0, parseInt(volumerange.value) - 10);
        if (parseInt(volumerange.value) === 0) {
            volume.src = 'Css/Icons/mute.png';
        } else {
            volume.src = 'Css/Icons/volume.png';
        }
        volume.style.transition = "all .5s ease";
    } else if (event.key === '8' || event.key === 'Numpad8') {
        window.scrollTo({ top: window.scrollY + window.innerHeight, behavior: 'smooth' });
    } else if (event.key === '2' || event.key === 'Numpad2') {
        window.scrollTo({ top: window.scrollY - window.innerHeight, behavior: 'smooth' });
    }
});

// Main Play/Pause
mplaypause.addEventListener('click', () => {
    if (!currentSong) return; // Prevent errors when no song is selected

    if (currentSong.paused) {
        currentSong.play();
        const icon = currentSong.parentElement.querySelector('i');
        if (icon) {
            icon.classList.remove('fa-play-circle');
            icon.classList.add('fa-pause-circle');
        }
        mplaypause.src = 'Css/Icons/pause.png';
    } else {
        currentSong.pause();
        const icon = currentSong.parentElement.querySelector('i');
        if (icon) {
            icon.classList.remove('fa-pause-circle');
            icon.classList.add('fa-play-circle');
        }
        mplaypause.src = 'Css/Icons/play.png';
    }
    mplaypause.style.transition = "all .5s ease";
});

// Volume icon
volume.addEventListener('click', () => {
    if (!currentSong) {
        volumerange.value = 100;
        return;
    }

    if (volume.src.includes('volume.png')) {
        volume.src = 'Css/Icons/mute.png';
        currentSong.muted = true;
    } else {
        volume.src = 'Css/Icons/volume.png';
        currentSong.muted = false;
    }
    volume.style.transition = "all .5s ease";
});

// Volume Range
volumerange.addEventListener('change', () => {
    if (!currentSong) {
        volumerange.value = 100;
        return;
    }

    currentSong.volume = volumerange.value / 100;

    if (parseInt(volumerange.value) === 0) {
        volume.src = 'Css/Icons/mute.png';
    } else {
        volume.src = 'Css/Icons/volume.png';
    }
    volume.style.transition = "all .5s ease";
});

// Improved progress bar handling with event listeners to track when user is interacting with it
progressbar.addEventListener('mousedown', () => {
    isDraggingProgress = true;
});

document.addEventListener('mouseup', () => {
    isDraggingProgress = false;
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
    if (currentSong) {
        currentSong.currentTime += 5;
    }
});

// Skip 10- functionality
backward10.addEventListener("click", () => {
    if (currentSong) {
        currentSong.currentTime -= 5;
    }
});

// Select Row Play & Pause
document.querySelectorAll('#songrow').forEach(row => {
    row.addEventListener('click', function () {
        // For Song
        let song = this.querySelector('audio');
        if (!song) return;

        if (currentSong && currentSong !== song) {
            currentSong.pause();
            currentSong.currentTime = 0;
            const prevIcon = currentSong.parentElement.querySelector('i');
            if (prevIcon) {
                prevIcon.classList.replace('fa-pause-circle', 'fa-play-circle');
            }
            mplaypause.src = 'Css/Icons/play.png';
        }

        if (song.paused) {
            song.play();
            this.classList.add('focus');
            const songNameEl = this.querySelector('#songname');
            if (songNameEl) {
                songNameEl.style.color = '#09a750';
            }
            const icon = this.querySelector('i');
            if (icon) {
                icon.classList.replace('fa-play-circle', 'fa-pause-circle');
            }
            mplaypause.src = 'Css/Icons/pause.png';
        } else {
            song.pause();
            this.classList.remove('focus');
            const songNameEl = this.querySelector('#songname');
            if (songNameEl) {
                songNameEl.style.color = 'White';
            }
            const icon = this.querySelector('i');
            if (icon) {
                icon.classList.replace('fa-pause-circle', 'fa-play-circle');
            }
            mplaypause.src = 'Css/Icons/play.png';
        }
        mplaypause.style.transition = "all .5s ease";
        currentSong = song;
        document.querySelector('.playlist').src = 'Css/Icons/Add.png';
        document.querySelector('#likeImage').src = 'Css/Icons/Disliked.png';
        document.querySelector('#liketext').innerText = 'Dislike';
    });
});

// Remove focus from other song rows
document.querySelectorAll('#songrow').forEach(row => {
    row.addEventListener('click', function () {
        document.querySelectorAll('#songrow').forEach(item => {
            if (item !== this) {
                item.classList.remove('focus');
                const songNameEl = item.querySelector('#songname');
                if (songNameEl) {
                    songNameEl.style.color = 'White';
                }
            }
        });
    });
});

// Song Cover and Info Update
document.querySelectorAll('#songrow').forEach(row => {
    row.addEventListener('click', function () {
        // For Title
        const songName = this.querySelector('#songname');
        if (!songName) return;

        const minisongname = document.getElementById('minisongtitle');
        if (minisongname) {
            minisongname.innerText = songName.innerText;
        }

        // For Cover
        let cover = this.querySelector('#songcover');
        if (!cover) return;

        const hovercoverimage = document.getElementById('hovercoverimage');
        const minicover = document.getElementById('minicover');

        if (minicover) {
            minicover.src = cover.src;
            minicover.style.animation = "fadeIn 0.8s ease";
            minicover.style.transition = "all 0.8s ease";
        }

        if (hovercoverimage) {
            hovercoverimage.src = cover.src;
        }

        // For Artist
        const artistNameEl = this.querySelector('#artistname');
        if (artistNameEl) {
            let artistNames = artistNameEl.innerText.split(',').map(name => name.trim());
            const miniArtistEl = document.getElementById('miniartistname');
            if (miniArtistEl) {
                miniArtistEl.innerText = artistNames.join(', ');
            }
        }
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
    const currentRow = document.querySelector('.focus');
    if (!currentRow) return;

    const allRows = Array.from(document.querySelectorAll('#songrow'));
    const currentIndex = allRows.indexOf(currentRow);
    let randomIndex;

    // Ensure we select a different song
    do {
        randomIndex = Math.floor(Math.random() * allRows.length);
    } while (randomIndex === currentIndex && allRows.length > 1);

    // Scroll to the selected row
    const selectedRow = allRows[randomIndex];
    selectedRow.scrollIntoView({
        behavior: 'smooth',
        block: 'center'
    });

    // Optional scroll to left and right panels if they exist
    const leftPanel = document.querySelector('.left');
    const rightPanel = document.querySelector('.right');

    if (leftPanel) {
        leftPanel.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
    }

    if (rightPanel) {
        rightPanel.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
    }

    // Play the selected song after a short delay
    setTimeout(() => {
        selectedRow.click();
    }, 1000);
});

// For Fullscreen
function toggleFullscreen() {
    if (!document.fullscreenElement) {
        document.documentElement.requestFullscreen().catch(err => {
            console.error(`Error attempting to enable full-screen mode: ${err.message || err}`);
        });
    } else {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        }
    }
}

// For Follow button
function ToggleFollow(element, name) {
    if (!element) return;

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