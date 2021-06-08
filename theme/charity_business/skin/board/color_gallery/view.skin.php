<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<script>
$(window).on('load', function() {
    $('.btn_v_01 a').css("background-color", "<?php echo $board['bo_1']; ?>");
    $('.bo_vc_w .btn_submit').css("background-color", "<?php echo $board['bo_1']; ?>");

});
</script>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>




        <div class="row">
          <div class="span12">
            <article>
              <div class="row">
                <div class="span12">
                  <div class="post-image">
                    <div class="post-heading">
                      <h3><a href="#"><?php echo cut_str(get_text($view['wr_subject']), 70); // 글제목 출력 ?></a></h3>
                    </div>
                    <?php
					// 파일 출력
					$v_img_count = count($view['file']);
					if($v_img_count) {
						echo "<div id=\"bo_v_img\">\n";

						for ($i=0; $i<=count($view['file']); $i++) {
							echo get_file_thumbnail($view['file'][$i]);
						}

						echo "</div>\n";
					}
					 ?>
                  </div>
                  <p>
					<!-- 본문 내용 시작 { -->
					<?php echo get_view_thumbnail($view['content']); ?>
					<?php //echo $view['rich_content']; // {이미지:0} 과 같은 코드를 사용할 경우 ?>
					<!-- } 본문 내용 끝 -->
                  </p>
                  <div class="bottom-article">
                    <ul class="meta-post">
                      <li><i class="icon-user"></i><a href="#"> <?php echo $view['name'] ?><?php if ($is_ip_view) { echo "&nbsp;($ip)"; } ?></a></li>
					  <li><i class="icon-tag"></i><?php echo $view['ca_name']; // 분류 출력 끝 ?></li>
                      <li><i class="icon-comments-alt"></i><a href="#bo_vc"> <?php echo number_format($view['wr_comment']) ?></a></li>
                      <li><i class="icon-eye-open"></i><a href="#"><?php echo number_format($view['wr_hit']) ?></a></li>
                      <li><i class="icon-calendar"></i><a href="#"><?php echo date("y-m-d H:i", strtotime($view['wr_datetime'])) ?></a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </article>




			<div class="row">
              <div class="span8">
				<a href="<?php echo $list_href ?>" class="btn" title="목록">목록</a>
	            <?php if ($reply_href) { ?><a href="<?php echo $reply_href ?>" class="btn" title="답변">답변</a><?php } ?>
	            <?php if ($write_href) { ?><a href="<?php echo $write_href ?>" class="btn" title="작성">작성</a><?php } ?>
              </div>
              <div class="span4">
	        	<?php if($update_href || $delete_href || $copy_href || $move_href || $search_href) { ?>
			            <?php if ($update_href) { ?><a href="<?php echo $update_href ?>" class="btn">수정</a><?php } ?>
			            <?php if ($delete_href) { ?><a href="<?php echo $delete_href ?>" class="btn" onclick="del(this.href); return false;">삭제</a><?php } ?>
			            <?php if ($copy_href) { ?><a href="<?php echo $copy_href ?>" class="btn" onclick="board_move(this.href); return false;">복사</a><?php } ?>
			            <?php if ($move_href) { ?><a href="<?php echo $move_href ?>" class="btn" onclick="board_move(this.href); return false;">이동</a><?php } ?>

	        	<?php } ?>
              </div>
            </div>

       
			<div class="row">
<!-- 게시물 읽기 시작 { -->

    
   <?php
    $cnt = 0;
    if ($view['file']['count']) {
        for ($i=0; $i<count($view['file']); $i++) {
            if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view'])
                $cnt++;
        }
    }
	?>

    <?php if($cnt) { ?>
    <!-- 첨부파일 시작 { -->

        <ul>
        <?php
        // 가변 파일
        for ($i=0; $i<count($view['file']); $i++) {
            if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) {
         ?>
            <li>
               	<i class="fa fa-folder-open" aria-hidden="true"></i>
                <a href="<?php echo $view['file'][$i]['href'];  ?>" class="view_file_download" download>
                    <strong><?php echo $view['file'][$i]['source'] ?></strong> <?php echo $view['file'][$i]['content'] ?> (<?php echo $view['file'][$i]['size'] ?>)
                </a>
                <br>
                <span class="bo_v_file_cnt"><?php echo $view['file'][$i]['download'] ?>회 다운로드 | DATE : <?php echo $view['file'][$i]['datetime'] ?></span>
            </li>
        <?php
            }
        }
         ?>
        </ul>

    <!-- } 첨부파일 끝 -->
    <?php } ?>

    <?php if(isset($view['link'][1]) && $view['link'][1]) { ?>
    <!-- 관련링크 시작 { -->

        <ul>
        <?php
        // 링크
        $cnt = 0;
        for ($i=1; $i<=count($view['link']); $i++) {
            if ($view['link'][$i]) {
                $cnt++;
                $link = cut_str($view['link'][$i], 70);
            ?>
            <li>
                <i class="fa fa-link" aria-hidden="true"></i>
                <a href="<?php echo $view['link_href'][$i] ?>" target="_blank">
                    <strong><?php echo $link ?></strong>
                </a>
                <br>
                <span class="bo_v_link_cnt"><?php echo $view['link_hit'][$i] ?>회 연결</span>
            </li>
            <?php
            }
        }
        ?>
        </ul>

    <!-- } 관련링크 끝 -->
    <?php } ?>
    
            </div>

    <?php if ($prev_href || $next_href) { ?>

        <?php if ($prev_href) { ?>
 			<div class="row">
              <div class="span6">
                <dd class="elc_01"><span class="nb_tit"><i class="fa fa-chevron-up" aria-hidden="true"></i> 이전글</span></dd>
                <dd class="elc_02"><a href="<?php echo $prev_href ?>"><?php echo $prev_wr_subject;?></a></dd>
                <dd class="elc_03"><span class="nb_date"><?php echo str_replace('-', '.', substr($prev_wr_date, '2', '8')); ?></span></dd>
 			  </div>


            <?php } ?>

            <?php if ($next_href) { ?>
              <div class="span6">
                <dd class="elc_01"><span class="nb_tit"><i class="fa fa-chevron-down" aria-hidden="true"></i> 다음글</span></dd>
                <dd class="elc_02"><a href="<?php echo $next_href ?>"><?php echo $next_wr_subject;?></a></dd>
                <dd class="elc_03"><span class="nb_date"><?php echo str_replace('-', '.', substr($next_wr_date, '2', '8')); ?></span></dd>
 			  </div>

        <?php } ?>
            </div>
    <?php } ?>
</div>

    <?php
    // 코멘트 입출력
    include_once(G5_BBS_PATH.'/view_comment.php');
	?>

<!-- } 게시판 읽기 끝 -->

<script>
<?php if ($board['bo_download_point'] < 0) { ?>
$(function() {
    $("a.view_file_download").click(function() {
        if(!g5_is_member) {
            alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
            return false;
        }

        var msg = "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";

        if(confirm(msg)) {
            var href = $(this).attr("href")+"&js=on";
            $(this).attr("href", href);

            return true;
        } else {
            return false;
        }
    });
});
<?php } ?>

function board_move(href)
{
    window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}
</script>

<script>
$(function() {
    $("a.view_image").click(function() {
        window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });

    // 추천, 비추천
    $("#good_button, #nogood_button").click(function() {
        var $tx;
        if(this.id == "good_button")
            $tx = $("#bo_v_act_good");
        else
            $tx = $("#bo_v_act_nogood");

        excute_good(this.href, $(this), $tx);
        return false;
    });

    // 이미지 리사이즈
    $("#bo_v_atc").viewimageresize();
});

function excute_good(href, $el, $tx)
{
    $.post(
        href,
        { js: "on" },
        function(data) {
            if(data.error) {
                alert(data.error);
                return false;
            }

            if(data.count) {
                $el.find("strong").text(number_format(String(data.count)));
                if($tx.attr("id").search("nogood") > -1) {
                    $tx.text("이 글을 비추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                } else {
                    $tx.text("이 글을 추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                }
            }
        }, "json"
    );
}
</script>
<!-- } 게시글 읽기 끝 -->