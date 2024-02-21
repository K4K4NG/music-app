<?php
include "inc/config.php";
if (isset($_GET['id'])) {
    $laguId = $_GET['id'];
    $sqlLirik = mysqli_query($konek, "SELECT * FROM lagu WHERE id = $laguId");
    $k = mysqli_fetch_array($sqlLirik);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lagu</title>
    <link rel="stylesheet" href="inc/style-edit.css">
</head>
<body>
    <div class="edit-lagu">
        <h1>Edit Lagu</h1>
        <form method='post' action='proses-edit.php' enctype='multipart/form-data'>
            <input type="hidden" name="laguId" value="<?= $laguId ?>">
            <label for="judul">Judul Lagu</label>
            <input type="text" name="judul" id="judul" value="<?= $k['judul'] ?>">
            <label for="penyanyi">Nama Pencipta</label>
            <input type="text" name="penyanyi" id="penyanyi" value="<?= $k['penyanyi'] ?>">
            <label for="lirik">Lirik Lagu</label>
            <textarea name="lirik" id="lirik" rows="10"><?= $k['lirik'] ?></textarea>
            <label for="">Foto album (300x300)</label>
            <label for="img" class="album"><i class="fa-solid fa-image"></i>
                <p>Change cover album</p>
            </label>
            <input type="file" name="img" id="img" accept="image/*">
            <label for="audio">Audio</label>
            <input type="file" name="audio" id="audio" accept="audio/*">
            <input type="submit" value="Simpan">
        </form>
    </div>
</body>
</html>
<?php
}
?>
