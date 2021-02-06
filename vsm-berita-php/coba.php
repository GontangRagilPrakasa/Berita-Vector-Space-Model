<?php  
 $sumber = 'http://ppid.jakarta.go.id/json?url=http://data.jakarta.go.id/dataset/06f19910-82c3-428f-9e13-14d848486f69/resource/a7cc5803-9993-427b-a3df-9745a233b38d/download/Lomba-bercerita-anak-TerbaikEdited.csv';
 $konten = file_get_contents($sumber);
 $data = json_decode($konten, true);

 //echo $data[1]["nama_lokasi"];
 echo "<h1 align='center'>Jumlah lomba anak bercerita terbaik jakarta ada ".count($data)." Siswa dan Siswi</h1>";
 echo "<br/>";
?>

<!DOCTYPE html>
<html>
<head>
 <title>Menampilkan data json</title>
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
 <table border="1">
  <tr>
   <th>No</th>
   <th>Tahun</th>
   <th>Jenis Lomba</th>
   <th>Juara</th>
   <th>Nama</th>
   <th>Sekolah</th>
   <th>ID</th> 
  </tr>
  <?php   
   for($a=0; $a < count($data); $a++)
   {
    print "<tr>";
    // penomeran otomatis
    print "<td>".$a."</td>";
    // menayangkan 
    print "<td>".$data[$a]['tahun']."</td>";
    print "<td>".$data[$a]['jenis']."</td>";
    print "<td>".$data[$a]['juara']."</td>";
    print "<td>".$data[$a]['nama']."</td>";
    print "<td>".$data[$a]['sekolah']."</td>";
    print "<td>".$data[$a]['id']."</td>";
    print "</tr>";
   }
  ?>
 </table>
</body>
</html>