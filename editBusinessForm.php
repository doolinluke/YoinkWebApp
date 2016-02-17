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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1-transitional.dtd>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link href='http://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>
        <meta charset="UTF-8">
        <script type="text/javascript" src="Javascript/business.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3kPZdtcJcP3EuDFpPNU3iIfAh0q-X6Gc&libraries=places"></script>
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
                            <li><a href="home.php">Businesses</a></li> 
                            <li><a href="viewDeals.php">Deals</a></li>
                            <li class=""><?php require 'toolbar.php' ?></li>
                        </ul>
                    </div>
                </div>
            </nav> 
        </div>
        
        <div class = "row">
            <div class="welcome">
                <div class="container">
                    <h1><?php
                            $username = $_SESSION['username'];
                            echo 'Edit ' . $row['business_name'];?>
                    </h1>
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
                                <input type="text" name="business_address" onKeyPress="return disableEnterKey(event)" id="txtautocomplete" value="<?php
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
                                <input type="text" name="business_lat" id="lblresultLat" value="<?php
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
                                <input type="text" name="business_long" id="lblresultLng" value="<?php
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
                                <select name="business_type">
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
                                    <input type="submit" style="color: transparent; background-color: transparent;" name="business_type" value="<?php
                                    if (isset($_POST) && isset($_POST['business_type'])) {
                                        echo $_POST['business_type'];
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
                            <td></td>
                            <td>
                                <input type="submit" value="Update Business" name="updateBusiness" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
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
            $('a.btn-info').tooltip();
        </script>
        <script type="text/javascript">
                google.maps.event.addDomListener(window, 'load', initialize);
                function initialize() {
                    var autocomplete = new google.maps.places.Autocomplete(document.getElementById('txtautocomplete'));
                    google.maps.event.addListener(autocomplete, 'place_changed', function() {
                        var places = autocomplete.getPlace();
                        var location ='<b>Location:</b>'+ places.formatted_address + "<br/>";
                        var localLat= places.geometry.location.lat();
                        //var location2 ='<b>Location:</b>'+ places.formatted_address + "<br/>";
                        var localLng =places.geometry.location.lng();
                        document.getElementById('lblresultLat').value = localLat;
                        document.getElementById('lblresultLng').value = localLng;
                        console.log(localLng + "" + localLat);
                        
                        return localLng
                });
                
                }
            </script>
            <script language="JavaScript">
                function disableEnterKey(e)
                {
                    var key;
                    if (window.event)
                        key = window.event.keyCode;
                    else
                        key = e.which;
                    if (key == 13)
                        return false;
                    else
                        return true;
                }
            </script>
    </body>
</html>
