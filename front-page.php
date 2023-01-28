<?php get_header() ?>
    <section>
        <div data-bss-parallax-bg="true" style="height: 600px;background-image: url(<?php echo get_theme_file_uri('images/header.jpeg'); ?>);background-position: center;background-size: cover;">
            <div class="container h-100">
                <div class="row h-100">
                    <div class="col-md-6 text-center text-md-start d-flex d-sm-flex d-md-flex justify-content-center align-items-center justify-content-md-start align-items-md-center justify-content-xl-center">
                        <div style="max-width: 350px;background: #f4cc40;padding: 30px;">
                            <h1 class="text-uppercase fw-bold">alumni</h1>
                            <p class="my-3" style="background: #f4cc40;">Your education does not end at graduation. The Faculty of Dentistry Universitas Indonesia offers programs and resources to alumni at every phase of your career.<br></p><a class="btn btn-primary btn-lg me-2" role="button" href="#">Give to FKG&nbsp; UI</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container py-4 py-xl-5" style="font-size: 18px;">
        <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
            <div class="col">
                <div class="card"><img class="card-img-top w-100 d-block fit-cover" style="height: 200px;" src="https://fkg.ui.ac.id/wp-content/uploads/2018/10/S__16744456-1-1060x450.jpg">
                    <div class="card-body p-4">
                        <h4><span style="color: rgb(54, 50, 48);">Upcoming Events</span><br></h4>
                        <p class="card-text"><span style="color: rgb(54, 50, 48);">Explore upcoming events designed for Alumni to grow their network, develop their knowledge, and reconnect with former classmates.</span><br></p><a href="<?php  echo site_url('/events'); ?>" class="btn btn-primary">FIND EVENTS</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card"><img class="card-img-top w-100 d-block fit-cover" style="height: 200px;" src="https://fkg.ui.ac.id/wp-content/uploads/2018/10/WhatsApp-Image-2021-07-28-at-12.20.53.jpeg">
                    <div class="card-body p-4">
                        <h4>Network</h4>
                        <p class="card-text"><span style="color: rgb(54, 50, 48);">The Faculty of Dentistry Network is made up of more than 10.000 alumni in some countries worldwide. Forge new connections among our community of influential dentistry leaders.</span><br></p><a href="<?php  echo site_url('/alumnies'); ?>" class="btn btn-primary">FIND YOUR NETWORK</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card"><img class="card-img-top w-100 d-block fit-cover" style="height: 200px;" src="https://fkg.ui.ac.id/wp-content/uploads/2018/10/PR4A9699-1-scaled.jpg">
                    <div class="card-body p-4">
                        <h4><span style="color: rgb(54, 50, 48);">Career Resources &amp; Professional Development</span><br></h4>
                        <p class="card-text"><span style="color: rgb(54, 50, 48);">Access career resources and professional development opportunities, request a transcript or get in touch with us.</span><br></p><a href="<?php  echo site_url('/vacancies'); ?>" class="btn btn-primary">DISCOVER MORE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-4 py-xl-5">
        <div class="row gy-4 gy-md-0">
            <div class="col-md-6">
                <div class="p-xl-5 m-xl-5"><img class="rounded img-fluid w-100 fit-cover" style="min-height: 300px;" src="https://fkg.ui.ac.id/wp-content/uploads/2018/07/81685D60-54BC-4984-AEC6-BD6973D4FEDE.jpeg"></div>
            </div>
            <div class="col-md-6 d-md-flex align-items-md-center">
                <div style="max-width: 350px;">
                    <h2 class="text-uppercase fw-bold">Investor Circle</h2>
                    <p class="my-3"><span style="color: rgb(54, 50, 48);">Join the Faculty of Dentistry top champions and give future leaders a transformative education. Donors who exceed an annual threshold of giving are eligible to join the Investors Circle at the partner level, and recent graduates may join at an associate level: all members receive exclusive benefits.</span><br></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-4 py-xl-5">
        <div class="row gy-4 gy-md-0">
            <div class="col-md-6 text-center text-md-start d-flex d-sm-flex d-md-flex justify-content-center align-items-center justify-content-md-start align-items-md-center justify-content-xl-center">
                <div style="max-width: 350px;">
                    <h2 class="text-uppercase fw-bold">ALUMNI NETWORK</h2>
                    <p class="my-3"><span style="color: rgb(54, 50, 48);">You are part of a thriving alumni network of business and community leaders that are driven to use business as a force for good. This powerful network is available to you wherever your career path leads. Check out our Alumni Network brochure to learn more about the many ways you can get involved, engage in lifelong learning, and give back</span><br></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-xl-5 m-xl-5"><img class="rounded img-fluid w-100 fit-cover" style="min-height: 300px;" src="https://iluniui-fkg.com/images/2020/04/03/all-team.jpg"></div>
            </div>
        </div>
        <h1 style="text-align: center;margin-top: 23px;margin-bottom: 25px;">Events</h1>

        <?php  
                $today = date('Ymd');
                $homepageEvents = new WP_Query(
                    array(
                        'posts_per_page' => 3,
                        'post_type' => 'event',
                        'orderby' => 'meta_value_num',
                        'meta_key' => 'event_date',
                        'order' => 'ASC',
                        'meta_query' => array(
                          array(
                            'key' => 'event_date',
                            'compare' => '>=',
                            'value' => $today,
                            'type' => 'numeric'
                          )
                        )
                     )
                );

                while($homepageEvents -> have_posts()){
                    $homepageEvents -> the_post();
                    ?>

                    <div class="card">
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
                                                        echo wp_trim_words(get_the_content(), 30);
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
        
    </div>
<?php get_footer() ?>