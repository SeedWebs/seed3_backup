<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package SEED3
 */

get_header();
?>
<section id="primary">
	<main id="main">
		<?php if (have_posts()) : ?>
		<header class="page-header">
			<?php
                printf(
                    /* translators: 1: search result title. 2: search term. */
                    '<h1 class="page-title">%1$s <span>%2$s</span></h1>',
                    esc_html__('Search results for:', 'seed3'),
                    get_search_query()
                );
		    ?>
		</header>
		<?php
		    // Start the Loop.
		    while (have_posts()) :
		        the_post();
		        get_template_part('parts/content/content', 'excerpt');

		        // End the loop.
		    endwhile;
		    seed_the_posts_navigation();
		    ?>
		<?php else : ?>
		<?php get_template_part('parts/content/content', 'none'); ?>
		<?php endif;?>
	</main>
</section>
<?php get_footer(); ?>