<?php
session_start();
$keys=file_get_contents("./keys.json",true);
$dbAcess=json_decode($keys,true)["databaseAcess"];
$mysqli=new mysqli("localhost",$dbAcess["username"],$dbAcess["password"],"ptitips");
if($mysqli->connect_error){
    die("Connection failed: ".$mysqli->connect_error);
};
$mysqli->set_charset('utf8mb4');
$catoptions=["recette","bricolage","administratif","quotidien","autre"];
$result=$mysqli->query("SELECT `idArticle`, `titre`, `medias` FROM `article` ORDER BY `date`");
$mysqli->close();
if($result!=false and $result->num_rows>0){
    $articles=array();
    while($row=$result->fetch_assoc()){
        array_push($articles,$row);
    };
}else{
    $articles=[];
};
?>
<!DOCTYPE html>
<html lang='fr'>
    <head>
        <meta charset='utf-8'/>
        <link rel='stylesheet' href='style.css'/>
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
        <main>
            <div class="content-item sitemap">
            <ul>
                <li><a href="/">Homepage</a></li>
                <ul>
                    <li><a href="about-us.php">About us</a></li>
                    <li><span>Articles</span></li>
                    <ul>
                    <?php
                    foreach($articles as &$item){
                        $maj=ucFirst($item['titre']);
                        echo "<li><a href=\"article.php?art={$item['idArticle']}\">{$maj}</a></li>";
                    };
                    ?>
                    </ul>
                    <li><a href="search.php">Recherche</a></li>
                    <ul>
                    <?php
                    foreach($catoptions as &$item){
                        $maj=ucFirst($item);
                        echo "<li><a href=\"search.php?cat={$item}\">{$maj}</a></li>";
                    };
                    ?>
                    </ul>
                    <li><a href="register.php">Inscription</a></li>
                    <li><a href="login.php">Connexion</a></li>
                    <ul>
                        <li><a href="profile.php">Profil</a></li>
                        <li><a href="chat.php">Chat</a></li>
                        <li><a href="disconnect.php">Déconnexion</a></li>
                    </ul>
                    <li><a href="error.php">Erreur</a></li>
                    <li><a href="sitemap.php">Plan du site</a></li>
                </ul>
            </ul>
            </div>
        </main>
        <footer>
            <nav class="about">
                <a href="about-us.php">about us <img src="/favicons/amogus.png" height=10 alt=""/></a>
                <a href="sitemap.php">plan du site</a>
            </nav>
        </footer>
        <script src="common.js"></script>
    </div></body>
</html>