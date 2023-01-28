<?php  
    if (is_user_logged_in()) {
                
	?>

	<!-- ======= Header Dashboard ======= -->
	<header id="header" class="header fixed-top d-flex align-items-center">

		<div class="d-flex align-items-center justify-content-between">
		<span class="bs-icon-sm bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center me-2 bs-icon"><img  style="height: 48px; " src="<?php echo get_theme_file_uri('images/fkg.png'); ?>" alt=""></span></a></span>
		</a>
		</div><!-- End Logo -->


		<nav class="header-nav ms-auto">
		<ul class="d-flex align-items-center">


			<li class="nav-item dropdown pe-3">

			<a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
			<span><?php echo get_avatar(get_current_user_id(), 60); ?></span>
			</a><!-- End Profile Iamge Icon -->

			<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">

				<li>
				<a class="dropdown-item d-flex align-items-center" href="<?php echo wp_logout_url(); ?>">
					<i class="bi bi-box-arrow-right"></i>
					<span>Keluar</span>
				</a>
				</li>

			</ul><!-- End Profile Dropdown Items -->
			</li><!-- End Profile Nav -->

		</ul>
		</nav><!-- End Icons Navigation -->

		</header><!-- End Header -->
				

    <?php

} else {
	?>
       <nav class="navbar navbar-light navbar-expand-md py-3" style="border-bottom: solid 1px">
        <div class="container" syle="ml-auto"><div><a class="navbar-brand d-flex align-items-center" href="/"><span class="bs-icon-sm bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center me-2 bs-icon"><img  style="height: 48px; " src="<?php echo get_theme_file_uri('images/fkg.png'); ?>" alt=""></span></a></div><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-2"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-2">
                 <nav class="main-navigation">

				 <?php
					wp_nav_menu( [
						'theme_location'	=> 'headerMenuLocation',
						'depth'         	=> 2,
						'container'			=> false,
						'menu_class'    	=> 'navbar-nav justify-content-start flex-grow-1 pe-3',
						'fallback_cb'   	=> '__return_false',
						'walker'         	=> new bootstrap_5_wp_nav_menu_walker()
					] );
					?>
                  </nav>
				  <?php get_search_form(); ?>
				  <div>
                <a href="<?php echo wp_login_url(); ?>" class="btn btn-primary ms-md-2">Login</a>
                <a href="<?php echo esc_url(site_url('/wp-signup.php')); ?>" class="btn btn-primary ms-md-2" style="background: #45a01a;">Sign Up</a></div>
          </div>
            </div>
        </div>
    </nav>
<?php 
} 
?>
	


