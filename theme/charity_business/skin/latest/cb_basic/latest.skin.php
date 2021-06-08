<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
$list_count = (is_array($list) && $list) ? count($list) : 0;
?>
  <div class="span4">
	<div class="pricing-box-alt">
	  <div class="pricing-heading">
		<h3><a href="<?php echo get_pretty_url($bo_table); ?>" style="color:#000"><?php echo $bo_subject ?></a></h3>
	  </div>
	  <div class="pricing-content">
		<ul>
		<?php for ($i=0; $i<$list_count; $i++) {  ?>
			  <li><i class="icon-ok"></i> <?php
				if ($list[$i]['icon_secret']) echo "<i class=\"fa fa-lock\" aria-hidden=\"true\"></i><span class=\"sound_only\">비밀글</span> ";

				echo "<a href=\"".get_pretty_url($bo_table, $list[$i]['wr_id'])."\" style=\"color:#000\"> ";
				if ($list[$i]['is_notice'])
					echo "<strong>".$list[$i]['subject']."</strong>";
				else
					echo $list[$i]['subject'];

				echo "</a>";
				
				if ($list[$i]['icon_hot']) echo "<span class=\"hot_icon\"><i class=\"fa fa-heart\" aria-hidden=\"true\"></i><span class=\"sound_only\">인기글</span></span>";
				if ($list[$i]['icon_new']) echo "<span class=\"new_icon\">N<span class=\"sound_only\">새글</span></span>";
				// if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
				// if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }

				echo $list[$i]['icon_reply']." ";
				if ($list[$i]['icon_file']) echo " <i class=\"fa fa-download\" aria-hidden=\"true\"></i>" ;
				if ($list[$i]['icon_link']) echo " <i class=\"fa fa-link\" aria-hidden=\"true\"></i>" ;

				if ($list[$i]['comment_cnt'])  echo "
				<span class=\"lt_cmt\"><span class=\"sound_only\">댓글</span>".$list[$i]['comment_cnt']."</span>";

				?></li>
		<?php }  ?>
		<?php if ($list_count == 0) { //게시물이 없을 때  ?>
		<li>게시물이 없습니다.</li>
		<?php }  ?>
		</ul>
	  </div>
	  <div class="pricing-action">
		<a href="<?php echo get_pretty_url($bo_table); ?>" class="btn btn-medium btn-theme"><i class="icon-plus-sign"></i> 더보기</a>
	  </div>
	</div>
  </div>