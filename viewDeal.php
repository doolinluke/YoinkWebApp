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
$businessDeal = $businessGateway2->getBusinessByDealId($dealId);
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
                    $deal = $deals->fetch(PDO::FETCH_ASSOC); 
                    echo $deal['deal_description']; ?></h1>
                </div>
            </div>
        </div>
        <div class="container">
            <table class="table table-bordered table-responsive">
                <tbody>
                    <?php
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