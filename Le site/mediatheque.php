<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <?php
        require "configDB.php";

        try{
            $pdo = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);
            $requete = "SELECT * FROM `Film`;";
            $prepare = $pdo->prepare($requete);
            $prepare->execute();
            $resultat = $prepare->fetchAll();
        }
        catch (PDOException $e){
            exit("❌🙀❌ OOPS :\n" . $e->getMessage());
        }

        echo "<div class='films'>";
        foreach($resultat as $key => $value){
            echo "<div class='film'>
                  <h2>". $value['titre'] ."</h2>
                  <img src='". $value['affiche'] ."' alt='affiche du film'/>
                  <p>". $value['acteurs'] ."</p>
                  <p>". $value['date_de_sortie'] ."</p>
                  <p>". $value['synopsis'] ."</p>
                  <p>". $value['realisateur'] ."</p>
                  </div>";
        }
        echo "</div>";



        if(!isset($_REQUEST['titre'], $_REQUEST['affiche'], $_REQUEST['acteurs'], $_REQUEST['date_de_sortie'], $_REQUEST['synopsis'], $_REQUEST['realisateur'])){
    ?>
            <h2>Ajouter un film</h2>
            <form action="" method="POST">
                <input type="text" name="titre" placeholder="Titre" required/>
                <input type="text" name="affiche" placeholder="Affiche" required/>
                <input type="text" name="acteurs" placeholder="Acteurs" required/>
                <input type="date" name="date_de_sortie" placeholder="Date de sortie" required/>
                <input type="text" name="synopsis" placeholder="Synopsis" required/>
                <input type="text" name="realisateur" placeholder="Réalisateur" required/>
                <input type="submit"/>
            </form>

    <?php
        }
        elseif(isset($_REQUEST['titre'], $_REQUEST['affiche'], $_REQUEST['acteurs'], $_REQUEST['date_de_sortie'], $_REQUEST['synopsis'], $_REQUEST['realisateur'])){
            $titre = $_REQUEST['titre'];
            $affiche = $_REQUEST['affiche'];
            $acteurs = $_REQUEST['acteurs'];
            $date_de_sortie = $_REQUEST['date_de_sortie'];
            $synopsis = $_REQUEST['synopsis'];
            $realisateur = $_REQUEST['realisateur'];

            try{
                $pdo = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);
                $requete = "INSERT INTO `Film` (`titre`, `affiche`, `acteurs`, `date_de_sortie`, `synopsis`, `realisateur`)
                VALUES ( :titre, :affiche, :acteurs, :date_de_sortie, :synopsis, :realisateur );";
                $prepare = $pdo->prepare($requete);
                $prepare->execute(array(
                    ":titre" => $titre,
                    ":affiche" => $affiche,
                    ":acteurs" => $acteurs,
                    ":date_de_sortie" => $date_de_sortie,
                    ":synopsis" => $synopsis,
                    ":realisateur" => $realisateur
                ));
                $res = $prepare->rowCount();

                if($res == 1){
                    header("Location: mediatheque.php");
                    exit(); 
                }
            }
            catch (PDOException $e){
                exit("❌🙀❌ OOPS :\n" . $e->getMessage());
            }
        }

        if(!isset($_REQUEST['modif'])){

            try{
                $pdo = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);
                $requete = "SELECT * FROM `Film`;";
                $prepare = $pdo->prepare($requete);
                $prepare->execute();
                $resultat = $prepare->fetchAll();
                $resultat = unique_multidim_array($resultat, "titre");
            }
            catch (PDOException $e){
                exit("❌🙀❌ OOPS :\n" . $e->getMessage());
            }
    ?>
            <h2>modifier un film</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <?php
                    echo "<select name='modif'>";
                    foreach($resultat as $key => $value){
                        echo "<option value='". $value['id'] ."'>". $value['titre'] ."</option>";
                    }
                    echo "</select>";
                ?>
                <input type="submit"/>
            </form>

    <?php
        }
        elseif(isset($_REQUEST['modif'])){

            $modif = $_REQUEST['modif'];

            try{
                $pdo = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);
                $requete = "SELECT * FROM `Film`
                            WHERE `id` = :id ;";
                $prepare = $pdo->prepare($requete);
                $prepare->execute(array(
                    ":id" => $modif
                ));
                $resultat = $prepare->fetchAll();
            }
            catch (PDOException $e){
                exit("❌🙀❌ OOPS :\n" . $e->getMessage());
            }

            echo "<h2>modifier un film</h2>
                <form action='' method='POST'>
                    <input type='text' name='titremodif' value='". htmlentities($resultat[0]['titre'], ENT_QUOTES) ."' required />
                    <input type='text' name='affichemodif' value='". htmlentities($resultat[0]['affiche'], ENT_QUOTES) ."' required />
                    <input type='text' name='acteursmodif' value='". htmlentities($resultat[0]['acteurs'], ENT_QUOTES) ."' required />
                    <input type='text' name='date_de_sortiemodif' value='". htmlentities($resultat[0]['date_de_sortie'], ENT_QUOTES) ."' required />
                    <input type='text' name='synopsismodif' value='". htmlentities($resultat[0]['synopsis'], ENT_QUOTES) ."' required />
                    <input type='text' name='realisateurmodif' value='". htmlentities($resultat[0]['realisateur'], ENT_QUOTES) ."' required />
                    <input type='text' name='id' value='". $resultat[0]['id'] ."' hidden />
                    <input type='submit' name='modifier' value='Oui'/>
                </form> ";
        }

        if(isset($_REQUEST['modifier'])){

            $titre = $_REQUEST['titremodif'];
            $affiche = $_REQUEST['affichemodif'];
            $acteurs = $_REQUEST['acteursmodif'];
            $date_de_sortie = $_REQUEST['date_de_sortiemodif'];
            $synopsis = $_REQUEST['synopsismodif'];
            $realisateur = $_REQUEST['realisateurmodif'];
            $id = $_REQUEST['id'];

            try{
                $pdo = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);
                $requete = "UPDATE `Film` SET
                `titre` = :titre,
                `affiche` = :affiche,
                `acteurs` = :acteurs,
                `date_de_sortie` = :date_de_sortie,
                `synopsis` = :synopsis,
                `realisateur` = :realisateur
                WHERE `id` = :id;"; 
                $prepare = $pdo->prepare($requete);
                $prepare->execute(array(
                    ":titre" => $titre,
                    ":affiche" => $affiche,
                    ":acteurs" => $acteurs,
                    ":date_de_sortie" => $date_de_sortie,
                    ":synopsis" => $synopsis,
                    ":realisateur" => $realisateur,
                    ":id" => $id
                ));
                $res = $prepare->rowCount();

                if($res == 1){
                    header("Location: mediatheque.php");
                    exit(); 
                }
        
            }
            catch (PDOException $e){
                exit("❌🙀❌ OOPS :\n" . $e->getMessage());
            }
        }

        if(!isset($_REQUEST['supp'])){

            try{
                $pdo = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);
                $requete = "SELECT * FROM `Film`;";
                $prepare = $pdo->prepare($requete);
                $prepare->execute();
                $resultat = $prepare->fetchAll();
                $resultat = unique_multidim_array($resultat, "titre");
            }
            catch (PDOException $e){
                exit("❌🙀❌ OOPS :\n" . $e->getMessage());
            }
    ?>
            <h2>supprimer un film</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <?php
                    echo "<select name='supp'>";
                    foreach($resultat as $key => $value){
                        echo "<option value='". $value['id'] ."'>". $value['titre'] ."</option>";
                    }
                    echo "</select>";
                ?>
                <input type="submit"/>
            </form>

    <?php
        }
        elseif(isset($_REQUEST['supp'])){

            $supp = $_REQUEST['supp'];

            $pdo = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);
            $requete = "SELECT * FROM `Film`
                        WHERE `id` = :id;";
            $prepare = $pdo->prepare($requete);
            $prepare->execute(array(
                ":id" => $supp
            ));
            $resultat = $prepare->fetchAll();

            echo "<h2>Voulez vous supprimer ce film ?</h2>
                <form action='' method='POST'>
                    <input type='text' name='titresupp' value='". htmlentities($resultat[0]['titre'], ENT_QUOTES) ."' required />
                    <input type='text' name='affichesupp' value='". htmlentities($resultat[0]['affiche'], ENT_QUOTES) ."' required />
                    <input type='text' name='acteurssupp' value='". htmlentities($resultat[0]['acteurs'], ENT_QUOTES) ."' required />
                    <input type='text' name='date_de_sortiesupp' value='". htmlentities($resultat[0]['date_de_sortie'], ENT_QUOTES) ."' required />
                    <input type='text' name='synopsissupp' value='". htmlentities($resultat[0]['synopsis'], ENT_QUOTES) ."' required />
                    <input type='text' name='realisateursupp' value='". htmlentities($resultat[0]['realisateur'], ENT_QUOTES) ."' required />
                    <input type='number' name='id' value='". $resultat[0]['id'] ."' hidden />
                    <input type='submit' name='supprimer' value='supprimer'/>
                </form> ";
        }

        if(isset($_REQUEST['supprimer'])){

            $id = $_REQUEST['id'];

            try{
                $pdo = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);
                $requete = "DELETE FROM `Film`
                        WHERE `id` = :id;"; 
                $prepare = $pdo->prepare($requete);
                $prepare->execute(array(
                    ":id" => $id
                ));
                $res = $prepare->rowCount();

                if($res == 1){
                    header("Location: mediatheque.php");
                    exit(); 
                }
        
            }
            catch (PDOException $e){
                exit("❌🙀❌ OOPS :\n" . $e->getMessage());
            }
        }

        if(!isset($_REQUEST['emprunt'])){

            try{
                $pdo = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);
                $requete = "SELECT * FROM `Film`;";
                $prepare = $pdo->prepare($requete);
                $prepare->execute();
                $resultat = $prepare->fetchAll();
                $resultat = unique_multidim_array($resultat, "titre");
            }
            catch (PDOException $e){
                exit("❌🙀❌ OOPS :\n" . $e->getMessage());
            }
    ?>
            <h2>modifier les dates d'emprunt d'un film</h2>
            <form action="" method="POST">
                <?php
                    echo "<select name='emprunt'>";
                    foreach($resultat as $key => $value){
                        echo "<option value='". $value['id'] ."'>". $value['titre'] ."</option>";
                    }
                    echo "</select>";
                ?>
                <input type="submit"/>
            </form>

    <?php
        }
        elseif(isset($_REQUEST['emprunt'])){

            $modif = $_REQUEST['emprunt'];

            try{
                $pdo = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);
                $requete = "SELECT * FROM `Film`
                            WHERE `id` = :id ;";
                $prepare = $pdo->prepare($requete);
                $prepare->execute(array(
                    ":id" => $modif
                ));
                $resultat = $prepare->fetchAll();
            }
            catch (PDOException $e){
                exit("❌🙀❌ OOPS :\n" . $e->getMessage());
            }

            echo "<h2>modifier les dates d'emprunt d'un film</h2>
                <form action='' method='POST'>
                    <label for='date_d_emprunt'>Date d'emprunt</label>
                    <input type='date' name='date_d_emprunt' value='". htmlentities($resultat[0]['date_d_emprunt'], ENT_QUOTES) ."' required />
                    <label for='date_de_retour'>Date de retour</label>
                    <input type='date' name='date_de_retour' value='". htmlentities($resultat[0]['date_de_retour'], ENT_QUOTES) ."' required />
                    <input type='text' name='id' value='". $resultat[0]['id'] ."' hidden />
                    <input type='submit' name='emprunter' value='Valider'/>
                </form> ";
        }

        if(isset($_REQUEST['emprunter'])){

            $date_d_emprunt = $_REQUEST['date_d_emprunt'];
            $date_de_retour = $_REQUEST['date_de_retour'];
            $id = $_REQUEST['id'];

            try{
                $pdo = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);
                $requete = "UPDATE `Film` SET
                `date_d_emprunt` = :date_d_emprunt,
                `date_de_retour` = :date_de_retour
                WHERE `id` = :id;"; 
                $prepare = $pdo->prepare($requete);
                $prepare->execute(array(
                    ":date_d_emprunt" => $date_d_emprunt,
                    ":date_de_retour" => $date_de_retour,
                    ":id" => $id
                ));
                $res = $prepare->rowCount();

                if($res == 1){
                    header("Location: mediatheque.php");
                    exit(); 
                }
        
            }
            catch (PDOException $e){
                exit("❌🙀❌ OOPS :\n" . $e->getMessage());
            }
        }


        function unique_multidim_array($array, $key) {
            $temp_array = array();
            $i = 0;
            $key_array = array();
           
            foreach($array as $val) {
                if (!in_array($val[$key], $key_array)) {
                    $key_array[$i] = $val[$key];
                    $temp_array[$i] = $val;
                }
                $i++;
            }
            return $temp_array;
        }
    ?>
</body>
</html>