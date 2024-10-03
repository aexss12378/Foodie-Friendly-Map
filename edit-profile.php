<?php

    session_start();
    require 'includes/dbh.inc.php';
    
    define('TITLE',"Edit Profile | KLiK");
    
    if(!isset($_SESSION['userId']))
    {
        header("Location: login.php");
        exit();
    }
    
    include 'includes/HTML-head.php';  
?> 


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
              
              <img class="cover-img" id='blah-cover' src="img/back.png">
              
              <form action="includes/profileUpdate.inc.php" method='post' enctype="multipart/form-data"
                    style="padding: 0 30px 0 30px;">
                    
              
                    <label class="btn btn-primary">
                        更換頭像<input type="file" id="imgInp" name='dp' hidden>
                    </label>
                    <img class="profile-img" id="blah"  src="#"> 
                    
                    
                    <?php  
                          if ($_SESSION['userLevel'] === 1)
                          {
                              echo '<img id="admin-badge" src="img/admin-badge.png">';
                          }
                    ?>

                    <h2><?php echo strtoupper($_SESSION['userUid']); ?></h2>
                    <br>
                  
                    <div class="form-row">
                      <div class="col">
                      <label for="exampleInputname">你的名字</label>
                        <input type="text" class="form-control" name="name" placeholder=" Name"
                               value="<?php echo $_SESSION['name'] ?>" >
                        <small id="emailHelp" class="form-text text-muted">Your Name</small>
                      </div>
                      <br>
                      <br>
                  
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="email" placeholder="email" 
                               value="<?php echo $_SESSION['emailUsers'] ?>" >
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                  
                    <div class="form-group">
                
                                <label >性別</label><br>
                                <input id="toggle-on" class="toggle toggle-left" name="gender" value="m" type="radio" 
                                    <?php 
                                        if ($_SESSION['gender'] == 'm'){ ?> 
                                            checked="checked"
                                    <?php } ?>>
                                <label for="toggle-on" class="btn-r">男</label>
                                <input id="toggle-off" class="toggle toggle-right" name="gender" value="f" type="radio"
                                    <?php if ($_SESSION['gender'] == 'f'){ ?> 
                                            checked="checked"
                                    <?php } ?>>
                                <label for="toggle-off" class="btn-r">女</label>
                    </div>
                  
                  <hr>
                  
                    <div class="form-group">
                        <label for="headline">個人簡介</label>
                        <input class="form-control" type="text" id="headline" name="headline" 
                               placeholder="介紹一下你自己 最多100字" value='<?php echo $_SESSION['headline']; ?>'><br>
                        
                        <label for="edit-bio">喜歡的食物類別</label>
                        <textarea class="form-control" id="edit-bio" rows="5" name="bio" maxlength="5000" 
                         readonly placeholder="點擊下方的按鈕添加" ><?php echo $_SESSION['bio']; ?></textarea>
                        
                        <?php
                            $sql = "select cat_id, cat_name from categories;";
                            $stmt = mysqli_stmt_init($conn);    

                            if (!mysqli_stmt_prepare($stmt, $sql))
                            {
                                die('sql error');
                            }
                            else
                            {
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);

                                if (mysqli_num_rows($result) == 0)
                                {
                                    echo "<h5 class='text-center text-muted'>You cannot create a topic before the admin creates "
                                    . "some categories</h5>";
                                }
                                else
                                {
                        ?>
                                
                                <?php 
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    echo '<input type="checkbox" class="likeFood" id='.$row['cat_id'].' value='. $row['cat_name'].'>' . $row['cat_name'] . '&emsp;</input>';
                                }
                                ?>
                                <br><br>             
                    <?php
                                }
                            }
                    ?>
                    </div>
                  
                  <hr>
                  
                  
                            
                  <br><input type="submit" class="btn btn-primary btn-small" name="update-profile" value="Update Profile">
                  
              </form>
              
              
          </div>
          <div class="col-sm-1">
            
          </div>
        </div>


      </div> <!-- /container -->

	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
  
  <script>
  </script> 


                            <script>
                                var dp = '<?php echo $_SESSION["userImg"]; ?>';
                                
                                $('#blah').attr('src', 'uploads/'+ dp);
                                
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

                                  $('.likeFood').click(function() {
                                    var likeFood = document.getElementById("edit-bio");
                                    var strLikeFood = likeFood.value;
                                    if (this.checked) {
                                      if (strLikeFood.indexOf(this.value) < 0) likeFood.value += this.value+" ";
                                    } 
                                    else {
                                      if (strLikeFood.indexOf(this.value) >= 0) strLikeFood = strLikeFood.replace(this.value+" ", "")
                                      likeFood.value = strLikeFood;
                                    }
                                  }); 
                                  
                            </script>
        
    </body>
</html>