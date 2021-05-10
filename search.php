<?php
session_start();
if(isset($_GET["cat"]) and ctype_alpha($_GET["cat"]) and strlen($_GET["cat"])<20){
    $cat=$_GET["cat"];
}else{
    $cat=null;
};
$keys=file_get_contents("./keys.json",true);
$dbAcess=json_decode($keys,true)["databaseAcess"];
$mysqli=new mysqli("localhost",$dbAcess["username"],$dbAcess["password"],"ptitips");
if($mysqli->connect_error){
    die("Connection failed: ".$mysqli->connect_error);
};
$mysqli->set_charset('utf8mb4');
$catoptions=["recette","bricolage","administratif","quotidien","autre"];
if(isset($cat) && $cat!=null && in_array($cat,$catoptions)){
    $request=$mysqli->prepare("SELECT `idArticle`, `titre`, `medias` FROM `article` WHERE `type`=? ORDER BY `date`");
    $request->bind_param("s",$cat);
    $request->execute();
    $result=$request->get_result();
}else{
    $result=$mysqli->query("SELECT `idArticle`, `titre`, `medias` FROM `article` ORDER BY `date`");
};
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
                    echo "<a class=\"nav-item nav-item--text\" href=\"test.html\">CHAT</a>";
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
        <main class="searchpage">

            <div class="content-item card-wrap card-wrap--big">
                <?php
                foreach($articles as &$item){
                    echo "<a href=\"article.php?art={$item['idArticle']}\" class='card'><div>";
                    $cover=json_decode($item['medias'])->cover;
                    echo "<div class='card__img'><img src=\"images/{$cover}\" alt=\"{$item['titre']}\"/></div>";
                    echo "<div class='card__text'><h1>{$item['titre']}</h1></div></div></a>";
                }
                ?>
            </div>
        </main>
        <footer>
            <form id="newsletter" action="newsletter.php" method="POST" target="_self">
                <h2>Newsletter</h2>
                <p>Si tu veux être au courant des dernières infos et articles, inscris-toi à notre newsletter&#8239;!<br/>
                Promis on va pas spammer...</p>
                <div class="newsletter__email">
                    <input id="nl-email__field" type="email" name="nl-email" placeholder="Email"/>
                    <input id="nl-email__submit" type="submit" name="nl-submit" value="Go&#8239;!">
                </div>
            </form>
            <nav class="about">
                <a href="/about-us">about us <img src="/favicons/amogus.png" height=10 alt=""/></a>
                <a href="/plan.html">plan du site</a>
            </nav>
        </footer>
        <script src="common.js"></script>
    </div></body>
</html>