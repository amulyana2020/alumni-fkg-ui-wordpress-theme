<?php
    get_header();

    while(have_posts()) {
        the_post();
        ?>
    
    <div data-bss-parallax-bg="true" style="height: 300px;background-image: url(<?php echo get_theme_file_uri('images/header.jpeg'); ?>);background-position: center;background-size: cover;">
        </div>

        <div class="container ">
            <div class="card p-4 mt-4">
            <h4 class="mb-4"><?php  the_title(); ?></h4>
            <?php  the_content(); ?>
            </div>
        </div>
        <div class="container">
            <h4 class="mb-4">Alumni Program Studi <?php  the_title();  ?></h4>
             <?php  
                $relatedAlumnies = new WP_Query(
                    array(
                        'posts_per_page' => 25,
                        'post_type' => 'alumni',
                        'orderby' => 'title',
                        'order' => 'ASC',
                        'meta_query' => array(
                            array(
                                'key' => 'major',
                                'compare' => 'LIKE',
                                'value' => '"'.get_the_ID().'"'
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
                            <h6><?php the_title(); ?></h6>
                            </div>
                        </div>   

                    <?php
                }
                echo '</div>';
          ?>
        </div>
        <div><?php  echo paginate_links(); ?></div>
        <?php

    }
    get_footer();
?>