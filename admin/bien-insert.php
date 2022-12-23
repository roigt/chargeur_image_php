<?php

include_once('./cnx/cnx.php');


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../ergonomie/css/style.css">
    <title>Inserer un nouveau bien</title>
</head>
<body>
  
   <article>
        <section>
            <form action="" method="post" enctype="multipart/form-data">
                <h1>Inserer un bien </h1>
        <?php    
        if(isset($_POST['envoyer'])){ //si le formulaire est valide .DEBUT
            if(empty($_POST['bien'])){ //si le champ bien est vide .DEBUT
               echo '<div class="error">Merci de nommer le bien</div>';
            }//si le champ bien est vide .FIN
            else{//si le champ bien n'est pas vide .DEBUT
             
                if(empty($_FILES['monImage']['tmp_name'])){//si l image est vide .DEBUT
                    echo '<div class="error">Merci d\'envoyer une image</div>';
                }//si l image est vide .FIN
                else{//si l image n'est pas vide .DEBUT
                    $dossierTempo = $_FILES['monImage']['tmp_name'];
                    $dossierSite = '../ergonomie/images' . $_FILES['monImage']['name'];
                    $extension = strrchr($_FILES['monImage']['name'], '.');
                    $autorise = ['.jpg', '.JPG', '.png', '.PNG'];

                     
                    if(in_array($extension,$autorise)){ //si l extension est autorisée .DEBUT
                    $deplacer = move_uploaded_file($dossierTempo, $dossierSite);
                
                    /*SQL*/
                        $sql    = "INSERT INTO bien(bien,image) VALUES(:bien,:image)";
                        $req    = $cnx->prepare($sql);
                        $retour = $req->execute(
                            array(
                                ':bien' => $_POST['bien'],
                                ':image' => $_FILES['monImage']['name']
                            )
                        );

                        if($retour){
                            echo '<div class="success">Le bien a été bien inserer</div>';
                        }else{
                            echo '<div class="error">Le bien n\'a pas pu bien etre inserer</div>';
                        }


                    }//si l extension est autorisée .FIN
                    else{//si l extension n est pas autorisé .DEBUT
                        echo '<div class="error">Cette extension d\'image n\'est pas aurorisé</div>';
                    }//si l extension n est pas autorisé .FIN

                }//si l image n'est pas vide .FIN
            }//si le champ bien n'est pas vide .FIN

        }// si le formulaire est validé .FIN
        ?>
                <input type="text" name="bien" placeholder="Nom du Bien">
                <p>Envoyer une image </p>
                <div id="download">
                   <input type="file" name="monImage" id="fichier">
                   <label for="fichier">
                    <div>
                        <i class="fa-solid fa-download"></i>
                    </div>
                   </label>
                </div>
               
                <input type="submit" name="envoyer" value="Inserer">
            </form>
        </section>
   </article>

   <script src="https://kit.fontawesome.com/b5e7d68c1a.js" crossorigin="anonymous"></script>
</body>
</html>