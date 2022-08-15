<?php
/*
* Template name: Home Page
*/
get_header();
?>

<?php if ( have_posts() ){ while ( have_posts() ){ the_post(); ?>
	<?php the_content(); ?>

    <main class="main">
		
	</main>

<?php } } else { ?>
	<div><?php esc_html_e('The page currently does not contain any information. Maybe this will be fixed soon.', 'wayup'); ?></div>
<?php } ?>

<?php get_footer(); ?>