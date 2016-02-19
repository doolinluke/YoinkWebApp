<?php
require_once 'Deal.php';
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

if (!isset($_GET) || !isset($_GET['id'])) {
    die('Invalid request');
}
$dealId = $_GET['id'];
$_SESSION['id'] = $dealId;

$connection = Connection::getInstance();
$gateway = new DealTableGateway($connection);

$businessGateway = new BusinessTableGateway($connection);

$businesses = $businessGateway->getBusinessByUserId($username, $sortOrder);

$statement = $gateway->getDealById($dealId);
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
        <script type="text/javascript" src="Javascript/deal.js"></script>
        <title>Yoink</title>
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
        
        <div class = "row">
            <div class="welcome">
                <div class="container">
                    <h1><?php  
                    echo 'Edit ' . $row['deal_description']; ?>
                </div>
            </div>
        </div>

        <div class="container">
            <form id="editDealForm" name="editDealForm" action="editDeal.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $dealId; ?>" />
                <table class="table table-bordered table-responsive">
                    <tbody>
                        <tr>
                            <td>Deal</td>
                            <td>
                                <input type="text" name="deal_description" value="<?php
                                if (isset($_POST) && isset($_POST['deal_description'])) {
                                    echo $_POST['deal_description'];
                                } else
                                    echo $row['deal_description']
                                    ?>" />
                                <span id="dealNameError" class="error">
                                    <?php
                                    if (isset($errorMessage) && isset($errorMessage['deal_description'])) {
                                        echo $errorMessage['deal_description'];
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
                                <input type="submit" value="Update Deal" name="updateDeal" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
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
