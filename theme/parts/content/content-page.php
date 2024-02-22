<?php
/**
 * Template part for displaying pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package SEED3
 */

?>
<article <?php post_class(); ?>>
	<?php if (!is_front_page()) : ?>
	<header class="entry-header">
		<?php the_title('<h1 class="entry-title mt-6 md:mt-8">', '</h1>');?>
	</header>
	<?php endif; ?>
	<?php seed_post_thumbnail(); ?>
	<div <?php seed_content_class('entry-content'); ?>>
		<?php the_content();?>
	</div>
	<?php if (get_edit_post_link()) : ?>
	<footer class="entry-footer">
		<?php edit_post_link();?>
	</footer>
	<?php endif; ?>
</article>