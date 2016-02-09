<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>My Website</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet">
        <script src="js/respond.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div class="row"> 
            <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
                <div class="container">
                    <div class="navbar-brand">
                        <p><img src="img/newlogo.png" alt="" class="img-responsive"></p>
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
                            <li><a href="#">Home</a></li>                    
                            <li><a href="#">Services</a></li> 
                            <li><a href="#">Book</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a class="btn btn-register btn-large" href="register.php">Register</a></li>
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
                <table class="table table-bordered">
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
        <div class="footerGroup navbar-fixed-bottom">
            <div class = "row">
                <div class="row3">
                    <div class = "bottom col-md-3 col-xs-6">
                        <ul class="footer navbar-nav">
                            <h3>FIND US HERE</h3>
                            <li><img src="img/fbicon.png" alt="" class="img-responsive"></li>                    
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
                        <p>ranelaghmedcentre@gmail.com</p>
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
                    <p>© Ranelagh Medical Centre. All rights reserved.</p>
                </div>
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
