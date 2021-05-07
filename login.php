<?php
session_start();
setlocale(LC_CTYPE, 'fr_FR');
if(isset($_POST['log-submit'])){
    $_SESSION['log-username']=$_POST['log-username'];
    $_SESSION['log-email']=strtolower($_POST['log-email']);
    $_SESSION['log-password']=$_POST['log-password'];
    header('Location:login.php');
    exit;
};
if(isset($_SESSION['log-password'])){
    setlocale(LC_ALL, 'fr_FR');
    if(!empty($_SESSION['log-username']) and !empty($_SESSION['log-email']) and !empty($_SESSION['log-password'])){
        if(!plog_match('/^((?![×Þß÷þðøÐ])[-\'_0-9a-zA-ZÀ-ÿ]){0,50}$/',$_SESSION['log-username'])){
            //mettre la box en rouge
            echo '<script>alert("le nom d\'utilisateur renseigné est invalide");</script>';
        }elseif(!filter_var($_SESSION['log-email'], FILTER_VALIDATE_EMAIL)){
            echo '<script>alert("l\'email renseigné est invalide");</script>';
        }elseif(strlen($_SESSION['log-password'])<8 or 
                !plog_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[_\W])([!-~]){8,}$/',$_SESSION['log-password'])){
            echo '<script>alert("Le mot de passe doit contenir 8 charactères dont : une lettre majuscule, une minuscule, un chiffre et un symbole");</script>';
        }else{
            foreach($_SESSION as &$val){
                $val=htmlspecialchars($val);
            };
            $username=$_SESSION['log-username'];
            $email=$_SESSION['log-email'];
            $password=$_SESSION['log-password'];
            var_dump($_SESSION);
            //--------------------------------
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $mysqli=new mysqli("localhost","ptitipsadmin","dCvvcttP]LZ=BHh","ptitips");
            if ($mysqli->connect_error) {
                die("Connection failed: ".$mysqli->connect_error);
            };
            $mysqli->set_charset('utf8mb4');
            //FAIRE LE SQL!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
            //--------------------------------
        }
    }else{
        echo '<script>alert("L\'un des champs requis est vide");</script>';
    };
    unset($_SESSION['log-username']);
    unset($_SESSION['log-email']);
    unset($_SESSION['log-password']);
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
                <form id="login" action="#" method="POST" target="_self">
                    <h2>Connexion</h2>
                    <div class="form-field" style="grid-column: 2/span 4">
                        <label for="log-username">Pseudo : </label>
                        <input id="log-username" type="text" placeholder="pseudo" pattern="^((?![×Þß÷þðøÐ])[-'_0-9a-zA-ZÀ-ÿ]){0,50}$" name="log-username" 
                        required title="peut contenir des lettres, chiffres, apostrophe, tiret et underscore">
                    </div>
                    <div class="form-field" style="grid-column: 2/span 4">
                        <label for="log-email">Email : </label>
                        <input id="log-email" type="email" placeholder="exemple@domain.com" name="log-email" required>
                    </div>
                    <div class="form-field" style="grid-column: 2/span 4">
                        <label for="log-password">Mot de passe : </label>
                        <input id="log-password" type="password" placeholder="8 caractères" name="log-password" 
                        required title="doit contenir 8 charactères dont : une lettre majuscule, une minuscule, un chiffre et un symbole" 
                        pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[_\W]).{8,}$">
                    </div>
                    <input id="log-submit" type="submit" name="log-submit" value="CONNEXION" >
                    <a id='registerinstead' href="/register.php">Inscription</a>
                </form>
            </main>
            <footer>
                <form id="newsletter" action="newsletter.php" method="POST" target="_self">
                    <h2>Newsletter</h2>
                    <p>Si tu veux être au courant des dernières infos et articles, inscris-toi à notre newsletter&#8239;!<br/>Promis on va pas spammer...</p>
                    <div class="newsletter__email">
                        <input id="nl-email__field" type="email" name="nl-email" placeholder="Email"/>
                        <input id="nl-email__submit" type="submit" name="nl-submit" value="Go&#8239;!">
                    </div>
                </form>
                <nav class="about">
                    <a href="#">about us <img src="/favicons/amogus.png" height=10 alt=""/></a>
                    <a href="/plan.html">plan du site</a>
                </nav>
            </footer>
        </div>
        <script>
            if(document.querySelector('#usericon')!==null && document.querySelector('#usericonhover')!==null){
                let usericon=document.querySelector('#usericon')
                usericon.addEventListener("mouseover",(event)=>{
                    document.querySelector('#usericonhover').style.display='block'
                });
                usericon.addEventListener("mouseout",(event)=>{
                    document.querySelector('#usericonhover').style.display='none'
                });
            };
            if(document.querySelector('#tips')!==null && document.querySelector('#tipshover')!==null){
                let tips=document.querySelector('#tips')
                tips.addEventListener("mouseover",(event)=>{
                    document.querySelector('#tipshover').style.display='block'
                });
                tips.addEventListener("mouseout",(event)=>{
                    document.querySelector('#tipshover').style.display='none'
                });
            };
        </script>
    </body>
</html>