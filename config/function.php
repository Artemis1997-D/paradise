<?php
/*---------------------------Formulaire Inscription---------------------*/

$resultat='';

if (isset($_POST['envoyer']) && $_POST['envoyer'] == "Envoyer les données") {

  extract($_POST);

  if(empty($pseudo)){
    $content .= "<div class='alert alert-danger'>Le champ pseudo est vide</div>";
  } elseif (iconv_strlen($pseudo) < 3 || iconv_strlen($pseudo) > 25) {
    $content .= "<div class='alert alert-danger'>Votre pseudo doit être compris entre 3 et 25 caractères</div>";
  } elseif (preg_match('/[A-Z]/', $pseudo)) {
    $content .= "<div class='alert alert-danger'>Votre pseudo ne dois pas contenir de lettre majuscule</div>";
  } elseif (preg_match('/[%!?*]/', $pseudo)) {
    $content .= "<div class='alert alert-danger'>Votre pseudo ne dois pas comporter de caractères spéciaux</div>";
  } elseif (isset($pseudo)) {
    $req = $pdo->prepare('SELECT * FROM membre WHERE `pseudo` = :pseudo');
    $req->execute(array('pseudo'=> $pseudo));
    $resultat=$req->fetch();
// Vérification :
    if($resultat) {
      $content .= "<div class='alert alert-danger'>Pseudo déjà utilisé</div>";
    }

  }

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

    $queryInsert = "INSERT INTO `membre`(`id`, `pseudo`, `prenom`, `nom`, `civilite`, `mdp`, `email`, `adresse`, `telephone`) VALUES (:id, :pseudo, :prenom, :nom, :civilite, :mdp, :email, :adresse, :telephone)";

    $reqPrep = $pdo->prepare($queryInsert);
    $reqPrep->execute(
        [
            'id' => null,
            'pseudo' => $pseudo,
            'prenom' => $prenom,
            'nom' => $nom,
            'civilite' => $civilite,
            'mdp' => $mdpCrypt,
            'email' => $email,
            'adresse' => $adresse,
            'telephone' => $telephone
            
        ]
    );
    $_SESSION['user']['pseudo'] = $pseudo;
    $_SESSION['user']['prenom'] = $prenom;
    $_SESSION['user']['nom'] = $nom;
    $_SESSION['user']['civilite'] = $civilite;
    $_SESSION['user']['mdp'] = $mdpCrypt;
    $_SESSION['user']['email'] = $email;
    $_SESSION['user']['adresse'] = $adresse;
    $_SESSION['user']['telephone'] = $telephone;
    $_SESSION['user']['statut'] = 0;
    header('location:profil_membre.php?register=true');
    exit();
  }
}
if (isset($_GET['register']) && $_GET['register'] == 'true') {
  $content .= "<div class='alert alert-success'>Inscription validée !</div>";

}

if (isset($_GET['login']) && $_GET['login'] == 'true') {
  if($_SESSION['user']['statut'] == 1 ) {
    $content .= "<div class='alert alert-success'>Connexion réussis ! Vous êtes connecté en tant qu'administrateur</div>";
  } else {
    $content .= "<div class='alert alert-success'>Connexion réussis ! Vous êtes connecté en tant que membre</div>";
  }
}

if(isset($_GET['access']) && $_GET['access'] == 'forbidden') 
{
  $content .= "<div class='alert alert-danger'>Vous ne pouvez pas acceder à cette page, vous devez vous inscrire ou vous connecter !</div>";
}

if(isset($_GET['connect']) && $_GET['connect'] == 'forbidden') 
{
  $content .= "<div class='alert alert-danger'>Votre statut ne vous permet pas d'accéder à cette page</div>";
}


/*------------------------------------Formulaire de connexion et sessions --------------------*/



if(isset($_POST['pseudo']) && isset($_POST['mdp'])) {
  
  extract($_POST);
    $mdpCrypt = password_hash($mdp, PASSWORD_DEFAULT);
    $pseudoAdmin = "admin";
    $mdpAdmin = "admin";
    
    if (($pseudoAdmin == $pseudo) && ($mdpAdmin == $mdp)){
      $_SESSION['user']['pseudo'] = $pseudo;
      $_SESSION['user']['mdp'] = $mdp;
      $_SESSION['user']['statut'] = 1;
      header('location:profil_admin.php?login=true');
      exit();

    } elseif ($pseudo !== "" && $mdp !== "") {
      $req = $pdo->prepare('SELECT * FROM membre WHERE `pseudo` = :pseudo');
      $req->execute(array(':pseudo'=> $pseudo ));
      $resultat=$req->fetch();
        if($resultat!=0) {
            if (password_verify($mdp, $resultat['mdp'])) {
              $_SESSION['user']['pseudo'] = $pseudo;
              $_SESSION['user']['mdp'] = $resultat['mdp'];
              $_SESSION['user']['prenom'] = $resultat['prenom'];
              $_SESSION['user']['nom'] = $resultat['nom'];
              $_SESSION['user']['civilite'] = $resultat['civilite'];
              $_SESSION['user']['email'] = $resultat['email'];
              $_SESSION['user']['adresse'] = $resultat['adresse'];
              $_SESSION['user']['telephone'] = $resultat['telephone'];
              $_SESSION['user']['statut'] = 0;
            header('Location: profil_membre.php?login=true');
            exit();
        
            } else {
              $content .= '<div style="background:tomato;padding:2%;">Mot de passe incorrect</div>';
            }

           
        }
        else
        {
          $content .= '<div style="background:tomato;padding:2%;">Utilisateur ou mot de passe incorrect</div>';
        }
    }
    else
    {
      $content .= '<div style="background:tomato;padding:2%;">Utilisateur ou mot de passe vide</div>';
    }

}


?>

              
