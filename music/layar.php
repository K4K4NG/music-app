<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tes layar muscik</title>
    <link rel="stylesheet" href="style-tes.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<?php
// Simulasikan pengambilan data lagu dari database atau sumber lainnya
$lagu = array(
    array(
        'title' => 'A Little Piece Of Heaven',
        'artist' => 'Avenged Sevenfold',
        'album' => 'Album Name 1', // Tambahkan key 'album'
        'image' => 'assets/upload/piece.jpeg'
    ),
    array(
        'title' => 'November Rain',
        'artist' => 'Guns N\' Roses',
        'album' => 'Album Name 2', // Tambahkan key 'album'
        'image' => 'assets/upload/seize.jpeg'
    ),
);

?>
<table id="laguTable"> <!-- Tambahkan id ke tabel untuk menargetkan dalam JavaScript -->
    <thead>
        <tr>
            <th>Judul Lagu</th>
            <th>Artis</th>
            <th>Album</th>
            <th>Gambar</th> <!-- Tambahkan kolom untuk gambar -->
        </tr>
    </thead>
    <tbody>
        <?php foreach ($lagu as $index => $musik) : ?>
            <tr data-index="<?php echo $index; ?>"> <!-- Tambahkan atribut data-index untuk menandai indeks item -->
                <td><?php echo $musik['title']; ?></td>
                <td><?php echo $musik['artist']; ?></td>
                <td><?php echo $musik['album']; ?></td>
                <td><img src="<?php echo $musik['image']; ?>" alt="Cover Art" width="100"></td> <!-- Tampilkan gambar dengan lebar 100px -->
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="music-container"> <!-- Hapus id dan style dari div -->
    <?php foreach ($lagu as $album) : ?>
        <div class="music-box">
            <div class="song-box">
                <div class="song-vas">
                    <div class="img-container">
                        <img src="<?php echo $album['image']; ?>" alt="">
                    </div>
                    <div class="song-deks">
                        <p class="title"><?php echo $album['title']; ?></p>
                        <p class="artist"><?php echo $album['artist']; ?></p>
                    </div>
                </div>
                <div class="icons">
                    <i class="fas fa-heart"></i>
                    <i class="fas fa-compress"></i>
                </div>
            </div>
            <div class="progress-control">
                <div class="control-button">
                    <i class="fas fa-random"></i>
                    <i class="fas fa-step-backward"></i>
                    <i class="play-pause fas fa-play"></i>
                    <i class="fas fa-step-forward"></i>
                    <i class="fas fa-undo-alt"></i>
                </div>
                <div class="progress-container">
                    <span>0:0</span>
                    <div class="progress-bar">
                        <div class="progress"></div>
                    </div>
                    <span>3:12</span>
                </div>
            </div>
            <div class="other-features">
                <i class="fas fa-list-ul"></i>
                <i class="fas fa-desktop"></i>
                <div class="volume-bar">
                    <i class="fas fa-volume-down"></i>
                    <div class="progress-bar">
                        <div class="progress"></div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<script>
    document.getElementById('laguTable').addEventListener('click', function(event) {
        var rowIndex = event.target.closest('tr').getAttribute('data-index'); // Dapatkan indeks baris yang ditekan
        var musicContainers = document.querySelectorAll('.music-box'); // Dapatkan semua konten musik

        // Sembunyikan semua konten musik kecuali yang sesuai dengan indeks yang ditekan
        musicContainers.forEach(function(container, index) {
            if (index == rowIndex) {
                container.style.display = 'block';
            } else {
                container.style.display = 'none';
            }
        });
    });
</script>
<style>
    /* CSS untuk tabel */
#laguTable {
  width: 100%;
  border-collapse: collapse;
  background-color: #f2f2f2; /* Warna latar belakang yang lebih cerah */
}

#laguTable th,
#laguTable td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

#laguTable th {
  background-color: #ddd; /* Warna latar belakang kolom header yang sedikit lebih gelap */
}

/* CSS untuk baris yang diklik pada tabel */
#laguTable tbody tr:hover {
  background-color: #e5e5e5; /* Warna latar belakang yang lebih terang saat dihover */
}

</style>
</body>
</html>
