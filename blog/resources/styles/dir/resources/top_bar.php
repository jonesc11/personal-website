<script type="text/javascript" src="/resources/js/drop.js"></script>
<div id="account-info" onmouseout="raise()" onmouseover="drop()">
    <?php
        if(empty($_SESSION['user'])) {
            echo '<a href="/account/login">Sign In</a><br/>';
            echo '<a href="/shop/cart" title="View Cart" id="cart">View Cart</a><br/>';
            echo '<a href="/account/create" id="create">Create An Account</a>';
        } else {
            echo '<a href="/account">Welcome, '.$_SESSION['user']['firstname'].'!</a><br/>';
            echo '<a href="/shop/cart" title="View Cart" id="cart">View Cart</a><br/>';
            echo '<a href="/logout.php" id="create">Logout</a>';
        }
    ?>
    <div id="dropdown"><a><img id="dropimage"onmouseover="drop()"src="/resources/images/tmpdrop.png"/></a></div>
</div>

<div id="menu-bar"><ul>
    <li><a href="/">Home</a></li>
    <li><a href="/shop/flags">Shop</a></li>
    <li><a href="/team">Our Team</a></li>
    <li><a href="/faq">FAQ</a></li>
    <li><a href="/contact">Contact Us</a></li>
    
</ul></div>
<div id="logo">
    <a href = "/"><img src="/resources/images/CardOverflowLogo.png" alt="Card Overflow"/></a>
</div>
