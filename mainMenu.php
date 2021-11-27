<?php //include "newSession.php"; ?>
<?php session_start(); ?>

<div class="main-grid-layout header">
    <a href="homePage.php" class="design head">Home</a>
    <a href="menu.php" class="design head2">Menu</a>
    <?php
    $user = $_SESSION['username'];
    if (isset($_SESSION['username'])) {
        echo '<a href="login.php" class="design head3">'.$user.'</a>';
    } else {
        echo '<a href="login.php" class="design head3">Login</a>';
        echo '<a href="registration.php" class="design head5">Registration</a>';
    }
    ?>
    <a href="contact.php" class="design head4">Contact</a>
</div>

<div class="design search">
    <form action="#">
        <label>
            <input type="text"
                   placeholder=" Search.."
                   name="search">
        </label>
    </form>
</div>