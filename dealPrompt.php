<?php
require_once 'Business.php';
require_once 'Connection.php';
require_once 'BusinessTableGateway.php';
require_once 'DealTableGateway.php';

require 'ensureUserLoggedIn.php';
$userId = $_SESSION['user_id'];


?>
<!DOCTYPE html>
<html>
    <head>
        <link href='http://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>
        <meta charset="UTF-8">
        <script type="text/javascript" src="Javascript/business.js"></script>
        <title>Yoink!</title>
        <meta charset="utf-8">  
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="CSS/bootstrap.min.css" rel="stylesheet">
        <link href="CSS/custom.css" rel="stylesheet">
        <script src="Javascript/respond.js"></script>
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
                            <li><p><?php
                            $username = $_SESSION['username'];
                            $numBus = $_SESSION['numBus'];
                            echo 'Welcome ' . $username;
                            ?></p></li>
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
                    <img src="img/shopper2.png" alt="">
                    <div class="carousel-caption">
                        <center><h1>Business Created</h1>
                            <p>Now that you've created your first business click the button below to create your first deal.</p>  
                            <a class="btn btn-primary btn-large" href="createDealForm.php">Create Deal</a></center>
                    </div>
                </div>                               
            </div>
        </div>

        <div class="row">
            <div class = "footerBar navbar-fixed-bottom col-md-12 col-xs-12">
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
