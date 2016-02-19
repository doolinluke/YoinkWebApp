<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Yoink!</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="CSS/bootstrap.min.css" rel="stylesheet">
        <link href="CSS/custom.css" rel="stylesheet">
        <script src="Javascript/respond.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>
    </head>
    <body>
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
                            <li class=""><?php require 'toolbar.php' ?></li>
                        </ul> 
                    </div>
                </div>
            </nav> 
        </div>
        <div class="row">
            <div class="container">
                <div class ="logIn">
                    <h1>Please Login</h1>
                </div>
            </div>
        </div>
        <?php
        if (!isset($username)) {
            $username = 'jim';
            $password = 'jim';
        }
        ?>
        <div class="container">            
            <form action="checkLogin.php" method="POST">
                <table class="table col-md-3 table-bordered">
                    <div class="container">
                        <tbody>
                            <tr>
                                <td>Username</td>
                                <td>
                                    <input type="text"
                                           name="username"
                                           value="<?php echo $username; ?>" />
                                    <span id="usernameError" class="error">
                                        <?php
                                        if (isset($errorMessage) && isset($errorMessage['username'])) {
                                            echo $errorMessage['username'];
                                        }
                                        ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td>
                                    <input type="password" name="password" value="<?php echo $password; ?>" />
                                    <span id="passwordError" class="error">
                                        <?php
                                        if (isset($errorMessage) && isset($errorMessage['password'])) {
                                            echo $errorMessage['password'];
                                        }
                                        ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" value="Login" name="login" />
                                    <input type="button"
                                           value="Register"
                                           name="register"
                                           onclick="document.location.href = 'register.php'"
                                           />
                                    <input type="button" value="Forgot Password" name="forgot" />
                                </td>
                            </tr>
                        </tbody>
                    </div>
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
