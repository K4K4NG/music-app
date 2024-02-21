<?php
include "inc/config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music favorite</title>
    <link rel="stylesheet" href="inc/style.css">
    <script src="https://kit.fontawesome.com/ca43952785.js" crossorigin="anonymous"></script>
    <link rel="icon" type="icon/x-image" href="images/music.png">
</head>

<body>
    <header>
        <a href="./" class="logo">
            <img src="images/music.png" width="50px">
            <h3>Music App</h3>
        </a>
        <i class="fa-solid fa-magnifying-glass"></i>
    </header>
    <?php
    if (isset($_GET['m'])) {
        if ($_GET['m'] == 'lirik') {
            include 'lirik.php';
        } elseif ($_GET['m'] == 'tambah') {
            include 'tambah-lagu.php';
        }
    } else {
    ?>
        <div class="btn-tambah-lagu">
            <a href="./?m=tambah">Tambah Lagu</a>
        </div>
        <main>
            <?php
            $sqlmusik = mysqli_query($konek, "SELECT * FROM lagu ORDER BY id DESC");
            while ($k = mysqli_fetch_array($sqlmusik)) {
            ?>
                <div class="lagu">
                    <div class="cover">
                        <img src="<?= $k['lokasi'] ?>" width="300px" class="cover-album">
                    </div>
                    <div class="judul">
                        <h3><?= $k['judul'] ?></h3>
                        <span><?= $k['penyanyi'] ?></span>
                        <a href="./?m=lirik&id=<?= $k['id'] ?>" class="fa-solid fa-play"></a>
                    </div>
                </div>
            <?php
            }
            ?>
        </main>
    <?php
    } ?>

</body>

</html>