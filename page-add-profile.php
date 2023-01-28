<?php acf_form_head(); ?>
<?php

    if (!is_user_logged_in()){
        wp_redirect('/');
        exit;
    } else {
        get_header();
        while(have_posts()) {
            the_post();

            $BsWp = new BsWp;

            $BsWp->get_template_parts([
                'sidebar', 
            ]);
            ?>
                 
                 <main id="main" class="main">
                    
                        <?php acf_form('new-alumni'); ?>

                </main>
    
            <?php
        }
        get_footer();
    }

?>