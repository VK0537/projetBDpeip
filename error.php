<?php
session_start();
if(isset($_GET['err']) and ctype_digit($_GET['err']) and strlen($_GET['err'])===3){
    $errorcode=$_GET['err'];
}else{
    $errorcode='404';
}
?>
<!DOCTYPE html>
<html lang='fr'>
    <head>
        <meta charset='utf-8'/>
        <link rel='stylesheet' href='http://localhost/style.css'/>
        <title>Ptitips</title>
        <link rel="icon" type="image/png" sizes="32x32" href="/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicons/favicon-16x16.png">
    </head>
    <body><div class="content">
        <header>
            <nav class="nav nav--left">
                <a class="nav-item nav-item--logo" href="/">
                    <img class="logo" src="favicons/logo.png" height=70 alt="Ptitips"/>
                </a>
                <a class="nav-item nav-item--text" href="test.html">NEWS</a>
                <div class="nav-item" id="tips">
                    <a class="nav-item nav-item--text" href="search">TIPS</a>
                    <ul class="nav-item__dropdown" id="tipshover">
                        <li><a href="search?cat=recette">Cuisine</a></li>
                        <li><a href="search?cat=bricolage">Bricolage</a></li>
                        <li><a href="search?cat=administratif">Administration</a></li>
                        <li><a href="search?cat=quotidien">Tâches Quotidiennes</a></li>
                        <li><a href="search?cat=autre">Autres</a></li>
                    </ul>
                </div>
                <?php
                if(isset($_SESSION['logged']) && $_SESSION['logged'] ){
                    echo "<a class=\"nav-item nav-item--text\" href=\"chat.php\">CHAT</a>";
                }
                ?>
            </nav>
            <nav class="nav nav--right">
                <div class="nav-item" id="usericon">
                    <?php
                    if(isset($_SESSION['logged']) && $_SESSION['logged'] ){
                        echo "<a class =\"nav-item nav-item--logo\" href=\"profile.php\"><img src=\"favicons/userw.png\" alt=\"Profil\"/></a>";
                        echo "<ul class=\"nav-item__dropdown\" id=\"usericonhover\">";
                        echo "<li><a href=\"profile.php\">Profil</a></li>";
                        echo "<li><a href=\"disconnect.php\">Déconnexion</a></li>";
                        echo "</ul>";
                    }else{
                        echo "<a class =\"nav-item nav-item--logo\" href=\"register.php\"><img src=\"favicons/userw.png\" alt=\"Inscription\"/></a>";
                        echo "<ul class=\"nav-item__dropdown\" id=\"usericonhover\">";
                        echo "<li><a href=\"register.php\">Inscription</a></li>";
                        echo "<li><a href=\"login.php\">Connexion</a></li>";
                        echo "</ul>";
                    }
                    ?>
                </div>
                <form class="nav-item nav-item--searchbar" action="#" method="GET" name="searchbar">
                    <input type="text" id="searchbar" name="search" placeholder="Search"/>
                </form>
            </nav>
        </header>
        <main id="container">
            <div class="ball" speed="1" style="top:100px;left:100px;color:rgb(255, 0, 0);"><?php echo $errorcode; ?></div>
            <!--<div class="content-item">
                <p id="error-code"</p>
            </div>-->
            <div class="content-item">
                <p">Tu semble égaré... Voici <a href="https://www.youtube.com/embed/dQw4w9WgXcQ" style="color:#FFC600">un lien</a> qui pourra peut être t'aider... <br/>
                Tu peux aussi essayer le <a href="sitemap.php" style="color:#FFC600">plan du site</a>...</p>
            </div>
        </main>
        <footer>
            <nav class="about">
                <a href="about-us.php">about us <img src="/favicons/amogus.png" height=10 alt=""/></a>
                <a href="sitemap.php">plan du site</a>
            </nav>
        </footer>
        <script src="http://localhost/common.js"></script>
        <script src="http://localhost/error.js"></script>
    </div></body>
</html>