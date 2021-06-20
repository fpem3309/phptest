<?php
include_once('./_common.php');

$g5['title'] = "제품소개";

include_once('../head.php');
?>




<h1>연습해봅시다잉</h1>
<form>
<input type="text" name="id""/>
<input type="submit" value="submit"/>
</form>

<?php
echo "다음 담타 시간은 : ";
echo $_GET["id"];



	$host = 'localhost';
    $user = 'fpem3309';
    $pw = 'fpemzhaqh77!';
    $dbName = 'fpem3309';
    $mysqli = new mysqli($host, $user, $pw, $dbName);
 
    if($mysqli){
        echo "MySQL 접속 성공";
    }else{
        echo "MySQL 접속 실패";
    }



?>



<?php
include_once('../_tail.php');
?>