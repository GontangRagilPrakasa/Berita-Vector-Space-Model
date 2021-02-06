<?php
    set_time_limit(0);
    $json=file_get_contents("http://localhost:5000/proses");
    if($json){
    	header('location:index.php');
    }
?>