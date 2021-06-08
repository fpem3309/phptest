<?php
include_once('../common.php');
$group['subject'] = "테마소개";
$group2['subject'] = "테마소개";
include_once(G5_THEME_PATH.'/head.php');
?>


  <section id="content">
      <div class="container">
        <div class="row">
          <div class="span8">
            <article>
              <div class="top-wrapper">
                <div class="post-heading">
                  <h3><a href="#">웹사이트 구축 및 운영</a></h3>
                </div>
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
              <p>
                홈페이지 제작 전문 회사이며 그누보드를 기반으로 디자인과 웹프로그램을 전문적으로 제작, 개발하고 있습니다. 다양한 프로젝트를 맡아오면서 그누보드 커스텀이 까다로움을 느끼고 이를 쉽게 접근해 홈페이지를 만들 수 있도록 채러티비즈니스 테마를 제작했습니다.

채러티비즈니스 테마는 심플하지만 유용함을 모토로 제작되었습니다. 베이직한 그대로 사용하거나, 혹은 커스텀을 해도 무리가 없게 되도록 심플한 디자인으로 제작되었습니다.
              </p>
            </article>
          </div>
          <div class="span4">
            <aside class="right-sidebar">
              <div class="widget">
                <h5 class="widgetheading">Project information</h5>
                <ul class="folio-detail">
                  <li><label>Category :</label> Web design</li>
                  <li><label>Client :</label> ASU Company</li>
                  <li><label>Project date :</label> 26 March, 2013</li>
                  <li><label>Project URL :</label><a href="#">www.projectsiteurl.com</a></li>
                </ul>
              </div>
              <div class="widget">
                <h5 class="widgetheading">Text widget</h5>
                <p>
                  다양한 경험을 해온 채러티비즈니스와 함께 문제를 해결해 나가는 솔루션을 제공받으세요.
                </p>
              </div>
            </aside>
          </div>
        </div>
      </div>
    </section>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>