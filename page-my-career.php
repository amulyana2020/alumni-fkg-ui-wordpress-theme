<?php

    if (!is_user_logged_in()){
        wp_redirect('/');
        exit;
    } else {
        get_header();
        
        $BsWp = new BsWp;

        $BsWp->get_template_parts([
            'sidebar', 
        ]);

        ?>

        <main id="main" class="main">

        <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo esc_url(site_url('/my-dashboard'));  ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Karir</li>
            </ol>
        </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <!-- Apakah User sudah terverifikasi ? -->
        <?php 
        $myAccount = new WP_Query(
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
                                ),
                                array(
                                    'key' => 'verified',
                                    'compare' => '==',
                                    'value' => true,
                                    'type' => 'boolean'
                                  )
                                )
                                
                            )
                                );

                        if ($myAccount -> have_posts()){
                            ?>
                                <div class="row">

                                        <!-- Jika sudah terverifikasi tampilkan list Vacancy -->
                                        <?php 
                                         $today = date('Ymd');
                                         $myVacancy = new WP_Query(
                                                array(
                                                    'post_type' => 'vacancy',
                                                    'orderby' => 'meta_value_num',
                                                    'meta_key' => 'valid_until',
                                                    'order' => 'ASC',
                                                    'meta_query' => array(
                                                    array(
                                                        'key' => 'valid_until',
                                                        'compare' => '>=',
                                                        'value' => $today,
                                                        'type' => 'numeric'
                                                    )
                                                    )
                                                    
                                                )
                                                    );

                                            if ($myVacancy -> have_posts()){
                                                $myVacancy -> the_post();
                                                    ?>
                                                       <div class="card my-4 p-4">
                                                            <h5><strong><?php  the_title();  ?></strong></h5>
                                                            <?php  the_content(); ?>
                                                            <p>Tanggal Penutupan: <?php the_field('valid_until'); ?> </p>
                                                            <p>Surat Lamaran dikirim ke: <?php the_field('send_to_email'); ?></p>
                                                       </div> 
                                                          
                                                
                                                    <?php
                                                }
                                            else {
                                                ?>
                                                    <div class="alert alert-info" role="alert">
                                                        Tidak ada info karir aktif.
                                                    </div>
                                                <?php
                                            }        
                                                ?>
                                </div>                

                                <?php
                        } else {
                            ?>

                            <div class="row">

                                <!-- Jika belum terverifikasi tampilkan warning -->
                                <div class="col-lg-8">
                                <div class="alert alert-info" role="alert">
                                    <ul>
                                        <li>Akun anda sedang dalam verifikasi. Anda akan melihat seluruh informasi di dalam website ini jika sudah terverifikasi.</li>
                                        <li>Proses verifikasi berjalan sekitar 5 hari kerja.</li>
                                        <li>Untuk mempermudah proses verifikasi silakan mengisi Profile secara lengkap dan benar.</li>
                                        <li>Jika proses verifikasi berjalan lamban, silakan menghubungi admin kami di email partnership@fkg.ui.ac.id.</li>
                                    </ul>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
        
        </section>

    </main><!-- End #main -->

        <?php

        get_footer();
    }

?>