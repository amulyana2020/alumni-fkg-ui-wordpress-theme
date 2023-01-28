<?php

    if (!is_user_logged_in()){
        wp_redirect('/');
        exit;
    } else {
        get_header();
        while(have_posts()) {
            the_post();

            $BsWp = new BsWp;

            $BsWp->get_template_parts([
                'sidebar', 
            ]);

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

                        } else {
                            ?>
                            <main id="main" class="main">
                            <div class="alert alert-danger" role="alert">
                                Anda belum memiliki profile. Silahkan membuat profile dengan menekan tombol di bawah.
                                </div>
                            <a href="<?php echo esc_url(site_url('/add-profile'));  ?>" class="btn btn-primary"> Masukan Profile</a>
                            </main>
                            <?php
                        }
                        
                        while($myData -> have_posts()){
                            $myData -> the_post();
                            ?>
            ?>

            <main id="main" class="main">

            <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo esc_url(site_url('/my-dashboard'));  ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
            </div><!-- End Page Title -->

            <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                    <img src="<?php the_field('photo'); ?>" alt="Profile" class="rounded-circle">
                    <h2><?php the_title(); ?></h2>
                    <div class="social-links mt-2">
                    <?php
                                            $relatedMajor = get_field('major');
                                            if ($relatedMajor){
                                                echo '<br>';
                                                echo '<h5 class="">Program Studi:</h5>';
                                                echo '<ul class="list-unstyled">';
                                                foreach ($relatedMajor as $major) {
                                                    ?>
                                                        <li><?php  echo get_the_title($major); ?></li>
                                                    <?php
                                                }    
                                                echo '</ul>';
                                            }
                                            ?>
                    </div>
                    </div>
                </div>

                </div>

                <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">

                        <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                        </li>
                    </ul>
                    <div class="tab-content pt-2">

                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                        <h5 class="card-title">Bio</h5>
                        <p class="small fst-italic"><?php the_field('biodata'); ?></p>

                        <h5 class="card-title">Profile Details</h5>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Full Name</div>
                            <div class="col-lg-9 col-md-8"><?php the_title(); ?></div>
                        </div>

                        <?php
                                            $relatedInstitution = get_field('institution');
                                            if ($relatedInstitution){
                                                echo '<div class="row">';
                                                echo '<div class="col-lg-3 col-md-4 label">Institusi</div>';
                                                foreach ($relatedInstitution as $institution) {
                                                    ?>
                                                        <div class="col-lg-9 col-md-8"><?php  echo get_the_title($institution); ?></div>
                                                    <?php
                                                }    
                                                echo '</div>';
                                            }
                                            
                                        ?>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Job</div>
                            <div class="col-lg-9 col-md-8"><?php the_field('job'); ?></div>
                        </div>

                        
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Address</div>
                            <div class="col-lg-9 col-md-8"><?php the_field('address'); ?></div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Phone</div>
                            <div class="col-lg-9 col-md-8"><?php the_field('phone'); ?></div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Email</div>
                            <div class="col-lg-9 col-md-8"><?php $current_user = wp_get_current_user();
                            echo $current_user->user_email; ?></div>
                        </div>
                        <div>
                        <a class='btn btn-danger' href="/edit-my-profile">Edit Profile</a>
                        </div>

                        </div>

                    </div><!-- End Bordered Tabs -->

                    </div>
                </div>

                </div>
            </div>
            </section>

            </main><!-- End #main -->
                 
           <?php
        }

        get_footer();
    }}

?>