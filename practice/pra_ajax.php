<?include_once('./_common.php'); ?>
<?include_once('../head.php'); ?>




<!-- <?for($i=0; $i<4; $i++){?>
<div>
	<ul>
		<li>a</li>
		<li>b</li>
		<li>c</li>
	<ul>
</div>


<div>
	<ul>
		<li>d</li>
		<li>e</li>
		<li>f</li>
	<ul>
</div>
 <?}?>
 -->

<?$data=[1,2,3,4];?>

<?foreach($data as $key => $value){?>

<div>
	<ul>
		<li>a</li>
		<li>b</li>
		<li>c</li>
	<ul>
</div>


<div>
	<ul>
		<li>d</li>
		<li>e</li>
		<li>f</li>
	<ul>
</div>

<?}?>





<?php
include_once('../_tail.php');
?>