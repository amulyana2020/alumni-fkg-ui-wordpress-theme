<?php
    get_header();

    while(have_posts()) {
        the_post();
        ?>
       <div data-bss-parallax-bg="true" style="height: 300px;background-image: url(<?php echo get_theme_file_uri('images/header.jpeg'); ?>);background-position: center;background-size: cover;">
        </div>
        <div class="container">
        <div class="card my-4 p-4">
            <div class="row">
                <div class="col-md-2 justify-content-center align-items-center">
                    <img src="<?php the_field('photo'); ?>" class="rounded-circle" style="width: 150px; height: 150px;"/>
                </div>
                <div class="col-md-10">
                <?php
                $relatedMajor = get_field('major');
                if ($relatedMajor){
                    echo '<h4 class="headline headline-medium">Program Studi</h3>';
                    echo '<ul class="list-unstyled">';
                    foreach ($relatedMajor as $major) {
                        ?>
                            <li><a href="<?php  echo get_the_permalink($major) ?>"><?php  echo get_the_title($major); ?></a></li>
                        <?php
                    }    
                    echo '</ul>';
                }
                
            ?>
                </div>          
            </div>
            <hr>
            <div>
                <h5><strong><?php  the_title();?></strong></h5>
                <?php the_field('biodata'); ?>
            </div>

            <hr>
        <div>
        <?php
                $relatedInstitution = get_field('institution');
                if ($relatedInstitution){
                    echo '<h4 class="headline headline-medium">Institusi</h3>';
                    echo '<ul class="list-unstyled">';
                    foreach ($relatedInstitution as $institution) {
                        ?>
                            <li><a href="<?php  echo get_the_permalink($institution) ?>"><?php  echo get_the_title($institution); ?></a></li>
                        <?php
                    }    
                    echo '</ul>';
                }
                
            ?>
        </div>
        </div>
        </div>
        
        <?php

    }
    get_footer();
?>