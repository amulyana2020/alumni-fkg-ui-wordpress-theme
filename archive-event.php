<?php 

get_header();

?>
<div data-bss-parallax-bg="true" style="height: 300px;background-image: url(<?php echo get_theme_file_uri('images/header.jpeg'); ?>);background-position: center;background-size: cover;">
</div>
<div class="container">
    <?php 
        while(have_posts()){
            the_post();
            ?>
                <div class="card my-4 p-4">
                    <h3><strong>Events</strong></h3>
                </div>
                
                <div class="card my-4">
                            <div class="card-body">
                                <div class="columns">
                                    <div class="row">
                                        <div class="column col-3 d-flex justify-content-center align-items-center">
                                            <div>
                                                <h1><?php 
                                                    $eventDate = new DateTime( get_field('event_date'));
                                                    echo $eventDate -> format('d')
                                                ?></h1>
                                                <h1><?php 
                                                    $eventDate = new DateTime( get_field('event_date'));
                                                    echo $eventDate -> format('M')
                                                ?></h1>
                                            </div>        
                                        </div>
                                        <div class="column col-9">
                                                <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                                <p class="card-text"><?php 
                                                    if (has_excerpt()){
                                                        echo get_the_excerpt();
                                                    } else {
                                                        echo wp_trim_words(get_the_content(), 50);
                                                    }
                                                ?></p><a class="card-link" href="<?php the_permalink(); ?>">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
            <?php
        }
    ?>
    <div><?php  echo paginate_links(); ?></div>
</div>
<?php 
get_footer();

?>