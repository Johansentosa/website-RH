<?php get_header(); ?>

<section>
	<div class="containerhome" id="page">
		<div class="container-inner">
			<div class="main">
				<!-- Home -->
				<div class="inner-containerhome group">
					<div id="about-container">
						<h1 class="text-center">About Bioengineering</h1>
						<hr>
						<div class="lay-half" id="video-about">
							<iframe width="427" height="240" src="https://www.youtube.com/embed/oWy8z4W4R5U" class="lay-hover-opacity" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
						</div>
						<div class="lay-half" id="inner-training">
							<h6>Indonesia, sebagai negara tropis, memiliki keaneka-ragaman Sumber Daya Hayati (SDH)  yang tinggi dan kaya akan sumber biomaterial potensial yang renewable dan sustainable. Permasalahan utama bangsa Indonesia saat ini adalah bahwa SDH yang kita miliki belum dapat secara optimal menjamin kesejahteraan bangsa. Untuk meningkatan manfaat dan produktivitas SDH-tropika dibutuhkan pengelolaan secara profesional agar dapat menjawab tantangan ekonomi nasional dan global. Karena itu, diperlukan sumber daya manusia (SDM) yang secara profesional...</h6>
							<a href="./latar-belakang/">
								<button type="button" class="lay-button lay-red lay-margin-top" style="border-radius: 10%;">Read More</button>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section><!--Home-->

<!--News-->
<section>
	<div class="cd-fixed-bg cd-fixed-bg--1">
		<div class="cd-fixed-bg__content">
			<span>
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
					<div class="containernews" id="page">
						<div class="container-inner">
							<div class="main">
								<div class="inner-containerhome group">
									<div id="news-container">
										<h1 class="text-center">Berita Terkini</h1>
										<hr>
										<?php echo do_shortcode('[wcp-carousel id="567" order="DESC" orderby="date" count="9"] '); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</svg>
			</span>
		</div>
	</div>
</section>


<section>
	<div class="containertesti" id="page">
		<div class="container-inner">
			<div class="main">
				<!-- Testimoni -->
				<div class="inner-containerhome group">
					<div id="testi-container">
						<h1 class="text-center">Testimoni</h1>
						<hr>
						<div class="w3-content w3-display-container">
						<?php echo do_shortcode('[testimonial_view id="1"]'); ?>
						<?php //echo do_shortcode('[stars_testimonials  total="2" style="8"  cols="2" order="DESC" title_color="grey"]  '); ?>
							
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section>
	<div class="containerpartner" id="page">
		<div class="cd-fixed-bg cd-fixed-bg--2">
			<div class="cd-fixed-bg__content">
				<span>
					<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
						<div class="container-inner">
							<div class="main">
							<!-- News -->
								<div class="inner-containerpartner group">
									<div id="partner-container">
										<h1 class="text-center">Partner</h1>
										<hr>
										<div class="display-partner w3-center">
											<div class="w3-third">
												<img class="w3-row" src="https://www.w3schools.com/w3css/img_avatar1.png">
											</div>
											<div class="w3-third">
												<img class="w3-row" src="https://www.w3schools.com/w3css/img_avatar2.png">
											</div>
											<div class="w3-third">
												<img class="w3-row" src="https://www.w3schools.com/w3css/img_avatar3.png">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</svg>
				</span>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>