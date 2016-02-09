<?php
require_once 'Connection.php';
require_once 'DealTableGateway.php';
require_once 'BusinessTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';
$username = $_SESSION['user_id'];

$conn = Connection::getInstance();
$dealGateway = new DealTableGateway($conn);
$businessGateway = new BusinessTableGateway($conn);

$deals = $dealGateway->getDeals();
$businesses = $businessGateway->getBusinessByUserId($username);
?>
<!DOCTYPE html>
<html>
    <head>
        <link href='http://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>
        <meta charset="UTF-8">
        <script type="text/javascript" src="Javascript/deal.js"></script>
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
                        <a href="home.php"><img src="img/company.png" onmouseover="this.src = 'img/companyFloat.png'" onmouseout="this.src = 'img/company.png'" /></a>
                        <h4>Businesses</h4>
                    </center>

                </div>

                <div class = "options col-md-6 col-xs-6">
                    <center>
                        <a href="viewDeals.php"><img src="img/deal.png" onmouseover="this.src = 'img/dealFloat.png'" onmouseout="this.src = 'img/deal.png'" /></a>
                        <h4>Deals</h4>
                    </center>
                </div>
            </div>
        </div>
        <div class = "row">
            <div class="welcome">
                <div class="container">
                    <h1>Create New Deal</h1>
                </div>
            </div>
        </div>
        <form action="createDeal.php" method="POST" id="createDealForm">
            <div class="container">
                <table class="table table-bordered">                
                    <tbody>
                        <tr>
                            <td>Deal Description</td>
                            <td>
                                <input type="text" name="deal_description" value="<?php
                                if (isset($_POST) && isset($_POST['deal_description'])) {
                                    echo $_POST['deal_description'];
                                }
                                ?>" />
                                <span id="dealNameError" class="error">
                                    <?php
                                    if (isset($errorMessage) && isset($errorMessage['dealNameError'])) {
                                        echo $errorMessage['dealNameError'];
                                    }
                                    ?>
                                </span>
                            </td>
                        </tr>
<!--                        <tr>
                            <td>Deal Category</td>
                            <td>
                                <input type="text" name="deal_category" value="<?php
                                if (isset($_POST) && isset($_POST['deal_category'])) {
                                    echo $_POST['deal_category'];
                                }
                                ?>" />
                                <span id="dealNameError" class="error">
                                    <?php
                                    if (isset($errorMessage) && isset($errorMessage['dealNameError'])) {
                                        echo $errorMessage['dealNameError'];
                                    }
                                    ?>
                                </span>
                            </td>
                        </tr>-->
                        <tr>
                            <td>Deal Category</td>
                            <td>
                                <select name="deal_category">
                                    <option value="-1">....</option>
                                    <option value="Food & Drink">Food & Drink</option>
                                    <option value="Pubs">Pubs</option>
                                    <option value="Electronics">Electronics</option>
                                    <option value="Movies, Games & Music">Movies, Games & Music</option>
                                    <option value="Miscellaneous">Miscellaneous</option>
                                    <input type="submit" name="deal_category" value="<?php
                                    if (isset($_POST) && isset($_POST['deal_category'])) {
                                        echo $_POST['deal_category'];
                                    }
                                    ?>" />
                                    <span id="dealCategoryError" class="error">
                                    <?php
                                    if (isset($errorMessage) && isset($errorMessage['dealCategoryError'])) {
                                        echo $errorMessage['dealCategoryError'];
                                    }
                                    ?>
                                </span>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Business</td>
                            <td>
                                <select name="businessId">
                                    <option value="-1">No Business</option>
                                    <?php
                                    $b = $businesses->fetch(PDO::FETCH_ASSOC);
                                    while ($b) {
                                        echo '<option value="' . $b['businessID'] . '">' . $b['business_name'] . '</option>';
                                        $b = $businesses->fetch(PDO::FETCH_ASSOC);
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <input type="submit" class="btn btn-info" value="Submit">
            </div>
        </form>

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
        <!-- javascript -->
        <script src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script>
                            $('a.btn-info').tooltip()
        </script>
    </body>
</html>
