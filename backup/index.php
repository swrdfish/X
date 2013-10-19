<! DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <link href='http://fonts.googleapis.com/css?family=Limelight' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:100,700' rel='stylesheet' type='text/css'>
        <link href="css/normalize.css" rel="stylesheet" type="text/css">
        <link href="css/main.css" rel="stylesheet" type="text/css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script src="js/jquery.fittext.js"></script>
        <script>
            $(function() {
                $("#logo").fitText(1.5);
                $("#description").fitText(2.5);
                $("#nav").fitText();
                $("#credits").fitText(1.8);

            });
        </script>
    </head>
    <body>
        <div id="background-image"></div>
        <div id="background-texture"></div>
        <div class="container">
            <div id="logo">
                <span class="logo">SAMUDRANIL ROY.</span>
            </div>
            <div id="description">
                <span class='description'>photographer. writter.</span>
            </div>
            <div id="nav">
                <ul>
                    <li><span class="nav">ABOUT.</span></li>
                    <li><span class="nav">PORTFOLIO.</span></li>
                    <li><a href="blog.php"><span class="nav">BLOG.</span></a></li>
                    <li><span class="nav">CONTACT.</span></li>
                </ul>
            </div>
            <div id="credits">
                designed by Binayak &amp; Bishakh.
            </div>
        </div>
    </body>
</html>
