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
                                <input type="text" style="width: 190px;" name="deal_description" value="<?php
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
                                <input type="submit" id="createDealForm" class="btn btn-info" value="Submit">
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
    </body>
</html>
