<?php
require_once 'Business.php';
require_once 'Connection.php';
require_once 'BusinessTableGateway.php';

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

if (isset($_GET) && isset($_GET['filterName'])) {
    $filterName = filter_input(INPUT_GET, 'filterName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
} else {
    $filterName = NULL;
}


$connection = Connection::getInstance();
$gateway = new BusinessTableGateway($connection);
$statement = $gateway->getBusinessByUserId($username, $sortOrder);

?>
<!DOCTYPE html>
<html>
    <head>
        <link href='http://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>
        <meta charset="UTF-8">
        <script type="text/javascript" src="Javascript/business.js"></script>
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
                    <h1>Your Businesses</h1>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">    
                <div class="col-md-12">
                    <table class="table table-bordered table-striped table-responsive">           
                        <thead>
                            <tr>
                                <th><a href="home.php?sortOrder=business_name">Business Name</a></th>
                                <th><a href="home.php?sortOrder=business_address">Address</a></th>
                                <th><a href="home.php?sortOrder=business_type">Category</a></th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $row = $statement->fetch(PDO::FETCH_ASSOC);
                            while ($row) {

                                echo '<tr>';
                                echo '<td>' . $row['business_name'] . '</td>';
                                echo '<td>' . $row['business_address'] . '</td>';
                                echo '<td>' . $row['business_type'] . '</td>';
                                echo '<td>'
                                . '<a class="btn btn-view btn-xs" href="viewBusiness.php?id=' . $row['businessID'] . '">View</a> '
                                . '<a class="btn btn-edit btn-xs" href="editBusinessForm.php?id=' . $row['businessID'] . '">Edit</a> '
                                . '<a class="deleteBusiness" href="deleteBusiness.php?id=' . $row['businessID'] . '"><button class = "btn btn-delete btn-xs">Delete</button></a> '
                                . '</td>';
                                echo '</tr>';

                                $row = $statement->fetch(PDO::FETCH_ASSOC);
                            }
                           
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="createButton">
                    <div class="container">
                        <a class="btn btn-create btn-large" href="createBusinessForm.php">Create new Business</a>
                    </div>
                </div>
            </div>
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
