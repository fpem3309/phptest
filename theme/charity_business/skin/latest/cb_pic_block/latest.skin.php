<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
$thumb_width = 600;
$thumb_height = 400;
$list_count = (is_array($list) && $list) ? count($list) : 0;
?>
  <div class="span12">
	<h4 class="heading"><a href="<?php echo get_pretty_url($bo_table); ?>" style="color:#000"><?php echo $bo_subject ?></a></h4>
	<div class="row">
	  <section id="projects">
		<ul id="thumbs" class="portfolio">
		<?php
		for ($i=0; $i<$list_count; $i++) {
		$thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $thumb_width, $thumb_height, false, true);

		if($thumb['src']) {
			$img = $thumb['src'];
		} else {
			$img = G5_IMG_URL.'/no_img.png';
			$thumb['alt'] = '이미지가 없습니다.';
		}
		$img_content = '<img src="'.$img.'" alt="'.$thumb['alt'].'" >';
		$wr_href = get_pretty_url($bo_table, $list[$i]['wr_id']);
		?>
		  <!-- Item Project and Filter Name -->
		  <li class="item-thumbs span3 design" data-id="id-0" data-type="web">
			<!-- Fancybox - Gallery Enabled - Title - Full Image -->
			<a class="hover-wrap fancybox" data-fancybox-group="gallery" title="<?php echo cut_str($list[$i]['subject'], 50, "..") ?>" href="<?php echo $thumb["ori"] ?>">
				<span class="overlay-img"></span>
				<span class="overlay-img-thumb font-icon-plus"></span>
				</a>
			<!-- Thumb Image and Description -->
			<a href="<?php echo $wr_href; ?>" class="lt_img"><?php echo run_replace('thumb_image_tag', $img_content, $thumb); ?></a>
		  </li>

		  <!-- End Item Project -->
    <?php }  ?>
    <?php if ($list_count == 0) { //게시물이 없을 때  ?>
    <li class="empty_li">게시물이 없습니다.</li>
    <?php }  ?>
		</ul>
	  </section>
	</div>
  </div>