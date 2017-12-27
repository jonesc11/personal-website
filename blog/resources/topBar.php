<?php require_once('openSQL.php'); echo "hi"; ?>
<div id="top-bar">
    <ul>
        <li><a href="/" title="Blog Home">Blog Home</a></li>
        <?php
            $query = "SELECT * FROM `categories`;";
            $statement = $db->prepare($query);
            $statement->execute();                        $i = 0;
            
            while (($row = $statement->fetch()) && $i < 5) {                if ($row['active']) {
                    echo '<li><a href="' . $row['path'] . '" title="' . $row['name'] . '">' . $row['name'] . '</a></li>';                    $i++;                }
            }                        if ($i == 5 && $row = $statement->fetch(PDO::FETCH_ASSOC)) {                echo "<li><a href=\"/category_directory\" title=\"All categories...\">All categories...</a></li>";            }                        if (isset($_SESSION['user'])) {                echo "<li id=\"account-button\"><a href=\"/account\" title=\"View Account\">Welcome, " . $_SESSION['firstname'] . "!</a></li>";            } else {                echo "<li id=\"account-button\"><a href=\"/account/login\" title=\"Login\">Login</a></li>";            }
        ?>
    </ul>
</div>