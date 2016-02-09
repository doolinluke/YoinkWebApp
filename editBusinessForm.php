<?php
require_once 'Business.php';
require_once 'Connection.php';
require_once 'BusinessTableGateway.php';
require_once 'DealTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

if (!isset($_GET) || !isset($_GET['id'])) {
    die('Invalid request');
}
$businessID = $_GET['id'];

$connection = Connection::getInstance();
$gateway = new BusinessTableGateway($connection);

$dealGateway = new DealTableGateway($connection);

$deals = $dealGateway->getDeals();

$statement = $gateway->getBusinessById($businessID);
if ($statement->rowCount() !== 1) {
    die("Illegal request");
}
$row = $statement->fetch(PDO::FETCH_ASSOC);
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
            <form id="editBusinessForm" name="editBusinessForm" action="editBusiness.php" method="POST">
                <input type="hidden" name="businessID" value="<?php echo $businessID; ?>" />
                <table class="table table-bordered table-responsive">
                    <tbody>
                        <tr>
                            <td>Business Name</td>
                            <td>
                                <input type="text" name="business_name" value="<?php
                                if (isset($_POST) && isset($_POST['business_name'])) {
                                    echo $_POST['business_name'];
                                } else
                                    echo $row['business_name']
                                    ?>" />
                                <span id="fNameError" class="error">
                                    <?php
                                    if (isset($errorMessage) && isset($errorMessage['business_name'])) {
                                        echo $errorMessage['business_name'];
                                    }
                                    ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>
                                <input type="text" name="business_address" value="<?php
                                if (isset($_POST) && isset($_POST['business_address'])) {
                                    echo $_POST['business_address'];
                                } else
                                    echo $row['business_address']
                                    ?>" />
                                <span id="fNameError" class="error">
                                    <?php
                                    if (isset($errorMessage) && isset($errorMessage['business_address'])) {
                                        echo $errorMessage['business_address'];
                                    }
                                    ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Latitude</td>
                            <td>
                                <input type="text" name="business_lat" value="<?php
                                if (isset($_POST) && isset($_POST['business_lat'])) {
                                    echo $_POST['business_lat'];
                                } else
                                    echo $row['business_lat']
                                    ?>" />
                                <span id="lNameError" class="error">
                                    <?php
                                    if (isset($errorMessage) && isset($errorMessage['business_lat'])) {
                                        echo $errorMessage['business_lat'];
                                    }
                                    ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Longitude</td>
                            <td>
                                <input type="text" name="business_long" value="<?php
                                if (isset($_POST) && isset($_POST['business_long'])) {
                                    echo $_POST['business_long'];
                                } else
                                    echo $row['business_long']
                                    ?>" />
                                <span id="addressError" class="error">
                                    <?php
                                    if (isset($errorMessage) && isset($errorMessage['business_long'])) {
                                        echo $errorMessage['business_long'];
                                    }
                                    ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Business Type</td>
                            <td>
                                <input type="text" name="business_type" value="<?php
                                if (isset($_POST) && isset($_POST['business_type'])) {
                                    echo $_POST['business_type'];
                                } else
                                    echo $row['business_type']
                                    ?>" />
                                <span id="phoneNumberError" class="error">
                                    <?php
                                    if (isset($errorMessage) && isset($errorMessage['business_type'])) {
                                        echo $errorMessage['business_type'];
                                    }
                                    ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" value="Update Business" name="updateBusiness" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
        <div class="footerGroup navbar">
            <div class = "row">
                <div class="row3">
                    <div class = "bottom col-md-3 col-xs-6">
                        <ul class="footer navbar-nav">
                            <h3>FIND US HERE</h3>
                            <li><img src="img/fbicon.png" alt="" class="img-responsive"></li>                    
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
                        <p>ranelaghmedcentre@gmail.com</p>
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
                    <p>© Ranelagh Medical Centre. All rights reserved.</p>
                </div>
            </div>
        </div>
        <!-- javascript -->
        <script src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script>
            $('a.btn-info').tooltip();
        </script>
    </body>
</html>
