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

<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ;?>" enctype="multipart/form-data">
        <input type="file" name="upload[]" multiple>
        <input type="submit" value="send">

<?php
    echo '<pre>';
    var_dump($_FILES);
    echo '</pre>';
?>

<?php
    for($i = 0; $i < count($_FILES['upload']['name']); $i++){
 
        $uploadfile = $_FILES['upload']['name'][$i];
 
        if(move_uploaded_file($_FILES['upload']['tmp_name'][$i],$uploadfile)){
            echo "파일이 업로드 되었습니다.<br />";
            echo "<img src ={$_FILES['upload']['name'][$i]} style='width:100px'> <p>";
            echo "1. file name : {$_FILES['upload']['name'][$i]}<br />";
            echo "2. file type : {$_FILES['upload']['type'][$i]}<br />";
            echo "3. file size : {$_FILES['upload']['size'][$i]} byte <br />";
            echo "4. temporary file size : {$_FILES['upload']['size'][$i]}<br />";
        } else {
            echo "파일 업로드 실패 !! 다시 시도해주세요.<br />";
        }
    }
?>




<?php
include_once('../_tail.php');
?>