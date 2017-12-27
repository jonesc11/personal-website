<?php
    require("../../open_user_connection.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 <?php require '../../resources/top_bar.php';
          require '../../resources/footer.php';?>
<html>
    <head>
        <title>Shop - Card Overflow</title>
        <link rel="stylesheet" href="/resources/styles/style_shop.css"/>
        <link rel="stylesheet" href="/resources/styles/header_style.css"/>
        <link rel="stylesheet" href="/resources/styles/footer_style.css"/>
        <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
        <script type="text/javascript" src="/resources/js/search_blur.js"></script>
    </head>
    <body>
        <form id="search-form" action="/search.php" method="post">
          <input type="text" id = "Search" name="search" value="Search..." 
          onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
          <select id="flags" name="flags">
                <option name ="All" value= "All">ALL</option>
                <option name ="English" value = "1">ENGLISH</option>
                <option name ="German" value= "2">GERMAN</option>
                <option name ="French" value = "3">FRENCH</option>
                <option name ="Italian" value = "4">ITALIAN</option>
                <option name ="Spanish" value = "5">SPANISH</option>
                <option name ="Portuguese" value = "6">PORTUGUESE </option>
          </select>
          <input type="submit" name="submit" value="Search"/>
        </form>
        <table id="flag_select" cellspacing="15">
            <tr>
            <td colspan="3" style="text-align:center;font-weight:bold;text-decoration:underline;font-size:4vh;">
                Choose a Language
            </td>
            </tr>
            <tr>
            <td><a href="../?q=&f=1"><img id ="flag_img" src="../../resources/images/USA.png" ></a></td>
            <td><a href="../?q=&f=2"><img id ="flag_img" src="../../resources/images/German.png" ></a></td>
            <td><a href="../?q=&f=3"><img id ="flag_img" src="../../resources/images/French.png" ></a></td>
            </tr><tr>
            <td><a href="../?q=&f=4"><img id ="flag_img" src="../../resources/images/italian.png" ></a></td>
            <td><a href="../?q=&f=5"><img id ="flag_img" src="../../resources/images/spain.png" ></a></td>
            <td><a href="../?q=&f=6"><img id ="flag_img" src="../../resources/images/Portugal.png"></a></td>
            </tr>
        </div>
    </body>
</html>