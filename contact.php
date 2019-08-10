<?php include "check.php";?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- viewport meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Avivon - Business Consulting & Finance HTML5 Template">
    <meta name="keywords"
        content="	advisor, business, consultant, consulting, corporate,  finance, financial, law firm, institutions, organizations , html5">
    <title>Alpha Exchange World - Pure Finance Consulting</title>

    <!-- Favicon Icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">

    <!-- inject:css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/fontello.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnificpopup.css">
    <link rel="stylesheet" href="sass/style.css">
    <!-- endinject -->
</head>

<body>
    <!-- page preloader -->
    <div id="loading-area">
        <div class="three col">
            <div class="loader" id="loader-1"></div>
        </div>
    </div><!-- end loading -->

    <div class="body-overlay"></div><!-- end body-overlay -->
    <div class="offcanvas-menu">
        <div class="menu__close"></div><!-- end menu__close -->
        <?php include "include/menu1.php";?>
    </div><!-- end offcanvas-menu -->

    <!-- ================================
         START MENU AREA
================================= -->
    <?php include "include/menu.php";?>
    <!-- ================================
          END MENU AREA
================================= -->

    <!--================================
         START BANNER AREA
=================================-->
    <section class="trusted-area breadcrumb-area text-center">
        <div class="trusted-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="trusted-content">
                            <div class="trusted__title">
                                <ul class="bread__rumb-item">
                                    <li class="active-item"><a href="index.php">home</a></li>
                                    <li>contact</li>
                                </ul>
                                <h2 class="trusted__title-title">contact us</h2>
                            </div><!-- end trusted__title -->
                        </div><!-- end trusted-content -->
                    </div><!-- end col-md-12 -->
                </div><!-- end row -->
            </div><!-- container -->
        </div><!-- end trusted-fluid -->
    </section><!-- end trusted-area -->
    <!--================================
      END BANNER AREA
=================================-->

    <!--================================
         START CONTACT AREA
=================================-->
    <section class="contact-area responsive-content area-padding">
        <div class="contact-fluid">
            <div class="container contact-info avivon-pb">
                <div class="row">
                    <div class="col-md-4 primary-padding">
                        <div class="avivon-heading">
                            <h2 class="avivon__title">feel free to write us a message</h2>
                            <p class="avivon__desc contact__desc mt-50px">
                                Your assets are your employees. Invest more on those performing well. Let the non
                                performers go.
                                For more details write to us.
                            </p>
                        </div><!-- end avivon-heading -->
                    </div><!-- end col-md-4 -->
                    <div class="col-md-8">
                        <div class="comment__form contact__form">
                            <form action="#">
                                <div class="input__box-input">
                                    <input type="text" placeholder="your name">
                                </div>
                                <div class="input__box-input email-box">
                                    <input type="email" placeholder="email address">
                                </div>
                                <textarea name="message" placeholder="message"></textarea>
                                <button class="submit__btn-btn">send message
                                    <span class="fontello icon-angle-double-right"></span>
                                </button>
                            </form>
                        </div><!-- end comment__form -->
                    </div><!-- end col-md-8 -->
                </div><!-- end row -->
            </div><!-- container -->
        </div><!-- end contact-fluid -->
    </section><!-- end contact-area -->
    <!--================================
      END CONTACT AREA
=================================-->

    <!--================================
        START OFC-CAOUSEL AREA
=================================-->
    <section class="ofc-caoursel-area avivon-pb">
        <div class="ofc-caoursel-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 primary-padding-2 text-center">
                        <div class="avivon-heading">
                            <h2 class="avivon__title">office</h2>
                        </div><!-- end avivon-heading -->
                    </div><!-- end col-md-12 -->
                </div><!-- end row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <img class="img-responsive" src="images/support.jpg">
                        </div>
                        <div class="col-md-4">
                            <div class="office-list-item">
                                <div class="office__name">
                                    <h3 class="office__name-title">Serbia</h3>
                                </div><!-- end office__name -->
                                <div class="office__desc">
                                    <p class="office__desc-desc">
                                        Stari Korzo 30, 1st Floor,
                                        Office No. 2, 12000,
                                        Pozarevac, Serbia<br>
                                        Phone : +381 12 532299 <br>
                                        email: support@alphaeworld.com</p>
                                </div><!-- end office__desc -->
                            </div><!-- end office-list-item -->
                        </div>
                    </div><!-- end col-md-12 -->
                </div><!-- end row -->
            </div><!-- container -->
        </div><!-- end ofc-caoursel-fluid -->
    </section><!-- end ofc-caoursel-area -->
    <!--================================
         END OFC-CAOUSEL AREA
=================================-->

    <!--========= start google map ===========-->
    <div id="map" class="mt-60px"></div>
    <!--========= end google map ===========-->

    <?php include "include/footer1.php";?>


    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/magnificpopup.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_Agsvf36du-7l_mp8iu1a-rXoKcWfs2I"></script>
    <script src="js/gmaps.js"></script>
    <script src="js/main.js"></script>
    <script>
    // google map control
    var map;
    $(document).ready(function() {
        map = new GMaps({
            el: '#map',
            center: new google.maps.LatLng(44.6207621, 21.1861061),
            zoom: 19,
            scrollWheel: false,
            styles: [{
                "featureType": "water",
                "elementType": "geometry",
                "stylers": [{
                    "color": "#e9e9e9"
                }, {
                    "lightness": 17
                }]
            }, {
                "featureType": "landscape",
                "elementType": "geometry",
                "stylers": [{
                    "color": "#f5f5f5"
                }, {
                    "lightness": 20
                }]
            }, {
                "featureType": "road.highway",
                "elementType": "geometry.fill",
                "stylers": [{
                    "color": "#ffffff"
                }, {
                    "lightness": 17
                }]
            }, {
                "featureType": "road.highway",
                "elementType": "geometry.stroke",
                "stylers": [{
                    "color": "#ffffff"
                }, {
                    "lightness": 29
                }, {
                    "weight": 0.2
                }]
            }, {
                "featureType": "road.arterial",
                "elementType": "geometry",
                "stylers": [{
                    "color": "#ffffff"
                }, {
                    "lightness": 18
                }]
            }, {
                "featureType": "road.local",
                "elementType": "geometry",
                "stylers": [{
                    "color": "#ffffff"
                }, {
                    "lightness": 16
                }]
            }, {
                "featureType": "poi",
                "elementType": "geometry",
                "stylers": [{
                    "color": "#f5f5f5"
                }, {
                    "lightness": 21
                }]
            }, {
                "featureType": "poi.park",
                "elementType": "geometry",
                "stylers": [{
                    "color": "#dedede"
                }, {
                    "lightness": 21
                }]
            }, {
                "elementType": "labels.text.stroke",
                "stylers": [{
                    "visibility": "on"
                }, {
                    "color": "#ffffff"
                }, {
                    "lightness": 16
                }]
            }, {
                "elementType": "labels.text.fill",
                "stylers": [{
                    "saturation": 36
                }, {
                    "color": "#333333"
                }, {
                    "lightness": 40
                }]
            }, {
                "elementType": "labels.icon",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "transit",
                "elementType": "geometry",
                "stylers": [{
                    "color": "#f2f2f2"
                }, {
                    "lightness": 19
                }]
            }, {
                "featureType": "administrative",
                "elementType": "geometry.fill",
                "stylers": [{
                    "color": "#fefefe"
                }, {
                    "lightness": 20
                }]
            }, {
                "featureType": "administrative",
                "elementType": "geometry.stroke",
                "stylers": [{
                    "color": "#fefefe"
                }, {
                    "lightness": 17
                }, {
                    "weight": 1.2
                }]
            }]

        });
    });
    </script>
</body>

</html>