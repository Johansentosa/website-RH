<?php
/**
* Plugin Main Class
*/
class Stars_Testimonials
{
	
	function __construct()
	{
		add_action( 'init', array($this, 'register_testimonials') );
		add_filter( 'post_updated_messages', array($this, 'testimonials_update_messages') );
		add_action( 'add_meta_boxes_stars_testimonial', array($this, 'adding_custom_meta_boxes') );
		add_action( 'save_post', array($this, 'save_testimonial' ) );
		add_shortcode( 'stars_testimonials', array($this, 'render_stars_testimonials') );
		add_action( 'stars_testimonial_display_rating', array($this, 'display_rating'), 10, 1 );
		add_action( 'stars_testimonial_display_company', array($this, 'display_company'), 10, 2 );
		add_action( 'vc_before_init', array($this, 'testimonial_integrateWithVC') );
	}

	function register_testimonials(){
		$labels_post = array(
			'name'               => _x( 'Testimonials', 'Testimonials', 'stars-testimonials' ),
			'singular_name'      => _x( 'Testimonial', 'Testimonial', 'stars-testimonials' ),
			'menu_name'          => _x( 'Stars Testimonials', 'Stars Testimonials', 'stars-testimonials' ),
			'name_admin_bar'     => _x( 'Testimonial', 'Testimonial', 'stars-testimonials' ),
			'add_new'            => _x( 'Add New', 'Testimonial', 'stars-testimonials' ),
			'add_new_item'       => __( 'Add New Testimonial', 'stars-testimonials' ),
			'new_item'           => __( 'New Testimonial', 'stars-testimonials' ),
			'edit_item'          => __( 'Edit Testimonial', 'stars-testimonials' ),
			'view_item'          => __( 'View Testimonial', 'stars-testimonials' ),
			'all_items'          => __( 'All Testimonials', 'stars-testimonials' ),
			'search_items'       => __( 'Search Testimonials', 'stars-testimonials' ),
			'parent_item_colon'  => __( 'Parent Testimonials:', 'stars-testimonials' ),
			'not_found'          => __( 'No Testimonials found.', 'stars-testimonials' ),
			'not_found_in_trash' => __( 'No Testimonials found in Trash.', 'stars-testimonials' )
		);

		$args_post = array(
			'labels'             => $labels_post,
	        'description'        => __( 'Your Testimonials.', 'stars-testimonials' ),
			'show_ui'            => true,
			'show_in_menu'       => true,
			'menu_icon'       	 => 'dashicons-editor-quote',
			'query_var'          => false,
			'hierarchical'       => false,
			'supports'           => array( 'title', 'editor', 'thumbnail' )
		);

		register_post_type( 'stars_testimonial', $args_post );

		$labels_tax = array(
			'name'              => _x( 'Categories', 'taxonomy general name', 'stars-testimonials' ),
			'singular_name'     => _x( 'Category', 'taxonomy singular name', 'stars-testimonials' ),
			'search_items'      => __( 'Search Categories', 'stars-testimonials' ),
			'all_items'         => __( 'All Categories', 'stars-testimonials' ),
			'parent_item'       => __( 'Parent Category', 'stars-testimonials' ),
			'parent_item_colon' => __( 'Parent Category:', 'stars-testimonials' ),
			'edit_item'         => __( 'Edit Category', 'stars-testimonials' ),
			'update_item'       => __( 'Update Category', 'stars-testimonials' ),
			'add_new_item'      => __( 'Add New Category', 'stars-testimonials' ),
			'new_item_name'     => __( 'New Category Name', 'stars-testimonials' ),
			'menu_name'         => __( 'Testomonial Categories', 'stars-testimonials' ),
		);

		$args_tax = array(
			'hierarchical'      => true,
			'labels'            => $labels_tax,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => false,
		);

		register_taxonomy( 'stars_testimonial_cat', array( 'stars_testimonial' ), $args_tax );		
	}

	function testimonials_update_messages( $messages ){
		$post             = get_post();
		$post_type        = get_post_type( $post );
		$post_type_object = get_post_type_object( $post_type );

		$messages['stars_testimonial'] = array(
			0  => '', // Unused. Messages start at index 1.
			1  => __( 'Testimonial updated.', 'stars-testimonials' ),
			2  => __( 'Custom field updated.', 'stars-testimonials' ),
			3  => __( 'Custom field deleted.', 'stars-testimonials' ),
			4  => __( 'Testimonial updated.', 'stars-testimonials' ),
			/* translators: %s: date and time of the revision */
			5  => isset( $_GET['revision'] ) ? sprintf( __( 'Testimonial restored to revision from %s', 'stars-testimonials' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6  => __( 'Testimonial published.', 'stars-testimonials' ),
			7  => __( 'Testimonial saved.', 'stars-testimonials' ),
			8  => __( 'Testimonial submitted.', 'stars-testimonials' ),
			9  => sprintf(
				__( 'Testimonial scheduled for: <strong>%1$s</strong>.', 'stars-testimonials' ),
				// translators: Publish box date format, see http://php.net/date
				date_i18n( __( 'M j, Y @ G:i', 'stars-testimonials' ), strtotime( $post->post_date ) )
			),
			10 => __( 'Testimonial draft updated.', 'stars-testimonials' )
		);

		return $messages;
	}

	function adding_custom_meta_boxes( $post ) {
	    add_meta_box( 
	        'stars-testimonials-settings',
	        __( 'Testimonial Settings' ),
	        array($this, 'render_settings_page'),
	        'stars_testimonial',
	        'normal',
	        'default'
	    );
	}

	function render_settings_page(){
		include 'inc/settings_page.php';
		wp_nonce_field( plugin_basename( __FILE__ ), 'wcp_testimonial_nonce' );
	}

	function save_testimonial($post_id){
        // verify if this is an auto save routine. 
        // If it is our form has not been submitted, so we dont want to do anything
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
            return;

        // verify this came from the our screen and with proper authorization,
        // because save_post can be triggered at other times
        if ( !isset( $_POST['wcp_testimonial_nonce'] ) )
            return;

        if ( !wp_verify_nonce( $_POST['wcp_testimonial_nonce'], plugin_basename( __FILE__ ) ) )
            return;

        // OK, we're authenticated: we need to find and save the data

        if (isset($_POST['testimonial_company_name'])) {
            update_post_meta( $post_id, 'testimonial_company_name', sanitize_text_field($_POST['testimonial_company_name']) );
        }

        if (isset($_POST['testimonial_company_url'])) {
            update_post_meta( $post_id, 'testimonial_company_url', esc_url($_POST['testimonial_company_url']) );
        }

        if (isset($_POST['testimonial_stars'])) {
            update_post_meta( $post_id, 'testimonial_stars', sanitize_text_field($_POST['testimonial_stars']) );
        }
	}

	function render_stars_testimonials($atts){
		wp_enqueue_style( 'font-awesome', plugin_dir_url( __FILE__ ).'/css/font-awesome.min.css' );
		wp_enqueue_style( 'stars-testimonials-styles', plugin_dir_url( __FILE__ ).'/css/styles.css' );
		extract(shortcode_atts( array(
			'style' => '1',
			'type' => 'grid',
			'cats' => '',
			'cols' => '2',
			'order' => 'DESC',
			'orderby' => 'date',
			'total' => '-1',
			'stars_color' => '',
			'text_color' => '',
			'bg_color' => '',
			'title_color' => '',
			'company_color' => '',
			'arrows_color' => 'red',
		), $atts) );

		// Init the Vars
		$row_class = '';
		$column_class = '';
		$data_attr = '';

		switch ($type) {
			case 'grid':
				wp_enqueue_style( 'simple-grid', plugin_dir_url( __FILE__ ).'/css/simplegrid.css' );
				$row_class = 'grid';
				$column_class = 'col-1-'.$cols;
				break;
			case 'masonry':
				wp_enqueue_style( 'simple-grid', plugin_dir_url( __FILE__ ).'/css/simplegrid.css' );
				wp_enqueue_script( 'wcp-masonry-js', plugin_dir_url( __FILE__ ).'/js/masonry.js', array('jquery', 'jquery-masonry') );
				$row_class = 'grid masonry-wrap';
				$column_class = 'masonry-item col-1-'.$cols;
				break;
			case 'slider':
				wp_enqueue_style( 'slick-css', plugin_dir_url( __FILE__ ).'/css/slick.css' );
				wp_enqueue_script( 'slick-js', plugin_dir_url( __FILE__ ).'/js/slick.min.js', array('jquery') );
				wp_enqueue_script( 'wcp-script-js', plugin_dir_url( __FILE__ ).'/js/script.js', array('jquery') );
				$row_class = 'wcp-slick';
				$column_class = '';
				if (is_array($atts)) {
			        foreach ($atts as $p_name => $p_val) {
			            $data_attr .= ' data-'.$p_name.' = '.$p_val;
			        }
				}
				break;
			
			default:
				# code...
				break;
		}

		$args = array(
			'post_type'   => 'stars_testimonial',
			'posts_per_page'   => $total,
			'order'               => $order,
			'orderby'             => $orderby,			
		);

		if ($cats != '') {
			$args['tax_query'] = array(
			'relation'  => 'AND',
				array(
					'taxonomy'         => 'stars_testimonial_cat',
					'field'            => 'id',
					'terms'            => explode(',', $cats),
					'include_children' => true,
					'operator'         => 'IN'
				),
			);
		}
		$r_id = rand();
		ob_start();
		$query_testimonials = new WP_Query( $args );

		if ( $query_testimonials->have_posts() ) {
			echo '<div class="stars-testimonials" id="st-'.$r_id.'">';
				echo '<div class="'.$row_class.'" '.$data_attr.'>';

				while ( $query_testimonials->have_posts() ) {
					$query_testimonials->the_post();
						$company = get_post_meta( get_the_id(), 'testimonial_company_name', true );
						$url = get_post_meta( get_the_id(), 'testimonial_company_url', true );
						$stars = get_post_meta( get_the_id(), 'testimonial_stars', true );					
						echo '<div class="'.$column_class.'">';
							include 'templates/style'.$style.'.php';
						echo '</div>';
				}
			
			
				echo '</div>';
			echo '</div>';
			echo "<style>";
			echo "#st-$r_id .st-rating { color:  $stars_color; }";
			echo "#st-$r_id .st-testimonial-content { color:  $text_color; }";
			echo "#st-$r_id .st-testimonial-content p { color:  $text_color; }";
			echo "#st-$r_id .st-testimonial-bg { background-color: $bg_color; }";
			echo "#st-$r_id .style1 .arrow { border-top-color: $bg_color; }";
			echo "#st-$r_id .style3 .arrow { border-top-color: $bg_color; }";
			echo "#st-$r_id .style10 .arrow { border-top-color: $bg_color; }";
			echo "#st-$r_id .style7 { border-bottom-color: $bg_color; }";
			echo "#st-$r_id .style7::before { background-color: $bg_color; }";
			if ($bg_color != '') {
			echo "#st-$r_id .st-style17 .st-testimonial-bg::before { border-color: transparent transparent transparent $bg_color; }";
			}
			echo "#st-$r_id .st-testimonial-title { color: $title_color; }";
			echo "#st-$r_id .slick-prev:before, #st-$r_id .slick-next:before { color: $arrows_color; }";
			echo "#st-$r_id .st-testimonial-company { color: $company_color; }";
			echo "</style>";
			wp_reset_postdata();
		}

		return ob_get_clean();
	}

	function display_rating($count){
		switch ($count) {
			case '5.0':
				echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
				break;
			case '4.5':
				echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>';
				break;
			case '4.0':
				echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>';
				break;
			case '3.5':
				echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
				break;
			case '3.0':
				echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
				break;
			case '2.5':
				echo '<i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
				break;
			case '2.0':
				echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
				break;
			case '1.5':
				echo '<i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
				break;
			case '1.0':
				echo '<i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
				break;
			case '0.5':
				echo '<i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
				break;
			
			default:
				echo '';
				break;
		}
	}

	function display_company($company, $url){
		if ($url != '') { ?>
			<a target="_blank" href="<?php echo esc_url( $url ); ?>"><?php echo esc_attr( $company ); ?></a>
		<?php } else {
			echo $company;
		}
	}

	function testimonial_integrateWithVC(){
	   vc_map( array(
			"name" => __( "Stars Testimonial", "stars-testimonials" ),
			"base" => "stars_testimonials",
			"class" => "",
			"category" => __( "Content", "stars-testimonials"),
			"params" => array(
				array(
				"type" 			=> 	"dropdown",
				"heading" 		=> 	__( 'Testimonial Type', 'counter-vc' ),
				"param_name" 	=> 	"type",
				"description" 	=> 	__( 'Choose how you want to display testimonials', 'counter-vc' ),
				"group" 		=> 	'General',
				"value" 		=> array(
					"Grid"		=> "grid", 
					"Masonry Grid" 	=> "masonry",
					"Slider" 	=> "slider",
					)
				),
				array(
				"type" 			=> 	"dropdown",
				"heading" 		=> 	__( 'Testimonial Style', 'counter-vc' ),
				"param_name" 	=> 	"style",
				"description" 	=> 	__( 'Choose single testimonial style here', 'counter-vc' ),
				"group" 		=> 	'General',
				"value" 		=> array(
					"Style 1"		=> "1",
					"Style 2"		=> "2",
					"Style 3"		=> "3",
					"Style 4"		=> "4",
					"Style 5"		=> "5",
					"Style 6"		=> "6",
					"Style 7"		=> "7",
					"Style 8"		=> "8",
					"Style 9"		=> "9",
					"Style 10"		=> "10",
					"Style 11"		=> "11",
					"Style 12"		=> "12",
					"Style 13"		=> "13",
					"Style 14"		=> "14",
					"Style 15"		=> "15",
					"Style 16"		=> "16",
					"Style 17"		=> "17",
					)
				),
				array(
				"type" 			=> 	"dropdown",
				"heading" 		=> 	__( 'Number of Columns', 'counter-vc' ),
				"param_name" 	=> 	"cols",
				"description" 	=> 	__( 'How many testimonials in a row', 'counter-vc' ),
				"group" 		=> 	'General',
				"value" 		=> array(
					"1 Column"		=> "1",
					"2 Columns"		=> "2",
					"3 Columns"		=> "3",
					"4 Columns"		=> "4",
					"5 Columns"		=> "5",
					"6 Columns"		=> "6",
					"7 Columns"		=> "7",
					"8 Columns"		=> "8",
					"9 Columns"		=> "9",
					"10 Columns"		=> "10",
					"11 Columns"		=> "11",
					"12 Columns"		=> "12",
				),
				'dependency' => array( 'element' => 'type', 'value' => array('grid', 'masonry') ),
				),
				array(
				"type" 			=> 	"textfield",
				"heading" 		=> 	__( 'Categories', 'counter-vc' ),
				"param_name" 	=> 	"cats",
				"description" 	=> 	__( 'Comma separated categories IDs', 'counter-vc' ),
				"group" 		=> 	'General',
				),
				array(
				"type" 			=> 	"textfield",
				"heading" 		=> 	__( 'Order', 'counter-vc' ),
				"param_name" 	=> 	"order",
				"description" 	=> 	__( 'ASC or DESC', 'counter-vc' ),
				"group" 		=> 	'General',
				),
				array(
				"type" 			=> 	"textfield",
				"heading" 		=> 	__( 'Order By', 'counter-vc' ),
				"param_name" 	=> 	"orderby",
				"description" 	=> 	__( 'Eg: date', 'counter-vc' ),
				"group" 		=> 	'General',
				),
				array(
				"type" 			=> 	"textfield",
				"heading" 		=> 	__( 'Total Number of Testimonials', 'counter-vc' ),
				"param_name" 	=> 	"total",
				"description" 	=> 	__( 'How many maximum testimonials you want to display, -1 for all', 'counter-vc' ),
				"group" 		=> 	'General',
				),
				
				array(
				"type" 			=> 	"textfield",
				"heading" 		=> 	__( 'Number of Columns', 'counter-vc' ),
				"param_name" 	=> 	"slidestoshow",
				"description" 	=> 	__( 'How many testimonials at a time', 'counter-vc' ),
				"group" 		=> 	'Slider Settings',
				'dependency' => array( 'element' => 'type', 'value' => array('slider') ),
				),

				array(
				"type" 			=> 	"textfield",
				"heading" 		=> 	__( 'Slides to Scroll', 'counter-vc' ),
				"param_name" 	=> 	"slidestoscroll",
				"description" 	=> 	__( 'How many testimonial scroll at a time', 'counter-vc' ),
				"group" 		=> 	'Slider Settings',
				'dependency' => array( 'element' => 'type', 'value' => array('slider') ),
				),

				array(
				"type" 			=> 	"textfield",
				"heading" 		=> 	__( 'Slider Speed', 'counter-vc' ),
				"param_name" 	=> 	"speed",
				"description" 	=> 	__( 'Provide slide speed in ms', 'counter-vc' ),
				"group" 		=> 	'Slider Settings',
				'dependency' => array( 'element' => 'type', 'value' => array('slider') ),
				),

				array(
				"type" 			=> 	"checkbox",
				"heading" 		=> 	__( 'Bottom Dots', 'counter-vc' ),
				"param_name" 	=> 	"dots",
				"description" 	=> 	__( 'Check to enable dots', 'counter-vc' ),
				"group" 		=> 	'Slider Settings',
				'dependency' => array( 'element' => 'type', 'value' => array('slider') ),
				),

				array(
				"type" 			=> 	"checkbox",
				"heading" 		=> 	__( 'Arrows', 'counter-vc' ),
				"param_name" 	=> 	"arrows",
				"description" 	=> 	__( 'Check to enable navigation arrows', 'counter-vc' ),
				"group" 		=> 	'Slider Settings',
				'dependency' => array( 'element' => 'type', 'value' => array('slider') ),
				),

				array(
				"type" 			=> 	"checkbox",
				"heading" 		=> 	__( 'Auto Play', 'counter-vc' ),
				"param_name" 	=> 	"autoplay",
				"description" 	=> 	__( 'Check to enable auto play', 'counter-vc' ),
				"group" 		=> 	'Slider Settings',
				'dependency' => array( 'element' => 'type', 'value' => array('slider') ),
				),

				array(
				"type" 			=> 	"textfield",
				"heading" 		=> 	__( 'Auto Play Speed', 'counter-vc' ),
				"param_name" 	=> 	"autoplayspeed",
				"description" 	=> 	__( 'Auto Play speed in ms Eg: 3000', 'counter-vc' ),
				"group" 		=> 	'Slider Settings',
				'dependency' => array( 'element' => 'type', 'value' => array('slider') ),
				),

				array(
				"type" 			=> 	"colorpicker",
				"heading" 		=> 	__( 'Stars Color', 'counter-vc' ),
				"param_name" 	=> 	"stars_color",
				"description" 	=> 	__( 'Choose Stars rating color here', 'counter-vc' ),
				"group" 		=> 	'Colors',
				),

				array(
				"type" 			=> 	"colorpicker",
				"heading" 		=> 	__( 'Text Color', 'counter-vc' ),
				"param_name" 	=> 	"text_color",
				"description" 	=> 	__( 'Choose testimonial text color here', 'counter-vc' ),
				"group" 		=> 	'Colors',
				),

				array(
				"type" 			=> 	"colorpicker",
				"heading" 		=> 	__( 'Background Color', 'counter-vc' ),
				"param_name" 	=> 	"bg_color",
				"description" 	=> 	__( 'Choose testimonial background color here', 'counter-vc' ),
				"group" 		=> 	'Colors',
				),

				array(
				"type" 			=> 	"colorpicker",
				"heading" 		=> 	__( 'Title Color', 'counter-vc' ),
				"param_name" 	=> 	"title_color",
				"description" 	=> 	__( 'Choose testimonial title color here', 'counter-vc' ),
				"group" 		=> 	'Colors',
				),

				array(
				"type" 			=> 	"colorpicker",
				"heading" 		=> 	__( 'Company Name Color', 'counter-vc' ),
				"param_name" 	=> 	"company_color",
				"description" 	=> 	__( 'Choose testimonial company name color here', 'counter-vc' ),
				"group" 		=> 	'Colors',
				),

				array(
				"type" 			=> 	"colorpicker",
				"heading" 		=> 	__( 'Slider Arrows', 'counter-vc' ),
				"param_name" 	=> 	"arrows_color",
				"description" 	=> 	__( 'Choose testimonial slider arrows color here', 'counter-vc' ),
				"group" 		=> 	'Colors',
				),
			)
	   ) );
	}
}
?>