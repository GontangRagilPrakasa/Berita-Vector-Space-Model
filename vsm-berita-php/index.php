<!------ Include the above in your HEAD tag ---------->
<title>Berita VSM</title>
<?php
include "library/import.php";
?>
<div class="container">
    <a href="index.php"><h1>Hasil Pencarian BERITA (VSM)</h1></a>
    <form action="pencarian.php" method="post">
        <div class="form-group">
          <input type="text" class="form-control google-search" name="judul" value="">
        <div class="btn-group">
      <br>
        <button type="submit" name="Kirim" class="btn btn-primary">Pencarian</button>
        </div>
        </div>
    </form>
</div>