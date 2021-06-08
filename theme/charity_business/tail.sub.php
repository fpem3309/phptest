<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<?php if ($is_admin == 'super') {  ?><!-- <div style='float:left; text-align:center;'>RUN TIME : <?php echo get_microtime()-$begin_time; ?><br></div> --><?php }  ?>

<!-- ie6,7에서 사이드뷰가 게시판 목록에서 아래 사이드뷰에 가려지는 현상 수정 -->
<!--[if lte IE 7]>
<script>
$(function() {
    var $sv_use = $(".sv_use");
    var count = $sv_use.length;

    $sv_use.each(function() {
        $(this).css("z-index", count);
        $(this).css("position", "relative");
        count = count - 1;
    });
});
</script>
<![endif]-->

<?php run_event('tail_sub'); ?>


<a href="#" class="scrollup"><i class="icon-chevron-up icon-square icon-32 active"></i></a>
  <!-- javascript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="<?php echo G5_THEME_URL; ?>/js/jquery.js"></script>
  <script src="<?php echo G5_THEME_URL; ?>/js/jquery.easing.1.3.js"></script>
  <script src="<?php echo G5_THEME_URL; ?>/js/bootstrap.js"></script>
  <script src="<?php echo G5_THEME_URL; ?>/js/jcarousel/jquery.jcarousel.min.js"></script>
  <script src="<?php echo G5_THEME_URL; ?>/js/jquery.fancybox.pack.js"></script>
  <script src="<?php echo G5_THEME_URL; ?>/js/jquery.fancybox-media.js"></script>
  <script src="<?php echo G5_THEME_URL; ?>/js/google-code-prettify/prettify.js"></script>
  <script src="<?php echo G5_THEME_URL; ?>/js/portfolio/jquery.quicksand.js"></script>
  <script src="<?php echo G5_THEME_URL; ?>/js/portfolio/setting.js"></script>
  <script src="<?php echo G5_THEME_URL; ?>/js/jquery.flexslider.js"></script>
  <script src="<?php echo G5_THEME_URL; ?>/js/jquery.nivo.slider.js"></script>
  <script src="<?php echo G5_THEME_URL; ?>/js/modernizr.custom.js"></script>
  <script src="<?php echo G5_THEME_URL; ?>/js/jquery.ba-cond.min.js"></script>
  <script src="<?php echo G5_THEME_URL; ?>/js/jquery.slitslider.js"></script>
  <script src="<?php echo G5_THEME_URL; ?>/js/animate.js"></script>

  <!-- Template Custom JavaScript File -->
  <script src="<?php echo G5_THEME_URL; ?>/js/custom.js"></script>


</body>
</html>
<?php echo html_end(); // HTML 마지막 처리 함수 : 반드시 넣어주시기 바랍니다.