<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

/*** Stylesheets ***/
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/css/bootstrap.css">', 0);
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/css/animation.css">', 0);
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/css/preview.css">', 0);
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/css/authenty.css">', 0);
add_stylesheet('<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/themes/smoothness/jquery-ui.css">', 0);

/*** js library ***/
add_javascript('<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js"></script>', 10);
add_javascript('<script src="'.$member_skin_url.'/js/bootstrap.min.js"></script>', 10);
add_javascript('<script src="'.$member_skin_url.'/js/jquery.icheck.min.js"></script>', 10);
add_javascript('<script src="'.$member_skin_url.'/js/waypoints.min.js"></script>', 10);

/*** authenty js ***/
add_javascript('<script src="'.$member_skin_url.'/js/authenty.js"></script>', 10);

/*** preview scripts **/
add_javascript('<script src="'.$member_skin_url.'/js/preview/jquery.malihu.PageScroll2id.js"></script>', 10);
add_javascript('<script src="'.$member_skin_url.'/js/preview/jquery.address-1.6.min.js"></script>', 10);
add_javascript('<script src="'.$member_skin_url.'/js/preview/scrollTo.min.js"></script>', 10);
add_javascript('<script src="'.$member_skin_url.'/js/preview/init.js"></script>', 10);
?>

	<style>
	/*** /css/default.css ***/
	a.btn,.btn{
		height: 46px;
		padding: 10px 16px;
		line-height: 1.33333;
		border-radius: 6px;
		-webkit-transition: background-color 0.3s ease-out;
		-moz-transition: background-color 0.3s ease-out;
		-o-transition: background-color 0.3s ease-out;
		transition: background-color 0.3s ease-out;
	}

	/*** /skin/social/style.css **/
	#sns_login{border:0;}
	.login-sns { background:transparent; }
	.login-sns h3{ display:none; }

	</style>
	<section id="authenty_preview">
        <section id="signin_main" class="authenty signin-main">
            <div class="section-content">
                <div class="wrap">
                    <div class="container">
                        <div class="row">
                            <div class="form-wrap" data-animation="fadeInUp" data-animation-delay=".8s">
                                <div class="title2 hidden-sm hidden-xs"><br><br><br><br><br><br><br><br><br><br>
                                    <h1>Login</h1>
                                    <h5>Company member login</h5>
                                    <div class="overlay"></div>
                                </div>
                                <div id="form_1">
									<form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">
									<input type="hidden" name="url" value="<?php echo $login_url ?>">
                                    <div class="form-main">
                                        <div class="form-group">
                                            <input type="text" name="mb_id" id="login_id" class="form-control required" placeholder="아이디" required="required">
                                            <input type="password" name="mb_password" id="login_pw" class="form-control required" placeholder="비밀번호" required="required">
                                            <button id="signIn_1" type="submit" class="btn btn-block signin">Sign In</button>
											<input type="checkbox" name="auto_login" id="login_auto_login">
											<label for="login_auto_login">자동로그인</label>
                                        </div>
                                    </div>
                                    <div class="form-footer">
                                        <div>
                                            <div class="col-xs-7">
                                                <i class="fa fa-unlock-alt"></i>
                                                <a href="<?php echo G5_BBS_URL ?>/password_lost.php" id="forgot_from_1">아이디 비밀번호 찾기</a>
                                            </div>
                                            <div class="col-xs-4">
                                                <i class="fa fa-check"></i>
                                                <a href="./register.php" id="signup_from_1">회원 가입</a>
                                            </div>
                                        </div>
                                    </div>
									</form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>

    <!-- preview scripts -->
    <script>
        (function($) {

			$("#login_auto_login").click(function(){
				if (this.checked) {
					this.checked = confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?");
				}
			});

            // get full window size
            $(window).on('load resize', function() {
                var w = $(window).width();
                var h = $(window).height();

                $('section').height(h);
            });

            // scrollTo plugin
            $('#signup_from_1').scrollTo({
                easing: 'easeInOutQuint',
                speed: 1500
            });
            $('#forgot_from_1').scrollTo({
                easing: 'easeInOutQuint',
                speed: 1500
            });

            // set focus on input
            var firstInput = $('section').find('input[type=text]').filter(':visible:first');

            if (firstInput != null) {
                firstInput.focus();
            }

            $('section').waypoint(function(direction) {
                var target = $(this).find('input[type=text]').filter(':visible:first');
                target.focus();
            }, {
                offset: 300
            }).waypoint(function(direction) {
                var target = $(this).find('input[type=text]').filter(':visible:first');
                target.focus();
            }, {
                offset: -400
            });


            // animation handler
            $('[data-animation-delay]').each(function() {
                var animationDelay = $(this).data("animation-delay");
                $(this).css({
                    "-webkit-animation-delay": animationDelay,
                    "-moz-animation-delay": animationDelay,
                    "-o-animation-delay": animationDelay,
                    "-ms-animation-delay": animationDelay,
                    "animation-delay": animationDelay
                });
            });

            $('[data-animation]').waypoint(function(direction) {
                if (direction == "down") {
                    $(this).addClass("animated " + $(this).data("animation"));
                }
            }, {
                offset: '90%'
            }).waypoint(function(direction) {
                if (direction == "up") {
                    $(this).removeClass("animated " + $(this).data("animation"));
                }
            }, {
                offset: '100%'
            });

        })(jQuery);

		function flogin_submit(f)
		{
			return true;
		}
    </script>

