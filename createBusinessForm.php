<script type="text/javascript" src="Javascript/business.js"></script>
<?php
require_once 'Connection.php';
require_once 'DealTableGateway.php';
require_once 'BusinessTableGateway.php';
require_once 'UserTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';
$username = $_SESSION['user_id'];

require 'ensureUserLoggedIn.php';

$conn = Connection::getInstance();
$dealGateway = new DealTableGateway($conn);
$userGateway = new UserTableGateway($conn);
$businessGateway = new BusinessTableGateway($conn);

$deals = $dealGateway->getDeals();
$users = $userGateway->getUserByUserName($username);
$businesses = $businessGateway->getBusinesses();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1-transitional.dtd>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link href='http://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>
        <meta charset="UTF-8">
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
                <div class = "row">
                    <div class="welcome">
                        <div class="container">
                            <h1>Create New Business</h1>
                        </div>
                    </div>
                </div>
            </div>
                
            <form id="createBusinessForm" action="createBusiness.php" method="POST" >
                <div class="container">
                    <table class="table table-bordered">                
                        <tbody>
                            <tr>
                                <td>Business Name</td>
                                <td>
                                    <input type="text" style="width: 300px;"name="business_name" value="<?php
                                    if (isset($_POST) && isset($_POST['business_name'])) {
                                        echo $_POST['business_name'];
                                    }
                                    ?>" />
                                    <span id="businessNameError" class="error">
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
                                    <!-- Calls the autocomplete script and the disable return key script -->
                                    <input type="text" style="width: 300px;" name="business_address" onKeyPress="return disableEnterKey(event)" id="txtautocomplete" value="<?php
                                    if (isset($_POST) && isset($_POST['business_address'])) {
                                        echo $_POST['business_address'];
                                    }
                                    ?>" />
                                    <span id="addressError" class="error">
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
                                    <input type="text" style="width: 300px;" name="business_lat" id="lblresultLat" value="<?php
                                    if (isset($_POST) && isset($_POST['business_lat'])) {
                                        echo $_POST['business_lat'];
                                    }
                                    ?>" />
                                    <span id="latitudeError" class="error">
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
                                    <input type="text" style="width: 300px;" name="business_long" id="lblresultLng" value="<?php
                                    if (isset($_POST) && isset($_POST['business_long'])) {
                                        echo $_POST['business_long'];
                                    }
                                    ?>" />
                                    <span id="longitudeError" class="error">
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
                                        <span id="businessTypeError" class="error">
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
                                    <button type="submit" id="createBusinessForm" class="btn btn-info">Create </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </form>

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
        <!-- Code to implement autocomplete function while typing in the business address -->
        <script type="text/javascript">
            google.maps.event.addDomListener(window, 'load', initialize);
            function initialize() {
                var autocomplete = new google.maps.places.Autocomplete(document.getElementById('txtautocomplete'));
                google.maps.event.addListener(autocomplete, 'place_changed', function () {
                    var places = autocomplete.getPlace();
                    var location = '<b>Location:</b>' + places.formatted_address + "<br/>";
                    var localLat = places.geometry.location.lat();
                    var localLng = places.geometry.location.lng();
                    document.getElementById('lblresultLat').value = localLat;
                    document.getElementById('lblresultLng').value = localLng;
                    console.log(localLng + "" + localLat);

                    return localLng
                });

            }
        </script>
        <!-- Code that disables the enter key from submitting the form when being used to select an address -->
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
