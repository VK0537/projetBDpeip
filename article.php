<?php 
$idValid=false;
$idArticle=$_GET["article"];
if(ctype_digit($idArticle) and strlen($idArticle)===8){
    $idValid=true;
    $apikeys=file_get_contents(__DIR__."/apikeys.json",true);
    $dbAcess=json_decode($apikeys)["databaseAcess"];
    $mysqli=new mysqli("localhost",$dbAcess["username"],$dbAcess["password"],"ptitips");
    if ($mysqli->connect_error) {
        die("Connection failed: ".$mysqli->connect_error);
    };
    $mysqli->set_charset('utf8mb4');
    $request=$mysqli->prepare("SELECT * FROM `article` WHERE `idArticle`=?");
    $request->bind_param("i",$idArticle);
    $request->execute();
    $match=$request->get_result();
    $request->close();
    if($match and $match->num_rows===1){
        $match=$match->fetch_assoc();
        $idValid=true;
        var_dump($match);
        // $titre=
        // `, `date`, `type`, `attributs`, `contenu`, `medias`
    }else{
        echo '<script>alert("database error");</script>';
    };
}else{
    echo '<script>alert("l\'id d\'article est invalide");</script>';
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
    <body>
        <div class="main-wrap">
            <header>
                <!-- #include file="include_head.html" -->
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
                <?php 
                var_dump($match);
                ?>
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