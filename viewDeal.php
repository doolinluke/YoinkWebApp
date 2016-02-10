<?php
require_once 'Connection.php';
require_once 'DealTableGateway.php';
require_once 'Deal.php';
require_once 'BusinessTableGateway.php';

$sessionId = session_id();
if ($sessionId == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

if (!isset($_GET) || !isset($_GET['id'])) {
    die('Invalid request');
}
$dealId = $_GET['id'];

$connection = Connection::getInstance();
$dealGateway = new DealTableGateway($connection);
$businessGateway = new BusinessTableGateway($connection);
$businessGateway2 = new BusinessTableGateway($connection);

$deals = $dealGateway->getDealById($dealId);
$businesses = $businessGateway->getBusinessById($bId);
$businessDeal = $businessGateway2->getBusinessByDealId($dealId);
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
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet">
        <script src="js/respond.js"></script>
    </head>
    <body>
        <!--<?php require 'toolbar.php' ?>-->
        <?php require 'mainMenu.php' ?>
        <?php
        if (isset($errorMessage)) {
            echo '<p>Error: ' . $errorMessage . '</p>';
        }
        ?> 
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
                            <li><a href="index.php">Home</a></li>                    
                            <li><a href="#">Services</a></li> 
                            <li><a href="#">Book</a></li>
                            <li><a href="#">Contact</a></li>
                            <li class=""><?php require 'toolbar.php' ?></li>
                        </ul> 
                    </div>
                </div>
            </nav> 
        </div>
        <div class = "row">
            <div class="container">
                <div class = "options col-md-6 col-xs-6">
                    <center>
                        <a href="home.php"><img src="img/company.png" onmouseover="this.src='img/companyFloat.png'" onmouseout="this.src='img/company.png'" /></a>
                        <h4>Businesses</h4>
                    </center>
                    
                </div>

                <div class = "options col-md-6 col-xs-6">
                    <center>
                        <a href="viewDeals.php"><img src="img/deal.png" onmouseover="this.src='img/dealFloat.png'" onmouseout="this.src='img/deal.png'" /></a>
                        <h4>Deals</h4>
                    </center>
                </div>
            </div>
        </div>
        <div class="container">
            <table class="table table-bordered table-responsive">
                <tbody>
                    <?php
                    $deal = $deals->fetch(PDO::FETCH_ASSOC);
                    $bus = $businessDeal->fetch(PDO::FETCH_ASSOC);
                    echo '<tr>';
                    echo '<td>Deal</td>'
                    . '<td>' . $deal['deal_description'] . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>Category</td>'
                    . '<td>' . $deal['deal_category'] . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>Business</td>'
                    . '<td>' . $bus['business_name'] . '</td>';
                    echo '</tr>';
                    echo '<th>Options</th>'
                    . '<td>'
                    . '<a class="btn btn-edit btn-xs" href="editDealForm.php?id=' . $deal['dealId'] . '">Edit</a> '
                    . '<a class="deleteDeal" href="deleteDeal.php?id=' . $deal['dealId'] . '"><button class = "btn btn-delete btn-xs">Delete</button></a> '
                    . '</td>';
                    echo'</tr>';
                    ?>
                </tbody>
            </table>
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