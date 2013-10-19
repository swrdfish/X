<?php
require_once "handle_picasa.php";
require_once "handle_tumblr.php";
?>

<! DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,300' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Limelight' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:100,700' rel='stylesheet' type='text/css'>
        <link href="css/normalize.css" rel="stylesheet" type="text/css">
        <link href="css/blog.css" rel="stylesheet" type="text/css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script src="js/jquery.fittext.js"></script>

        <script>
            $(function() {

            });
        </script>
    </head>
    <body>
        <div id="background-texture"></div>
        <div id="nav">
            <div id="logo">SAMUDRANIL ROY</div>
            <div id="logo-bottom"></div>
            <ul>
                <li><span class='nav'>ABOUT</span></li>
                <li><span class='nav'>PORTFOLIO</span></li>
                <li><span class='nav'>BLOG</span></li>
                <li><span class='nav'>CONTACT</span></li>
            </ul>
        </div>

        <div class="container">
            <?php if (!isset($_GET['id'])): ?>
                    <?php
                    ##
                    ## get the short posts from tumblr
                    ##
                    if (isset($_GET['page'])){
                        $offset = $_GET['page'] - 1;
                        $response = $Tumblr->getPostsShort(($offset*7), '7');
                    }
                    else {
                        $response = $Tumblr->getPostsShort('0', '7');
                        $offset = 0;
                    }
                    $Posts = array_slice($response, 2);
                    $total_posts = $response['total_posts'];
                    $date = new DateTime();
                    foreach($Posts[0] as $entry){
                        echo "<div class='blog-post'>";
                        echo "<h3 class='blog-title'><a href='blog.php?id=".$entry['id']."'><span class='blog-title'>".$entry['title']."</span></a></h3>";
                        $date->setTimestamp($entry['time']);
                        echo "<span class='blog-date'>".$date->format('jS F\, Y \a\t g:ia')."</span>";
                        echo "<div class='blog-body'>".$entry['body'];
                        echo "<a href='blog.php?id=".$entry['id']."'><span class='blog-readon'>read on ..</span></a>";
                        echo "</div></div>";
                        }

                    // next prev bar
                    echo "<div class='blog-next-prev'>";
                    if($offset > 0){
                        echo "<a href='blog.php?page=".($offset)."'><span class='blog-next'>newer →</span></a>";
                        }
                    if(($total_posts - ($offset +1)*7) > 0){
                        echo "<a href='blog.php?page=".($offset + 2)."'><span class='blog-prev'>← older</span></a>";
                    }
                    echo "</div>";
                    ?>
            <?php elseif (isset($_GET['id'])): ?>
                <?php
                    $Post = $Tumblr->getSinglePost($_GET['id']);
                    echo "<div class='blog-post'>";
                    echo "<h3 class='blog-title'><span class='blog-title'>".$Post['title']."</span></h3>";
                    $date = new DateTime();
                    $date->setTimestamp($Post['time']);
                    echo "<span class='blog-date'>".$date->format('jS F\, Y \a\t g:ia')."</span>";
                    echo "<div class='blog-body'>";
                    echo $Post['body'];
                    echo "</div></div>";
                ?>
            <?php endif; ?>
        </div>
    </body>
</html>
