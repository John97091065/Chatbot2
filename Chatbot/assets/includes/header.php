<?php
    session_start();
?>

<header>
    <div class="home"><h3><a href="./">DigiDave</a></h3></div>
    <input type="search" name="group" placeholder="search group" style="width: 300px; height: 30px; border-radius: 20px;">
    <nav>
        <ul>
            <li><a href="#">news</a></li>
            <li><a href="#">documentatie</a></li>
            <li><a href="#">Contact</a></li>
            <?php
                if ($_SESSION) {
                    if ($_SESSION["username"]) {
                        print("<li><a href='p/logout.php'>Logout</a></li>");
                    } 
                } else {
                    print("<li><a href='p/'>Login</a></li>");
                }
                
            ?>
        </ul>
    </nav>
</header>