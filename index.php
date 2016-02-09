<?php
require_once 'Business.php';
require_once 'Connection.php';
require_once 'BusinessTableGateway.php';

/*if (isset($_GET) && isset($_GET['sortOrder'])) {
    $sortOrder = $_GET['sortOrder'];
    $columnNames = array("businessID", "business_name", "business_address", "business_lat", "business_long", "business_type");
    if (!in_array($sortOrder, $columnNames)) {
        $sortOrder = 'businessID';
    }
} else {
    $sortOrder = 'businessID';
}

if (isset($_GET) && isset($_GET['filterName'])) {
    $filterName = filter_input(INPUT_GET, 'filterName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
} else {
    $filterName = NULL;
}

$connection = Connection::getInstance();
$gateway = new BusinessTableGateway($connection);

$statement = $gateway->getBusinesses($sortOrder, $filterName);*/
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>My Website</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet">
        <script src="js/respond.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="row"> 
            <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
                <div class="container">
                    <div class="navbar-brand">
                        <p><img src="img/yoinklogosmall.png" alt="" class="img-responsive"></p>
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
                            <li><a href="#">Home</a></li>                    
                            <li><a href="#">Services</a></li> 
                            <li><a href="#">Book</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="home.php">Admin</a></li>
                            <li class=""><?php require 'toolbar.php' ?></li>
                        </ul> 
                    </div>
                </div>
            </nav> 
        </div>

        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="img/diners.png" alt="">
                    <div class="carousel-caption">
                        <center><h1>YOINK!</h1>
                            <p>Yoink! is the perfect shopping pal for finding the deals you want</p>
                            <p>current, dynamic, and always on trend</p>
                            <a class="btn btn-primary btn-large" href="#">Join Us Now</a></center>
                    </div>
                </div>

                <div class="item">
                    <img src="img/shopper.png" alt="">
                    <div class="carousel-caption">
                        <center><h1>YOINK!</h1>
                            <p>Yoink! finds you your new best customers</p>
                            <p>and walks them right through the door</p>
                            <a class="btn btn-primary btn-large" href="#">Join Us Now</a></center>
                    </div>
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <div class="row2 col-lg-12">
            <div class="container">
                <div class="bio col-lg-12">
                    <h1>Modern. Dynamic.Experienced.</h1>
                    <p>Ranelagh Medical Centre, providing a full range of general
                        practice care to public and private businesss.</p>
                </div>
            </div>
        </div>

        <div class = "row">
            <div class="container">
                <div class = "options col-md-3 col-xs-6">
                    <p><img src="img/restaurant.png" alt="" class="img-responsive"></p>
                    <h4>Restaurants</h4>
                </div>

                <div class = "options col-md-3 col-xs-6">
                    <p><img src="img/clothes.png" alt="" class="img-responsive"></p>
                    <h4>Clothes Shops</h4>
                </div>

                <div class = "options col-md-3 col-xs-6">
                    <p><img src="img/pub.png" alt="" class="img-responsive"></p>
                    <h4>Pubs</h4>
                </div>

                <div class = "options col-md-3 col-xs-6">
                    <p><img src="img/cafe.png" alt="" class="img-responsive"></p>
                    <h4>Cafés</h4>
                </div>
            </div>
        </div>

        <div class="jumbotron-2" class="img-responsive">             
            <div class="container"> 
                <div class="row">
                    <h1>About Us</h1>
                    <p>At Ranelagh Medical Centre we provide you with the most</p> 
                    <P>current, dynamic, professional and trustworthy public and private health care.</p>
                    <p>For over 20 years we have provided top quality medical services for all our businesss.</p>
                    <a class="btn btn-primary btn-large" href="#">Meet The Team</a>
                </div>
            </div>
        </div>

        <div class="row2 col-lg-12">
            <div class="container">
                <div class="tour col-lg-12">
                    <center>
                        <h1>Want to see our home?</h1>
                        <p>Click here to take a tour of our award winning facilities and see where thousands 
                            of happy members come for the best medical care available.</p>
                        <a class="btn btn-primary btn-large" href="#">Take a Tour</a>
                    </center>
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




