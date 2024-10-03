<?php

    session_start();
    require 'includes/dbh.inc.php';
    
    define('TITLE',"Find People | KLiK");
    
    if(!isset($_SESSION['userId']))
    {
        header("Location: login.php");
        exit();
    }
    
    include 'includes/HTML-head.php';
?>  


	<link rel="stylesheet" type="text/css" href="css/list-page.css">
    </head>
    
    <body style="background: #f1f1f1">

    
        <?php include 'includes/navbar.php'; ?>
        
        <main role="main" class="container">
            <div class="mx-5">
                <div class="d-flex align-items-center p-3 my-3 mx-5 text-white-50 bg-purple rounded shadow-sm">
                    <img class="mr-3" src="img/200.png" alt="" width="48" height="48">
                  <div class="lh-100">
                    <h1 class="mb-0 text-white lh-100">使用者名單</h1>
                    <small>尋找已註冊的使用者，可以查看他們的貼文</small>
                  </div>
                </div>

                <div class="my-3 mx-5 p-3 bg-white rounded shadow-sm">
                  <h5 class="border-bottom border-gray pb-2 mb-0">推薦的帳號</h5>


                  <?php

                      $sql = "select idUsers, uidUsers, userLevel, name, emailUsers, userImg
                              from users
                              order by userLevel desc, idUsers asc";

                      $stmt = mysqli_stmt_init($conn);    

                      if (!mysqli_stmt_prepare($stmt, $sql))
                      {
                          die('SQL error');
                      }
                      else
                      {
                          mysqli_stmt_execute($stmt);
                          $result = mysqli_stmt_get_result($stmt);

                          while ($row = mysqli_fetch_assoc($result))
                          {

                              echo '<a href="profile.php?id='.$row['idUsers'].'">
                                  <div class="media text-muted pt-3">
                                      <img src="uploads/'.$row['userImg'].'" alt="" class="mr-2 rounded-circle div-img list-user-img">
                                      <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray ">
                                        <strong class="d-block text-gray-dark">'.ucwords($row['uidUsers']).'</strong></a>
                                            <span class="text-primary">'.ucwords($row['name']).'</span><br>
                                            '.$row['emailUsers'].'
                                      </p>                                
                                  </div>';
                          }
                     }
                  ?>

                      <small class="d-block text-right mt-3">
                          <a href="profile.php" class="btn btn-primary">前往個人資訊</a>
                      </small>


                </div>
            </div>
        </main>

        
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    </body>
</html>