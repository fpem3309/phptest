<?php
include_once('../common.php');
$group['subject'] = "ABOUT";
$group2['subject'] = "인사말";
include_once(G5_THEME_PATH.'/head.php');
?>

<div class="row">
  <div class="span6">
	<h2>여러분을  <strong>환영합니다.</strong></h2>
	<p>
	  그누보드는 공유 정신을 나타내는 "GNU" 와 게시판을 나타내는 "Board" 가 합쳐진 말입니다. 그누보드는 웹에서 게시글, 회원정보 등을 편리하게 관리하는 게시판(BBS - Bulletin Board System) 프로그램입니다. 오픈된 소스 코드를 바탕으로 다양한 기능(플러그인)을 추가하기 쉽게 제작되어 있습니다. 그누보드5의 대표적인 플러그인 으로는 쇼핑몰 기능을 하는 "영카트5" 가 있습니다.
	</p>
	<p>
	  소프트웨어를 양도받은 사람의 권리를 보호하기 위해서 우리는 배포자들이 이러한 권리를 부정하거나 포기하도록 피양도자에게 요구하는 행위를 금지시킬 필요가 있습니다. 이러한 금지 사항은 라이브러리를 개작하거나 배포하는 모든 사람들이 예외없이 지켜야 할 의무와 같습니다.
	</p>
	<p>
	  예를 들어, LGPL 라이브러리를 배포할 경우에는 이를 유료로 판매하거나 무료로 배포하는 것에 관계없이 자신이 해당 라이브러리에 대해서 가질 수 있었던 모든 권리를 피양도자에게 그대로 양도해 주어야 하고, 라이브러리의 원시 코드를 함께 제공하거나 원시 코드를 구할 수 있는 방법을 확실히 알려주어야 합니다.
	</p>
  </div>
  <div class="span6">
	<!-- start flexslider -->
	<div class="flexslider">
	  <ul class="slides">
		<li>
		  <img src="<?php echo G5_THEME_URL; ?>/img/works/full/image-01-full.jpg" alt="" />
		</li>
		<li>
		  <img src="<?php echo G5_THEME_URL; ?>/img/works/full/image-02-full.jpg" alt="" />
		</li>
		<li>
		  <img src="<?php echo G5_THEME_URL; ?>/img/works/full/image-03-full.jpg" alt="" />
		</li>
	  </ul>
	</div>
	<!-- end flexslider -->
  </div>
</div>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>