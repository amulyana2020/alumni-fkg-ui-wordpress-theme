<?php
    get_header();
    while(have_posts()) {
        the_post();
        ?>
      <section>
        <div data-bss-parallax-bg="true" style="height: 300px;background-image: url(<?php echo get_theme_file_uri('images/header.jpeg'); ?>);background-position: center;background-size: cover;">
        </div>
    </section>

    <div class="container">
      <?php  
                $relatedAlumnies = new WP_Query(
                    array(
                        'post_type' => 'alumni',
                        'orderby' => 'meta_value_num',
                        'meta_key' => 'candidate',
                        'order' => 'ASC',
                        'meta_query' => array(
                          array(
                            'key' => 'candidate',
                            'compare' => '==',
                            'value' => true,
                            'type' => 'boolean'
                          )
                        )
                     )
                );

                echo '<div class="row">';
                while($relatedAlumnies -> have_posts()){
                    $relatedAlumnies -> the_post();
                    ?>
                        <div class="card col-2 m-2">
                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                            <a class="" href="<?php  echo get_the_permalink() ?>"><img src="<?php the_field('photo'); ?>" alt="Profile" class="rounded-circle" style="width: 120px; height: 120px;"> </a>
                            <h5><?php the_title(); ?></h5>
                            </div>
                        </div> 

                    <?php
                }
                echo '</ul>';
          ?> 
      </div><br/>     
      <div class="container">
        <?php  the_content(); 
            echo do_shortcode('[poll id="3"]')
        ?>
        
      </div>
    </div>

        <?php

    }
    get_footer();
?>