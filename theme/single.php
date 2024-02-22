<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package SEED3
 */

get_header();
?>
<section id="primary">
    <main id="main">
        <?php
            /* Start the Loop */
            while (have_posts()) :
                the_post();
                get_template_part('parts/content/content', 'single');
                if (is_singular('post')) {
                    // Previous/next post navigation.
                    the_post_navigation(
                        array(
                            'next_text' => '<span aria-hidden="true">' . __('Next Post', 'seed3') . '</span> ' .
                                '<span class="sr-only">' . __('Next post:', 'seed3') . '</span> <br/>' .
                                '<span>%title</span>',
                            'prev_text' => '<span aria-hidden="true">' . __('Previous Post', 'seed3') . '</span> ' .
                                '<span class="sr-only">' . __('Previous post:', 'seed3') . '</span> <br/>' .
                                '<span>%title</span>',
                        )
                    );
                }
                // If comments are open, or we have at least one comment, load
                // the comment template.
                if (comments_open() || get_comments_number()) {
                    comments_template();
                }
                // End the loop.
            endwhile;?>
    </main>
</section>
<?php get_footer(); ?>