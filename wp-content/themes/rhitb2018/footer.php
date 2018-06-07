						</div><!--/.main-inner-->
					</div><!--/.main-->
				</div><!--/.container-inner-->
			</div><!--/.container-->
			<footer id="footer">	
				<?php // footer widgets
					$total = 4;
					if ( ot_get_option( 'footer-widgets' ) != '' ) {
						$total = ot_get_option( 'footer-widgets' );
						if( $total == 1) $class = 'one-full';
						if( $total == 2) $class = 'one-half';
						if( $total == 3) $class = 'one-third';
						if( $total == 4) $class = 'one-fourth';
					}

					if ( (	is_active_sidebar( 'footer-1' ) ||
							is_active_sidebar( 'footer-2' ) ||
							is_active_sidebar( 'footer-3' ) ||
							is_active_sidebar( 'footer-4' ) ) && $total > 0 ) {
				?>
				<section class="container" id="footer-widgets">
					<div class="container-inner">
						<div class="pad group">
							<?php $i = 0; while ( $i < $total ) { $i++; ?>
								<?php if ( is_active_sidebar( 'footer-' . $i ) ) { ?>
									<div class="footer-widget-<?php echo $i; ?> grid <?php echo $class; ?> <?php if ( $i == $total ) { echo 'last'; } ?>">
										<?php dynamic_sidebar( 'footer-' . $i ); ?>
									</div>
								<?php } ?>
							<?php } ?>
						</div><!--/.pad-->
					</div><!--/.container-inner-->
				</section><!--/.container-->
				<?php } ?>

				<?php if ( has_nav_menu( 'footer' ) ): ?>
				<nav class="nav-container group" id="nav-footer">
					<div class="nav-toggle"><i class="fa fa-bars"></i></div>
					<div class="nav-text"><!-- put your mobile menu text here --></div>
					<div class="nav-wrap"><?php wp_nav_menu( array('theme_location'=>'footer','menu_class'=>'nav container group','container'=>'','menu_id'=>'','fallback_cb'=>false) ); ?></div>
				</nav><!--/#nav-footer-->
				<?php endif; ?>

				<section class="container" id="footer-bottom" style="padding-top: 25px">
					<div class="lay-third" id="text-footer">
						<h4 style="color:white"><strong>Labtek 1A Kampus ITB Jatinangor,</strong></h4>
							<p>Jl. Let. Jen. Purn. Dr. (HC). Mashudi no. 1, Sumedang, Jawa Barat, Indonesia <br></p>
							<p>Telp: (022) 2511575<br> 
							Fax: (022) 2534107</p><br>
						<!--
						<div >
								<a href="#" class="btn btn-dark" style="border-radius:50%; background-color:#3a3a3a;"><i class="fa fa-facebook fa-lg" style="color:white"></i></a>
								<a href="#" class="btn btn-dark" style="border-radius:50%; background-color:#3a3a3a"><i class="fa fa-instagram fa-lg" style="color:white"></i></a>
								<a href="#" class="btn btn-dark" style="border-radius:50%; background-color:#3a3a3a"><i class="fa fa-twitter fa-lg" style="color:white"></i></a>
							</div> -->
					</div>
					
					<div align="center" class="lay-third" id="text-footer">
						<h4><strong>FOLLOW US</strong></h4>
						<div class="wrapper" id="social-links">
						
							<ul>
								<li class="facebook">
									<a href="#">
										<i class="fa fa-facebook fa-lg lay-hover-opacity"></i>
									</a>
								</li>
								<li class="twitter">
									<a href="#">
										<i class="fa fa-twitter fa-lg lay-hover-opacity"></i>
									</a>
								</li>
								<li class="instagram">
									<a href="#">
										<i class="fa fa-instagram fa-lg lay-hover-opacity"></i>
									</a>
								
							</ul>
						</div>
						
					</div>
					<div align="right" class="lay-third" id="map" >
						<script>
							function initMap() {
								var uluru = {lat: -6.928894, lng: 107.768387};
								var map = new google.maps.Map(document.getElementById('map'), {
									zoom: 15,
									center: uluru
								});
								var marker = new google.maps.Marker({
									position: uluru,
									map: map
								});
							}
						</script>
						<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDY0UYkMfSUZEjXXH-rzm-4qrExorm9Yio&callback=initMap"></script>
					</div>			
				</section><!--/.container#20579b-->
				<section id="footer-bottom" style="background-color:#5b5b5b; padding:10px 50px 10px 0px; color:white">
					<div class="container" align="right" style="padding-right:30px">
						
							<p>&copy; <?php echo date( 'Y' ); ?> Institut Teknologi Bandung -  <?php _e( 'All Rights Reserved.', 'hueman' ); ?> </p>
						
					</div>
				</section>
			</footer><!--/#footer-->
			
		</div><!--/#wrapper-->
		<?php wp_footer(); ?>
	</body>
</html>