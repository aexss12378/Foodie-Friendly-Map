<?php

    session_start();
    define('TITLE',"Sign Up");
    
    if(isset($_SESSION['userId']))
    {
        header("Location: index.php");
        exit();
    }
    include 'includes/HTML-head.php';
?>  
    </head>
    
    <body>

        
        <div id="signup">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 offset-sm-1 ?version=1">
                        
                        <div class="signup-left position-fixed text-center">
                            
                            <img src="img/pizza (1).png">
                            <br><br><br>

                            <?php
                            
                                if(isset($_GET['error']))
                                {
                                    if($_GET['error'] == 'emptyfields')
                                    {
                                        echo '<div class="alert alert-danger" role="alert">
                                                <strong>Error: </strong> Fill In All The Fields
                                              </div>';
                                    }
                                    else if ($_GET['error'] == 'invalidmailuid')
                                    {
                                        echo '<div class="alert alert-danger" role="alert">
                                                <strong>Error: </strong> Please enter a valid email and user name
                                              </div>';
                                    }
                                    else if ($_GET['error'] == 'invalidmail')
                                    {
                                        echo '<div class="alert alert-danger" role="alert">
                                                <strong>Error: </strong> Please enter a valid email
                                              </div>';
                                    }
                                    else if ($_GET['error'] == 'invaliduid')
                                    {
                                        echo '<div class="alert alert-danger" role="alert">
                                                <strong>Error: </strong> Please enter a valid user name
                                              </div>';
                                    }
                                    else if ($_GET['error'] == 'passwordcheck')
                                    {
                                        echo '<div class="alert alert-danger" role="alert">
                                                <strong>Error: </strong> Passwords donot match
                                              </div>';
                                    }
                                    else if ($_GET['error'] == 'usertaken')
                                    {
                                        echo '<div class="alert alert-danger" role="alert">
                                                <strong>Error: </strong> This User name is already taken
                                              </div>';
                                    }
                                    else if ($_GET['error'] == 'invalidimagetype')
                                    {
                                        echo '<div class="alert alert-danger" role="alert">
                                                <strong>Error: </strong> Invalid image type 
                                              </div>';
                                    }
                                    else if ($_GET['error'] == 'imguploaderror')
                                    {
                                        echo '<div class="alert alert-danger" role="alert">
                                                <strong>Error: </strong> Image upload error, please try again
                                              </div>';
                                    }
                                    else if ($_GET['error'] == 'imgsizeexceeded')
                                    {
                                        echo '<div class="alert alert-danger" role="alert">
                                                <strong>Error: </strong> Image too large
                                              </div>';
                                    }
                                    else if ($_GET['error'] == 'sqlerror')
                                    {
                                        echo '<div class="alert alert-danger" role="alert">
                                                <strong>Website Error: </strong> Contact admin to have the issue fixed
                                              </div>';
                                    }
                                }
                                else if (isset($_GET['signup']) == 'success')
                                {
                                    echo '<div class="alert alert-success" role="alert">
                                            <strong>Signup Successful</strong> Please Login from the login menu
                                          </div>';
                                }
                            ?>
                            <form id="signup-form" action="includes/signup.inc.php" method='post' enctype="multipart/form-data">
                        
                            <input type="submit" class="btn btn-light btn-lg" name="signup-submit" value="Signup">
                                
                            <br><br>
                                
                            <a  href="login.php">
                                <i class="fa fa-sign-in fa-2x social-icon" aria-hidden="true"></i>
                            </a> 
                            
                        </div> 
                    </div>
                    
                    <div class="col-sm-6 offset-sm-6 text-center">
                        
                        <h1 class="mt-4 text-muted">請填上資料</h1>
                        <h3 class="mt-1 text-muted">登入資料與個人資料必填</h3>
                        <br>
                        
                        <div class="form-row border-top my-3">
                            <div class="form-group col-md-12">
                                <h2>登入資料</h2>
                            </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="name">帳號名(可以是綽號...etc)</label>
                            <input type="text" class="form-control" id="name" name="uid" placeholder="Username" maxlength="25">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="email">電子郵件</label>
                            <input type="email" class="form-control" id="email" name="mail" placeholder="Email">
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="pwd">密碼</label>
                            <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="pwd-repeat">再次確認密碼</label>
                            <input type="password" class="form-control" id="pwd-repeat" name="pwd-repeat" 
                                   placeholder="Repeat Password">
                          </div>
                        </div>
                        <div class="form-row border-top my-3">
                            <div class="form-group col-md-12">
                                <h2>個人資料</h2>
                            </div>
                        </div>
                        <div class="form-row ">
                          <div class="form-group col-md-12">
                            <label for="name">全名</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="name" maxlength="100">
                          </div>
                          
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 align-self-center">
                                <label >性別</label><br>
                                <input id="toggle-on" class="toggle toggle-left" name="gender" value="m" type="radio" checked>
                                <label for="toggle-on" class="btn-r">男</label>
                                <input id="toggle-off" class="toggle toggle-right" name="gender" value="f" type="radio">
                                <label for="toggle-off" class="btn-r">女</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 align-self-center">
                                <img id="blah" class="rounded" src="#" alt="your image" class="img-responsive rounded"
                                     style="height: 200px; width: 190px; object-fit: cover;">
                                <br><br><label class="btn btn-primary ">
                                    選擇照片以設定頭像(可以之後再設定)<input type="file" id="imgInp" name='dp' hidden>
                              </label>
                            </div>
                        </div>
                        <div class="form-row border-top my-3">
                            <div class="form-group col-md-12">
                                <h2>自我介紹</h2>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="headline">個人簡介</label>
                            <input type="text" class="form-control" id="headline" name="headline" 
                                placeholder="介紹一下你自己 最多100字" maxlength="100">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="bio">喜歡的食物類別</label>
                            <textarea class="form-control" id="bio" name="bio" rows="6" maxlength="1000" 
                                placeholder="請在創建帳號後，在修改個人資料的地方編輯"></textarea>
                          </div>
                    </form>
                </div>
                    
                </div>
                
            </div>
        </div>
                           
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js" ></script>
        
        <script>
            $('#blah').attr('src', 'uploads/default.png');
            function readURL(input) {

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#blah').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                    }
            }

            $("#imgInp").change(function() {
                readURL(this);
            });
                                  
                                  
        </script>
        
    </body>
</html>