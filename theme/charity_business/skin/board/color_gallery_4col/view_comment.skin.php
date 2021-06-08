<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<script>
// 글자수 제한
var char_min = parseInt(<?php echo $comment_min ?>); // 최소
var char_max = parseInt(<?php echo $comment_max ?>); // 최대
</script>
<div class="row h1"><p class="hidden"></p></div><div class="row h1"><p class="hidden"></p></div><div class="row h1"><p class="hidden"></p></div><div class="row h1"><p class="hidden"></p></div>
<!-- 댓글 시작 { -->
<div class="comment_list clearfix" id="comments">

    <h4>댓글목록</h4>
				<ol>
    <?php
    $cmt_amt = count($list);
    for ($i=0; $i<$cmt_amt; $i++) {
        $comment_id = $list[$i]['wr_id'];
        $cmt_depth = ""; // 댓글단계
        $cmt_depth = strlen($list[$i]['wr_comment_reply']) * 20;
        $comment = $list[$i]['content'];
        /*
        if (strstr($list[$i]['wr_option'], "secret")) {
            $str = $str;
        }
        */
        $comment = preg_replace("/\[\<a\s.*href\=\"(http|https|ftp|mms)\:\/\/([^[:space:]]+)\.(mp3|wma|wmv|asf|asx|mpg|mpeg)\".*\<\/a\>\]/i", "<script>doc_write(obj_movie('$1://$2.$3'));</script>", $comment);
        $cmt_sv = $cmt_amt - $i + 1; // 댓글 헤더 z-index 재설정 ie8 이하 사이드뷰 겹침 문제 해결
     ?>


			
    <article id="c_<?php echo $comment_id ?>" <?php if ($cmt_depth) { ?>style="margin-left:<?php echo $cmt_depth ?>px;border-top-color:#e0e0e0"<?php } ?>>



              <div class="media">
                <a href="#" class="thumbnail pull-left"><?php echo get_member_profile_img($list[$i]['mb_id']); ?></a>
                <div class="media-body">
                  <div class="media-content">
                    <h6><span><?php echo $list[$i]['datetime'] ?></span> <?php echo get_text($list[$i]['wr_name']); ?></h6>
                    <p>
                                  <?php if (strstr($list[$i]['wr_option'], "secret")) { ?><?php } ?>
            <?php echo $comment ?>
                    </p>

                <?php if ($list[$i]['is_reply']) { ?><a href="<?php echo $c_reply_href;  ?>" onclick="comment_box('<?php echo $comment_id ?>', 'c'); return false;" class="align-right">답변</a><?php } ?>
                <?php if ($list[$i]['is_edit']) { ?><a href="<?php echo $c_edit_href;  ?>" onclick="comment_box('<?php echo $comment_id ?>', 'cu'); return false;" class="align-right">수정</a><?php } ?>
                <?php if ($list[$i]['is_del'])  { ?><a href="<?php echo $list[$i]['del_link'];  ?>" onclick="return comment_delete();" class="align-right">삭제</a><?php } ?>
  
                  </div>
                </div>
              </div>

 
        <span id="edit_<?php echo $comment_id ?>"></span><!-- 수정 -->
        <span id="reply_<?php echo $comment_id ?>"></span><!-- 답변 -->

        <input type="hidden" value="<?php echo strstr($list[$i]['wr_option'],"secret") ?>" id="secret_comment_<?php echo $comment_id ?>">
        <textarea id="save_comment_<?php echo $comment_id ?>" style="display:none"><?php echo get_text($list[$i]['content1'], 0) ?></textarea>

        <?php if($list[$i]['is_reply'] || $list[$i]['is_edit'] || $list[$i]['is_del']) {
            $query_string = clean_query_string($_SERVER['QUERY_STRING']);

            if($w == 'cu') {
                $sql = " select wr_id, wr_content, mb_id from $write_table where wr_id = '$c_id' and wr_is_comment = '1' ";
                $cmt = sql_fetch($sql);
                if (!($is_admin || ($member['mb_id'] == $cmt['mb_id'] && $cmt['mb_id'])))
                    $cmt['wr_content'] = '';
                $c_wr_content = $cmt['wr_content'];
            }

            $c_reply_href = './board.php?'.$query_string.'&amp;c_id='.$comment_id.'&amp;w=c#bo_vc_w';
            $c_edit_href = './board.php?'.$query_string.'&amp;c_id='.$comment_id.'&amp;w=cu#bo_vc_w';
         ?>
         

        <?php } ?>



    </article>
				
    <?php } ?>
    <?php if ($i == 0) { //댓글이 없다면 ?><p id="bo_vc_empty">등록된 댓글이 없습니다.</p><?php } ?>
</ol>

</div>
<!-- } 댓글 끝 -->

<?php if ($is_comment_write) {
    if($w == '')
        $w = 'c';
?>
<!-- 댓글 쓰기 시작 { -->
<aside id="bo_vc_w">
<div class="add_comment" id="addcomments">
	<div class="add_comment_title">
		<h4>댓글쓰기</h4>
	</div>
	<div class="clear"></div>
	<div class="comment_form">
								 <form id="commentform" name="fviewcomment" action="./write_comment_update.php" onsubmit="return fviewcomment_submit(this);" method="post" autocomplete="off">
								<input type="hidden" name="w" value="<?php echo $w ?>" id="w">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="comment_id" value="<?php echo $c_id ?>" id="comment_id">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="is_good" value="">
                <div class="row">


							<?php if ($is_guest) { ?>
                  <div class="span3">
							   <input type="text" name="wr_name" value="<?php echo get_cookie("ck_sns_name"); ?>" id="wr_name" required placeholder="* Enter your id">

                  </div>
                  <div class="span2">
							   <input type="password" name="wr_password" id="wr_password" required placeholder="* Enter your password">
                  </div>
							<?php } ?>

							<?php if ($is_guest) { ?>
				  <div class="span12">
								<?php echo $captcha_html; ?>
                  </div>

							<?php } ?>

                  <div class="span12">
							   비밀글사용<input type="checkbox" name="wr_secret" value="secret" id="wr_secret">
                  </div>




  <div class="span12 margintop10">
										 <?php if ($comment_min || $comment_max) { ?><strong id="char_cnt"><span id="char_count"></span>글자</strong><?php } ?>
									<textarea rows="6" id="wr_content" name="wr_content" maxlength="10000" required class="textarea textarea_middle required" title="내용"
									<?php if ($comment_min || $comment_max) { ?>onkeyup="check_byte('wr_content', 'char_count');"<?php } ?> class="textarea textarea_middle required"><?php echo $c_wr_content;  ?></textarea>
									<?php if ($comment_min || $comment_max) { ?><script> check_byte('wr_content', 'char_count'); </script><?php } ?>
									<script>
									$(document).on( "keyup change", "textarea#wr_content[maxlength]", function(){
										var str = $(this).val()
										var mx = parseInt($(this).attr("maxlength"))
										if (str.length > mx) {
											$(this).val(str.substr(0, mx));
											return false;
										}
									});
									</script>


										<input type="submit" id="btn_submit" value="댓글등록" class="btn btn-theme margintop10">       </div>                     
</div>
								</form>
								</div>
</div>
</aside>

<script>
var save_before = '';
var save_html = document.getElementById('bo_vc_w').innerHTML;

function good_and_write()
{
    var f = document.fviewcomment;
    if (fviewcomment_submit(f)) {
        f.is_good.value = 1;
        f.submit();
    } else {
        f.is_good.value = 0;
    }
}

function fviewcomment_submit(f)
{
    var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자

    f.is_good.value = 0;

    var subject = "";
    var content = "";
    $.ajax({
        url: g5_bbs_url+"/ajax.filter.php",
        type: "POST",
        data: {
            "subject": "",
            "content": f.wr_content.value
        },
        dataType: "json",
        async: false,
        cache: false,
        success: function(data, textStatus) {
            subject = data.subject;
            content = data.content;
        }
    });

    if (content) {
        alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
        f.wr_content.focus();
        return false;
    }

    // 양쪽 공백 없애기
    var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자
    document.getElementById('wr_content').value = document.getElementById('wr_content').value.replace(pattern, "");
    if (char_min > 0 || char_max > 0)
    {
        check_byte('wr_content', 'char_count');
        var cnt = parseInt(document.getElementById('char_count').innerHTML);
        if (char_min > 0 && char_min > cnt)
        {
            alert("댓글은 "+char_min+"글자 이상 쓰셔야 합니다.");
            return false;
        } else if (char_max > 0 && char_max < cnt)
        {
            alert("댓글은 "+char_max+"글자 이하로 쓰셔야 합니다.");
            return false;
        }
    }
    else if (!document.getElementById('wr_content').value)
    {
        alert("댓글을 입력하여 주십시오.");
        return false;
    }

    if (typeof(f.wr_name) != 'undefined')
    {
        f.wr_name.value = f.wr_name.value.replace(pattern, "");
        if (f.wr_name.value == '')
        {
            alert('이름이 입력되지 않았습니다.');
            f.wr_name.focus();
            return false;
        }
    }

    if (typeof(f.wr_password) != 'undefined')
    {
        f.wr_password.value = f.wr_password.value.replace(pattern, "");
        if (f.wr_password.value == '')
        {
            alert('비밀번호가 입력되지 않았습니다.');
            f.wr_password.focus();
            return false;
        }
    }

    <?php if($is_guest) echo chk_captcha_js();  ?>

    set_comment_token(f);

    document.getElementById("btn_submit").disabled = "disabled";

    return true;
}

function comment_box(comment_id, work)
{
    var el_id;
    // 댓글 아이디가 넘어오면 답변, 수정
    if (comment_id)
    {
        if (work == 'c')
            el_id = 'reply_' + comment_id;
        else
            el_id = 'edit_' + comment_id;
    }
    else
        el_id = 'bo_vc_w';

    if (save_before != el_id)
    {
        if (save_before)
        {
            document.getElementById(save_before).style.display = 'none';
            document.getElementById(save_before).innerHTML = '';
        }

        document.getElementById(el_id).style.display = '';
        document.getElementById(el_id).innerHTML = save_html;
        // 댓글 수정
        if (work == 'cu')
        {
            document.getElementById('wr_content').value = document.getElementById('save_comment_' + comment_id).value;
            if (typeof char_count != 'undefined')
                check_byte('wr_content', 'char_count');
            if (document.getElementById('secret_comment_'+comment_id).value)
                document.getElementById('wr_secret').checked = true;
            else
                document.getElementById('wr_secret').checked = false;
        }

        document.getElementById('comment_id').value = comment_id;
        document.getElementById('w').value = work;

        if(save_before)
            $("#captcha_reload").trigger("click");

        save_before = el_id;
    }
}

function comment_delete()
{
    return confirm("이 댓글을 삭제하시겠습니까?");
}

comment_box('', 'c'); // 댓글 입력폼이 보이도록 처리하기위해서 추가 (root님)

<?php if($board['bo_use_sns'] && ($config['cf_facebook_appid'] || $config['cf_twitter_key'])) { ?>
// sns 등록
$(function() {
    $("#bo_vc_send_sns").load(
        "<?php echo G5_SNS_URL; ?>/view_comment_write.sns.skin.php?bo_table=<?php echo $bo_table; ?>",
        function() {
            save_html = document.getElementById('bo_vc_w').innerHTML;
        }
    );
});
<?php } ?>
</script>
<?php } ?>
<!-- } 댓글 쓰기 끝 -->