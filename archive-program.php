<?php 

get_header();

?>
<div data-bss-parallax-bg="true" style="height: 300px;background-image: url(<?php echo get_theme_file_uri('images/header.jpeg'); ?>);background-position: center;background-size: cover;">
</div>
<div class="container">
    <ul class="link-list min-list">
    <?php 
        while(have_posts()){
            the_post();
            ?>
                <li>
                  <a href="<?php the_permalink();  ?>"><?php  the_title();  ?></a>
        </li>
            <?php
        }
    ?>
    </ul>
</div>
<?php 
get_footer();

?>