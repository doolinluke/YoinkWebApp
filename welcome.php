<?php
require_once 'Business.php';
require_once 'Connection.php';
require_once 'BusinessTableGateway.php';
require_once 'checkRegister.php';

require 'ensureUserLoggedIn.php';
$userID = $_SESSION['user_id'];

?>
<!DOCTYPE html>
<html>
    <head>
        <link href='http://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>
        <meta charset="UTF-8">
        <script type="text/javascript" src="Javascript/business.js"></script>
        <title>Medical Centre</title>
        <meta charset="utf-8">  
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="CSS/bootstrap.min.css" rel="stylesheet">
        <link href="CSS/custom.css" rel="stylesheet">
        <script src="Javascript/respond.js"></script>
<!--        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBbHIhlshSnY9ddWv58BBg23XvmkVAu03o&callback=initMap"></script>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBbHIhlshSnY9ddWv58BBg23XvmkVAu03o&libraries=places"></script>
        <script src ="http://maps.googleapis.com/maps/api/geocode/output?parameters"></script>
        <script type ="text/javascript">
            google.maps.event.addDomListener(window, 'load', initialize);
        </script>-->
    </head>
    <body>
        <div class="row"> 
            <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
                <div class="container">
                    <div class="navbar-brand">
                        <p><a href="index.php"><img src="img/yoinklogosmall.png" alt="" class="img-responsive"></a></p>
                    </div>
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="glyphicon glyphicon-arrow-down"></span>
                            MENU
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#"<?php
                            $username = $_SESSION['username'];
                            $userID = $_SESSION['user_id'];
                            echo '<h3>Welcome ' . $username . $userID . '</h3>';
                            ?></a></li>
                            <li><a></a></li>                    
                            <li><a href="home.php">Businesses</a></li> 
                            <li><a href="viewDeals.php">Deals</a></li>
                            <li class=""><?php require 'toolbar.php' ?></li>
                        </ul> 
                    </div>
                </div>
            </nav> 
        </div>
        
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="img/chefs.png" alt="">
                    <div class="carousel-caption">
                        <center><h1>Welcome To Yoink!</h1>
                            <p>To get started with Yoink! click the button below to create your first business and then attach a deal to your business</p>  
                            <a class="btn btn-primary btn-large" href="createBusinessForm.php">Create Business</a></center>
                    </div>
                </div>                               
            </div>
        </div>

        <div class = "row">
            <div class="row3">

                <div class = "bottom col-md-3 col-xs-6">
                    <ul class="footer navbar-nav">
                        <h3>FIND US HERE</h3>
                        <li><img src="img/fbicon.png" onmouseover="this.src='img/fbiconfloat.png'" onmouseout="this.src='img/fbicon.png'" /></li>
                        <li><img src="img/instaicon.png" onmouseover="this.src='img/instaiconfloat.png'" onmouseout="this.src='img/instaicon.png'" /></li>
                        <li><img src="img/twittericon.png" onmouseover="this.src='img/twittericonfloat.png'" onmouseout="this.src='img/twittericon.png'" /></li>
                    </ul>
                </div>

                <div class = "bottom col-md-3 col-xs-6">
                    <h3>SEE OUR ENDORSEMENTS</h3>
                    <p>Click here to read reviews from satisfied members as well as professional endorsements and testimonials from highly regarded medical professionals.</p>
                </div>

                <div class = "bottom col-md-3 col-xs-6">
                    <h3>CONTACT US</h3>
                    <P>Feel free to get in touch. Either pop into us at our location, phone us, or you can email us.</P>
                    <p>84 Ranelagh Road, Ranelagh, D6</p>
                    <p>Phone: 0871234567</p>
                    <p>yoink@gmail.com</p>
                </div>

                <div class = "bottom col-md-3 col-xs-6">
                    <h3>JOIN OUR MAILING LIST</h3>
                    <p>Enter you email address to keep up to date with new membership offers.</p>
                    <input type="email" id="form_email" name="form[email]" required="required" placeholder="Enter your email address">
                    <a class="btn btn-primary btn-large" href="#">Subscribe</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class = "footerBar col-md-12 col-xs-12">
                <p>© YOINK! 2016. All rights reserved.</p>
            </div>
        </div>
        <!-- javascript -->
        <script src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script>
            $('a.btn-info').tooltip()
        </script>
    </body>
</html>
