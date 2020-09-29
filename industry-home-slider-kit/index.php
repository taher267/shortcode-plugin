<?php 
/*
	Plugin Name:Industry Slider Toolkit
	Plugin URI:http://fb.com/taher267
	Version:1.0.0
	Description: This is Jaza Plugin
*/

	function industry_toolkit_css_file() {
	wp_enqueue_style( 'insustryToolkit', plugins_url( '/assets/css/style.css', __FILE__ ),NULL,'1.0.0','all');
	wp_enqueue_style( 'owlCarousel', plugins_url( '/assets/css/owl.carousel.min.css', __FILE__ ),NULL,'2.3.4','all');
	wp_enqueue_script( 'owlCarouseljs', plugins_url( '/assets/js/owl.carousel.min.js', __FILE__ ),array('jquery'),'2.3.4',true);
}
add_action( 'wp_enqueue_scripts', 'industry_toolkit_css_file' );
	//Home Slider

	function industry_register_post() {

	$labels = array(
		'name'               => __( 'Industry Slider', 'coffee-html' ),
		'singular_name'      => __( 'Singular Name', 'coffee-html' ),
		'add_new'            => _x( 'Add New Slide', 'coffee-html', 'coffee-html' ),
		'add_new_item'       => __( 'Add New Slide', 'coffee-html' ),
		'new_item'           => __( 'New Slide', 'coffee-html' ),
		'all_items' 		=> __( 'All Slides', 'coffee-html' ),
	);

	$args = array(
		'labels'              => $labels,
		'public'              => false,
		'show_ui'             => true,
		'taxonomies'          => array('category','post_tag'),
		'supports'            => array('title','editor','author','thumbnail'),
		'menu_position' => 2,
	);

	register_post_type( 'jaza_industry_post', $args );
}
add_action( 'init', 'industry_register_post' );

function industry_jaza_func01($atts,$content=null){
extract( shortcode_atts( [
		'count' => 2,
		'loop' => true,
		'items' => 1,
		'type' => '',
		'nav' => true,
		'dots' => true,
		'autoplay' => true,
		'autoplayTimeout' => 5000,
	], $atts));
$args=[
	'post_type' => 'jaza_industry_post',
	'posts_per_page' =>2,
	'order' => 'ASC',
];
$get_post= new WP_Query($args);


$rand=rand(288394,999999);

$slide_markup='

<script>

jQuery(window).load(function(){
  jQuery("#sliderHome_'.$rand.'").owlCarousel(
  {
	loop:'.$items.',
	items:'.$items.',
	nav:'.$nav.',
	dots:'.$dots.',
	autoplay:'.$autoplay.',
	autoplayTimeout:'.$autoplayTimeout.',
	});
});

</script>


<div id="sliderHome_'.$rand.'" class="industry_slider owl-carousel">';
while ($get_post->have_posts()):$get_post->the_post();
	$post_id=get_the_ID();
	$slide_markup.='<div class="industry_single_slide" style="background:url('.esc_url(get_the_post_thumbnail_url($post_id)).')"><div class="industry_single_slide_inner"><div class="container"><div class="row"><div class="col-md-6">';
	$slide_markup.='<h2>'.esc_html(get_the_title($post_id)).'</h2>';
	$slide_markup.=''.wpautop(esc_html(get_the_content($post_id))).'';
	$slide_markup.='</div></div></div></div></div>';
	endwhile;
$slide_markup.='</div>';
	wp_reset_query();
	return $slide_markup;

}

add_shortcode( 'jaza_industry_slider', 'industry_jaza_func01');








// Box Two


// function industry_custom_post_box(){
// 	register_post_type('section_box',array(
// 		'public' => false,
// 		'show_ui' => true,
// 		'labels' => array(
// 			'name' => __('Post Boxs','coffee-html'),
// 			'singular_name' => __('A Post Box','coffee-html'),

// 		),
// 		'supports' => array('title','editor', 'thumbnail','page-attributes'),
// 	));
// }
// add_action( 'init', 'industry_custom_post_box');

// //post_box shortcode
// function industry_jaza_post_scode($atts,$content=null){
// extract( shortcode_atts( [
// 		'count' => 2,
// 		'type' => 'post',
// 		'title' => '',
// 		'subtitle' => '',
// 		'description' => '',
// 	], $atts));
// $args=array(
// 	'post_type' => 'section_box',
// 	'posts_per_page' =>1,
// 	// 'order' => 'ASC',
// );
// $get_post= new WP_Query($args);
// $post_markup='<div class="industry_section_title">';
// while($get_post->have_posts()):$get_post->the_post();
// 	$post_id=get_the_ID();
// 	$post_markup='<div style="background:url('.get_the_post_thumbnail_url().')no-repeat;backgroud-size:cover;height:350px;background-position:center;" class="post_inner"';

// 		$post_markup.='<h2>'.get_the_content().'</h2">';
// endwhile;
// 	$post_markup.='</div>';
// 	wp_reset_query();
// 	return $post_markup;

// }

// add_shortcode( 'industry_post_box', 'industry_jaza_post_scode');



























//							SLIDER AREA FUNCTION AND SHORTCODE
// function industry_theme_custom_slider(){
// 	$argus=array(
// 	'public' => false,
// 	'show_ui' => true,
// 	'menu_icon' => 'dashicons-cover-image',
// 	'labels' => [
// 		'name' => 'Slider',
// 		'singular_name' => __('Slide'),
// 		'all_items' =>__('All Slides'),
// 		'add_new' => 'Add New Slide',
// 		'add_new_item' => 'Add New Slide',
// 	],
// 	'supports' => ['title','editor','thumbnail','page-attributes'],
// 	'taxonomies' => ['post_tag','category'],
// );
// 	register_post_type('industry_slide',$argus);
// }
// add_action( 'init','industry_theme_custom_slider');