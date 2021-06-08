<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">', 0);
?>


    <section>
<!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="wr_1" id="wr_1" value="<?php echo $write['wr_1'] ?>">
    <?php
    $option = '';
    $option_hidden = '';
    if ($is_notice || $is_html || $is_secret || $is_mail) {
        $option = '';
        if ($is_notice) {
            $option .= "\n".'<input type="checkbox" id="notice" name="notice" value="1" '.$notice_checked.'>'."\n".'<label for="notice">공지</label>';
        }

        if ($is_html) {
            if ($is_dhtml_editor) {
                $option_hidden .= '<input type="hidden" value="html1" name="html">';
            } else {
                $option .= "\n".'<input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'>'."\n".'<label for="html">HTML</label>';
            }
        }

        if ($is_secret) {
            if ($is_admin || $is_secret==1) {
                $option .= "\n".'<input type="checkbox" id="secret" name="secret" value="secret" '.$secret_checked.'>'."\n".'<label for="secret">비밀글</label>';
            } else {
                $option_hidden .= '<input type="hidden" name="secret" value="secret">';
            }
        }

        if ($is_mail) {
            $option .= "\n".'<input type="checkbox" id="mail" name="mail" value="mail" '.$recv_email_checked.'>'."\n".'<label for="mail">답변메일받기</label>';
        }
    }

    echo $option_hidden;
    ?>

      <div class="container pt-60">
        <div class="row">
          <div class="col-md-12">
            <div class="icon-box mb-0 p-0">


<div class="bo_w_info write_div">
	<table class="table"><tbody>

    <?php if ($option) { ?>
		<tr><td>
			<div class="write_div">
				<label for="wr_subject" class="col-sm-2 control-label">옵션</label>
				<div class="col-sm-10">
					<?php echo $option ?>
				</div><!-- col-sm-10 -->

			</div>
	</td></tr>
    <?php } ?>

	<?php if ($is_category) { ?>
 		<tr><td>
   <div class="bo_w_select write_div">
        <label for="ca_name"  class="col-sm-2 control-label">분류</label>
		<div class="col-sm-10 form-inline">
			<select class="form-control" name="ca_name" id="ca_name" required>
				<option value="">분류를 선택하세요</option>
				<?php echo $category_option ?>
			</select>
			<span id="autosave_wrapper write_div">
				<?php if ($is_member) { // 임시 저장된 글 기능 ?>
				<script src="<?php echo G5_JS_URL; ?>/autosave.js"></script>
				<?php if($editor_content_js) echo $editor_content_js; ?>
				<button type="button" id="btn_autosave" class="btn_frmline pull-right">임시 저장된 글 (<span id="autosave_count"><?php echo $autosave_count; ?></span>)</button>
				<div id="autosave_pop" class="well" style="display:none">
					<ul></ul>
					<div class="text-right"><button type="button" class="autosave_close btn btn-sm btn-primary">닫기</button></div>
				</div>
				<?php } ?>
			</span>
		</div><!-- col-sm-10 -->
    </div>
  	</td></tr>
  <?php } ?>

		<tr><td>
    <div class="bo_w_tit write_div">
		<div class="col-sm-10">
				<input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="frm_input full_input form-control required" placeholder="제목">

	    </div><!-- col-sm-10 -->
        
    </div>
	</td></tr>




<?php if ($is_name) { ?>
		<tr><td>
    <div class="bo_w_tit write_div">
		<div class="col-sm-10">
				  <input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="form-control required" placeholder="이름">

	    </div><!-- col-sm-10 -->
        
    </div>
	</td></tr>
  <?php } ?>

 

      
  

	<?php if ($is_password) { ?>
		<tr><td>
    <div class="bo_w_tit write_div">
        <label for="wr_password" class="col-sm-2 control-label text-center">비밀번호</label>
		<div class="col-sm-10">
        <input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?> class="form-control <?php echo $password_required ?>" placeholder="비밀번호">
	    </div><!-- col-sm-10 -->
    </div>
	</td></tr>    
	<?php } ?>



    <?php if ($is_email) { ?>
		<tr><td>
    <div class="bo_w_tit write_div">
            <label for="wr_email" class="col-sm-2 control-label text-center">이메일</label>
		<div class="col-sm-10">
        <input type="text" name="wr_email" value="<?php echo $email ?>" id="wr_email" class="form-control email" placeholder="이메일">
	    </div><!-- col-sm-10 -->
    </div>
	</td></tr> 
    <?php } ?>
    </div>



 		<tr><td>
   <div class="write_div">
  		<div class="col-sm-10">
		  <div class="wr_content <?php echo $is_dhtml_editor ? $config['cf_editor'] : ''; ?>">
				<?php if($write_min || $write_max) { ?>
				<!-- 최소/최대 글자 수 사용 시 -->
				<p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
				<?php } ?>
				<?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
				<?php if($write_min || $write_max) { ?>
				<!-- 최소/최대 글자 수 사용 시 -->
				<div id="char_count_wrap"><span id="char_count"></span>글자</div>
				<?php } ?>
			</div>
	
	    </div><!-- col-sm-10 -->
        
    </div>
	</td></tr>

    <?php if ($is_link) { ?>
 		<tr><td>
   <div class="bo_w_link write_div">
        <label class="col-sm-2 control-label" for="wr_link1">링크</label>
  		<div class="col-sm-10">
			<input type="text" name="wr_link1" value="<?php $write['wr_link1'] ?>" id="wr_link1" class="frm_input full_input form-control" size="50">
	    </div><!-- col-sm-10 -->
    </div>
	</td></tr>

    <?php } ?>

    <?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
 		<tr><td>
   <div class="bo_w_flie write_div">
        <div class="file_wr write_div">
            <label for="bf_file_<?php echo $i+1 ?>" class="lb_icon col-sm-2 control-label">파일 #<?php echo $i+1 ?></label>
			<div class="col-sm-10">
				<input type="file" name="bf_file[]" id="bf_file_<?php echo $i+1 ?>" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file">
			</div><!-- col-sm-10 -->
       </div>
        <?php if ($is_file_content) { ?>
        <input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="full_input frm_input" size="50" placeholder="파일 설명을 입력해주세요.">
        <?php } ?>

        <?php if($w == 'u' && $file[$i]['file']) { ?>
        <span class="file_del">
            <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
        </span>
        <?php } ?>
        
    </div>
	</td></tr>
    <?php } ?>


    <?php if ($is_use_captcha) { //자동등록방지  ?>
		<tr><td>
    <div class="write_div">
        <?php echo $captcha_html ?>
    </div>
	</td></tr>
    <?php } ?>

		<tr><td>
    <div class="btn_confirm write_div">
        <input type="submit" value="작성완료" id="btn_submit" accesskey="s" class="btn btn-primary btn-large btn-rounded">
        <a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn btn-primary btn-large btn-rounded">취소</a>
    </div>
	</td></tr>

	</tbody></table>


    </form>


           </div>


          </div>
        </div>
      </div>
    </section>











    


    

    <script>
    <?php if($write_min || $write_max) { ?>
    // 글자수 제한
    var char_min = parseInt(<?php echo $write_min; ?>); // 최소
    var char_max = parseInt(<?php echo $write_max; ?>); // 최대
    check_byte("wr_content", "char_count");

    $(function() {
        $("#wr_content").on("keyup", function() {
            check_byte("wr_content", "char_count");
        });
    });

    <?php } ?>
    function html_auto_br(obj)
    {
        if (obj.checked) {
            result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
            if (result)
                obj.value = "html2";
            else
                obj.value = "html1";
        }
        else
            obj.value = "";
    }

    function fwrite_submit(f)
    {
        <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

        var subject = "";
        var content = "";
        $.ajax({
            url: g5_bbs_url+"/ajax.filter.php",
            type: "POST",
            data: {
                "subject": f.wr_subject.value,
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

		var link_url = $('#wr_link1').val();		
		video_id = youtube_video_id(link_url);	
		if (video_id) {
			wr_link1 = 'https://www.youtube.com/watch?v='+video_id;
			wr_link2 = 'http://img.youtube.com/vi/'+video_id+'/hqdefault.jpg';
			$('#wr_1').val(video_id);
			$('#wr_link1').val(wr_link1);
			$('#wr_link2').val(wr_link2);
		}

        if (subject) {
            alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
            f.wr_subject.focus();
            return false;
        }

        if (content) {
            alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
            if (typeof(ed_wr_content) != "undefined")
                ed_wr_content.returnFalse();
            else
                f.wr_content.focus();
            return false;
        }

        if (document.getElementById("char_count")) {
            if (char_min > 0 || char_max > 0) {
                var cnt = parseInt(check_byte("wr_content", "char_count"));
                if (char_min > 0 && char_min > cnt) {
                    alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
                    return false;
                }
                else if (char_max > 0 && char_max < cnt) {
                    alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                    return false;
                }
            }
        }

        <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }

	function youtube_video_id(link_url) {
		
		link_url = link_url.substring(link_url.lastIndexOf("?")+1, link_url.length);
		link_url = link_url.split("v=")[1]; 
	
		if (link_url.indexOf("&") != -1) {
			link_url = link_url.split("&")[0];
		}
		else if (link_url.indexOf("%26") != -1) {
			link_url = link_url.split("%26")[0];
		}

		return link_url;
	}


	function getvidID(link_url){

		if (confirm("썸네일정보를 불러오시겠습니까?")){
			video_id = youtube_video_id(link_url);	
			if (video_id) {
				wr_link2 = 'http://img.youtube.com/vi/'+video_id+'/hqdefault.jpg';
				$('#wr_link2').val(wr_link2);
			}
		}
	}

    </script>

<!-- } 게시물 작성/수정 끝 -->