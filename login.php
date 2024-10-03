<?php

    session_start();
    define('TITLE',"Log In"); 
    
    function strip_bad_chars( $input ){
        $output = preg_replace( "/[^a-zA-Z0-9_-]/", "", $input);
        return $output;
    }
    
    if(isset($_SESSION['userId']))
    {
        header("Location: index.php");
        exit();
    }
    
    include 'includes/HTML-head.php';
?>  
    </head>
    
    <body>


    <section id="cover">
        <div id="cover-caption">
            <div class="container">
                <div class="col-sm-10 offset-sm-1">
                    <img src='img/pizza (1).png'><br><br><br><br>
                    <h1 class="text-white">登入以繼續</h1>
                    <br>
                    <?php
                    
                        if(isset($_GET['error']))
                        {
                            if($_GET['error'] == 'emptyfields')
                            {
                                echo '<div class="alert alert-danger" role="alert">
                                        <strong>Error: </strong>仍有空格沒有填上
                                      </div>';
                            }
                            else if($_GET['error'] == 'nouser')
                            {
                                echo '<div class="alert alert-danger" role="alert">
                                        <strong>Error: </strong>沒有這個使用者
                                      </div>';
                            }
                            else if ($_GET['error'] == 'wrongpwd')
                            {;
                                echo '<div class="alert alert-danger" role<"alert">
                                        <strong>Error: </strong> 密碼錯誤，請重新輸入密碼
                                      </div>';
                            }
                            else if ($_GET['error'] == 'sqlerror')
                            {
                                echo '<div class="alert alert-danger" role="alert">
                                        <strong>Error: </strong>Website error. Contact admin to have it fixed
                                      </div>';
                            }
                            
                        }
                        else if(isset($_GET['newpwd']))
                        {
                            if($_GET['newpwd'] == 'passwordupdated')
                            {
                                echo '<div class="alert alert-success" role="alert">
                                        <strong>Password Updated </strong>Login with your new password
                                      </div>';
                            }
                        }
                    ?>
                    <form method="post" action="includes/login.inc.php" class="form-inline justify-content-center">

                        <div class="form-group">
                            <label class="sr-only">使用者名字</label>
                            <input type="text" id="name" name="mailuid"
                                   class="form-control form-control-lg mr-1" placeholder="Username">
                        </div>

                        <div class="form-group">
                            <label class="sr-only">密碼</label>
                            <input type="password" id="password" name="pwd"
                                   class="form-control form-control-lg mr-1" placeholder="Password">
                        </div>
                        <br>
                        <input type="submit" class="btn btn-dark btn-lg mr-1" name="login-submit" value="Log in ">
                    </form>    
                    
                    <br>

                    <a href="signup.php" class="btn btn-light btn-lg mr-1">Signup</a>
                    
                    <br><br>

                </div>
            </div>
        </div>
    </section>

        
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js" ></script>
    
    </body>
</html>