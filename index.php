<?php

    session_start();
    include_once 'includes/dbh.inc.php';
    define('TITLE',"美食/交友");

    $companyName = "Franklin's Fine Dining";
    
    function strip_bad_chars( $input ){
        $output = preg_replace( "/[^a-zA-Z0-9_-]/", "", $input);
        return $output;
    }
    
    if(!isset($_SESSION['userId']))
    {
        header("Location: login.php");
        exit();
    }
    
    include 'includes/HTML-head.php';
?> 
<style>
        .point {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: red;
            border-radius: 50%;
        }
        #point1 {
            top: 290px;
            left: 115px;
        }
        #point2 {
            top: 354px;
            left: 95px;
        }
        #point3 {
            top: 410px;
            left: 300px;
        }
        #point4 {
            top: 320px;
            left: 293px;
        }
        #point5 {
            top: 370px;
            left: 428px;
        }
        #point6 {
            top: 370px;
            left: 515px;
        }
        #point7 {
            top: 412px;
            left: 343px;
        }
        #point8 {
            top: 305px;
            left: 215px;
        }
        #point9 {
            top: 350px;
            left: 270px;
        }
        #point10 {
            top: 370px;
            left: 720px;
        }
        
        #infoBox {
            position: absolute;
            top: 0;
            left: 0;
            width: 200px;
            height: 100px;
            background-color: #ccc;
            display: none;
        }
    </style>

<link href="css/list-page.css" rel="stylesheet">
<link href="css/loader.css" rel="stylesheet">
    </head>
    
    <body>
            
            <?php include 'includes/navbar.php'; ?> 
            
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-3">

                        <?php include 'includes/profile-card.php'; ?>
                        <br><br><br>
                        <a href="create-topic.php" class="btn btn-warning btn-lg btn-block">分享貼文</a>
                        <a href="categories.php" class="btn btn-warning btn-lg btn-block">查看貼文</a>
                    </div>

                    <div class="col-sm-7" >

                        <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
                            <div class="lh-100">
                                <h1 class="mb-0 text-white lh-100">楠梓區地圖</h1>
                            </div>
                        </div>  
                        <div class="text-center p-3">
                            <!-- <img src="img/map.png"><br> -->
                            <img src="img/map.png">
                            <a href="https://www.google.com/maps/place/%E9%90%B5%E7%9A%AE%E5%B1%8B%E8%87%AA%E5%8A%A9%E9%A4%90/@22.7316567,120.2769032,18.16z/data=!4m6!3m5!1s0x346e0f733cbc9763:0x4ae83aa761151a57!8m2!3d22.7314646!4d120.2765634!16s%2Fg%2F11s4ymsnhp?authuser=1&entry=ttu">
                                <div class="point" id="point1"></div>
                            </a>
                            <a href="https://www.google.com/maps/place/%E5%A4%A9%E9%A6%99%E7%A6%8F%E9%BA%B5%E9%A4%A8/@22.7272072,120.2766324,18.16z/data=!3m1!5s0x346e0f6ac6b4df73:0x9a6c29217bc36ed7!4m6!3m5!1s0x346e0f3514fe4ab7:0x67c74bf3f97f701f!8m2!3d22.7275517!4d120.2760418!16s%2Fg%2F11hyt606vm?authuser=1&entry=ttu">
                            <div class="point" id="point2"></div>
                            </a>
                            <a href="https://www.google.com/maps/place/%E7%89%9B%E6%97%BA%E7%89%9B%E6%8E%92+NiuWang+Steak/@22.7239457,120.2918979,21z/data=!4m6!3m5!1s0x346e0fa6796929fb:0xb3f3500338e97edf!8m2!3d22.7238567!4d120.2920642!16s%2Fg%2F11jx0wqv3g?authuser=1&entry=ttu">
                            <div class="point" id="point3"></div>
                            </a>
                            <a href="https://www.google.com/maps/place/%E6%9F%B4%E9%BB%9E+Chai+Dian+%E5%8D%88%E6%99%9A%E9%A4%90%E5%AE%B5%E5%A4%9C%E5%B0%88%E8%B3%A3%E5%BA%97/@22.7316359,120.2903715,17z/data=!4m6!3m5!1s0x346e0f84d95afa2d:0x271160ed68cb73c2!8m2!3d22.7314827!4d120.292004!16s%2Fg%2F11sm7f8nbq?authuser=1&entry=ttu">
                            <div class="point" id="point4"></div>
                            </a>
                            <a href="https://www.google.com/maps/place/%E7%AF%89%E9%96%93%E5%B9%B8%E7%A6%8F%E9%8D%8B%E7%89%A9+%E9%AB%98%E9%9B%84%E6%A5%A0%E6%A2%93%E5%BA%97/@22.7271637,120.3005104,17z/data=!3m2!4b1!5s0x346e0fa15f410fd9:0xef03b6e46b058595!4m6!3m5!1s0x346e0f948bf2e9c1:0x62aeb158ca049c55!8m2!3d22.7271637!4d120.3030907!16s%2Fg%2F11rcd9k9fr?authuser=1&entry=ttu">
                            <div class="point" id="point5"></div>
                            </a>
                            <a href="https://www.google.com/maps/place/%E9%A3%9F%E5%A4%A7%E5%AE%A2%E7%89%9B%E6%8E%92/@22.7276162,120.3072748,17z/data=!3m1!4b1!4m6!3m5!1s0x346e0fbb4536b1b1:0x49958a3515420a0f!8m2!3d22.7276162!4d120.3098551!16s%2Fg%2F11c5_pgd2n?authuser=1&entry=ttu">
                            <div class="point" id="point6"></div>
                            </a>
                            <a href="https://www.google.com/maps/place/%E9%99%B3%E9%BA%BB%E9%A3%AF-%E6%A4%92%E9%BA%BB%E9%9B%9E%E8%85%BF%E9%A3%AF/@22.7240416,120.2941189,17z/data=!3m1!4b1!4m6!3m5!1s0x346e0f79657fc601:0x3898382e01a69e77!8m2!3d22.7240416!4d120.2966992!16s%2Fg%2F11f5hlq9v0?authuser=1&entry=ttu">
                            <div class="point" id="point7"></div>
                            </a>
                            <a href="https://www.google.com/maps/place/%E9%9B%99%E9%86%AC%E5%92%96%E5%93%A9-%E9%AB%98%E5%A4%A7%E5%BA%97/@22.7333995,120.2852723,17.87z/data=!4m14!1m7!3m6!1s0x346e0fc6767d8c8b:0x9f36c1348898eeee!2zUElaWkEgSFVU5b-F5Yud5a6iLemrmOmbhOW7uualoOW6lw!8m2!3d22.7271614!4d120.326077!16s%2Fg%2F11bw46yhjn!3m5!1s0x346e0f0e01f93129:0xc8c5c77942a81f16!8m2!3d22.732189!4d120.2859092!16s%2Fg%2F11dxdy6p8r?authuser=1&entry=ttu">
                            <div class="point" id="point8"></div>
                            </a>
                            <a href="https://www.google.com/maps/place/%E6%97%A9%E5%88%B0%E6%99%9A%E5%88%B0%E6%A5%A0%E6%A2%93%E5%BA%97/@22.7291275,120.2905698,17.68z/data=!3m1!5s0x346e0f0c672e792d:0x26e51fa50ee29de!4m6!3m5!1s0x346e0fa1e8493925:0x5e8ed4b7ccf8763c!8m2!3d22.7284753!4d120.2903739!16s%2Fg%2F11nf_xqc8n?authuser=1&entry=ttu">
                            <div class="point" id="point9"></div>
                            </a>
                            <a href="https://www.google.com/maps/place/PIZZA+HUT%E5%BF%85%E5%8B%9D%E5%AE%A2-%E9%AB%98%E9%9B%84%E5%BB%BA%E6%A5%A0%E5%BA%97/@22.7271614,120.3234967,17z/data=!3m1!4b1!4m6!3m5!1s0x346e0fc6767d8c8b:0x9f36c1348898eeee!8m2!3d22.7271614!4d120.326077!16s%2Fg%2F11bw46yhjn?authuser=1&entry=ttu">
                            <div class="point" id="point10"></div>
                            </a>
                            
                            <div id="infoBox"></div>

    <script>
        // 定義每個點的資訊
        const pointsInfo = {
            point1: {
                info: '高大鐵皮屋自助餐',
                link: 'https://www.google.com/maps/place/%E9%90%B5%E7%9A%AE%E5%B1%8B%E8%87%AA%E5%8A%A9%E9%A4%90/@22.7316567,120.2769032,18.16z/data=!4m6!3m5!1s0x346e0f733cbc9763:0x4ae83aa761151a57!8m2!3d22.7314646!4d120.2765634!16s%2Fg%2F11s4ymsnhp?authuser=1&entry=ttu'
            },
            point2: {
                info: '天香福麵館',
                link: 'target-page2.html'
            },
            point3: {
                info: '牛旺牛排',
                link: 'target-page3.html'
            },
            point4: {
                info: '柴點',
                link: 'target-page4.html'
            },
            point5: {
                info: '築間',
                link: 'target-page5.html'
            },
            point6: {
                info: '食大客',
                link: 'target-page6.html'
            },
            point7: {
                info: '陳麻飯',
                link: 'target-page7.html'
            },
            point8: {
                info: '雙醬咖哩',
                link: 'target-page8.html'
            },
            point9: {
                info: '早到晚到',
                link: 'target-page9.html'
            },
            point10: {
                info: '必勝客建楠店',
                link: 'target-page10.html'
            }
        };

        // 獲取點和資訊框的元素
        const points = document.querySelectorAll('.point');
        const infoBox = document.getElementById('infoBox');

        // 添加滑鼠事件監聽器
        points.forEach(point => {
            point.addEventListener('mouseover', showInfo);
            point.addEventListener('mouseout', hideInfo);
        });

        // 顯示資訊框
        function showInfo(event) {
            const pointId = event.target.id;
            const pointInfo = pointsInfo[pointId];

            // 更改資訊框的內容
            infoBox.innerHTML = `
                <a href="${pointInfo.link}">${pointInfo.info}</a>
            `;

            // 設置資訊框的位置
            infoBox.style.top = '460px';
            infoBox.style.left ='-280px';

            // 顯示資訊框
            infoBox.style.display = 'block';
        }

        // 隱藏資訊框
        function hideInfo() {
            // 隱藏資訊框
            infoBox.style.display = 'none';
        }
    </script>
                        </div>
                        <br>
                        
                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade show active" id="forum" role="tabpanel" aria-labelledby="forum-tab">

                                <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
                                    <div class="lh-100">
                                        <h1 class="mb-0 text-white lh-100">本站推薦餐廳</h1>
                                    </div>
                                </div>

                                <div class="row mb-2" id="1">
                                    <?php
                                    $name = array("牛旺牛排","必勝客高雄建楠店","築間幸福鍋物<br>高雄楠梓店","柴點","高大鐵皮屋自助餐","天香福麵館","食大客牛排","早到晚到","陳麻飯","雙醬咖哩");
                                    $map = array("https://www.google.com/maps/place/%E7%89%9B%E6%97%BA%E7%89%9B%E6%8E%92+NiuWang+Steak/@22.7239457,120.2918979,21z/data=!4m6!3m5!1s0x346e0fa6796929fb:0xb3f3500338e97edf!8m2!3d22.7238567!4d120.2920642!16s%2Fg%2F11jx0wqv3g?authuser=1&entry=ttu",
                                                 "https://www.google.com/maps/place/PIZZA+HUT%E5%BF%85%E5%8B%9D%E5%AE%A2-%E9%AB%98%E9%9B%84%E5%BB%BA%E6%A5%A0%E5%BA%97/@22.7271614,120.3234967,17z/data=!3m1!4b1!4m6!3m5!1s0x346e0fc6767d8c8b:0x9f36c1348898eeee!8m2!3d22.7271614!4d120.326077!16s%2Fg%2F11bw46yhjn?authuser=1&entry=ttu",
                                                 "https://www.google.com/maps/place/%E7%AF%89%E9%96%93%E5%B9%B8%E7%A6%8F%E9%8D%8B%E7%89%A9+%E9%AB%98%E9%9B%84%E6%A5%A0%E6%A2%93%E5%BA%97/@22.7271637,120.3005104,17z/data=!3m2!4b1!5s0x346e0fa15f410fd9:0xef03b6e46b058595!4m6!3m5!1s0x346e0f948bf2e9c1:0x62aeb158ca049c55!8m2!3d22.7271637!4d120.3030907!16s%2Fg%2F11rcd9k9fr?authuser=1&entry=ttu",
                                                 "https://www.google.com/maps/place/%E6%9F%B4%E9%BB%9E+Chai+Dian+%E5%8D%88%E6%99%9A%E9%A4%90%E5%AE%B5%E5%A4%9C%E5%B0%88%E8%B3%A3%E5%BA%97/@22.7316359,120.2903715,17z/data=!4m6!3m5!1s0x346e0f84d95afa2d:0x271160ed68cb73c2!8m2!3d22.7314827!4d120.292004!16s%2Fg%2F11sm7f8nbq?authuser=1&entry=ttu",
                                                 "https://www.google.com/maps/place/%E9%90%B5%E7%9A%AE%E5%B1%8B%E8%87%AA%E5%8A%A9%E9%A4%90/@22.7316567,120.2769032,18.16z/data=!4m6!3m5!1s0x346e0f733cbc9763:0x4ae83aa761151a57!8m2!3d22.7314646!4d120.2765634!16s%2Fg%2F11s4ymsnhp?authuser=1&entry=ttu",
                                                 "https://www.google.com/maps/place/%E5%A4%A9%E9%A6%99%E7%A6%8F%E9%BA%B5%E9%A4%A8/@22.7272072,120.2766324,18.16z/data=!3m1!5s0x346e0f6ac6b4df73:0x9a6c29217bc36ed7!4m6!3m5!1s0x346e0f3514fe4ab7:0x67c74bf3f97f701f!8m2!3d22.7275517!4d120.2760418!16s%2Fg%2F11hyt606vm?authuser=1&entry=ttu",
                                                 "https://www.google.com/maps/place/%E9%A3%9F%E5%A4%A7%E5%AE%A2%E7%89%9B%E6%8E%92/@22.7276162,120.3072748,17z/data=!3m1!4b1!4m6!3m5!1s0x346e0fbb4536b1b1:0x49958a3515420a0f!8m2!3d22.7276162!4d120.3098551!16s%2Fg%2F11c5_pgd2n?authuser=1&entry=ttu",
                                                 "https://www.google.com/maps/place/%E6%97%A9%E5%88%B0%E6%99%9A%E5%88%B0%E6%A5%A0%E6%A2%93%E5%BA%97/@22.7291275,120.2905698,17.68z/data=!3m1!5s0x346e0f0c672e792d:0x26e51fa50ee29de!4m6!3m5!1s0x346e0fa1e8493925:0x5e8ed4b7ccf8763c!8m2!3d22.7284753!4d120.2903739!16s%2Fg%2F11nf_xqc8n?authuser=1&entry=ttu",
                                                 "https://www.google.com/maps/place/%E9%99%B3%E9%BA%BB%E9%A3%AF-%E6%A4%92%E9%BA%BB%E9%9B%9E%E8%85%BF%E9%A3%AF/@22.7240416,120.2941189,17z/data=!3m1!4b1!4m6!3m5!1s0x346e0f79657fc601:0x3898382e01a69e77!8m2!3d22.7240416!4d120.2966992!16s%2Fg%2F11f5hlq9v0?authuser=1&entry=ttu",
                                                 "https://www.google.com/maps/place/%E9%9B%99%E9%86%AC%E5%92%96%E5%93%A9-%E9%AB%98%E5%A4%A7%E5%BA%97/@22.7333995,120.2852723,17.87z/data=!4m14!1m7!3m6!1s0x346e0fc6767d8c8b:0x9f36c1348898eeee!2zUElaWkEgSFVU5b-F5Yud5a6iLemrmOmbhOW7uualoOW6lw!8m2!3d22.7271614!4d120.326077!16s%2Fg%2F11bw46yhjn!3m5!1s0x346e0f0e01f93129:0xc8c5c77942a81f16!8m2!3d22.732189!4d120.2859092!16s%2Fg%2F11dxdy6p8r?authuser=1&entry=ttu");
                                    $text = array("真材實料的濃厚醬汁😎<br>創意多變的各種菜色🥳<br>濃湯&飲品 免費享用😍<br>","披薩、烤雞、炸物、濃湯<br>各種奇特口味<br>各種特殊癖好<br>一應俱全","結合「百味食材截取特色精華」概念<br>以食材特色融入湯品與料理中<br>透過主廚創意巧思，料理多了異國特色","楠梓宵夜銅板美食價位平易近人<br>","很便宜可以訓練腸胃","麵食、炒手、打拋豬飯、水餃、肉燥飯<br>很容易一口接著一口<br>吃起來相當過癮","慢火窯烤肉質軟嫩，搭上特製醬汁<br>香味四溢，絕妙滋味","超狂人氣的早到晚到 晚餐宵夜美食<br>正餐、飲料、點心樣樣都有","採臨櫃點餐的簡樸餐廳<br>供應大份量的、椒麻雞、<br>麻婆豆腐和烏龍麵","將日式美食最具代表性之一的咖哩料理<br>融合在地適合的口味<br>以兩種醬汁讓民眾感受不同韻味");
                                    $img = array("img/steak.jpg","img/hot.png","img/ju.jpg","shiba.png","img/iron.jpg","img/sky.jpg","img/stuck.jpg","img/food.jpg","img/rice.jpg","img/curry.jpeg");

                                    for($i=0;$i<=9;$i++)
                                    {
                                    echo
                                    '<div class="col-md-6">
                                        <div class="card flex-md-row mb-4 shadow-sm h-md-250">
                                            <a href="'.$map[$i].'">
                                            <img class="card-img-left flex-auto d-none d-lg-block blogindex-cover" src="' . $img[$i % count($img)] . '" alt="Card image cap">
                                            </a>
                                            <div class="card-body d-flex flex-column align-items-start">
                                                <strong class="d-inline-block mb-2 text-primary text-center  ml-auto"></strong>
                                                <h6 class="mb-0">
                                                    <a class="text-dark" href="'.$map[$i].'"><span style="font-size: 20px;font-weight: bold;">'.$name[$i].'</span></a>
                                                    <br><br>
                                                    <small class="card-text mb-auto">'.$text[$i].'</small><br><br>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>';           
                                    }
                                    ?>
                                </div>
                            
                            </div>    
                        </div>

                        <br>
                        
                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade show active" id="forum" role="tabpanel" aria-labelledby="forum-tab">

                                <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
                                    <div class="lh-100">
                                        <h1 class="mb-0 text-white lh-100">最新貼文</h1>
                                    </div>
                                </div>  

                                <div class="row mb-2" id="1">
                                    <?php
                                        $sql = "select topic_id, topic_subject, topic_date, topic_cat, topic_by,topic_img, userImg, idUsers, uidUsers, cat_name, (
                                                    select sum(post_votes)
                                                    from posts
                                                    where post_topic = topic_id
                                                    ) as upvotes
                                                from topics, users, categories 
                                                where topics.topic_by = users.idUsers
                                                and topics.topic_cat = categories.cat_id
                                                order by topic_id desc, upvotes asc 
                                                LIMIT 20";
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
                                                echo   '<div class="col-md-6">
                                                            <div class="card flex-md-row mb-4 shadow-sm h-md-250">
                                                                <a href="posts.php?topic='.$row['topic_id'].'">
                                                                <img src="uploads/'.$row['topic_img'].'" class="img-fluid center-block user-img"style="width: 200px; height: 200px;">
                                                                </a>
                                                                <div class="card-body d-flex flex-column align-items-start">
                                                                    <strong class="d-inline-block mb-2 text-primary text-center  ml-auto">
                                                                    <i class="fa fa-chevron-up" aria-hidden="true"></i><br>'.$row['upvotes'].'
                                                                    </strong>
                                                                    <h6 class="mb-0">
                                                                    <a class="text-dark" href="posts.php?topic='.$row['topic_id'].'">'
                                                                    .substr(ucwords($row['topic_subject']),0,15).'...</a>
                                                                    </h6>
                                                                    <small class="mb-1 text-muted">'.date("F jS, Y", strtotime($row['topic_date'])).'</small>
                                                                    <small class="card-text mb-auto">貼文者: '.ucwords($row['uidUsers']).'</small>
                                                                    <a href="posts.php?topic='.$row['topic_id'].'">前往貼文</a>
                                                                </div>
                                                            </div>
                                                        </div>';
                                            }
                                        }
                                    ?>     
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js" ></script>


        
    </body>
</html>   