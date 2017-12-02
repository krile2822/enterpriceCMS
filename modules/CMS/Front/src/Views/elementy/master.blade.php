<!DOCTYPE html>
<!--

  Theme Name: Elementy
  Description: HTML/CSS 
  Author: Abcgomel 
  Designed & Coded by Abcgomel
  
-->

<html>
  <head>
    <title>Elementy - Responsive HTML5 Template</title>
    <meta charset=utf-8 >
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="robots" content="index, follow" > 
    <meta name="keywords" content="HTML5 Template" > 
    <meta name="description" content="Elementy - Responsive HTML5 Template" > 
    <meta name="author" content="Vladimir Azarushkin">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="theme-color" content="#2a2b2f">
    
    <!-- FAVICONS -->
    <link rel="shortcut icon" href="/elementy/images/favicon/favicon.png">
    <link rel="apple-touch-icon" href="/elementy/images/favicon/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/elementy/images/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/elementy/images/favicon/apple-touch-icon-114x114.png">
    <link rel="icon" sizes="192x192" href="/elementy/images/favicon/icon-192x192.png">
    

    <!-- jQuery  -->
    <script type="text/javascript" src="/elementy/js/jquery.min.js"></script>
<!-- CSS -->
    <!--  GOOGLE FONT -->   
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,200%7COpen+Sans:400,300,700' rel='stylesheet' type='text/css'>
    
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="/elementy/css/bootstrap.min.css"> 
  
    <!-- ICONS ELEGANT FONT & FONT AWESOME & LINEA ICONS  -->   
    <link rel="stylesheet" href="/elementy/css/icons-fonts.css" > 
  
    <!-- CSS THEME -->    
    <link rel="stylesheet" href="/elementy/css/style.css" >
  
    <!-- ANIMATE -->  
    <link rel='stylesheet' href="/elementy/css/animate.min.css">

    <!-- LIGHTBOX -->
    <link href="/lightbox2/src/css/lightbox.css" rel="stylesheet">
    
    <!-- IE Warning CSS -->
    <!--[if lte IE 8]><link rel="stylesheet" type="text/css" href="css/ie-warning.css" ><![endif]-->
    <!--[if lte IE 8]><link rel="stylesheet" type="text/css" href="css/ie8-fix.css" ><![endif]-->
    
    <!-- Magnific popup, Owl Carousel Assets in style.css -->   
  
<!-- CSS end -->

<!-- JS begin some js files in bottom of file-->
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
  </head>
  <body class="font-raleway">
  
    <!-- LOADER --> 
    <div id="loader-overflow">
      <div id="loader3" class="loader-cont">Please enable JS</div>
    </div>  

    <div id="wrap" class="boxed ">
      <div class="grey-bg"> <!-- Grey BG  --> 
        
        <!--[if lte IE 8]>
        <div id="ie-container">
          <div id="ie-cont-close">
            <a href='#' onclick='javascript&#058;this.parentNode.parentNode.style.display="none"; return false;'><img src='images/ie-warn/ie-warning-close.jpg' style='border: none;' alt='Close'></a>
          </div>
          <div id="ie-cont-content" >
            <div id="ie-cont-warning">
              <img src='images/ie-warn/ie-warning.jpg' alt='Warning!'>
            </div>
            <div id="ie-cont-text" >
              <div id="ie-text-bold">
                You are using an outdated browser
              </div>
              <div id="ie-text">
                For a better experience using this site, please upgrade to a modern web browser.
              </div>
            </div>
            <div id="ie-cont-brows" >
              <a href='http://www.firefox.com' target='_blank'><img src='images/ie-warn/ie-warning-firefox.jpg' alt='Download Firefox'></a>
              <a href='http://www.opera.com/download/' target='_blank'><img src='images/ie-warn/ie-warning-opera.jpg' alt='Download Opera'></a>
              <a href='http://www.apple.com/safari/download/' target='_blank'><img src='images/ie-warn/ie-warning-safari.jpg' alt='Download Safari'></a>
              <a href='http://www.google.com/chrome' target='_blank'><img src='images/ie-warn/ie-warning-chrome.jpg' alt='Download Google Chrome'></a>
            </div>
          </div>
        </div>
        <![endif]-->
        
        <!-- HEADER 1 FONT WHITE TRANSPARENT -->
        <div class="header-black-bg"></div> <!-- NEED FOR TRANSPARENT HEADER ON MOBILE -->
        <header id="nav" class="header header-1 header-black">
          <div class="header-wrapper">
          <div class="container-m-30 clearfix">
            <div class="logo-row">
            
            <!-- LOGO --> 
            <div class="logo-container-2">
                <div class="logo-2">
                  <a href="index.html" class="clearfix">
                    <img src="/elementy/images/icbtech.png" class="logo-img" alt="Logo">
                  </a>
                </div>
              </div>
            <!-- BUTTON --> 
            <div class="menu-btn-respons-container">
              <button id="menu-btn" type="button" class="navbar-toggle btn-navbar collapsed" data-toggle="collapse" data-target="#main-menu .navbar-collapse">
                <span aria-hidden="true" class="icon_menu hamb-mob-icon"></span>
              </button>
            </div>
           </div>
          </div>

            @include('front::elementy.layouts.main-menu')
                
              </div>
              <!-- END container-m-30 -->
            
          </div>
          <!-- END main-menu-container -->
          
          
          </div>
          <!-- END header-wrapper -->
          
        </header>
        
        @yield('static_media')
        

        @yield('page')

        
        @include('front::elementy.layouts.footer')
        
      </div><!-- End BG --> 
    </div><!-- End wrap --> 
      
<!-- JS begin -->

    

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/elementy/js/bootstrap.min.js"></script>   

    <!-- FORM VALIDATION -->
    <script src="/elementy/js/jquery.validate.min.js"></script>

    <!-- MAGNIFIC POPUP -->
    <script src='/elementy/js/jquery.magnific-popup.min.js'></script>
    
    <!-- PORTFOLIO SCRIPTS -->
    <script type="text/javascript" src="/elementy/js/imagesloaded.pkgd.min.js"></script>
    <script type="text/javascript" src="/elementy/js/isotope.pkgd.min.js"></script>
    <script type="text/javascript" src="/elementy/js/imagesloaded.pkgd.min.js"></script>
    <script type="text/javascript" src="/elementy/js/masonry.pkgd.min.js"></script>
    
    <!-- LIGHTBOX -->
    <script src="/lightbox2/src/js/lightbox.js"></script>

    <!-- APPEAR -->    
    <script type="text/javascript" src="/elementy/js/jquery.appear.js"></script>

    <!-- OWL -->
    <script type="text/javascript" src="/elementy/js/owl-carousel/owl.carousel.min.js"></script>    
    
    <!-- JQUERY TWEETS -->
    <script src="/elementy/js/twitter/jquery.tweet.js"></script> 
    
    <!-- GOOGLE -->
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script>
    <script src="/elementy/js/gmap3.min.js" type="text/javascript"></script>

    <!-- MAIN SCRIPT -->
    <script src="/elementy/js/main.js"></script>

    <!-- JS end --> 
  
  </body>
</html>   