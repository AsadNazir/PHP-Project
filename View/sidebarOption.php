
<?php

$isAdmin = $_SESSION["isAdmin"];


echo '<li><a class="<?php if ($_SERVER["PATH_INFO"] == "/register") {
    echo "active_sidebar";
}

?>" href="register">Add Animal</a></li>'

?>


