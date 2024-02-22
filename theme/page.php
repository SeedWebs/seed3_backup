<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default. Please note that
 * this is the WordPress construct of pages: specifically, posts with a post
 * type of `page`.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package SEED3
 */

get_header();
?>
<section id="primary">
    <main id="main">
        <?php while (have_posts()) : the_post();?>
        <?php get_template_part('parts/content/content', 'page');?>
        <?php if (comments_open() || get_comments_number()) {
            comments_template();
        } ?>
        <?php endwhile; ?>
    </main>
</section>
<?php get_footer(); ?>