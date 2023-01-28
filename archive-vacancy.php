<?php 

get_header();

?>
<div data-bss-parallax-bg="true" style="height: 300px;background-image: url(<?php echo get_theme_file_uri('images/header.jpeg'); ?>);background-position: center;background-size: cover;">
    </div>
<div class="container">
    <div class="card my-4 p-4">
    <h4>Vacancy</h4>
    </div>
    
    <?php 
        while(have_posts()){
            the_post();
            ?>
               <div class="card my-4 p-4">
                    <a href="<?php the_permalink();  ?>"><?php  the_title();  ?></a>
               </div> 
                  
        
            <?php
        }
    ?>
</div>
<?php 
get_footer();

?>