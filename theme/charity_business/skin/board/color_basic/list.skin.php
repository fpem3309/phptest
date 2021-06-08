<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

?>

<script>
$(window).on('load', function() {
    $('#bo_cate_on').css("background-color", "<?php echo $board['bo_1']; ?>");
    $('#bo_list .cnt_cmt').css("background-color", "<?php echo $board['bo_1']; ?>");
    $('#bo_list .btn_list_01 a').css("background-color", "<?php echo $board['bo_1']; ?>");
    $('#bo_list .td_num2 .fa-bell').css("color", "<?php echo $board['bo_1']; ?>");
    $('#bo_list .td_num2 .fa-lock').css("color", "<?php echo $board['bo_1']; ?>");
    $('#bo_list .comm_cnt').css("color", "<?php echo $board['bo_1']; ?>");
    $('.scrap_ico .fa-heart').css("color", "<?php echo $board['bo_1']; ?>");
    //$('.scrap_ico .fa-heart-o').css("color", "<?php echo $board['bo_1']; ?>"); 빈하트 컬러적용시 주석해제
});
</script>



<!-- 게시판 목록 시작 { -->
<div id="bo_list" style="width:<?php echo $width; ?>">





    
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
        <div id="bo_list_total">
            <span>Total <?php echo number_format($total_count) ?>건</span>
            <?php echo $page ?> 페이지
        </div>
    </div>
    <!-- } 게시판 페이지 정보 및 버튼 끝 -->
        	
    <div class="tbl_head01 tbl_wrap">
        <table>
        <caption><?php echo $board['bo_subject'] ?> 목록</caption>
        <!--
        <thead>
        <tr>

            <th scope="col" class="all_chk chk_box">

            </th>

            <th scope="col">번호</th>
            <th scope="col">제목</th>
            <th scope="col">글쓴이</th>
            <th scope="col"><?php echo subject_sort_link('wr_hit', $qstr2, 1) ?>조회 </a></th>
            <?php if ($is_good) { ?><th scope="col"><?php echo subject_sort_link('wr_good', $qstr2, 1) ?>추천 </a></th><?php } ?>
            <?php if ($is_nogood) { ?><th scope="col"><?php echo subject_sort_link('wr_nogood', $qstr2, 1) ?>비추천 </a></th><?php } ?>
            <th scope="col"><?php echo subject_sort_link('wr_datetime', $qstr2, 1) ?>날짜  </a></th>
        </tr>
        </thead>
        -->
        <tbody>
        <?php
        for ($i=0; $i<count($list); $i++) {
            
            if ($member['mb_id']) {
                $myscrap = sql_fetch("select count(*) as cnt from ".$g5['scrap_table']." where mb_id = '".$member['mb_id']."' and bo_table = '".$bo_table."' and wr_id = '".$list[$i]['wr_id']."'");        
            }
            
            $thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], "50", "40");
            
        	if ($i%2==0) $lt_class = "even";
        	else $lt_class = "";
		?>
        <tr class="<?php if ($list[$i]['is_notice']) echo "bo_notice"; ?> <?php echo $lt_class ?>">
            
            <td class="td_num2">
            <?php
            if ($list[$i]['is_notice']) // 공지사항
                echo '<i class="fa fa-bell" aria-hidden="true"></i>';
            else if ($wr_id == $list[$i]['wr_id'])
                echo "<span class=\"bo_current\">열람중</span>";
            else if ($list[$i]['icon_secret']) 
                echo '<i class="fa fa-lock" aria-hidden="true"></i>';
            else
                echo $list[$i]['num'];
             ?>
            </td>

            <td class="td_subject" style="padding-left:<?php echo $list[$i]['reply'] ? (strlen($list[$i]['wr_reply'])*10) : '0'; ?>px">

                <div class="bo_tit">
                    <!--
                    <ul class="bo_tit_ul1">
                    </ul>
                    -->
                    <ul class="bo_tit_ul2">
                    <a href="<?php echo $list[$i]['href'] ?>" <?php if($list[$i]['icon_secret']) { ?>style="color:#999"<?php } ?>>
                        <?php echo $list[$i]['icon_reply'] ?>
                        
                        <?php if($list[$i]['icon_secret']) { ?>
                        비밀글로 보호된 글입니다.
                        <?php } else { ?>
                        <?php echo $list[$i]['subject'] ?> <?php if ($list[$i]['comment_cnt']) { ?><a class="comm_cnt">+<?php echo $list[$i]['wr_comment']; ?> </a><?php } ?>
                    </a><?php } ?> <?php if ($list[$i]['icon_new']) echo "<span class=\"new_icon\">N<span class=\"sound_only\">새글</span></span>";?>
                    </ul>
                    <ul class="bo_tit_ul3">
                        <span class="bo_names"><?php echo $list[$i]['name'] ?></span>　
                        <?php if ($is_category && $list[$i]['ca_name']) { ?>
                        <?php echo $list[$i]['ca_name'] ?>　
                        <?php } ?>
                        <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $list[$i]['datetime'] ?>　
                        <i class="fa fa-eye" aria-hidden="true"></i> <?php echo $list[$i]['wr_hit'] ?>　
                    </ul>
                    
                </div>
            </td>
            
            

            

            
            <?php if ($is_checkbox) { ?>
            <td class="td_chk chk_box">
				<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>" class="selec_chk">
            	<label for="chk_wr_id_<?php echo $i ?>">
            		<span></span>
            		<b class="sound_only"><?php echo $list[$i]['subject'] ?></b>
            	</label>
            </td>
            <?php } ?>

        </tr>
        <?php } ?>
        <?php if (count($list) == 0) { echo '<tr><td colspan="'.$colspan.'" class="empty_table">게시물이 없습니다.</td></tr>'; } ?>
        </tbody>
        </table>
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

    
</div>
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
