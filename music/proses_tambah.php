<?php
include "inc/config.php";

if (!empty($_POST['judul']) && !empty($_POST['penyanyi']) && !empty($_POST['lirik'])) {
    $judul = $_POST['judul'];
    $penyanyi = $_POST['penyanyi'];
    $lirik = addslashes($_POST['lirik']);

    // proses insert lagu
    $folderUpload = "assets/upload";

    $imgFile = $_FILES['img'];
    $audioFile = $_FILES['audio'];

    // Proses upload file gambar
    $imgName = $imgFile['name'];
    $imgTmpLocation = $imgFile['tmp_name'];

    $imgNewName = uniqid() . '-' . $imgName;
    $imgLocation = "{$folderUpload}/{$imgNewName}";
    $imgUploadSuccess = move_uploaded_file($imgTmpLocation, $imgLocation);

    // Proses upload file audio
    $audioName = $audioFile['name'];
    $audioTmpLocation = $audioFile['tmp_name'];

    $audioNewName = uniqid() . '-' . $audioName;
    $audioLocation = "{$folderUpload}/{$audioNewName}";

    // Jika lokasi audio berada di luar folder, maka pindahkan atau salin ke folder yang dipilih
    if (!file_exists($audioTmpLocation)) {
        // Pindahkan atau salin file audio ke folder yang telah dipilih
        if (!copy($audioTmpLocation, $audioLocation)) {
            echo "<span style='color: red'>Gagal memindahkan atau menyalin file audio</span> <br>";
            exit;
        }
    } else {
        // Jika lokasi audio berada di dalam folder yang telah dipilih, langsung salin ke lokasi baru
        $audioUploadSuccess = move_uploaded_file($audioTmpLocation, $audioLocation);
        if (!$audioUploadSuccess) {
            echo "<span style='color: red'>Upload file audio gagal</span> <br>";
            exit;
        }
    }

    // Jika kedua proses upload berhasil
    if ($imgUploadSuccess && $audioUploadSuccess) {
        $sqlTambah = "INSERT INTO lagu (judul, penyanyi, lirik, nama_foto, lokasi, audio) VALUES 
                      ('$judul', '$penyanyi', '$lirik', '$imgName', '$imgLocation', '$audioLocation')";
        if ($konek->query($sqlTambah) === TRUE) {
            header('Location:./');
        } else {
            echo "Error: " . $sqlTambah . "<br>" . $konek->error;
        }

        $konek->close();
    } else {
        echo "<span style='color: red'>Upload file gagal</span> <br>";
    }
} else {
    header('Location:./m=tambah');
}
?>
