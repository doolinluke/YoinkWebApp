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

if (isset($_GET) && isset($_GET['sortOrder'])) {
    $sortOrder = $_GET['sortOrder'];
    $columnNames = array("businessID", "business_name", "business_address", "business_lat", "business_long", "business_type");
    if (!in_array($sortOrder, $columnNames)) {
        $sortOrder = 'businessID';
    }
}
else {
    $sortOrder = 'businessID';
}

$conn = Connection::getInstance();
$dealGateway = new DealTableGateway($conn);
$businessGateway = new BusinessTableGateway($conn);

$deals = $dealGateway->getDeals();
$businesses = $businessGateway->getBusinessByUserId($username, $sortOrder);
?>
<!DOCTYPE html>
<html>
    <head>
        <link href='http://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>
        <meta charset="UTF-8">
        <script type="text/javascript" src="Javascript/deal.js"></script>
        <title>Yoink!</title>
        <meta charset="utf-8">  
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="CSS/bootstrap.min.css" rel="stylesheet">
        <link href="CSS/custom.css" rel="stylesheet">
        <script src="Javascript/respond.js"></script>
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
        
        <div class="welcome">
            <div class="container">
                <h1>Create New Deal</h1>
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
                        <tr>
                            <td>Deal Category</td>
                            <td>
                                <select name="deal_category">
                                    <option value="-1">....</option>
                                    <option value="Café">Café</option>
                                    <option value="Clothes & Fashion">Clothes & Fashion</option>
                                    <option value="Electronics">Electronics</option>
                                    <option value="Entertainment">Entertainment</option>
                                    <option value="Food & Drink">Food & Drink</option>
                                    <option value="Health & Beauty">Health & Beauty</option>
                                    <option value="Miscellaneous">Miscellaneous</option>
                                    <option value="Music, Movies & Games">Music, Movies & Games</option>
                                    <option value="Pubs">Pubs</option>
                                    <option value="Restaurants">Restaurants</option>
                                    <input type="submit" style="color: transparent; background-color: transparent;" name="deal_category" value="<?php
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
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" class="btn btn-info" value="Submit">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>

        <div class = "row">
            <div class="row3">
                <div class = "bottom col-md-3 col-xs-6">
                    <ul class="footer navbar-nav">
                        <h3>FIND US HERE</h3>
                        <li><img src="img/fbicon.png" onmouseover="this.src = 'img/fbiconfloat.png'" onmouseout="this.src = 'img/fbicon.png'" /></li>
                        <li><img src="img/instaicon.png" onmouseover="this.src = 'img/instaiconfloat.png'" onmouseout="this.src = 'img/instaicon.png'" /></li>
                        <li><img src="img/twittericon.png" onmouseover="this.src = 'img/twittericonfloat.png'" onmouseout="this.src = 'img/twittericon.png'" /></li>
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
