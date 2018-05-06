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
</section><!--News-->

<section>
  <div class="containertesti" id="page">
    <div class="container-inner">
      <div class="main">
        <!-- Testimoni -->
        <div class="inner-containerhome group">
          <div id="testi-container">
            <h1>Testimoni</h1>
            <div class="w3-content w3-display-container">
              <div class="mySlides" id="display-testimoni">
                <div class="w3-twothird">
                  <div class="w3-row" id="text-testi">Program Studi Rekayasa Hayati adalah........Program Studi Rekayasa Hayati adalah........Program Studi Rekayasa Hayati adalah........Program Studi Rekayasa Hayati adalah........Program Studi Rekayasa Hayati adalah........Program Studi Rekayasa Hayati adalah........Program Studi Rekayasa</div>
                  <a href="./alumni" id="text-testi-link" class="w3-row">READ MORE</a>
                </div>
                <div class="w3-third">
                  <img class="w3-row" src="https://www.w3schools.com/w3css/img_avatar1.png">
                </div>
              </div>
              <div class="mySlides" id="display-testimoni">
                <div class="w3-twothird">
                  <div class="w3-row" id="text-testi">Progr</div>
                  <a href="./alumni" id="text-testi-link" class="w3-row">READ MORE</a>
                </div>
                <div class="w3-third">
                  <img class="w3-row" src="https://www.w3schools.com/w3css/img_avtar.jpg">
                </div>
              </div>
              <div class="mySlides" id="display-testimoni">
                <div class="w3-twothird">
                  <div class="w3-row" id="text-testi">Program Studi Rekayasa Hayati adalah........Program Studi Rekayasa Hayati adalah........Program Studi Re</div>
                  <a href="./alumni" id="text-testi-link" class="w3-row">READ MORE</a>
                </div>
                <div class="w3-third">
                  <img class="w3-row" src="https://www.w3schools.com/w3css/img_avatar3.png">
                </div>
              </div>
              <div>
                <button id="button-testi-kiri" class="w3-button w3-black w3-display-right" onclick="plusDivs(-1)">&#10094;</button>
                <button id="button-testi-kanan" class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
              </div>
            </div>

              <script>
              var slideIndex = 1;
              showDivs(slideIndex);

              function plusDivs(n) {
                showDivs(slideIndex += n);
              }

              function showDivs(n) {
                var i;
                var x = document.getElementsByClassName("mySlides");
                if (n > x.length) {slideIndex = 1}    
                if (n < 1) {slideIndex = x.length}
                for (i = 0; i < x.length; i++) {
                   x[i].style.display = "none";  
                }
                x[slideIndex-1].style.display = "block";  
              }
              </script>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>