<?php

session_start();

// if (isset($_GET['id']) && isset($_SESSION['userId']))
if (isset($_GET['topic'])  && ($_GET['by'] == $_SESSION['userId']) && isset($_SESSION['userId']))
{
    
    require 'dbh.inc.php';
    
    // $topic = $_GET['id'];
    // $post = $_GET['post'];
    $topic = $_GET['topic'];
    
    if(isset($_GET['page']))
    {
        $page = $_GET['page'];
    }
    else
    {
        $page = 'forum';
    }
    
    $sql = "delete from topics where topic_id = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql))
    {
        header("Location: ../".$page.".php?error=sqlerror");
        exit();
    }
    else
    {
        mysqli_stmt_bind_param($stmt, "s", $topic);
        mysqli_stmt_execute($stmt);
        // header("Location: ../".$page.".php");
        header("Location: ../index.php");

        exit();
    }
    
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    
}
else
{
    // header("Location: ../".$page.".php");
    header("Location: ../index.php");

    exit();
}