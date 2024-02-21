<?php
include "inc/config.php";
if (isset($_GET['id'])) {
    $laguId = $_GET['id'];
    $sqlLirik = mysqli_query($konek, "SELECT * FROM lagu WHERE id = $laguId");
    $k = mysqli_fetch_array($sqlLirik);
?>

<div class="bg-cover" style="background-image: url(<?= $k['lokasi'] ?>);">
    <div class="cover-lirik">
        <img src="<?= $k['lokasi'] ?>" width="300px">
        <div class="judul-lagu">
            <h1><?= $k['judul'] ?></h1>
            <p><?= $k['penyanyi'] ?></p>
            <div class="music-play">
                <audio id="audioPlayer" src="<?= $k['audio'] ?>"></audio>
                <div class="waktu">
                    <span id="currentTime">00:00</span>
                    <div class="range-music">
                        <input type="range" id="seekBar" name="seekBar" min="0" value="0">
                    </div>
                    <span id="duration">00:00</span>
                </div>
                <div class="play">
                    <i class="fa-solid fa-backward-step"></i>
                    <i class="fa-solid fa-circle-play" id="playButton"></i>
                    <i class="fa-solid fa-forward-step"></i>
                    <i class="fa-solid fa-stop" id="stopButton"></i> <!-- Tombol stop -->
                </div>
            </div>
        </div>
    </div>
</div>

<section class="lirik">
    <div class="lirik-lagu">
        <h3>Lirik Lagu</h3>
        <br>
        <pre><?= $k['lirik'] ?></pre>
        <a href='edit_lagu.php?id=<?= $laguId ?>' class="edit-button">Edit Lagu</a>
        <a href="index.php" class="dashboard-button">Kembali</a>
    </div>
</section>

<style>
    .lirik-lagu h3 {
        color: green;
    }

    .lirik-lagu {
        border: 2px solid green;
        padding: 10px;
        border-radius: 5px;
        display: inline-block;
    }

    .edit-button {
        background-color: green;
        color: white;
        padding: 10px 20px;
        border-radius: 10px;
        text-decoration: none;
        float: right;
        margin-left: 10px;
    }

    .edit-button:hover {
        background-color: darkgreen;
    }

    .dashboard-button {
        background-color: green;
        color: white;
        padding: 10px 20px;
        border-radius: 10px;
        margin-bottom: 10px; /* Menambahkan margin bawah untuk memberikan jarak dengan lirik */
        display: block; /* Menjadikan tombol sebagai blok agar rapih */
        width: fit-content;
    }

    .dashboard-button:hover {
        background-color: darkgreen;
    }
</style>

<script>
    const audioPlayer = document.getElementById('audioPlayer');
    const playButton = document.getElementById('playButton');
    const seekBar = document.getElementById('seekBar');
    const currentTime = document.getElementById('currentTime');
    const duration = document.getElementById('duration');
    const stopButton = document.getElementById('stopButton');

    // Fungsi untuk memulai audio secara otomatis ketika halaman dimuat
    window.onload = function() {
        audioPlayer.play();
        playButton.classList.remove('fa-circle-play');
        playButton.classList.add('fa-pause');
    };

    playButton.addEventListener('click', function() {
        if (audioPlayer.paused || audioPlayer.ended) {
            audioPlayer.play();
            playButton.classList.remove('fa-circle-play');
            playButton.classList.add('fa-pause');
        } else {
            audioPlayer.pause();
            playButton.classList.remove('fa-pause');
            playButton.classList.add('fa-circle-play');
        }
    });

    stopButton.addEventListener('click', function() {
        audioPlayer.pause();
        audioPlayer.currentTime = 0;
        playButton.classList.remove('fa-pause');
        playButton.classList.add('fa-circle-play');
    });

    audioPlayer.addEventListener('timeupdate', function() {
        currentTime.textContent = formatTime(audioPlayer.currentTime);
        seekBar.value = audioPlayer.currentTime;
    });

    audioPlayer.addEventListener('loadedmetadata', function() {
        duration.textContent = formatTime(audioPlayer.duration);
        seekBar.max = audioPlayer.duration;
    });

    seekBar.addEventListener('input', function() {
        audioPlayer.currentTime = seekBar.value;
    });

    function formatTime(seconds) {
        const minutes = Math.floor(seconds / 60);
        seconds = Math.floor(seconds % 60);
        return (minutes < 10 ? '0' : '') + minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
    }
</script>
<?php
}
?>