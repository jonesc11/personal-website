<?php require '../open_user_connection.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>Card Overflow</title>
        <link rel="stylesheet" href="/resources/styles/style_our_team.css"/>
        <link rel="stylesheet" href="/resources/styles/header_style.css"/>
        <link rel="stylesheet" href="/resources/styles/footer_style.css"/>
        <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
        <script src="resources/js/jquery-3.2.1.min.js"></script>
        <!--<script type="text/javascript" src="resources/js/slide.js"></script>-->

    </head>
    <body>
        <div id="alert">
            <p>Insert Text Here</p>
            <a id="close-alert"><img src="images/close.jpg" alt="close"/></a>
        </div>
        <?php require '../resources/top_bar.php';
              require '../resources/footer.php'; $db = null;?>
        <form id="search-form" action="search.php" method="post">
          <input type="text" id = "Search" name="search" value="Search..." 
          onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
          <input type="submit" name="submit" value="Search"/>
        </form>
        <div id="allplayers">
            <div id="player-row">
                <div id="f1_container">
                    <div id="f1_card" class="shadow">
                      <div class="front face">
                        <img src="../resources/images/Thomas.jpg" width = "80%" height = "80%" style="margin:3%;">
                        <p id = "pname">Thomas Dean</p>
                      </div>
                      <div class="back face center">
                        <p><div id="under">HOMETOWN:</div>
                        Marlboro, NJ</p>
                        <p><div id="under">TOPS:</div>
                        ARG Phildelphia 2014 - Top 16
                        </br>NAWCQ 2016 - Top 64
                        <p><div id="under">FAVORITE DECK:</div>
                        Djinn Nekroz</p>
                      </div>
                    </div>
                </div>
                <div id="f1_container">
                    <div id="f1_card" class="shadow">
                      <div class="front face">
                        <img src="../resources/images/Willy.png" width = "80%" height = "80%" style="margin:3%;">
                        <p id = "pname">Willy Silva Jr.</p>
                      </div>
                      <div class="back face center">
                        <p><div id="under">HOMETOWN:</div>
                        Elizabeth, NJ</p>
                        <p><div id="under">TOPS:</div>
                        NAWCQ 2016 - Top 64
                        </br>YCS Toronto 2016 - Top 16
                        </br>3 Regional Top 8s</p>
                        <p><div id="under">FAVORITE DECK:</div>
                        Shaddoll</p>                      </div>
                    </div>
                </div>
                <div id="f1_container">
                    <div id="f1_card" class="shadow">
                      <div class="front face">
                        <img src="../resources/images/Jarrid.jpg" width = "80%" height = "80%" style="margin:3%;">
                        <p id = "pname">Jarrid Centamore</p>
                      </div>
                      <div class="back face center">
                        <p><div id="under">HOMETOWN:</div>
                        Manahawkin, NJ</p>
                        <p><div id="under">TOPS:</div>
                        ARG 25k Philadelphia 2015 - Top 32
                        </br>ARG Atlantic City 2015 - 2nd Place
                        </br>UDS Philadelphia 2015 - Top 4
                        </br>YCS Charleston 2015 - Top 8
                        </br>1 Regional Top 8</p>
                        <p><div id="under">FAVORITE DECK:</div>
                        Burning Abyss</p>
                      </div>
                    </div>
                </div>
                <div id="f1_container">
                    <div id="f1_card" class="shadow">
                      <div class="front face">
                        <img src="../resources/images/Steve.jpg" width = "80%" height = "80%" style="margin:3%;">
                        <p id = "pname">Steve Gleason</p>
                      </div>
                      <div class="back face center">
                        <p><div id="under">HOMETOWN:</div>
                        Laurel, NJ</p>
                        <p><div id="under">TOPS:</div>
                        UDS Philadelphia 2015 - Top 8
                        </br>YCS Atlanta 2016 - Top 32 
                        </br>YCS Providence 2016 - Top 8</p>
                        <p><div id="under">FAVORITE DECK:</div>
                        Performapal Pendulum</p>
                      </div>
                    </div>
                </div>
            </div>
            <div id="player-row">
                <div id="f1_container">
                    <div id="f1_card" class="shadow">
                      <div class="front face">
                        <img src="../resources/images/McMeaty.png" width = "80%" height = "80%" style="margin:3%;">
                        <p id = "pname">Steven McMearty</p>
                      </div>
                      <div class="back face center">
                        <p><div id="under">HOMETOWN:</div>
                        Reading, PA</p>
                        <p><div id="under">TOPS:</div>
                        ARG Syracuse 2015 - 3rd Place
                        </br>ARG Providence 2015 - 1st Place
                        </br>YCS Atlanta 2016 - Top 8
                        </br>ARG Charlotte 2016 - 3rd Place
                        </br>ARG 25K 2016 - Top 32
                        </br>ARG Springfield 2016 - Top 8
                        </br>4 Regional Top 8s
                        <p><div id="under">FAVORITE DECK:</div>
                        Shaddoll</p>
                      </div>
                    </div>
                </div>
                <div id="f1_container">
                    <div id="f1_card" class="shadow">
                      <div class="front face">
                        <img src="../resources/images/MattCarioli.jpg" width = "80%" height = "80%" style="margin:3%;">
                        <p id = "pname">Matt Carioli</p>
                      </div>
                      <div class="back face center">
                        <p><div id="under">HOMETOWN:</div>
                        Newfield, NJ</p>
                        <p><div id="under">TOPS:</div>
                        ARG Atlantic City 2015 - Top 8 
                        </br>ARG 25k 2016 - Top 32 
                        </br>ARG Springfield 2017 - 3rd Place
                        <p><div id="under">FAVORITE DECK:</div>
                        Djinnless Nekroz</p>
                      </div>
                    </div>
                </div>
                <div id="f1_container">
                    <div id="f1_card" class="shadow">
                      <div class="front face">
                        <img src="../resources/images/Gian.png" width = "80%" height = "80%" style="margin:3%;">
                        <p id = "pname">Giancarlo Villacorta</p>
                      </div>
                      <div class="back face center">
                        <p><div id="under">HOMETOWN:</div>
                        Elizabeth, NJ</p>
                        <p><div id="under">TOPS:</div>
                        2 Regional Top 8s
                        <p><div id="under">FAVORITE DECK:</div>
                        Karakuri Geargia</p>
                      </div>
                    </div>
                </div>
                <div id="f1_container">
                    <div id="f1_card" class="shadow">
                      <div class="front face">
                        <img src="../resources/images/Johan.jpg" width = "80%" height = "80%" style="margin:3%;">
                        <p id = "pname">Johan Burke</p>
                      </div>
                      <div class="back face center">
                        <p><div id="under">HOMETOWN:</div>
                        Bear, DE</p>
                        <p><div id="under">TOPS:</div>
                        NAWCQ 2016 - Top 16
                        </br>YCS Origins 2016 - Top 8
                        </br>3 Regional Top 8s</p>
                        <p><div id="under">FAVORITE DECK:</div>
                        Mermail</p>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
<script type="text/javascript" src="/resources/js/RotatePlayer.js"></script>
</html>