<?php

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
    <body>
        <div class="main-wrap gradient">
            <header>
                <nav class="nav nav--left">
                    <a class="nav-item nav-item--logo" href="/">
                        <img class="logo" src="favicons/logo.png" height=70 alt="Ptitips"/>
                    </a>
                    <a class="nav-item nav-item--text" href="test.html">NEWS</a>
                    <div class="nav-item" id="tips">
                        <a class="nav-item nav-item--text" href="test.html">TIPS</a>
                        <ul class="nav-item__hover" id="tipshover">
                            <li><a href="test.html">Cuisine</a></li>
                            <li><a href="test.html">Bricolage</a></li>
                            <li><a href="test.html">Administration</a></li>
                            <li><a href="test.html">Tâches Quotidiennes</a></li>
                            <li><a href="test.html">Autres</a></li>
                        </ul>
                    </div>
                    <a class="nav-item nav-item--text" href="test.html" style="display: none;">CHAT</a>
                </nav>
                <nav class="nav nav--right">
                    <div class="nav-item" id="usericon">
                        <a class ="nav-item nav-item--logo" href="register.php"><img src="favicons/userw.png" alt="Inscription"/></a>
                        <ul class="nav-item__hover" id="usericonhover">
                            <li><a href="register.php">Inscription</a></li>
                            <li><a href="login.php">Connexion</a></li>
                        </ul>
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
                    <button class="button--big" onclick="window.location.href='test.html';">C'est Parti !</button>
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
                    <a href="article.php?article=48077208" class="card">
                        <div>
                            <div class="card__img"><img src="images/8a9.jpg" alt="harold"/></div>
                            <div class="card__text"><h1>10 astuces joie et bonne humeur</h1><p>Comment être heureux et éviter le suicide</p></div>
                        </div>
                    </a>
                    <a href="article.php?article=21162139" class="card">
                        <div>
                            <div class=card__img><img src="images/EfjF3oRn.jpg" alt="healthy dish image"/></div>
                            <div class="card__text"><h1>5 astuces pâté</h1><p>Existe aussi pour les végans !</p></div>
                        </div>
                    </a>
                    <a href="article.php?article=59972036" class="card">
                        <div>
                            <div class=card__img><img src="images/SDFGH.jpg" alt="clebs"/></div>
                            <div class="card__text"><p>Plus de 990255734 astuces sur les teckels</p></div>
                        </div>
                    </a>
                    <a href="article.php?article=62417654" class="card">
                        <div>
                            <div class=card__img><img src="images/IMG_0935.JPG" alt="vendre"/></div>
                            <div class="card__text"><p>Vendre ses talents en situation de retrutement</p></div>
                        </div>
                    </a>
                    <a href="article.php?article=40227636" class="card">
                        <div>
                            <div class=card__img><img src="images/IMG_1281.JPG" alt="exam"/></div>
                            <div class="card__text"><p>Réussir ses révisions</p></div>
                        </div>
                    </a>
                    <a href="article.php?article=64845667" class="card">
                        <div>  
                            <div class=card__img><img src="images/IMG_0838.jpg" alt="clodo"/></div>
                            <div class="card__text"><h1>Gérer ses finances</h1><p>Ou comment ne pas finir à la rue</p></div>
                        </div>
                    </a>
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
        </div>
        <script src="common.js"></script>
        <script>
            // if(document.querySelector('.content-item--white')!==null && document.querySelector('.main-wrap')!==null && (window.location.pathname=='/' || window.location.pathname=='/index.php')){
            //     let whiteContentHeight=document.querySelector('.content-item--white').clientHeight;
            //     let mainWrap=document.querySelector('.main-wrap');
            //     mainWrap.setAttribute('grad-height',whiteContentHeight+'px');
            //     window.addEventListener('resize',(event)=>{
            //         let whiteContentHeight=document.querySelector('.content-item--white').clientHeight;
            //         mainWrap.setAttribute('grad-height',whiteContentHeight+'px');
            //     },once=false);
            // };
        </script>
    </body>
</html>