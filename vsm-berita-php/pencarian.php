<title>Berita VSM</title>
<?php
set_time_limit(0);
include "library/import.php";
//menampilkan API
if(isset($_POST['Kirim'])){

$text = $_POST['judul'];
include "library/import.php";
?>

<br>
<div class="container">
    <a href="index.php"><h1>Hasil Pencarian BERITA (VSM) </h1></a>
    <form action="pencarian.php" method="post">
        <div class="form-group">
          <input type="text" class="form-control google-search" name="judul" value="<?php echo $text ?>">
        <div class="btn-group">
      <br>
        <button type="submit" name="Kirim" class="btn btn-primary">Pencarian</button>
        </div>
        </div>
    </form>
<?php
$query =  str_replace(" ", "%20", $text);
$json=file_get_contents("http://localhost:5000/search?q=$query");
$data = json_decode($json, true);
 echo "<br/>";
}
?>
<!DOCTYPE html>
<html>
<head>
 <title>Vector Space Model</title>
 <style>
  table {
   width: 100%; 
  }
  table tr td {
   padding: 1rem;
  }
 </style>
</head>
<body>
  <table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>Ranking</th>
      <th>Document</th>
      <th>Score</th>
      <th>Media</th>
      <th>Kategori</th>
      <th>Judul</th>
    </tr>
  </thead>
  <?php   
  $i =1;
  foreach ($data as $value) {
      foreach ($value['details'] as $dataa) {
        echo '<tbody>
      <tr class="active">';
         echo '<td>'.$i.'</td>';
         echo '<td>'.$dataa['document'].'</td>';
         echo '<td>'.$dataa['score'].'</td>';
         echo '<td>'.$dataa['media'].'</td>';
         echo '<td>'.$dataa['kategori'].'</td>';
         echo '<td>'.$dataa['judul'].'</td>';
      echo '<tr>';
        $i = $i+1;
   }
 }
  ?>
  </table> 
</body>
</html>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});

$(document).ready(function(){
  $('[data-toggle="popover"]').popover();   
});
</script>
