<div class="main-grid-layout sidebarContainer">
    <div style="padding-top: 10px" class="sidebarContent">Content</div>
    <div class="sidebarContentText">
        <div>
            <div class="sidebarContentTextStyle">
                <a href="/homePage.php">Profile</a>
            </div>
            <div class="sidebarContentTextStyle">
                <a href="/homePage.php">Friends</a>
            </div>
            <div class="sidebarContentTextStyle">
                <a href="/homePage.php">Massages</a>
            </div>
            <div style="text-align: center;margin-top: 1vh;margin-bottom: -15vh">
                <a href="/homePage.php">Your Posts</a>
            </div>
        </div>
    </div>
    <div style="padding-top: 10px" class="sidebarSettings">Settings</div>
    <div class="sidebarSettingsText">
        <div class="sidebarContentText">
            <div>
                <div class="sidebarContentTextStyle">
                    <?php
                    $user = $_SESSION['username'];
                    if (isset($_SESSION['username'])) {
                        echo '<a href="/User/userSettings.php">User Settings</a>';
                    } else {
                        echo '<a href="/User/login.php">User Settings</a>';
                    }
                    ?>
                </div>
                <div class="sidebarContentTextStyle">
                    <a href="/homePage.php">Help Center</a>
                </div>
                <div style="text-align: center;margin-top: 1vh;margin-bottom: -15vh">
                    <a href="/User/sighOut.php">Sign Out</a>
                </div>
            </div>
        </div>
    </div>
</div>