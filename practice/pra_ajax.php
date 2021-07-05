<?include_once('./_common.php'); ?>
<?include_once('../head.php'); ?>




<?php

	$host = 'localhost';
    $user = 'fpem3309';
    $pw = 'fpemzhaqh77!';
    $db = 'fpem3309';


    $mysqli = new mysqli($host, $user, $pw, $db);
 
    if($mysqli){
        echo "MySQL 접속 성공";
    }else{
        echo "MySQL 접속 실패";
    }


?>




<?php
include_once('../_tail.php');
?>