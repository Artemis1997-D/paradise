<?php
session_start(); //initialisation de la session

//on ne peut pas accéder à cette page si la session 'user' a été créée.
if(isset($_SESSION['user']))
{
  header('location:page2.php?connect=forbidden');
  exit();
}
//Vérifier les pages qui sont interdites sans connexion

$content = "";


if(isset($_GET['access']) && $_GET['access'] == 'forbidden'){
  $content .= '<div style="background:tomato;padding:2%;">Pour accéder à la page profil, vous devez être connecté </div>';
}

if (isset($_POST['envoyer'])) {

    echo '<pre>';
    print_r($_POST);
    echo '</pre';

    extract($_POST); // convertit les indices sous la forme de variable tout en conservant les données saisies
    
    $pseudoValid = 'toto';
    $mdpValid = "jpfaisduvelo";

    $pseudoAdmin = "admin";
    $mdpAdmin = "admin";

    $pseudo = $_POST['pseudo'];
    $mdp = $_POST["mdp"];

    if(($pseudoValid == $pseudo) && ($mdpValid == $mdp)) {
      
      $_SESSION['user']['pseudo'] = $pseudo;
      $_SESSION['user']['mdp'] = $mdp;
      $_SESSION['user']['statut'] = 0;

      header('location:page2.php');
      exit();

    } else if(($pseudoAdmin == $pseudo) && ($mdpAdmin == $mdp))
    {//administrateur
      $_SESSION['user']['pseudo'] = $pseudo;
      $_SESSION['user']['mdp'] = $mdp;
      $_SESSION['user']['statut'] = 1;

      header('location:page2.php');
      exit();


    } else {
        $content .= '<div style="background:red;padding:1%;">Erreur d\'identification</div>';
    }
    

}


?>
<h2>Page 1</h2>
<form action="" method="post">
    <?= $content; ?>
    <label for="pseudo">pseudo</label>
    <input type="text" name="pseudo" id="pseudo"><br>
    <label for="mdp">mot de passe</label>
    <input type="password" name="mdp" id="mdp"><br>
    <input type="submit" value="Envoyer" name="envoyer">
</form>