<?php
require_once "handle_picasa.php";
require_once "handle_tumblr.php";
?>

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
    ?>
<?php elseif (isset($_GET['id'])): ?>
    <?php
        $Post = $Tumblr->getSinglePost($_GET['id']);
    ?>
<?php endif; ?>

<! DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />

        <?php if (isset($_GET['id'])): ?>
        <title> Samudranil Roy - <?php echo $Post['title'];?></title>
        <meta property="og:title" content="Samudranil Roy - <?php echo $Post['title'];?>" />
        <meta property="og:type" content="article" />
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="samudranil22">
        <meta name="twitter:title" content="Samudranil Roy - <?php echo $Post['title'];?>">
        <meta name="twitter:description" content="Samudranil Roy - blog">
        <?php else: ?>
        <title> Samudranil Roy - blog</title>
        <meta property="og:title" content="Samudranil Roy - blog"/>
        <meta property="og:type" content="blog" />
        <?php endif; ?>

        <meta name="author" content="Samudranil Roy" />
        <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,300' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Limelight' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:100,700' rel='stylesheet' type='text/css'>
        <link href="css/normalize.css" rel="stylesheet" type="text/css">
        <link href="css/blog.css" rel="stylesheet" type="text/css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script src="js/jquery.fittext.js"></script>



        <script type="text/javascript">var switchTo5x=true;</script>
        <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
        <script type="text/javascript" src="http://s.sharethis.com/loader.js"></script>




      <script type="text/javascript">
          $(function() {
               $("img[src*='farm']").each(function(){
                    var src = $( this ).attr('src');
                    var href = src.replace('_z','_b');
                    $( this ).wrap( "<a class='lightbox' href="+href+"></a>" );
                });
                $(".lightbox").fancybox({
                                            openEffect: 'elastic',
                                            closeEffect: 'fade'
                                        })

                });
      </script>

    <!--  FANCYBOX -------------------------------------------------------------- -->

    <!-- Add mousewheel plugin (this is optional) -->
    <script type="text/javascript" src="/js/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

    <!-- Add fancyBox -->
    <link rel="stylesheet" href="/js/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
    <script type="text/javascript" src="/js/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

    <!-- Optionally add helpers - button, thumbnail and/or media -->
    <link rel="stylesheet" href="/js/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
    <script type="text/javascript" src="/js/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
    <script type="text/javascript" src="/js/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

    <link rel="stylesheet" href="/js/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
    <script type="text/javascript" src="/js/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>






   <script type="text/javascript">
        //DISQUS------------------------------------
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'samudranilroy'; // required: replace example with your forum shortname

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
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
                    echo "<div class='blog-post'>";
                    echo "<h3 class='blog-title'><span class='blog-title'>".$Post['title']."</span></h3>";
                    $date = new DateTime();
                    $date->setTimestamp($Post['time']);
                    echo "<span class='blog-date'>".$date->format('jS F\, Y \a\t g:ia')."</span>";
                    echo "<div class='blog-body'>";
                    echo $Post['body'];
                    echo "</div></div><div id=\"disqus_thread\"></div></div>";

                    //Social buttons
                    echo "<div id='share'>
                                 </div>"

               ?>
            <?php endif; ?>

    </body>

            <script type="text/javascript">stLight.options({publisher: "47ec02df-b90d-4a07-89f1-a7dbf7d2519a", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
            <script>
            var options={ "publisher": "47ec02df-b90d-4a07-89f1-a7dbf7d2519a", "position": "right", "ad": { "visible": false, "openDelay": 5, "closeDelay": 0}, "chicklets": { "items": ["facebook", "twitter", "googleplus", "linkedin", "pinterest", "sharethis"]}};
            var st_hover_widget = new sharethis.widgets.hoverbuttons(options);
            </script>

</html>
