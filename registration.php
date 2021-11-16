<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="Styles.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration</title>
</head>
<body>
<div class="main-grid-layout container">

    <!--Kontajner pre Header-->
    <div class="main-grid-layout header">
        <a href="homePage.php" class="design head">Home</a>
        <a href="menu.php" class="design head2">Menu</a>
        <a href="login.php" class="design head3">Login</a>
        <a href="registration.php" class="design head5">Registration</a>
        <a href="contact.php" class="design head4">Contact</a>
    </div>

    <!--Kontajner pre Register-->
    <div class="main-grid-layout box1Container" style="text-align: center;max-width: 70%;margin-left: 15%">
        <div style="padding-top: 10px" class="nameOfBox1">Registration</div>
        <div class="box1Text">
            <div class="fillWindows register">
                <form action="#">
                    <div>
                        <label>
                            <input type="text" placeholder="Username" required minlength="6"
                                   maxlength="15">
                        </label>
                    </div>
                    <div>
                        <label>
                            <input type="email" placeholder="Email Address" required minlength="6">
                        </label>
                    </div>
                    <div>
                        <label>
                            <input type="password" placeholder="Password" required minlength="6">
                        </label>
                    </div>
                    <div>
                        <label>
                            <input type="password" placeholder="Password Confirmation" required minlength="6">
                        </label>
                    </div>
                    <div>
                        <button type="submit">Register</button>
                    </div>
                    <div>
                        <label>
                            <input type="checkbox" checked="checked" name="remember"><a style="margin-left: 1%;"
                                                                                        href="registration.php">Accepting
                            terms and conditions</a>
                        </label>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Kontajner pre Login-->
    <div class="main-grid-layout box2Container" style="text-align: center;max-width: 70%;margin-left: 15%">
        <div class="nameOfBox2" style="padding-top: 10px"><a
                href="login.php"><span>already have an account? log in</span></a></div>
    </div>

    <!--SearchBar-->
    <div class="design search">
        <form action="#">
            <label>
                <input type="text"
                       placeholder=" Search.."
                       name="search">
            </label>
        </form>
    </div>

    <!--Kontajner pre Sidebar-->
    <div class="main-grid-layout sidebarContainer">
        <div style="padding-top: 10px" class="sidebarContent">Content</div>
        <div class="sidebarContentText">
            <div>
                <div class="sidebarContentTextStyle">
                    <a href="homePage.php">Profile</a>
                </div>
                <div class="sidebarContentTextStyle">
                    <a href="homePage.php">Friends</a>
                </div>
                <div class="sidebarContentTextStyle">
                    <a href="homePage.php">Massages</a>
                </div>
                <div style="text-align: center;margin-top: 1vh;margin-bottom: -15vh">
                    <a href="homePage.php">Your Posts</a>
                </div>
            </div>
        </div>
        <div style="padding-top: 10px" class="sidebarSettings">Settings</div>
        <div class="sidebarSettingsText">
            <div class="sidebarContentText">
                <div>
                    <div class="sidebarContentTextStyle">
                        <a href="homePage.php">User Settings</a>
                    </div>
                    <div class="sidebarContentTextStyle">
                        <a href="homePage.php">Help Center</a>
                    </div>
                    <div style="text-align: center;margin-top: 1vh;margin-bottom: -15vh">
                        <a href="homePage.php">Sign Out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Reklamy-->
    <div class="design ads">
        <a href="homePage.php"><img src="Resources/ads.jpg" alt=""></a>
    </div>
    <div class="design footer">Footer</div>

</div>
</body>
</html>