<?php
session_start();
include_once 'includes/dbh.inc.php';

define('TITLE', "Create Forum | KLiK");

include 'includes/HTML-head.php';
?>

<link rel="stylesheet" type="text/css" href="css/comp-creation.css">
</head>

<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="bg-contact2" style="background-image: url('img/banner.png');">
        <div class="container-contact2">
            <div class="wrap-contact2">
                <form class="contact2-form" method="post" action="includes/create-topic.inc.php"
                    enctype="multipart/form-data">
                    <span class="contact2-form-title">發佈討論串</span>

                    <span class="text-center">
                        <?php
if (isset($_GET['error'])) {
    if ($_GET['error'] == 'emptyfields') {
        echo '<h5 class="text-danger">*Fill In All The Fields</h5>';
    } else if ($_GET['error'] == 'sqlerror') {
        echo '<h5 class="text-danger">*Website Error: Contact admin to have the issue fixed</h5>';
    } else if ($_GET['error'] == 'filetoolarge') {
        echo '<h5 class="text-danger">*The file is too large. Maximum file size is 5MB.</h5>';
    } else if ($_GET['error'] == 'fileuploaderror') {
        echo '<h5 class="text-danger">*An error occurred while uploading the file. Please try again.</h5>';
    } else if ($_GET['error'] == 'invalidfiletype') {
        echo '<h5 class="text-danger">*Invalid file type. Allowed file types are JPG, JPEG, and PNG.</h5>';
    }
} else if (isset($_GET['operation']) && $_GET['operation'] == 'success') {
    echo '<h5 class="text-success">*Forum successfully created</h5>';
}
?>
                    </span>

                    <?php
$sql = "SELECT cat_id, cat_name FROM categories;";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    die('sql error');
} else {
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 0) {
        echo "<h5 class='text-center text-muted'>You cannot create a topic before the admin creates "
            . "some categories</h5>";
    } else {
        ?>

                    <div class="wrap-input2 validate-input" data-validate="Name is required">
                        <input class="input2" type="text" name="topic-subject">
                        <span class="focus-input2" data-placeholder="想要分享的資訊？"></span>
                    </div>

                    <label>種類</label>
                    <select class="form-control" name="topic-cat">

                        <?php
while ($row = mysqli_fetch_assoc($result)) {
    echo "<option value=\"" . $row['cat_id'] . "\">" . $row['cat_name'] . "</option>";
}
?>

                    </select><br><br>

                    <?php
$sql = "SELECT res_id, res_name FROM restaurants;";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    die('sql error');
} else {
    mysqli_stmt_execute($stmt);
    $result1 = mysqli_stmt_get_result($stmt);
}
?>

                    <label>餐廳</label>
                    <select class="form-control" name="res-name">

                        <?php
while ($row = mysqli_fetch_assoc($result1)) {
    echo "<option value=\"" . $row['res_id'] . "\">" . $row['res_name'] . "</option>";
}
?>

                    </select><br><br>

                    <div class="wrap-input2 validate-input" data-validate="Description is required">
                        <textarea class="input2" name="post-content"></textarea>
                        <span class="focus-input2" data-placeholder="在這裡寫上你的文章"></span>
                    </div>

                    <div class="wrap-input2 validate-input" data-validate="Please choose an image">
                        <input type="file" name="topic_image" id="topic-image-input">
                        <div id="topic-image-preview-container">
                            <img id="topic-image-preview" src="#" alt="預覽圖片" style="width: 200px; height: 200px;">
                        </div>
                    </div>

                    <div class="container-contact2-form-btn">
                        <div class="wrap-contact2-form-btn">
                            <div class="contact2-form-bgbtn"></div>
                            <button class="contact2-form-btn" type="submit" name="create-topic">發布</button>
                        </div>
                    </div>
                    <?php
}
}
?>
                </form>
            </div>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        // 預覽圖片
        function previewTopicImage(event) {
            var reader = new FileReader();
            reader.onload = function () {
                var preview = document.getElementById('topic-image-preview');
                preview.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        // 監聽檔案選擇事件
        var topicImageInput = document.getElementById('topic-image-input');
        topicImageInput.addEventListener('change', previewTopicImage);
    </script>
    <script src="js/creation-main.js"></script>
</body>

</html>
