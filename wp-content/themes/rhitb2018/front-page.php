<?php get_header(); ?>

<section>
  <div class="containerhome" id="page">
    <div class="container-inner">
      <div class="main">
        <!-- Home -->
        <div class="inner-containerhome group">
          <div id="about-container">
            <h1>About Bioengineering</h1>
            <div class="lay-half" id="video-about">
              <iframe width="427" height="240" src="https://www.youtube.com/embed/oWy8z4W4R5U" class="lay-hover-opacity" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>
            <div class="lay-half" id="inner-training">
              <h6>Indonesia, sebagai negara tropis, memiliki keaneka-ragaman Sumber Daya Hayati (SDH)  yang tinggi dan kaya akan sumber biomaterial potensial yang renewable dan sustainable. Permasalahan utama bangsa Indonesia saat ini adalah bahwa SDH yang kita miliki belum dapat secara optimal menjamin kesejahteraan bangsa. Untuk meningkatan manfaat dan produktivitas SDH-tropika dibutuhkan pengelolaan secara profesional agar dapat menjawab tantangan ekonomi nasional dan global. Karena itu, diperlukan sumber daya manusia (SDM) yang secara profesional...</h6>
              <a href="./latar-belakang/">
                <button type="button" class="lay-button lay-red lay-margin-top">Read More</button>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section><!--Home-->

<section>
  <div class="containernews" id="page">
    <div class="container-inner">
      <div class="main">
        <!-- News -->
        <div class="inner-containerhome group">
          <div id="news-container">
            <h1>Berita</h1>

            <?php echo do_shortcode('[wonderplugin_slider id=1]'); ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section><!--News-->

<?php get_footer(); ?>