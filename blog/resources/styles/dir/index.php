<?php require 'open_user_connection.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>Card Overflow</title>
        <link rel="stylesheet" href="/resources/styles/style_home.css"/>
        <link rel="stylesheet" href="/resources/styles/header_style.css"/>
        <link rel="stylesheet" href="/resources/styles/footer_style.css"/>
        <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
        <script src="resources/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="/resources/js/slide.js"></script>
        <script type="text/javascript" src="/resources/js/search_blur.js"></script>
    </head>
    <body>
        <div id="alert">
            <p>Insert Text Here</p>
            <a id="close-alert"><img src="images/close.jpg" alt="close"/></a>
        </div>
        <?php require 'resources/top_bar.php';
              require 'resources/footer.php'; $db = null;?>
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
        <div id="slidespace">
            <div id="slide1">
                <div id="banner"><a href="1"><img src="/resources/images/spain.png"/></a></div>
                <div id="product_card"><img src="/resources/images/USA.png"//></div>
                <div id="product_desc"><img src="/resources/images/USA.png"//></div>
            <ul id="buttons">
                <svg height="20" width="20">
                  <circle cx="10" cy="10" r="8" stroke="blue" stroke-width="2" fill="white" onclick = "slide1()" />
                </svg>
                <svg height="20" width="20">
                  <circle cx="10" cy="10" r="8" stroke="black" stroke-width="1" fill="#eee" onclick = "slide2()"/>
                </svg>
                <svg height="20" width="20">
                  <circle cx="10" cy="10" r="8" stroke="black" stroke-width="1" fill="#eee" onclick = "slide3()"/>
                </svg>
                <svg height="20" width="20">
                  <circle cx="10" cy="10" r="8" stroke="black" stroke-width="1" fill="#eee" onclick = "slide4()"/>
                </svg>
                <svg height="20" width="20">
                  <circle cx="10" cy="10" r="8" stroke="black" stroke-width="1" fill="#eee" onclick = "slide5()"/>
                </svg>
            </ul>
            </div>
            <div id="slide2">
                <div id="banner"><a href="2"><img src="/resources/images/USA.png"//></a></div>
                <div id="product_card"><img src="/resources/images/USA.png"//></div>
                <div id="product_desc"><img src="/resources/images/spain.png"//></div>
                <ul id="buttons">
                    <svg height="20" width="20">
                      <circle cx="10" cy="10" r="8" stroke="black" stroke-width="1" fill="#eee" onclick = "slide1()"/>
                    </svg>
                    <svg height="20" width="20">
                      <circle cx="10" cy="10" r="8" stroke="blue" stroke-width="2" fill="white" onclick = "slide2()"/>
                    </svg>
                    <svg height="20" width="20">
                      <circle cx="10" cy="10" r="8" stroke="black" stroke-width="1" fill="#eee" onclick = "slide3()"/>
                    </svg>
                    <svg height="20" width="20">
                      <circle cx="10" cy="10" r="8" stroke="black" stroke-width="1" fill="#eee" onclick = "slide4()"/>
                    </svg>
                    <svg height="20" width="20">
                      <circle cx="10" cy="10" r="8" stroke="black" stroke-width="1" fill="#eee" onclick = "slide5()"/>
                    </svg>
                </ul>
            </div>
            <div id="slide3">
                <div id="banner"><a href="2"><img/></a></div>
                <div id="product_card"><img src="/resources/images/spain.png"//></div>
                <div id="product_desc"><img src="/resources/images/USA.png"//></div>
                <ul id="buttons">
                    <svg height="20" width="20">
                      <circle cx="10" cy="10" r="8" stroke="black" stroke-width="1" fill="#eee" onclick = "slide1()"/>
                    </svg>
                    <svg height="20" width="20">
                      <circle cx="10" cy="10" r="8" stroke="black" stroke-width="1" fill="#eee" onclick = "slide2()"/>
                    </svg>
                    <svg height="20" width="20">
                      <circle cx="10" cy="10" r="8" stroke="blue" stroke-width="2" fill="white" onclick = "slide3()" />
                    </svg>
                    <svg height="20" width="20">
                      <circle cx="10" cy="10" r="8" stroke="black" stroke-width="1" fill="#eee" onclick = "slide4()"/>
                    </svg>
                    <svg height="20" width="20">
                      <circle cx="10" cy="10" r="8" stroke="black" stroke-width="1" fill="#eee" onclick = "slide5()"/>
                    </svg>
                </ul>
            </div>
            <div id="slide4">
                <div id="banner"><a href="2"><img/></a></div>
                <div id="product_card"><img src="/resources/images/USA.png"//></div>
                <div id="product_desc"><img src="/resources/images/USA.png"//></div>
                <ul id="buttons">
                    <svg height="20" width="20">
                      <circle cx="10" cy="10" r="8" stroke="black" stroke-width="1" fill="#eee" onclick = "slide1()"/>
                    </svg>
                    <svg height="20" width="20">
                      <circle cx="10" cy="10" r="8" stroke="black" stroke-width="1" fill="#eee" onclick = "slide2()"/>
                    </svg>
                    <svg height="20" width="20">
                      <circle cx="10" cy="10" r="8" stroke="black" stroke-width="1" fill="#eee" onclick = "slide3()"/>
                    </svg>
                    <svg height="20" width="20">
                      <circle cx="10" cy="10" r="8" stroke="blue" stroke-width="2" fill="white" onclick = "slide4()"/>
                    </svg>
                    <svg height="20" width="20">
                      <circle cx="10" cy="10" r="8" stroke="black" stroke-width="1" fill="#eee" onclick = "slide5()"/>
                    </svg>
                </ul>
            </div>
            <div id="slide5">
                <div id="banner"><a href="2"><img/></a></div>
                <div id="product_card"><img src="/resources/images/MattC.jpg"//></div>
                <div id="product_desc"><img src="/resources/images/MattC.jpg"//></div>
                <ul id="buttons">
                    <svg height="20" width="20">
                      <circle cx="10" cy="10" r="8" stroke="black" stroke-width="1" fill="#eee" onclick = "slide1()"/>
                    </svg>
                    <svg height="20" width="20">
                      <circle cx="10" cy="10" r="8" stroke="black" stroke-width="1" fill="#eee" onclick = "slide2()"/>
                    </svg>
                    <svg height="20" width="20">
                      <circle cx="10" cy="10" r="8" stroke="black" stroke-width="1" fill="#eee" onclick = "slide3()"/>
                    </svg>
                    <svg height="20" width="20">
                      <circle cx="10" cy="10" r="8" stroke="black" stroke-width="1" fill="#eee" onclick = "slide4()"/>
                    </svg>
                    <svg height="20" width="20">
                      <circle cx="10" cy="10" r="8" stroke="blue" stroke-width="2" fill="white" onclick = "slide5()"/>
                    </svg>
                </ul>
            </div>
        </div>
    </body>
</html>