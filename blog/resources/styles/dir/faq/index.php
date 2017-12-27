<?php require '../open_user_connection.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>Card Overflow</title>
        <link rel="stylesheet" href="/resources/styles/style_home.css"/>
        <link rel="stylesheet" href="/resources/styles/style_faq.css"/>
        <link rel="stylesheet" href="/resources/styles/header_style.css"/>
        <link rel="stylesheet" href="/resources/styles/footer_style.css"/>
        <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
        <script src="resources/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="/resources/js/search_blur.js"></script>

    </head>
    <body>
        <div id="alert">
            <p>Insert Text Here</p>
            <a id="close-alert"><img src="images/close.jpg" alt="close"/></a>
        </div>
        <form id="search-form" action="search.php" method="post">
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
		<div class=faq>
			<ul>
				<h1>Frequently Asked Questions</h1>
				<li onClick="faqclick('faq0')">Are foreign language Yu-Gi-Oh! cards tournament legal?</li>
				<p id="faq0">Yes. German, French, Italian, Spanish, and Portuguese language cards are legal for Konami and ARG tournament play. These are all TCG languages. However, players should always carry a written translation for the card or a copy of the card in English in a place other than their deck box, as per Konami and ARG rules. They are legal at all tournament levels. </p>
				<li onClick="faqclick('faq1')">Can I use Japanese, Korean, or Chinese language cards in tournament play?</li>
				<p id="faq1">No. While we may have these language cards in stock, they are considered OCG and cannot be played in Konami or ARG tournaments.</p>
				<li onClick="faqclick('faq2')">Do you only sell foreign language Yu-Gi-Oh! cards?</li>
				<p id="faq2">No. We sell English Yu-Gi-Oh! singles, in addition to sealed product, sleeves, playmats, and so on.</p>
				<li onClick="faqclick('faq3')">I want X card in Y language, but it is not in stock. Can you acquire it?</li>
				<p id="faq3">The chances are high. If you want something that we do not have in stock or it is unlisted, shoot us an email on the "Contact Us" page and we will get back to you within 48 hours. </p>
				<li onClick="faqclick('faq4')">Do you ship internationally?</li>
				<p id="faq4">Yes. Currently, we only ship to Canada and the United States. However, you can use the "Contact Us" page to inquire about potential international shipping outside of Canada and the US, and we will do our best to work out a solution.</p>
				<li onClick="faqclick('faq5')">I've seen some players wearing Card Overflow apparel at tournaments. Do you sell Card Overflow apparel?</li>
				<p id="faq5">Yes. Starting soon, we will be selling t-shirts, hoodies, and potentially other Card Overflow apparel in various sizes. </p>
				<li onClick="faqclick('faq6')">Do you buy cards/have a buylist?</li>
				<p id="faq6">Yes. We will be buying singles, sealed product, and other Yu-Gi-Oh! products soon. However, we are currently not buying at the moment.</p>
				<li onClick="faqclick('faq7')">I want to cancel my order. How can I do that?</li>
				<p id="faq7">When looking at your order details, select the "Cancellation Request Form" option and simply fill out the form. </p>
			</ul>
		</div>
    </body>
            <?php
			  require '../resources/top_bar.php';
              require '../resources/footer.php';?>
</html>