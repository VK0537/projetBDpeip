<?php
session_start();
if(isset($_POST['reg-submit'])){
    $_SESSION['reg-username']=$_POST['reg-username'];
    $_SESSION['reg-lname']=$_POST['reg-lname'];
    $_SESSION['reg-name']=$_POST['reg-name'];
    $_SESSION['reg-email']=strtolower($_POST['reg-email']);
    $_SESSION['reg-password']=$_POST['reg-password'];
    $_SESSION['reg-age']=$_POST['reg-age'];
    $_SESSION['reg-ville']=$_POST['reg-ville'];
    $_SESSION['reg-domaine']=$_POST['reg-domaine'];
    header('Location:register.php');
    exit;
};
if(isset($_SESSION['reg-domaine'])){
    $username=$_SESSION['reg-username'];
    $lname=$_SESSION['reg-lname'];
    $name=$_SESSION['reg-name'];
    $email=$_SESSION['reg-email'];
    $password=$_SESSION['reg-password'];
    $age=$_SESSION['reg-age'];
    $ville=$_SESSION['reg-ville'];
    $domaine=$_SESSION['reg-domaine'];

    if(!empty($username) and !empty($lname) and !empty($name) and !empty($email) and !empty($password) and !empty($age)){
        if(!ctype_alnum($username)){
            //mettre la box en rouge
            echo '<script>alert("le nom d\'utilisateur renseigné est invalide");</script>';
        }elseif(!ctype_alpha($lname)){
            echo '<script>alert("le nom renseigné est invalide");</script>';
        }elseif(!ctype_alpha($name)){
            echo '<script>alert("le prénom renseigné est invalide");</script>';
        }elseif(!ctype_digit($age)){
            echo '<script>alert("l\'age renseigné est invalide");</script>';
        }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo '<script>alert("l\'email renseigné est invalide");</script>';
        }elseif(strlen($password)<8 or 
                !preg_match('/[0-9]+/',$password) or 
                !preg_match('/[a-z]+/',$password) or 
                !preg_match('/[A-Z]+/',$password) or 
                !preg_match('/[\W]+/',$password)){
            echo '<script>alert("Le mot de passe doit contenir 8 charactères dont : une lettre majuscule, une minuscule, un chiffre et un symbole");</script>';
        }else{
            $mysqli=new mysqli("localhost","ptitipsadmin","dCvvcttP]LZ=BHh","ptitips");
            if ($mysqli->connect_error) {
                die("Connection failed: ".$mysqli->connect_error);
            };
            $mysqli->set_charset('utf8mb4');
            // id , nom , prenom , pseudo , email , isAdmin , dob , idVille , idDomaine , idNews
            //$mysqli->query("INSERT INTO utilisateur VALUES ('".$mysqli->real_escape_string())
        }
    }else{
        echo '<script>alert("L\'un des champs requis est vide");</script>';
    };
    unset($_SESSION['reg-username']);
    unset($_SESSION['reg-lname']);
    unset($_SESSION['reg-name']);
    unset($_SESSION['reg-email']);
    unset($_SESSION['reg-password']);
    unset($_SESSION['reg-age']);
    unset($_SESSION['reg-ville']);
    unset($_SESSION['reg-domaine']);
}
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
        <div class="main-wrap">
            <header class="header">
                <!-- #include file="include_head.html" -->
                <nav class="nav nav--left">
                    <a class="nav-item nav-item--logo" href="index.html">
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
                        <label for="reg-username">Nom d'utilisateur : </label>
                        <input id="reg-username" type="text" placeholder="pseudo" pattern="\w{2,20}" name="reg-username" required>
                    </div>
                    <div class="register-field">
                        <label for="reg-email">Adresse email : </label>
                        <input id="reg-email" type="email" placeholder="email" name="reg-email" required>
                    </div>
                    <div class="register-field">
                        <label for="reg-lname">Nom : </label>
                        <input id="reg-lname" type="text" placeholder="nom" pattern="\w{2,20}" name="reg-lname" required>
                    </div>
                    <div class="register-field">
                        <label for="reg-name">Prénom : </label>
                        <input id="reg-name" type="text" placeholder="prénom" pattern="\w{2,20}" name="reg-name" required>
                    </div>
                    <div class="register-field">
                        <label for="reg-password">Mot de passe : </label>
                        <input id="reg-password" type="password" placeholder="mot de passe" name="reg-password" 
                        required title="doit contenir 8 charactères dont : une lettre majuscule, une minuscule, un chiffre et un symbole" 
                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{8,}">
                    </div>
                    <div class="register-field">
                        <label for="reg-age">Age : </label>
                        <input id="reg-age" type="text" placeholder="Age" pattern="\d{2}" name="reg-age" required>
                    </div>
                    <div class="register-field">
                        <label for="reg-ville">Ville : </label>
                        <input id="reg-ville" type="text" placeholder="Ville" pattern="[a-zA-Z]{0,30}" name="reg-ville" list="villes">
                        <datalist id="villes">
                            <option value="Tours">Tours</option>
                            <option value="Paris">Paris</option>
                            <!-- api google maps -->
                        </datalist>
                    </div>
                    <div class="register-field">
                        <label for="reg-domaine">Domaine de Formation ou d'Activité : </label>
                        <!-- <input id="reg-domaine" type="text" placeholder="Domaine de Formation et d'activité" pattern="{2,20}" name="domaine"> -->
                        <select name="reg-domaine" id="reg-domaine">
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
                    <input id="reg-submit" type="submit" name="reg-submit" value="INSCRIPTION" >
                    <a id='connectinstead' href="/connexion.html">Connexion</a>
                </form>
            </main>
            <footer>
                <form id="newsletter" action="newsletter.php" method="POST" target="_self">
                    <h2>Newsletter</h2>
                    <p>Si tu veux être au courant des dernierres infos et articles, inscris-toi à notre newsletter&#8239;!<br/>Promis on va pas spammer...</p>
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