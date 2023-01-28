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
            <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">

            <!-- Apakah user sudah terverifikasi ? -->
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

                                        <!-- Jika sudah terverifikasi tampilkan Dashboard -->
                                    <div class="col-lg-8" style="height: 70vh">
                                        <div class="row">

                                            <div class="col-xxl-4 col-md-6">
                                            <div class="card info-card sales-card">
                                                <div class="card-body">
                                                <h5 class="card-title">Profil Saya</span></h5>

                                                <div class="d-flex align-items-center">
                                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-cart"></i>
                                                    </div>
                                                    <div class="ps-3">
                                                    <h6>145</h6>
                                                    <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                                                    </div>
                                                </div>
                                                </div>

                                            </div>
                                            </div>

                                            <div class="col-xxl-4 col-md-6">
                                            <div class="card info-card revenue-card">
                                                <div class="card-body">
                                                <h5 class="card-title">Karir</span></h5>

                                                <div class="d-flex align-items-center">
                                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-currency-dollar"></i>
                                                    </div>
                                                    <div class="ps-3">
                                                    <h6>120</h6>
                                                    <span class="small pt-1">lowongan</span>

                                                    </div>
                                                </div>
                                                </div>

                                            </div>
                                            </div>

                                        
                                            <div class="col-xxl-4 col-xl-12">

                                            <div class="card info-card customers-card">

                                                <div class="filter">
                                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                    <li class="dropdown-header text-start">
                                                    <h6>Filter</h6>
                                                    </li>

                                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                                </ul>
                                                </div>

                                                <div class="card-body">
                                                <h5 class="card-title">Customers <span>| This Year</span></h5>

                                                <div class="d-flex align-items-center">
                                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-people"></i>
                                                    </div>
                                                    <div class="ps-3">
                                                    <h6>1244</h6>
                                                    <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span>

                                                    </div>
                                                </div>

                                                </div>
                                            </div>

                                            </div>



                                        </div>
                                        </div>

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