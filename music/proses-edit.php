<?php
include "inc/config.php";

if (!empty($_POST['judul']) && !empty($_POST['penyanyi']) && !empty($_POST['lirik']) && isset($_POST['laguId'])) {
    $laguId = $_POST['laguId'];
    $judul = $_POST['judul'];
    $penyanyi = $_POST['penyanyi'];
    $lirik = addslashes($_POST['lirik']);

    $folderUpload = "assets/upload";
    $files = $_FILES;
    $namaFile = $files['img']['name'];
    $lokasiTmp = $files['img']['tmp_name'];
    $lokasiBaru = '';

    if (!empty($namaFile)) {
        $namaBaru = uniqid() . '-' . $namaFile;
        $lokasiBaru = "{$folderUpload}/{$namaBaru}";
        $prosesUpload = move_uploaded_file($lokasiTmp, $lokasiBaru);
        if (!$prosesUpload) {
            echo "<span style='color: red'>Upload file {$namaFile} gagal</span> <br>";
            exit;
        }
    }

    // Audio
    $audioFile = $files['audio']['name'];
    $audioTmp = $files['audio']['tmp_name'];
    $audioLokasiBaru = '';

    if (!empty($audioFile)) {
        $namaAudioBaru = uniqid() . '-' . $audioFile;
        $audioLokasiBaru = "{$folderUpload}/{$namaAudioBaru}";
        $prosesUploadAudio = move_uploaded_file($audioTmp, $audioLokasiBaru);
        if (!$prosesUploadAudio) {
            echo "<span style='color: red'>Upload file audio {$audioFile} gagal</span> <br>";
            exit;
        }
    }

    // Jika audio baru diunggah dan lokasinya berbeda dengan lokasi awal
    if (!empty($audioLokasiBaru) && !empty($audioFile)) {
        $sqlLagu = mysqli_query($konek, "SELECT * FROM lagu WHERE id = $laguId");
        $dataLagu = mysqli_fetch_array($sqlLagu);
        $lokasiAudioLama = $dataLagu['audio_lokasi'];
        
        // Pindahkan file audio ke folder yang baru
        if ($audioLokasiBaru !== $lokasiAudioLama) {
            rename($lokasiAudioLama, $audioLokasiBaru);
        }
    }

    $sqlEdit = "UPDATE lagu SET judul='$judul', penyanyi='$penyanyi', lirik='$lirik'";
    if (!empty($lokasiBaru)) {
        $sqlEdit .= ", nama_foto='$namaFile', lokasi='$lokasiBaru'";
    }
    if (!empty($audioLokasiBaru)) {
        $sqlEdit .= ", audio_nama='$audioFile', audio_lokasi='$audioLokasiBaru'";
    }
    $sqlEdit .= " WHERE id='$laguId'";

    if ($konek->query($sqlEdit) === TRUE) {
        header('Location:./');
    } else {
        echo "Error: " . $sqlEdit . "<br>" . $konek->error;
    }

    $konek->close();
} else {
    header('Location:./m=tambah');
}
?>
