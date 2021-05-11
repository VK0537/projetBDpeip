<?php
session_start();
setlocale(LC_CTYPE, 'fr_FR');
if(isset($_SESSION['logged'])&&$_SESSION['logged']){
    header('Location:error.php?err=403');
    exit();
}
if(isset($_POST['log-submit'])){
    $_SESSION['log-email']=strtolower($_POST['log-email']);
    $_SESSION['log-password']=$_POST['log-password'];
    header('Location:login.php');
    exit();
};
if(isset($_SESSION['log-password'])){
    setlocale(LC_ALL, 'fr_FR');
    if(!empty($_SESSION['log-email']) and !empty($_SESSION['log-password'])){
        if(!filter_var($_SESSION['log-email'], FILTER_VALIDATE_EMAIL)){
            echo '<script>alert("l\'email renseigné est invalide");</script>';
        }elseif(strlen($_SESSION['log-password'])<8 or !preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[_\W])([!-~]){8,}$/',$_SESSION['log-password'])){
            echo '<script>alert("le nom d\'utilisateur ou le mot de passe est incorrect");</script>';
        }else{
            foreach($_SESSION as &$val){
                $val=htmlspecialchars($val);
            };
            //------------------------------------
            $keys=file_get_contents("./keys.json",false);
            $dbAcess=json_decode($keys,true)["databaseAcess"];
            $mysqli=new mysqli("localhost",$dbAcess["username"],$dbAcess["password"],"ptitips");
            if ($mysqli->connect_error) {
                die("Connection failed: ".$mysqli->connect_error);
            };
            $mysqli->set_charset('utf8mb4');
            $request=$mysqli->prepare("SELECT `email` FROM `utilisateur` WHERE `email`=? AND `password`=?");
            $request->bind_param("ss",$_SESSION['log-email'],$_SESSION['log-password']);
            $request->execute();
            $userMatch=$request->get_result();
            $request->close();
            if($userMatch->num_rows===1){
                $_SESSION['logged']=true;
                $_SESSION['email']=$_SESSION['log-email'];
                unset($userMatch,$_SESSION['log-email'],$_SESSION['log-password']);
                header('Location:/');
                exit();
            }elseif($userMatch->num_rows>1){
                echo '<script>alert("erreur de doublon");</script>';
            }else{
                echo '<script>alert("le nom d\'utilisateur ou le mot de passe est incorrect");</script>';
            };
        };
    }else{
        echo '<script>alert("L\'un des champs requis est vide");</script>';
    };
    unset($userMatch,$_SESSION['log-email'],$_SESSION['log-password']);
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
        <header class="header">
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
            <form id="login" action="#" method="POST" target="_self">
                <h2>Connexion</h2>
                <div class="form-field" style="grid-column: 2/span 4">
                    <label for="log-email">Email : </label>
                    <input id="log-email" type="email" placeholder="exemple@domain.com" name="log-email" required>
                </div>
                <div class="form-field" style="grid-column: 2/span 4">
                    <label for="log-password">Mot de passe : </label>
                    <input id="log-password" type="password" placeholder="8 caractères" name="log-password" 
                    required title="doit contenir 8 charactères dont : une lettre majuscule, une minuscule, un chiffre et un symbole">
                </div>
                <input id="log-submit" type="submit" name="log-submit" value="CONNEXION">
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
                <a href="about-us.php">about us <img src="/favicons/amogus.png" height=10 alt=""/></a>
                <a href="plan.php">plan du site</a>
            </nav>
        </footer>
        <script>
        if(document.querySelector('#log-email')!==null){
            document.querySelector('#log-email').focus();
        };
        </script>
        <script src="common.js"></script>
    </div></body>
</html>