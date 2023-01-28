<?php 

get_header();

?>

<div data-bss-parallax-bg="true" style="height: 300px;background-image: url(<?php echo get_theme_file_uri('images/header.jpeg'); ?>);background-position: center;background-size: cover;">
    </div>
<div class="container">
    <?php 
        echo '<div class="row my-4">';
        while(have_posts()){
            the_post();
            ?>
            <div class="card col-2 m-2">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                    <a class="" href="<?php  echo get_the_permalink() ?>"><img src="<?php the_field('photo'); ?>" alt="Profile" class="rounded-circle" style="width: 120px; height: 120px;"> </a>
                    <h6 class="mt-4"><?php the_title(); ?></h6>
                    </div>
                </div>   
            <?php
        }
        echo '</div>';

    ?>
    <div><?php  echo paginate_links(); ?></div>
</div>
<?php 
get_footer();

?>