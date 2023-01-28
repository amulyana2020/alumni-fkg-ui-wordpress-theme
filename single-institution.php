<?php
    get_header();

    while(have_posts()) {
        the_post();
        ?>

        <div data-bss-parallax-bg="true" style="height: 300px;background-image: url(<?php echo get_theme_file_uri('images/header.jpeg'); ?>);background-position: center;background-size: cover;">
        </div>
        <div class="container">
            <div class="card p-4 mt-4">
                <?php  the_title(); ?>
                <?php  the_content(); ?>
            </div>
        </div>
        <div class="container">
            <h5 class="my-4">Alumni yang bekerja untuk <?php the_title(); ?></h5>
             <?php  
                $relatedAlumnies = new WP_Query(
                    array(
                        'posts_per_page' => 25,
                        'post_type' => 'alumni',
                        'orderby' => 'title',
                        'order' => 'ASC',
                        'meta_query' => array(
                            array(
                                'key' => 'institution',
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
                        <div class="card col-2 m-1">
                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                            <a class="" href="<?php  echo get_the_permalink() ?>"><img src="<?php the_field('photo'); ?>" alt="Profile" class="rounded-circle" style="width: 120px; height: 120px;"> </a>
                            <h6 class="mt-4"><?php the_title(); ?></h6>
                            </div>
                        </div> 
                    <?php
                }
                echo '</div>';
          ?>
        </div>
        <div><?php  echo paginate_links(); ?></div>
        </div>
        <?php

    }
    get_footer();
?>