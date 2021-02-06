<?php
include "library/import.php";
$json=file_get_contents("http://localhost:5000/test");
$data = json_decode($json, true);
 echo "<br/>";
 ?>
 <center><a href="index.php"><h1>History Search</h1></a></center>
 <?php
 echo "<div class='container'>";
   // for($a=0; $a < count($data); $a++)
  foreach ($data as $value) {
  		echo "<h2 class='text-success'>"."Judul".$value['id']." , ".$value['query']."</h2>";
      foreach ($value['details'] as $dataa) {

          // echo "<tr>";
          // // penomeran otomatis
          // // menayangkan 
          // echo "<td>".$dataa['id']."</td>";
          // echo "<td>".$dataa['label']."</td>";
          // echo "<td>".$dataa['document']."</td>";
          // echo "<td>".$dataa['score']."</td>";
          // echo "<td>".$dataa['Judul']."</td>";
          // echo "<td>".$dataa['Reviewer']."</td>";
          // echo "<td>".$dataa['Abstrak']."</td>";
  
          // echo "</tr>";
        echo "<div class='col-md-12'>";
          echo "<div class='col-md-7'>";
          echo "<h3 class='text-primary'>".$dataa['Judul']." , ".$dataa['Reviewer']."</h3>";
          echo "<h5>".$dataa['id']." , ".$dataa['document']." , ".$dataa['score']."</h5>";
          echo "<p>".$dataa['Abstrak']."</p>";
          echo "</div>";
        echo "</div>";
   }
 }
 echo "</div>";
  ?>