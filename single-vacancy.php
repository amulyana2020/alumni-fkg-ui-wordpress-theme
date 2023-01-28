<?php
    get_header();

    while(have_posts()) {
        the_post();
        ?>

        <div data-bss-parallax-bg="true" style="height: 300px;background-image: url(<?php echo get_theme_file_uri('images/header.jpeg'); ?>);background-position: center;background-size: cover;">
        </div>


        <div class="container">
            <div class="card my-4 p-4">
            <h4 class="mb-4"><?php  the_title(); ?></h4>
            <?php  the_content(); ?>
            <p>Tanggal Penutupan: <?php the_field('valid_until'); ?> </p>
            <p>Surat Lamaran dikirim ke: 
                
            <?php 

            if (is_user_logged_in()) {
                the_field('send_to_email');
            } else {
                ?>
                Anda harus login untuk melihat data ini.
                <?php
            }
            
             ?> </p>
            </div>
            
             <div><?php  echo paginate_links(); ?></div>
        </div>
        </div>
        <?php

    }
    get_footer();
?>