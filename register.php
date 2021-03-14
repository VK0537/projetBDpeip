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
        <div class="main-wrap">
            <header class="header">
                <!-- #include file="include_head.html" -->
                <nav class="nav nav--left">
                    <a class="nav-item nav-item--logo" href="index.html">
                        <img class="logo" src="favicons/logo.png" height="70" alt="Ptitips"/>
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
                    <a class="nav-item nav-item--text" href="test.html">CHAT</a>
                </nav>
                <nav class="nav nav--right">
                    <a class ="nav-item nav-item--logo" href="register.php"><img src="favicons/userw.png" alt="Connexion"/></a>
                    <form class="nav-item nav-item--searchbar" action="#" method="GET" name="searchbar">
                        <input type="text" id="searchbar" name="search" placeholder="Search"/>
                    </form>
                </nav>
            </header>
            <main>
                <form id="register" action="#" method="POST" target="_self">
                    <h2>Inscription</h2>
                    <div class="register-field">
                        <label for="username">Nom d'utilisateur : </label>
                        <input id="username" type="text" placeholder="nom d'utilisateur" pattern="\w{2,20}" name="username" required>
                    </div>
                    <div class="register-field">
                        <label for="email">Adresse email : </label>
                        <input id="email" type="email" placeholder="email" name="email" required>
                    </div>
                    <div class="register-field">
                        <label for="password">Mot de passe : </label>
                        <input name="password" type="password" placeholder="mot de passe" 
                        pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$" name="password" 
                        required title="doit contenir une lettre, un chiffre et un caractère spécial">
                    </div>
                    <div class="register-field">
                        <label for="age">Age : </label>
                        <input id="age" type="text" placeholder="Age" pattern="\d{2}" name="age" required>
                    </div>
                    <div class="register-field">
                        <label for="lieu">Lieu d'études : </label>
                        <input id="lieu" type="text" placeholder="Lieu d'etude" pattern="[a-zA-Z]{0,30}" name="lieu">
                    </div>
                    <div class="register-field">
                        <label for="formation">Formation : </label>
                        <!-- <input id="formation" type="text" placeholder="Formation" pattern="{2,20}" name="formation"> -->
                        <select name="formation" id="formation">
                            <option value="">Choisir un domaine</option>
                            <option value="1">agriculture, animalier</option>
                            <option value="2">armée, sécurité</option>
                            <option value="3">arts, culture, artisanat</option>
                            <option value="4">banque, assurances,immobilier</option>
                            <option value="5">commerce, marketing, vente</option>
                            <option value="6">construction, architecture, travaux publics</option>
                            <option value="7">économie, droit, politique</option>
                            <option value="8">électricité, électronique, robotique</option>
                            <option value="9">environnement, énergies, propreté</option>
                            <option value="10">gestion des entreprises, comptabilité</option>
                            <option value="11">histoire/géographie, psychologie, sociologie</option>
                            <option value="12">hôtellerie, restauration, tourisme</option>
                            <option value="13">information, communication, audiovisuel</option>
                            <option value="14">informatique, internet</option>
                            <option value="15">lettres, langues, enseignement</option>
                            <option value="16">logistique, transport</option>
                            <option value="17">fabrication, industrie, matières premières</option>
                            <option value="18">mécanique</option>
                            <option value="19">santé, social</option>
                            <option value="20">sciences</option>
                            <option value="21">sport</option>
                        </select>
                    </div>
                    <input id="submit" type="submit" value="LOGIN" >
                    <a href="/connexion.html">Connexion</a>
                </form>
            </main>
            <footer>
                <form id="newsletter" action="newsletter.php" method="POST" target="_self">
                    <h2>Newsletter</h2>
                    <p>Si tu veux être au courant des dernierres infos et articles, inscris-toi à notre newsletter&#8239;!</br>Promis on va pas spammer...</p>
                    <div class="newsletter__email">
                        <input id="nl-email__field" type="email" name="nl-email" placeholder="Email"/>
                        <input id="nl-email__submit" type="submit" name="nl-submit" value="Go&#8239;!">
                        <!-- pattern="(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*)@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?)" -->
                    </div>
                </form>
                <nav class="about">
                    <a href="#">about us <img src="/favicons/amogus.png" height="10px"/></a>
                    <a href="/plan.html">plan du site</a>
                </nav>
            </footer>
        </div>
        <script>
            if(document.getElementById('tips')!==null && document.getElementById('tipshover')!==null){
                let tips=document.getElementById('tips')
                tips.addEventListener("mouseover",(event)=>{
                    document.getElementById('tipshover').style.display='block'
                });
                tips.addEventListener("mouseout",(event)=>{
                    document.getElementById('tipshover').style.display='none'
                });
            };
            if(document.querySelector('.content-item--white')!==null && document.querySelector('.main-wrap')!==null && window.location.pathname=='/'){
                let whiteContentHeight=document.querySelector('.content-item--white').clientHeight;
                let mainWrap=document.querySelector('.main-wrap');
                mainWrap.setAttribute('grad-height',whiteContentHeight+'px');
                window.addEventListener('resize',(event)=>{
                    let whiteContentHeight=document.querySelector('.content-item--white').clientHeight;
                    console.log(whiteContentHeight+'px');
                    mainWrap.setAttribute('grad-height',whiteContentHeight+'px');
                },once=false);
            };
        </script>
    </body>
</html>