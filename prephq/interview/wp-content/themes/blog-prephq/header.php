<!Doctype HTML>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<title>
			<?php
			if (wp_title('', false)) {
				wp_title(' | ', true, 'right');
			} else {
				bloginfo('description');
			}
			?>
		</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    
		<?php wp_head(); ?>
		
<!-- Google Tag Manager -->
<!-- <script>
    setTimeout(function(){
        (function(w,d,s,l,i){
            w[l]=w[l]||[];
            w[l].push({'gtm.start': new Date().getTime(), event:'gtm.js'});
            var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';
            j.async=true; j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;
            f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-P57SX2T');
    }, 5000); // Delay for 5 seconds (5000 ms)
</script> -->
<!-- End Google Tag Manager -->
	</head>
<body <?php body_class(); ?>>
	<!-- Google Tag Manager (noscript) -->
<!-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P57SX2T"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> -->
<!-- End Google Tag Manager (noscript) -->
<!--
	<header id="header">
		<div class="container-fluid">
			<nav class="navbar navbar-expand-md navbar-light bg-faded">
			<?php //if( has_custom_logo() ) { 
  //the_custom_logo(); 
	//} else { ?>
	<h1 class="navbar-brand mb-0"><a href="<?php //echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php //bloginfo( 'name' ); ?></a></h1>
<?php //} ?>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs4navbar" aria-controls="bs4navbar" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
   </button>
   <?php
  //  wp_nav_menu([
  //    'menu'            => 'top',
  //    'theme_location'  => 'top',
  //    'container'       => 'div',
  //    'container_id'    => 'bs4navbar',
  //    'container_class' => 'collapse navbar-collapse',
  //    'menu_id'         => false,
  //    'menu_class'      => 'navbar-nav ml-auto mr-auto',
  //    'depth'           => 2,
  //    'fallback_cb'     => 'bs4navwalker::fallback',
  //    'walker'          => new bs4navwalker()
  //  ]);
   ?>
</nav>
		</div>
	</header>
  -->
 <header>
      <div class="container">
        <nav class="navbar" aria-label="Main navigation">
            <a class="logo" href="https://prephq.theiotacademy.co/">
                <img
                src="https://prephq.theiotacademy.co/blog/wp-content/uploads/2025/08/logo.png"
                alt="Navbar"
                class="logo-img"
                width="140"
                height="47"
                />
            </a>

          <ul class="nav-links" id="navLinks">
            <li>
              <li><a class="nav-link" href="https://prephq.theiotacademy.co/">Home</a></li>
            </li>
            <li><a class="nav-link" href="https://prephq.theiotacademy.co/about">About</a></li>
            <li><a class="nav-link" href="https://prephq.theiotacademy.co/contact">Contact</a></li>
            <li><a class="nav-link" href="https://prephq.theiotacademy.co/*">Practice</a></li>
            <li><a class="nav-link" href="https://prephq.theiotacademy.co/*">Resources</a></li>
            <li><a class="nav-link" href="https://prephq.theiotacademy.co/*">Free Mock</a></li>
          </ul>
          <ul class="search-login" id="rightControls">
            <li class="search-form">
              <form onSubmit={handleSearch}>
                <input id="searchInput" type="text" placeholder="Search..." />
                <button type="submit" aria-label="Search">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    viewBox="0 0 20 20"
                    fill="none"
                  >
                    <path
                      d="M9.02772 17.4985C4.35974 17.4929 0.692038 14.2916 0.0814847 9.93178C-0.495288 5.80903 2.04326 1.74134 6.00373 0.44196C11.0696 -1.21965 16.4376 1.97094 17.3646 7.2154C17.7788 9.55892 17.2915 11.7298 15.9571 13.7011C15.7989 13.935 15.8014 14.0627 16.009 14.2666C17.192 15.4277 18.3562 16.6076 19.5291 17.7794C19.8994 18.1497 20.1021 18.567 19.9482 19.1032C19.7093 19.9371 18.7378 20.2705 18.044 19.7513C17.9277 19.6643 17.8219 19.5624 17.7187 19.4591C16.5608 18.3024 15.3997 17.1488 14.2525 15.9814C14.0685 15.7943 13.9509 15.7818 13.7364 15.9326C12.2425 16.9817 10.5697 17.4766 9.02772 17.4972V17.4985ZM8.77249 15.0292C12.1737 15.048 15.0194 12.2503 15.0382 8.86825C15.0576 5.38112 12.3032 2.56777 8.84755 2.54024C5.24617 2.51084 2.62942 5.4368 2.54246 8.52667C2.43674 12.2753 5.41131 15.043 8.77249 15.0292Z"
                      fill="white"
                    />
                  </svg>
                </button>
              </form>
            </li>
            <li>
                <a href="https://prephq.theiotacademy.co/login" class="login-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M3.63255 13.1673C3.91304 12.7266 4.11715 12.366 4.36071 12.0329C4.84907 11.365 5.46578 10.8441 6.22837 10.5073C6.71234 10.2932 7.19069 10.4291 7.39229 10.8366C7.60517 11.2667 7.43236 11.7393 6.93649 11.9716C6.1307 12.3491 5.57409 12.9538 5.23287 13.7626C5.05756 14.1783 5.07822 14.2171 5.48393 14.3993C6.36736 14.7968 7.28398 15.0466 8.26195 15.0454C8.69834 15.0454 9.01202 15.2789 9.11908 15.6457C9.21926 15.9869 9.08277 16.3644 8.74405 16.5578C8.60067 16.6399 8.40783 16.6668 8.23815 16.6655C6.50949 16.6505 4.93171 16.1434 3.52674 15.1405C1.70478 13.8397 0.567781 12.0724 0.149545 9.88004C-0.509114 6.42814 1.05301 3.07139 3.94811 1.27219C5.66425 0.206072 7.53817 -0.226512 9.54546 0.114046C12.9846 0.698128 15.2248 2.70454 16.2936 5.99618C16.5277 6.71673 16.5622 7.50803 16.6411 8.27115C16.6937 8.77949 16.3224 9.16136 15.8559 9.17138C15.4114 9.18077 15.0533 8.8208 15.0326 8.32124C14.9875 7.25637 14.7728 6.23595 14.2713 5.28564C13.262 3.37188 11.6767 2.1624 9.57739 1.77802C5.90405 1.10504 2.6383 3.41257 1.83501 6.76682C1.31284 8.94851 1.83063 10.9142 3.21369 12.664C3.3364 12.8192 3.46663 12.9688 3.6313 13.1667L3.63255 13.1673Z" fill="black"/>
                        <path d="M11.0281 9.19767C11.3261 9.29533 11.8414 9.44996 12.3473 9.63213C14.3858 10.3646 16.4207 11.1077 18.458 11.8433C19.2325 12.1225 19.3953 12.7754 18.8212 13.3657C18.1888 14.0162 17.5508 14.6616 16.9047 15.2989C16.7287 15.4723 16.7319 15.5869 16.9072 15.7597C17.8507 16.6893 18.7886 17.6259 19.7202 18.568C20.1547 19.0075 20.0702 19.636 19.5562 19.9133C19.2607 20.0724 18.8819 20.0135 18.582 19.7287C18.1738 19.3412 17.7806 18.9374 17.3817 18.5398C16.8427 18.0021 16.2973 17.4706 15.7702 16.9209C15.5861 16.7294 15.464 16.7363 15.2843 16.9197C14.6638 17.5526 14.0371 18.1799 13.3985 18.7946C13.247 18.9405 13.0529 19.0832 12.855 19.1302C12.4155 19.2354 12.0881 19.0463 11.9184 18.5999C11.5628 17.6653 11.2297 16.7219 10.8897 15.7816C10.3512 14.2929 9.80591 12.8067 9.28061 11.3136C8.92186 10.2951 9.712 9.20518 11.0287 9.19767H11.0281ZM10.9511 10.8879C10.9266 10.913 10.9022 10.938 10.8772 10.9631C11.5834 12.9044 12.2903 14.8457 13.0091 16.8214C13.113 16.7475 13.1487 16.7288 13.1762 16.7012C14.3333 15.5443 15.4884 14.3862 16.6473 13.2305C16.8333 13.0446 16.7619 12.9645 16.549 12.8887C15.1084 12.376 13.6702 11.8558 12.2308 11.3393C11.8051 11.1866 11.3774 11.0382 10.9511 10.8879Z" fill="black"/>
                        <path d="M5.44637 6.22405C5.43948 4.67151 6.72862 3.40318 8.29075 3.37C9.89231 3.3362 11.2647 4.63958 11.2366 6.32735C11.2096 7.95 9.99312 9.13069 8.40783 9.17451C6.70733 9.22146 5.45388 7.93999 5.44637 6.22405ZM9.5874 6.28165C9.5874 5.5636 9.03894 4.98765 8.35085 4.98264C7.6659 4.97764 7.06609 5.5661 7.06359 6.24534C7.06108 6.96088 7.60955 7.51993 8.31642 7.52243C9.05835 7.52431 9.58803 7.00784 9.5874 6.28227V6.28165Z" fill="black"/>
                        </svg> 
                    <span>Login</span>
                </a>
            </li>
          </ul>

          <button class="menu-toggle" id="menuToggle" aria-label="Toggle navigation" aria-expanded="false">
        <span class="menuIcon">☰</span>
        </button>

        </nav>
      </div>
    </header>
<!--navbar end-->