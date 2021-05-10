<!DOCTYPE html>
<html lang='fr'>
    <head>
        <meta charset='utf-8'/>
        <link rel='stylesheet' href='style.css'/>
        <title>Ptitips</title>
        <!-- <base href="localhost" target="_blank"> -->
        <link rel="icon" type="image/png" sizes="32x32" href="/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicons/favicon-16x16.png">
        <script>
            function nlAlert(email){
                if(email){
                    alert('A verification email have been sent to'+email);
                }else{
                    alert('Invalid email, please retry...');
                };
            }
        </script>
    </head>
    <body><div class="content">
        <header>
            <!-- #include file="include_head.html" -->
            <nav class="nav nav--left">
                <a class="nav-item nav-item--logo" href="index.html">
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
        <main>
            <div class="content-item">
                <h1>Besoin d'un p'tit tips?</h1>
                <p>&Agrave; votre inscription, vous avez la posibilité de renseigner votre lieu d'étude afin 
                de pouvoir être mis en relation avec des gens de votre université ou école. Vous pourrez 
                ainsi faire plus ample connaissance avec vos futurs amis en vrai&#8239;! Ce qui peut vous 
                permettre aussi de trouver des colocs ou, en temps de Covid, de se sentir un peu moins seul...<br/>
                Vous trouverez sur notre site plusieures rubriques, qui vous redirigeront notamment vers 
                des recettes, des tutos de bricolage, une page d'aide à l'administratif, et une page qui 
                concerne la gestion de vos tâches quotidiennes : budget, liste de courses, etc...</p>
            </div>
            <div class="content-item card-wrap">
                <a href="test.html"><div class="card">
                    <div class="card__img"><img src="images/8a9.jpg" alt="harold"/></div>
                    <div class="card__text"><h1>10 astuces joie et bonne humeur</h1><p>Comment être heureux et éviter le suicide</p></div>
                </div></a>
                <a href="test.html"><div class="card">
                    <div class=card__img><img src="images/20501.jpg" alt="healthy dish image"/></div>
                    <div class="card__text"><h1>5 astuces pâté</h1><p>Existe aussi pour les végans !</p></div>
                </div></a>
                <a href="test.html"><div class="card">
                    <div class=card__img><img src="images/SDFGH.jpg" alt="clebs"/></div>
                    <div class="card__text"><p>Plus de 990255734 astuces sur les teckels</p></div>
                </div></a>
                <a href="test.html"><div class="card">
                    <div class=card__img><img src="images/IMG_0935.JPG" alt="vendre"/></div>
                    <div class="card__text"><p>Vendre ses talents en situation de retrutement</p></div>
                </div></a>
                <a href="test.html"><div class="card">
                    <div class=card__img><img src="images/IMG_1281.JPG" alt="exam"/></div>
                    <div class="card__text"><p>Réussir ses révisions</p></div>
                </div></a>
                <a href="test.html"><div class="card">  
                    <div class=card__img><img src="images/IMG_0838.jpg" alt="clodo"/></div>
                    <div class="card__text"><h1>Gérer ses finances</h1><p>Ou comment ne pas finir à la rue</p></div>
                </div></a>
            </div>
            <div class="content-item">
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
                <a href="#">about us <img src="/favicons/amogus.png" height=10 alt=""/></a>
                <a href="/plan.html">plan du site</a>
            </nav>
        </footer>
        <script src="/common.js"></script>
    </div></body>
</html>