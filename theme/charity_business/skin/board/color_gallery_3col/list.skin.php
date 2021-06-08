<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>




    
    <form name="fboardlist" id="fboardlist" action="<?php echo G5_BBS_URL; ?>/board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">

    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div id="bo_btn_top">
        <div id="bo_list_total">
            
            
    <!-- 게시판 카테고리 시작 { -->
    <?php if ($is_category) { ?>

        <ul class="portfolio-categ filter">
            <?php echo $category_option ?>
        </ul>

    <?php } ?>
    <!-- } 게시판 카테고리 끝 -->
<br><br><br>

    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div id="bo_btn_top">
        
		    <?php if ($is_checkbox) { ?>
    <div id="gall_allchk" class="all_chk chk_box">
        <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);" class="selec_chk">
        <label for="chkall">
            <span></span>
            <b class="sound_only">현재 페이지 게시물 </b> 전체선택
        </label>
    </div>
    <?php } ?>
		
		
		<div id="bo_list_total">
            <span>Total <?php echo number_format($total_count) ?>건</span>
            <?php echo $page ?> 페이지
        </div>
    </div>
    <!-- } 게시판 페이지 정보 및 버튼 끝 -->
        	
    









            <div class="row">
              <section id="projects">
                <ul id="thumbs" class="portfolio">

        <?php for ($i=0; $i<count($list); $i++) {

            $classes = array();
            
            $classes[] = 'gall_li';
            $classes[] = 'col-gn-'.$bo_gallery_cols;

            if( $i && ($i % $bo_gallery_cols == 0) ){
                $classes[] = 'box_clear';
            }

            if( $wr_id && $wr_id == $list[$i]['wr_id'] ){
                $classes[] = 'gall_now';
            }

            $line_height_style = ($board['bo_gallery_height'] > 0) ? 'line-height:'.$board['bo_gallery_height'].'px' : '';
         ?>

<li class="item-thumbs span4 design" data-id="id-0" data-type="web">
											<a href="<?php echo $list[$i]['href'] ?>">
                        <?php
                        if ($list[$i]['is_notice']) { // 공지사항  ?>
                            <span class="is_notice" style="<?php echo $line_height_style; ?>">공지</span>
                        <?php } else {
                            $thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height'], false, true);

                            if($thumb['src']) {
                                $img_content = '<img src="'.$thumb['src'].'" class="img-responsive" alt="'.$thumb['alt'].'" >';
                            } else {
                                $img_content = '<span class="no_image" style="'.$line_height_style.'">no image</span>';
                            }

                            echo run_replace('thumb_image_tag', $img_content, $thumb);
                        }
                         ?>
                        </a>


												<a href="<?php echo $thumb['ori'] ?>" class="team-item-detail-inner light-color fancylight" data-fancybox-group="light"> <span class="icon-box fa fa-picture-o"></span> </a>

											<div class="gall_chk chk_box">
												<?php if ($is_checkbox) { ?>
												<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>" class="selec_chk">
												<label for="chk_wr_id_<?php echo $i ?>">
													<span></span>
													<b class="sound_only"><?php echo $list[$i]['subject'] ?></b>
												</label>
												<?php } ?>
												<span class="sound_only">
													<?php
													if ($wr_id == $list[$i]['wr_id'])
														echo "<span class=\"bo_current\">열람중</span>";
													else
														echo $list[$i]['num'];
													 ?>
												</span><a href="<?php echo $list[$i]['href'] ?>" class="bo_tit">
                            <?php echo utf8_strcut(strip_tags($list[$i]['subject']), 10, '..'); ?>                    
                         </a>

</li>



        <?php } ?>
        <?php if (count($list) == 0) { echo "<li class=\"empty_list\">게시물이 없습니다.</li>"; } ?>

                  <!-- End Item Project -->
                </ul>
              </section>
            </div>





    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">
        <?php if ($list_href || $write_href) { ?>

            <?php if ($is_checkbox) { ?>
            <button type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value" class="btn btn-primary btn-large btn-rounded">선택삭제</button>
            <button type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value" class="btn btn-primary btn-large btn-rounded">선택복사</button>
            <button type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value" class="btn btn-primary btn-large btn-rounded">선택이동</button>
            <?php } ?>
            <?php if ($list_href) { ?><a href="<?php echo $list_href ?>" class="btn btn-primary btn-large btn-rounded">목록</a><?php } ?>
            <?php if ($write_href) { ?><a href="<?php echo $write_href ?>" class="btn btn-primary btn-large btn-rounded">글쓰기</a><?php } ?>

        <?php } ?>
    </div>
    <?php } ?>

<br><br>

	<!-- 페이지 -->
	<?php echo $write_pages; ?>
	<!-- 페이지 -->
	
 
    </form>

    

<br><br>
<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = g5_bbs_url+"/board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == "copy")
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = g5_bbs_url+"/move.php";
    f.submit();
}

// 게시판 리스트 관리자 옵션
jQuery(function($){
    $(".btn_more_opt.is_list_btn").on("click", function(e) {
        e.stopPropagation();
        $(".more_opt.is_list_btn").toggle();
    });
    $(document).on("click", function (e) {
        if(!$(e.target).closest('.is_list_btn').length) {
            $(".more_opt.is_list_btn").hide();
        }
    });
});
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->
