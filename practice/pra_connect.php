<?php
include_once('./_common.php');

$g5['title'] = "제품소개";

include_once('../head.php');
?>



<h3>Mysql Connect</h3>
<form>
<input type="text" name="id"/>
<input type="submit" value="submit"/>
</form>

<?php
echo " DB 연결됐어? : ";
echo $_GET["id"];


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

<h3>Img Upload</h3>
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




<h3>Form POST</h3>
<form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
<input type="text" name="id" placeholder="form태그로 현재에 보낼 내용"/>
<input type="submit" value="gogo"/>
</form>

<p>form태그로 넘어온 내용 : <?=$_POST['id'];?></p>




<?php
include_once('../_tail.php');
?>