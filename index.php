<?php
require_once 'Business.php';
require_once 'Connection.php';
require_once 'BusinessTableGateway.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Yoink!</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="CSS/bootstrap.min.css" rel="stylesheet">
        <link href="CSS/custom.css" rel="stylesheet">
        <script src="Javascript/respond.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
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
                            <li><a href="home.php">Businesses</a></li> 
                            <li><a href="viewDeals.php">Deals</a></li>
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
                    <img src="img/shopper.png" alt="">
                    <div class="carousel-caption">
                        <center><h1>YOINK!</h1>
                            <p>Yoink! finds you your new best customers</p>
                            <p>and walks them right through the door</p>
                            <a class="btn btn-primary btn-large" href="register.php">Join Us Now</a></center>
                    </div>
                </div>
                
                <div class="item">
                    <img src="img/diners.png" alt="">
                    <div class="carousel-caption">
                        <center><h1>YOINK!</h1>
                            <p>Yoink! is the perfect shopping pal for finding the deals you want</p>
                            <p>Current, dynamic, and always on trend</p>
                            <a class="btn btn-primary btn-large" href="register.php">Join Us Now</a></center>
                    </div>
                </div>
                <div class="item">
                    <img src="img/coffee.png" alt="">
                    <div class="carousel-caption">
                        <center><h1>YOINK!</h1>
                            <p>Yoink! finds you your new best customers</p>
                            <p>and walks them right through the door</p>
                            <a class="btn btn-primary btn-large" href="register.php">Join Us Now</a></center>
                    </div>
                </div>
                <div class="item">
                    <img src="img/table.png" alt="">
                    <div class="carousel-caption">
                        <center><h1>YOINK!</h1>
                            <p>Yoink! finds you your new best customers</p>
                            <p>and walks them right through the door</p>
                            <a class="btn btn-primary btn-large" href="register.php">Join Us Now</a></center>
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
                    <h1>Modern. Dynamic. Intuitive.</h1>
                    <p>Yoink! couldn't be more simple to use. Both for customers and business owners.</p>
                    <p>Our services are available to all types of business. Restaurants, Cafés, Pubs, Clothes Shops, Music, Movies and Game stores etc.</p>
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
                    <p>We here at Yoink! are passionate about improving the way businesses find new customers</p> 
                    <P>Join us for free to see how Yoink! can transform your customer base</p></p>
                    <a class="btn btn-primary btn-large" href="register.php">Join Yoink!</a>
                </div>
            </div>
        </div>

        <div class="row2 col-lg-12">
            <div class="container">
                <div class="tour col-lg-12">
                    <center>
                        <h1>Want to join us at Yoink!?</h1>
                        <p>Click here to join the list of businesses that are reaching more people than ever with Yoink!</p>
                        <a class="btn btn-primary btn-large" href="register.php">Join Us</a>
                    </center>
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
        <script src="Javascript/bootstrap.min.js"></script>
        <script>
            $('a.btn-info').tooltip();
        </script>
    </body>
</html>




