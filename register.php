<?php
session_start();
setlocale(LC_CTYPE, 'fr_FR');
if(isset($_POST['reg-submit'])){
    $_SESSION['reg-username']=$_POST['reg-username'];
    $_SESSION['reg-lname']=$_POST['reg-lname'];
    $_SESSION['reg-name']=$_POST['reg-name'];
    $_SESSION['reg-email']=strtolower($_POST['reg-email']);
    $_SESSION['reg-dob']=$_POST['reg-dob'];
    $_SESSION['reg-city']=$_POST['reg-city'];
    $_SESSION['reg-cityId']=$_POST['reg-cityId'];
    $_SESSION['reg-domaine']=(int)$_POST['reg-domaine'];
    $_SESSION['reg-password']=$_POST['reg-password'];
    header('Location:register.php');
    exit;
};
if(isset($_SESSION['reg-password'])){
    setlocale(LC_ALL, 'fr_FR');
    if(!empty($_SESSION['reg-username']) and !empty($_SESSION['reg-lname']) and !empty($_SESSION['reg-name']) and !empty($_SESSION['reg-email']) 
    and !empty($_SESSION['reg-password']) and !empty($_SESSION['reg-dob'])){
        if(preg_match('/^(.*(,\sFrance))$/',$_SESSION['reg-city'])){
            $_SESSION['reg-city']=substr($_SESSION['reg-city'],0,-8);
        };
        if(!preg_match('/^((?![×Þß÷þðøÐ])[-\'_0-9a-zA-ZÀ-ÿ]){0,50}$/',$_SESSION['reg-username'])){
            echo '<script>alert("le nom d\'utilisateur renseigné est invalide");</script>';
        }elseif(!preg_match('/^((?![×Þß÷þðøÐ])[-\'\sa-zA-ZÀ-ÿ]){0,50}$/',$_SESSION['reg-lname'])){
            echo '<script>alert("le nom renseigné est invalide");</script>';
        }elseif(!preg_match('/^((?![×Þß÷þðøÐ])[-\'\sa-zA-ZÀ-ÿ]){0,50}$/',$_SESSION['reg-name'])){
            echo '<script>alert("le prénom renseigné est invalide");</script>';
        }elseif(!checkdate(explode("-",$_SESSION['reg-dob'])[1],explode("-",$_SESSION['reg-dob'])[2],explode("-",$_SESSION['reg-dob'])[0])){
            echo '<script>alert("la date de naissance renseignée est invalide");</script>';
        }elseif(!filter_var($_SESSION['reg-email'], FILTER_VALIDATE_EMAIL)){
            echo '<script>alert("l\'email renseigné est invalide");</script>';
        }elseif(strlen($_SESSION['reg-password'])<8 or !preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[_\W])([!-~]){8,}$/',$_SESSION['reg-password'])){
            echo '<script>alert("Le mot de passe doit contenir 8 charactères dont : une lettre majuscule, une minuscule, un chiffre et un symbole");</script>';
        }elseif(!empty($_SESSION['reg-city']) and !preg_match('/^((?![×Þß÷þðøÐ])[-\'\sa-zA-ZÀ-ÿ]){0,50}$/',$_SESSION['reg-city'])){
            echo '<script>alert("la ville renseignée est invalide");</script>';
        }elseif(!empty($_SESSION['reg-cityId']) and !preg_match('/^([-\w])+$/',$_SESSION['reg-cityId'])){
            echo '<script>alert("valeur d\'Id de ville corrompue");</script>';
        }elseif(!empty($_SESSION['reg-domaine']) and ($_SESSION['reg-domaine']>21 or $_SESSION['reg-domaine']<1)){
            echo '<script>alert("valeur de domaine corrompue");</script>';
        }else{
            $today=new DateTime();
            $dob=new DateTime($_SESSION['reg-dob']);
            if($today->diff($dob)->y<16){
                echo '<script>alert("t\'es pas un peu jeune?");</script>';
            }else{
                foreach($_SESSION as &$val){

                    $val=htmlspecialchars($val);
                };
                //------------------------------------
                $apikeys=file_get_contents("./apikeys.json",true);
                $dbAcess=json_decode($apikeys,true)["databaseAcess"];
                $mysqli=new mysqli("localhost",$dbAcess["username"],$dbAcess["password"],"ptitips");
                if ($mysqli->connect_error) {
                    die("Connection failed: ".$mysqli->connect_error);
                };
                $mysqli->set_charset('utf8mb4');
                $request=$mysqli->prepare("SELECT `email` FROM `utilisateur` WHERE `email`=?");
                $request->bind_param("s",$_SESSION['reg-email']);
                $request->execute();
                $userExists=$request->get_result();
                $request->close();
                if($userExists->num_rows===0){
                    $request=$mysqli->prepare("SELECT `idVille` FROM `ville` WHERE `nom`=?");
                    $request->bind_param("s",$_SESSION['reg-city']);
                    $request->execute();
                    $cityExists=$request->get_result();
                    $request->close();
                    if($cityExists->num_rows===0){
                        if(empty($_SESSION['reg-cityId'])){
                            $_SESSION['reg-cityId']=$_SESSION['reg-city'];
                        };
                        $request=$mysqli->prepare("INSERT INTO `ville` (`idVille`,`nom`) VALUES (?,?)");
                        if($request==false){}
                        $request->bind_param("ss",$_SESSION['reg-cityId'],$_SESSION['reg-city']);
                        $request->execute();
                        $request->close();
                    }else{
                        if(empty($_SESSION['reg-cityId'])){
                            while ($row = $cityExists->fetch_assoc()) {
                                $idVille=$row["idVille"];
                            }
                            $_SESSION['reg-cityId']=$idVille;
                        }else{
                            $request=$mysqli->prepare("SELECT `idVille` FROM `ville` WHERE `nom`=? AND `idVille`=?");
                            $request->bind_param("ss",$_SESSION['reg-city'],$_SESSION['reg-cityId']);
                            $request->execute();
                            $nameAndIdMatch=$request->get_result();
                            $request->close();
                            if($nameAndIdMatch->num_rows!==1){
                                while ($row = $nameAndIdMatch->fetch_assoc()) {
                                    $idVille=$row["idVille"];
                                }
                                $_SESSION['reg-cityId']=$idVille;
                            };
                        };
                    };
                    $request=$mysqli->prepare("INSERT INTO utilisateur (`nom`,`prenom`,`pseudo`,`email`,`password`,`dob`,`idVille`,`idDomaine`) VALUES (?,?,?,?,?,?,?,?)");
                    $request->bind_param("sssssssi",$_SESSION['reg-lname'],$_SESSION['reg-name'],$_SESSION['reg-username'],$_SESSION['reg-email'],$_SESSION['reg-password'],$_SESSION['reg-dob'],$_SESSION['reg-cityId'],$_SESSION['reg-domaine']);
                    $request->execute();
                    $request->close();
                    $mysqli->close();
                }else{
                    echo '<script>alert("l\'utilisateur existe déjà");</script>';
                };
                //-----------------------------------
            };
        };
    }else{
        echo '<script>alert("L\'un des champs requis est vide");</script>';
    };
    unset($dob);
    unset($idVille);
    unset($_SESSION['reg-username']);
    unset($_SESSION['reg-lname']);
    unset($_SESSION['reg-name']);
    unset($_SESSION['reg-email']);
    unset($_SESSION['reg-password']);
    unset($_SESSION['reg-dob']);
    unset($_SESSION['reg-city']);
    unset($_SESSION['reg-cityId']);
    unset($_SESSION['reg-domaine']);
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
        <script>
        let autocomplete, addressField, idField, options;
        function initMap(){
            addressField = document.querySelector("#reg-city");
            idField = document.querySelector("#reg-cityId");
            options = {
                componentRestrictions: { country: "fr" },
                fields: ["address_components","place_id"],
                types: ['(cities)']
            }
            autocomplete = new google.maps.places.Autocomplete(addressField, options);
            autocomplete.addListener("place_changed", fillInAddress);
        }
        function fillInAddress(){
            let place = autocomplete.getPlace();
            try{
                addressField.value = place.address_components[0].short_name;
                idField.value = place.place_id;
            }catch(err){
                if(err instanceof TypeError){};
            }
        }
        </script>
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
                <form id="register" action="#" method="POST" target="_self">
                    <h2>Inscription</h2>
                    <div class="form-field" style="grid-column: span 2">
                        <label for="reg-username">Pseudo : </label>
                        <input id="reg-username" type="text" placeholder="pseudo" pattern="^((?![×Þß÷þðøÐ])[-'_0-9a-zA-ZÀ-ÿ]){0,50}$" name="reg-username" 
                        required title="peut contenir des lettres, chiffres, apostrophe, tiret et underscore">
                    </div>
                    <div class="form-field" style="grid-column: span 2">
                        <label for="reg-name">Prénom : </label>
                        <input id="reg-name" type="text" placeholder="Jean-Marie" pattern="^((?![×Þß÷þðøÐ])[-'\s0-9a-zA-ZÀ-ÿ]){0,50}$" name="reg-name" required>
                    </div>
                    <div class="form-field" style="grid-column: span 2">
                        <label for="reg-lname">Nom : </label>
                        <input id="reg-lname" type="text" placeholder="Bigard" pattern="^((?![×Þß÷þðøÐ])[-'\s0-9a-zA-ZÀ-ÿ]){0,50}$" name="reg-lname" required>
                    </div>
                    <div class="form-field" style="grid-column: span 3">
                        <label for="reg-email">Email : </label>
                        <input id="reg-email" type="email" placeholder="exemple@domain.com" name="reg-email" required>
                    </div>
                    <div class="form-field" style="grid-column: span 3">
                        <label for="reg-password">Mot de passe : </label>
                        <input id="reg-password" type="password" placeholder="8 caractères" name="reg-password" 
                        required title="doit contenir 8 charactères dont : une lettre majuscule, une minuscule, un chiffre et un symbole" 
                        pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[_\W]).{8,}$">
                    </div>
                    <div class="form-field" style="grid-column: span 3">
                        <label for="reg-dob">Date de Naissance : </label>
                        <input id="reg-dob" class="placeholder" type="date" placeholder="jj/mm/aaaa" name="reg-dob"min="1950-01-01" required >
                    </div>
                    <div class="form-field" style="grid-column: span 3">
                        <label for="reg-city">Ville : </label>
                        <input id="reg-city" type="text" placeholder="Paris" pattern="^((?![×Þß÷þðøÐ])[-',\s0-9a-zA-ZÀ-ÿ]){0,50}$" name="reg-city">
                    </div>
                    <div class="form-field" style="display:none">
                        <input id="reg-cityId" type="text" name="reg-cityId">
                    </div>
                    <div class="form-field">
                        <div class="selectdiv">
                            <select name="reg-domaine" id="reg-domaine">
                                <option value="0">Choisir un domaine d'activité : </option>
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
                    </div>
                    <input id="reg-submit" type="submit" name="reg-submit" value="INSCRIPTION" >
                    <a id='connectinstead' href="/login.php">Connexion</a>
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
        <script src="common.js"></script>
        <script>
            if(document.querySelector('#reg-username')!==null){
                document.querySelector('#reg-username').focus();
            };
            if(document.querySelector('#reg-dob')!==null){
                let today=new Date().toJSON().slice(0,10);
                let dob=document.querySelector('#reg-dob');
                dob.setAttribute('max',today);
                dob.setAttribute('value',today);
                dob.addEventListener('change',(event)=>{
                    console.log('change');
                    dob.classList.remove('placeholder');
                })
            };
            if(document.querySelector('#reg-submit')!==null){
                let inputs=document.querySelectorAll('#register input');
                for(let i=0;i<inputs.length;i++){
                    inputs[i].addEventListener('keydown',(event)=>{
                        if(event.keyCode==13){
                            event.preventDefault();
                            return false;
                }})}
            };
        </script>
        <script src='select.js'></script>
        <script>
            fetch("apikeys.json")
            .then(response=>response.json())
            .then(data=>{
                let url=data.apikeys[0].url;
                let mapsScript=document.createElement('script');
                mapsScript.setAttribute('async',"");
                mapsScript.setAttribute('src',url);
                document.body.appendChild(mapsScript);
            });
        </script>
    </body>
</html>