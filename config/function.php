<?php
/*---------------------------Formulaire Inscription---------------------*/

if (isset($_POST['envoyer']) && $_POST['envoyer'] == "Envoyer les données") {

  extract($_POST);

  if(empty($prenom)){
    $content .= "<div class='alert alert-danger'>Le champ prenom est vide</div>";
  } 
  
  if(empty($nom)){
    $content .= "<div class='alert alert-danger'>Le champ nom est vide</div>";
  } 

  if (empty($mdp)) {
    $content .= "<div class='alert alert-danger'>Le champ Mot de passe est vide</div>";
  } elseif (!preg_match('/[a-z]/', $mdp)) {
    $content .= "<div class='alert alert-danger'>Votre mot de passe doit comprendre une lettre minuscule</div>";
  } elseif (!preg_match('/[A-Z]/', $mdp)) {
    $content .= "<div class='alert alert-danger'>Votre mot de passe doit comprendre une lettre majuscule</div>";
  } elseif (!preg_match('/[0-9]/', $mdp)) {
    $content .= "<div class='alert alert-danger'>Votre mot de passe doit comprendre un chiffre</div>";
  } elseif (!preg_match('/[%!?*]/', $mdp)) {
    $content .= "<div class='alert alert-danger'>Votre mot de passe doit comprendre un caractère spécial [%!?*]</div>";
  } elseif (iconv_strlen($mdp) < 8 || iconv_strlen($mdp) > 20) {
    $content .= "<div class='alert alert-danger'>Votre mot de passe doit être compris entre 8 et 20 caractères</div>";
  } elseif ($mdp != $repeatmdp) {
    $content .= "<div class='alert alert-danger'>Les mots de passe ne correspondent pas</div>";
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $content .= "<div class='alert alert-danger'>Email incorrect</div>";
  }

  if(empty($adresse)){
    $content .= "<div class='alert alert-danger'>Le champ adresse est vide</div>";
  } 

  if (!preg_match('/[0-9]/', $telephone)) {
    $content .= "<div class='alert alert-danger'>Veuillez utiliser des chiffres pour le numéro de téléphone </div>";
  } elseif (iconv_strlen($telephone) != 10 ) {
    $content .= "<div class='alert alert-danger'>Le numéro de téléphone dois comprendre 10 chiffres </div>";
  }

  if (empty($content)) {
    $mdpCrypt = password_hash($mdp, PASSWORD_DEFAULT);

    $queryInsert = "INSERT INTO `membre`(`id`, `prenom`, `nom`, `civilite`, `mdp`, `email`, `adresse`, `telephone`) VALUES (:id,:prenom,:nom, :civilite, :mdp, :email, :adresse, :telephone)";

    $reqPrep = $pdo->prepare($queryInsert);
    $reqPrep->execute(
        [
            'id' => null,
            'prenom' => $prenom,
            'nom' => $nom,
            'civilite' => $civilite,
            'mdp' => $mdpCrypt,
            'email' => $email,
            'adresse' => $adresse,
            'telephone' => $telephone
            
        ]
    );

    header('location:inscription.php?register=true');
    exit();
  }
}
if (isset($_GET['register']) && $_GET['register'] == 'true') {
  $content .= "<div class='alert alert-success'>Inscription validée !</div>";

}


/*-------------------------------------*/




?>

              
