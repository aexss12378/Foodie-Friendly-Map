<?php

session_start();
require 'includes/dbh.inc.php';

define('TITLE', "Forum | KLiK");

if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['topic'])) {
    $topic = $_GET['topic'];
} else {
    header("Location: index.php");
    exit();
}

include 'includes/HTML-head.php';
?>

<link href="css/forum-styles.css" rel="stylesheet">
</head>

<body>

<?php
include 'includes/navbar.php';

if (isset($_POST['submit-reply'])) {
    $content = $_POST['reply-content'];

    if (!empty($content)) {
        $sql = "INSERT INTO posts (post_content, post_date, post_topic, post_by) "
            . "VALUES (?, NOW(), ?, ?)";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            die('SQL error');
        } else {
            mysqli_stmt_bind_param($stmt, "sss", $content, $topic, $_SESSION['userId']);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
        }
    }
}

$sql = "SELECT topics.*, categories.*, restaurants.*, topics.topic_img AS topic_image 
        FROM topics 
        INNER JOIN categories ON topics.topic_cat = categories.cat_id
        INNER JOIN restaurants ON topics.topic_res = restaurants.res_id  
        WHERE topics.topic_id = ?";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    die('SQL error');
} else {
    mysqli_stmt_bind_param($stmt, "s", $topic);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (!($forum = mysqli_fetch_assoc($result))) {
        die('SQL error');
    }
}

?>

<br><br>
<div class="container">
    <div class="col-sm-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Forums</a></li>
                <li class="breadcrumb-item"><a href="#"><?php echo ucwords($forum['cat_name']); ?></a></li>
                <li class="breadcrumb-item"><a href="#"><?php echo ucwords($forum['res_name']); ?></a></li>
            </ol>
        </nav>
        <div class="card post-header text-center">
            <h1><?php echo ucwords($forum['topic_subject']); ?></h1>
            <?php
            if (!empty($forum['topic_img'])) {
                echo '<img src="' . $forum['topic_img'] . '" alt="Topic Image"style="width: 500px; height: 300px; margin: 0 auto;">';
                
            }
            if (($forum['topic_by'] == $_SESSION['userId'])) {
                echo '<a href="includes/delete-forum.php?topic=' . $topic . '&by=' . $forum['topic_by'] . '">'
                    . '<i class="fa fa-trash fa-2x" aria-hidden="true"></i></a><br>';
                }       
            ?>
        </div>
    </div>
    <div class="col-sm-12">

        <?php
        // First, get all votes for this user in this topic to avoid N+1 queries
        $user_votes = array();
        $sql_votes = "SELECT pv.votePost, pv.vote FROM postvotes pv "
            . "INNER JOIN posts p ON pv.votePost = p.post_id "
            . "WHERE p.post_topic=? AND pv.voteBy=?";
        $stmt_votes = mysqli_stmt_init($conn);
        
        if (!mysqli_stmt_prepare($stmt_votes, $sql_votes)) {
            // If vote query fails, log the error and show a user-friendly message
            error_log('SQL error preparing vote data statement: ' . mysqli_error($conn));
            echo '<div class="alert alert-danger" role="alert">Sorry, we are unable to load vote information right now. Please try again later.</div>';
            exit();
        } else {
            mysqli_stmt_bind_param($stmt_votes, "ss", $topic, $_SESSION['userId']);
            if (!mysqli_stmt_execute($stmt_votes)) {
                // Execution of the vote query failed
                error_log('SQL error executing vote data statement: ' . mysqli_error($conn));
                echo '<div class="alert alert-danger" role="alert">Sorry, we are unable to load vote information right now. Please try again later.</div>';
                exit();
            }
            $votes_result = mysqli_stmt_get_result($stmt_votes);
            if ($votes_result === false) {
                // Fetching vote query results failed
                error_log('SQL error fetching vote data result set: ' . mysqli_error($conn));
                echo '<div class="alert alert-danger" role="alert">Sorry, we are unable to load vote information right now. Please try again later.</div>';
                exit();
            }
            
            while ($vote_row = mysqli_fetch_assoc($votes_result)) {
                $user_votes[$vote_row['votePost']] = $vote_row['vote'];
            }
        }
        
        $sql = "SELECT * FROM posts p, users u "
            . "WHERE p.post_topic=? AND p.post_by=u.idUsers "
            . "ORDER BY p.post_id";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            die('SQL error');
        } else {
            mysqli_stmt_bind_param($stmt, "s", $topic);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            

            $i = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                $voted_u = false;
                $voted_d = false;

                // Check if user has voted on this post using the pre-fetched data
                if (!isset($user_votes[$row['post_id']])) {
                    // User hasn't voted on this post
                    $voted_u = true;
                    $voted_d = true;
                } else if ($user_votes[$row['post_id']] == 1) {
                    // User has upvoted
                    $voted_d = true;
                } else if ($user_votes[$row['post_id']] == -1) {
                    // User has downvoted
                    $voted_u = true;
                }

                echo '<div class="card post">  
                        <span class="date">' . date("F jS, Y", strtotime($row['post_date'])) . '<span class="span-post-no">#' . $i . '</span> </span>
                        <div class="row">
                            <div class="col-sm-3 user">
                                <div class="text-center">
                                <img src="uploads/'.$row['userImg'].'" class="img-fluid center-block user-img">
                                
                                    <h3>' . $row['uidUsers'] . '</h3>
                                    <small class="text-muted">' . $row['headline'] . '</small><br><br>
                                    <table style="width:100%">
                                        <tr>
                                            <th>Joined:</th>
                                            <td>Sep 27, 2021</td>
                                        </tr>                        
                                    </table>
                                    <a href="profile.php?id=' . $row['idUsers'] . '">
                                        <i class="fa fa-user fa-2x" aria-hidden="true"></i></a>                      
                                </div>
                            </div>
                            <div class="col-sm-9 post-content">
                                <p>' . $row['post_content'] . '</p>
                                <div class="vote text-center">';
                if (($row['post_by'] == $_SESSION['userId'])) {
                    echo '<a href="includes/delete-post.php?topic=' . $topic . '&post=' . $row['post_id'] . '&by=' . $row['post_by'] . '">'
                        . '<i class="fa fa-trash fa-2x" aria-hidden="true"></i></a><br>';
                    }
                        
                    if ($voted_u)
                    {
                        echo "<a href='includes/post-vote.inc.php?topic=".$topic."&post=".$row['post_id']."&vote=1' >";
                    }
                    // echo '<i class="fa fa-chevron-up fa-3x" aria-hidden="true"></i></a>';
                    echo '<i class="fa fa-thumbs-up fa-3x" aria-hidden="true"></i></a>';


                    
                    echo '<br><span class="vote-count">'.$row['post_votes'].'</span><br>';
                    
                    
                    if ($voted_d)
                    {
                        echo "<a href='includes/post-vote.inc.php?topic=".$topic."&post=".$row['post_id']."&vote=-1' >";
                    }
                    // echo '<i class="fa fa-chevron-down fa-3x" aria-hidden="true"></i></a>';
                    echo '<i class="fa fa-thumbs-down fa-3x" aria-hidden="true"></i></a>';




                echo '</div>
                            </div>
                        </div>
                    </div>';

                $i++;
            }
        }
        ?>

    </div>

    <div class="col-sm-12">
        <form method="post" action="">
            <fieldset>
                <div class="form-group">
                    <textarea name="reply-content" class="form-control" id="reply-form" rows="7"></textarea>
                </div>
                <input type="submit" value="Submit reply" class="btn btn-lg btn-dark" name="submit-reply">
            </fieldset>
        </form>
    </div>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>

</html>
