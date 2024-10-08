<?php

    session_start();
    require 'includes/dbh.inc.php';
    
    define('TITLE',"Profile | KLiK");
    
    if(!isset($_SESSION['userId']))
    {
        header("Location: login.php");
        exit();
    }
    
    if(isset($_GET['id']))
    {
        $userid = $_GET['id'];
    }
    else
    {
        $userid = $_SESSION['userId'];
    }
    
    $sql = "select * from users where idUsers = ".$userid;
    $stmt = mysqli_stmt_init($conn);    
    
    if (!mysqli_stmt_prepare($stmt, $sql))
    {
        die('SQL error');
    }
    else
    {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);
    }
    
    include 'includes/HTML-head.php';   
?> 
<link href="css/list-page.css" rel="stylesheet">
<link href="css/list-page.css" rel="stylesheet" type="text/css">
<link href="css/loader.css" rel="stylesheet">
</head>

<body>

    <?php include 'includes/navbar.php'; ?>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-3">
            
                <?php include 'includes/profile-card.php'; ?>
              
            </div>
            
            
            <div class="col-sm-7 text-center" id="user-section">
                <img class="cover-img" src="img/back.png">
                <img class="profile-img" src="uploads/<?php echo $user['userImg']; ?>">
              
                <?php  
                    if ($user['userLevel'] === 1)
                    {
                        echo '<img id="admin-badge" src="img/admin-badge.png">';
                    }
                ?>
              
                <h2><?php echo ucwords($user['uidUsers']); ?></h2>
                <h6><?php echo ucwords($user['name']) ; ?></h6>
                <h6><?php echo '<small class="text-muted">'.$user['emailUsers'].'</small>'; ?></h6>
              
                <?php 
                if ($user['gender'] == 'm')
                {
                    echo '<i class="fa fa-male fa-2x" aria-hidden="true" style="color: #709fea;"></i>';
                }
                else if ($user['gender'] == 'f')
                {
                    echo '<i class="fa fa-female fa-2x" aria-hidden="true" style="color: #FFA6F5;"></i>';
                }
                ?>
              
                <br><small><?php echo $user['headline']; ?></small>
                <br><br>
                <hr>
                <h3>喜歡的食物種類</h3>
                <div class="profile-bio">
                    <medium><?php echo $user['bio'];?></medium>
                </div>
              

                <br><br>
                <hr>
                <h3>貼文集</h3>
                <br><br>
              
                <?php
                    $sql = "select * from topics where topic_by = ?";
                    $stmt = mysqli_stmt_init($conn);    

                    if (!mysqli_stmt_prepare($stmt, $sql))
                    {
                        die('SQL error');
                    }
                    else
                    {
                        mysqli_stmt_bind_param($stmt, "s", $userid);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        
                        echo '<div class="container">'
                                    .'<div class="row">';
                        
                        $row = mysqli_fetch_assoc($result);
                        if(empty($row))
                        {
                            echo '<div class="col-sm-4" style="padding-bottom: 30px;"></div>
                                <div class="col-sm-4">
                                    <img class="profile-empty-img" src="img/empty.png">
                                  </div>
                                  <div class="col-sm-4" style="padding-bottom: 30px;"></div>
                                    </div>
                                  </div>';
                        }
                        else
                        {
                            do
                            {
                                echo '<div class="col-sm-4" style="padding-bottom: 30px;">
                                        <div class="card user-blogs">
                                            <a href="posts.php?topic='.$row['topic_id'].'">
                                            <img class="card-img-top" src="img/food.jpeg" alt="Card image cap">
                                            <div class="card-block p-2">
                                              <p class="card-title">'.ucwords($row['topic_subject']).'</p>
                                             <p class="card-text"><small class="text-muted">'
                                             .date("F jS, Y", strtotime($row['topic_date'])).'</small></p>
                                            </div>
                                            </a>
                                          </div>
                                          </div>';
                            }while ($row = mysqli_fetch_assoc($result));
                            echo '</div>'
                                    .'</div>';
                        }
                    }
                ?>

                <br><br>

            </div>
            
            </div>
        </div>


    </div> <!-- /container -->
    <script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
                </html>