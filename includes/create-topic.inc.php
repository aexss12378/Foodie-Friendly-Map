<?php
session_start();
if (isset($_POST['create-topic'])) {
    require 'dbh.inc.php';

    $resName = $_POST['res-name'];
    $topicSubject = $_POST['topic-subject'];
    $topicCategory = $_POST['topic-cat'];
    $postContent = $_POST['post-content'];

    if (empty($topicSubject) || empty($postContent)) {
        header("Location: ../create-topic.php?error=emptyfields");
        exit();
    } else {
        $sql = "INSERT INTO topics (topic_subject, topic_date, topic_cat, topic_by, topic_res) VALUES (?, NOW(), ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../create-topic.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "sssi", $topicSubject, $topicCategory, $_SESSION['userId'],$resName);
            mysqli_stmt_execute($stmt);
            $topicId = mysqli_insert_id($conn);
            mysqli_stmt_close($stmt);

            $sql = "INSERT INTO posts (post_content, post_date, post_topic, post_by) VALUES (?, NOW(), ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../create-topic.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "sss", $postContent, $topicId, $_SESSION['userId']);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                if (!empty($_FILES['topic_image']['name'])) {
                    $file = $_FILES['topic_image'];
                    $fileName = $file['name'];
                    $fileTmpName = $file['tmp_name'];
                    $fileSize = $file['size'];
                    $fileError = $file['error'];
                    $fileType = $file['type'];

                    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                    $allowedExtensions = array('jpg', 'jpeg', 'png');

                    if (in_array($fileExt, $allowedExtensions)) {
                        if ($fileError === 0) {
                            if ($fileSize < 5242880) { // 最大檔案大小為 5MB (5242880 bytes)
                                $fileNameNew = uniqid('', true) . '.' . $fileExt;
                                $fileDestination = '../uploads/' . $fileNameNew;
                                move_uploaded_file($fileTmpName, $fileDestination);

                                // 將圖片連結存儲到 SQL 資料庫
                                $sql = "UPDATE topics SET topic_img = ? WHERE topic_id = ?";
                                $stmt = mysqli_stmt_init($conn);
                                if (mysqli_stmt_prepare($stmt, $sql)) {
                                    mysqli_stmt_bind_param($stmt, "si", $fileDestination, $topicId);
                                    mysqli_stmt_execute($stmt);
                                    mysqli_stmt_close($stmt);
                                }
                            } else {
                                header("Location: ../create-topic.php?error=filetoolarge");
                                exit();
                            }
                        } else {
                            header("Location: ../create-topic.php?error=fileuploaderror");
                            exit();
                        }
                    } else {
                        header("Location: ../create-topic.php?error=invalidfiletype");
                        exit();
                    }
                }

                header("Location: ../index.php?operation=success");
                exit();
            }
        }
    }

    mysqli_close($conn);
} else {
    header("Location: ../index.php");
    exit();
}