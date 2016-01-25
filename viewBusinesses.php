<?php
require_once 'Connection.php';
require_once 'BusinessTableGateway.php';

require 'ensureUserLoggedIn.php';

$connection = Connection::getInstance();
$gateway = new BusinessTableGateway($connection);

$statement = $gateway->getBusinesses();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="js/business.js"></script>
        <?php require "styles.php" ?>
        <title></title>
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <?php require 'header.php' ?>
        <?php require 'mainMenu.php' ?>
        <div class="container">
            <h2>View Businesses</h2>
            <?php
            if (isset($message)) {
                echo '<p>' . $message . '</p>';
            }
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Staff Number</th>
                        <th>Skills</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $row = $statement->fetch(PDO::FETCH_ASSOC);
                    while ($row) {


                        echo '<td>' . $row['business_name'] . '</td>';
                        echo '<td>' . $row['business_address'] . '</td>';
                        echo '<td>' . $row['business_lat'] . '</td>';
                        echo '<td>' . $row['business_long'] . '</td>';
                        echo '<td>' . $row['business_type'] . '</td>';
                        echo '<td>'
                        . '<a href="viewBusiness.php?id=' . $row['id'] . '">View</a> '
                        . '<a href="editBusinessForm.php?id=' . $row['id'] . '">Edit</a> '
                        . '<a class="deleteBusiness" href="deleteBusiness.php?id=' . $row['id'] . '">Delete</a> '
                        . '</td>';
                        echo '</tr>';

                        $row = $statement->fetch(PDO::FETCH_ASSOC);
                    }
                    ?>
                </tbody>
            </table>
            <p><a href="createBusinessForm.php">Create Business</a></p>
        </div>
        <?php require 'footer.php'; ?>
        <?php require 'scripts.php'; ?>
    </body>
</html>
