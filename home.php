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
$statement = $gateway->getBusinessByUserId($username);

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
<!--        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBbHIhlshSnY9ddWv58BBg23XvmkVAu03o&callback=initMap"></script>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBbHIhlshSnY9ddWv58BBg23XvmkVAu03o&libraries=places"></script>
        <script src ="http://maps.googleapis.com/maps/api/geocode/output?parameters"></script>
        <script type ="text/javascript">
            google.maps.event.addDomListener(window, 'load', initialize);
        </script>-->
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <div class="row"> 
            <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
                <div class="container">
                    <div class="navbar-brand">
                        <p><a href="home.php"><img src="img/yoinklogosmall.png" alt="" class="img-responsive"></a></p>
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
            <div class="welcome">
                <div class="container">
                    <h1>Your Businesses</h1>
                    <!--  Calls in the session $username the prints it out -->
                    <?php
                    $username = $_SESSION['username'];
                    echo '<h3>Welcome ' . $username . '</h3>';
                    ?>
                </div>
            </div>
        </div>
        <?php
        if (isset($message)) {
            echo '<p>' . $message . '</p>';
        }
        ?>

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
            <!--<div class="row">-->
<!--                <div class="col-md-2">
                    <form class="form-horizontal" role="form" action="home.php?sortOrder=<?php echo $sortOrder; ?>" method="GET">                      
                        <div class="form-group">
                            <label class="control-label" for="lName">First Name</label>
                            <div>
                                <input type="text"
                                       name="filterName"
                                       class="form-control"
                                       value="<?php echo $filterName; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label"></label>
                            <div>
                                <button type="submit" name="filterBtn" id="filterBtn" class="btn btn-success">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>-->
            <div class="row">    
                <div class="col-md-12">
                    <table class="table table-bordered table-striped table-responsive">           
                        <thead>
                            <tr>
                                <th><a href="home.php?sortOrder=business_name">Business Name</a></th>
                                <th><a href="home.php?sortOrder=business_address">Address</a></th>
                                <th><a href="home.php?sortOrder=business_lat">Latitude</a></th>
                                <th><a href="home.php?sortOrder=business_long">Longitude</a></th>
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
                                echo '<td>' . $row['business_lat'] . '</td>';
                                echo '<td>' . $row['business_long'] . '</td>';
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
            $('a.btn-info').tooltip()
        </script>
    </body>
</html>
