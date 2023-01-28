<?php
    get_header();

    while(have_posts()) {
        the_post();
        ?>

        <div data-bss-parallax-bg="true" style="height: 300px;background-image: url(<?php echo get_theme_file_uri('images/header.jpeg'); ?>);background-position: center;background-size: cover;">
        </div>
        <div class="container">
            <div class="card p-4 my-4">
                <h1><?php  the_title();  ?></h1>
                <?php  the_content(); ?>
            </div>
        </div>
        <?php

    }
    get_footer();
?>