<?php 
session_start();
$keys=file_get_contents("./keys.json",true);
$dbAcess=json_decode($keys,true)["databaseAcess"];
$mysqli=new mysqli("localhost",$dbAcess["username"],$dbAcess["password"],"ptitips");
if($mysqli->connect_error){
    die("Connection failed: ".$mysqli->connect_error);
};
$mysqli->set_charset('utf8mb4');
$result=$mysqli->query("SELECT `idArticle`, `titre`, `medias` FROM `article` ORDER BY `date` LIMIT 6;");
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
        <!-- <base href="localhost" target="_blank"> -->
        <link rel="icon" type="image/png" sizes="32x32" href="/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicons/favicon-16x16.png">
    </head>
    <body><div class="content gradient">
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
            <div class="content-item content-item--white">
                <h1>Besoin d'un p'tit tips?</h1>
            </div>
            <div class="content-item content-item--white">
                <p>Bienvenue sur la plateforme dédiée à vous aider dans les débuts de votre vie autonome&#8239;!<br/>
                Que vous sortiez fraîchement de Parcoursup, ou que vous rentriez dans votre vie de jeune actif 
                (&nbsp;félicitations pour votre job ;)&nbsp;), nous sommes les experts des bons plans et astuces 
                pour vous sauver dans votre autonomie et surtout pour vous accompagner tout au long de votre 
                cursus. Ici, vous pourrez échanger autant que vous le souhaitez avec des personnes dans la 
                même situation que vous, pour discuter et s'entraider.</p>
            </div>
            <div class="content-item">
                <button class="button--big" onclick="window.location.href='register.php';">C'est Parti !</button>
            </div>
            <div class="content-item">
                <p>&Agrave; votre inscription, vous avez la posibilité de renseigner votre lieu d'étude afin 
                de pouvoir être mis en relation avec des gens de votre université ou école. Vous pourrez 
                ainsi faire plus ample connaissance avec vos futurs amis en vrai&#8239;! Ce qui peut vous 
                permettre aussi de trouver des colocs ou, en temps de Covid, de se sentir un peu moins seul...<br/>
                Vous trouverez sur notre site plusieures rubriques, qui vous redirigeront notamment vers 
                des recettes, des tutos de bricolage, une page d'aide à l'administratif, et une page qui 
                concerne la gestion de vos tâches quotidiennes : budget, liste de courses, etc...</p>
            </div>
            <div class="content-item card-wrap">
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
                <p>Si tu veux être au courant des dernières infos et articles, inscris-toi à notre newsletter&#8239;!<br/>Promis on va pas spammer...</p>
                <div class="newsletter__email">
                    <input id="nl-email__field" type="email" name="nl-email" placeholder="Email"/>
                    <input id="nl-email__submit" type="submit" name="nl-submit" value="Go&#8239;!">
                    <!-- pattern="(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*)@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?)" -->
                </div>
            </form>
            <nav class="about">
                <a href="about-us.php">about us <img src="/favicons/amogus.png" height=10 alt=""/></a>
                <a href="sitemap.php">plan du site</a>
            </nav>
        </footer>
        <script src="common.js"></script>
        <script>
            if(document.querySelector('.content-item--white')!==null && (window.location.pathname=='/' || window.location.pathname=='/index.php')){
                let whiteContent=document.querySelectorAll('.content-item--white');
                window.addEventListener('resize',(event)=>{
                    console.log(window.innerWidth,whiteContent[0].clientHeight+whiteContent[1].clientHeight);
                },once=false);
            };
        </script>
    </div></body>
</html>