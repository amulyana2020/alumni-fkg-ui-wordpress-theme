<?php acf_form_head(); ?>
<?php

    if (!is_user_logged_in()){
        wp_redirect('/');
        exit;
    } else {
        get_header();

        $myData = new WP_Query(
            array(
                'posts_per_page' => -1,
                'post_type' => 'alumni',
                'orderby' => 'meta_value_num',
                'meta_key' => 'username',
                'order' => 'ASC',
                'meta_query' => array(
                array(
                    'key' => 'username',
                    'compare' => '==',
                    'value' => get_current_user_id(),
                    'type' => 'numeric'
                )
                )
                
            )
        );

        if ($myData -> have_posts()){
            $myData -> the_post();
        }


            $BsWp = new BsWp;

            $BsWp->get_template_parts([
                'sidebar', 
            ]);
            ?>
                 
                 <main id="main" class="main">
                    
                        <?php acf_form (array(
                            'field_groups' => array(6,11),
                            'fields' => ['photo', 'biodata', 'graduation_year', 'major', 'job', 'address', 'phone', 'institution'],
                            'return'		=> home_url('my-profile'),
                            'submit_value'  => 'Save My Profile',
                            'html_submit_button'  => '<input type="submit" class="btn btn-primary" value="%s" />',

                        ));
                        ?>

                </main>
    
            <?php
        }
        get_footer();
    

?>