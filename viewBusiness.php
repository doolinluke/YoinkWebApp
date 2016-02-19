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
$bId = $_GET['id'];

$connection = Connection::getInstance();
$gateway = new BusinessTableGateway($connection);
$dealGateway = new DealTableGateway($connection);


$statement = $gateway->getBusinessById($bId);
$deals = $dealGateway->getDealByBusinessId($bId);
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
        
        <div class = "row">
            <div class="welcome">
                <div class="container">
                    <h1><?php
                    $row = $statement->fetch(PDO::FETCH_ASSOC); 
                    echo $row['business_name']; ?></h1>
                </div>
            </div>
        </div>
        <div class="container">
            <table class="table table-bordered table-responsive">
                <tbody>
                    <?php
                    echo '<tr>';
                    echo '<th>Business Name</th>'
                    . '<td>' . $row['business_name'] . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<th>Business Address</th>'
                    . '<td>' . $row['business_address'] . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<th>Lat</th>'
                    . '<td>' . $row['business_lat'] . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<th>Long</th>'
                    . '<td>' . $row['business_long'] . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<th>Business Type</th>'
                    . '<td>' . $row['business_type'] . '</td>';
                    echo '</tr>';
                    echo '<th>Options</th>'
                    . '<td>'
                    . '<a class="btn btn-edit btn-xs" href="editBusinessForm.php?id=' . $row['businessID'] . '">Edit</a> '
                    . '<a class="deleteBusiness" href="deleteBusiness.php?id=' . $row['businessID'] . '"><button class = "btn btn-delete btn-xs">Delete</button></a> '
                    . '</td>';
                    '</tr>';
                    ?>
                </tbody>
            </table>
        </div>
        
        <div class="row2 col-lg-12">
            <div class="container">
                <div class="tour col-lg-12">
                    <h1>Deals assigned to <?php echo $row['business_name']; ?></h1>
                </div>
                <?php if ($deals->rowCount() !== 0) { ?>
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th>Deal Description</th>
                                <th>Deal Category</th>
                                <th>Business</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $row = $deals->fetch(PDO::FETCH_ASSOC);
                            while ($row) {
                                echo '<td>' . $row['deal_description'] . '</td>';
                                echo '<td>' . $row['deal_category'] . '</td>';
                                echo '<td>' . $row['business_name'] . '</td>';
                                echo '<td>'
                                . '<a class="btn btn-view btn-xs" href="viewDeal.php?id=' . $row['dealId'] . '">View</a> '
                                . '<a class="btn btn-edit btn-xs" href="editDealForm.php?id=' . $row['dealId'] . '">Edit</a> '
                                . '<a class="deletePatient" href="deleteDeal.php?id=' . $row['dealId'] . '"><button class = "btn btn-delete btn-xs">Delete</button></a> '
                                . '</td>';
                                echo '</tr>';

                                $row = $deals->fetch(PDO::FETCH_ASSOC);
                            }
                            ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                <div class="container">
                    <h3>There are no deals assigned to this business. <a href="createDealForm.php">Create One</a></h3>
                </div>
                <?php } ?>
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
