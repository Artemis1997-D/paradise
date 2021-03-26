<!DOCTYPE html>
    <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Paradise</title>
<!-----------Liens-vers-Bootstrap-et-CSS----------------------------------------------------------->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA==" crossorigin="anonymous" />
            <link rel="stylesheet" href="./asset/style/style.css">
<!-----------Liens-vers-les-fonts-Google----------------------------------------------------------->
            <link rel="preconnect" href="https://fonts.gstatic.com">
            <link href="https://fonts.googleapis.com/css2?family=Lora:ital@1&display=swap" rel="stylesheet">
            <link rel="preconnect" href="https://fonts.gstatic.com">
            <link href="https://fonts.googleapis.com/css2?family=Karla:wght@300;400&family=Lora:ital@1&display=swap" rel="stylesheet">
        </head>

        <body class="m-0 p-0">
            <header class="d-flex flex-row flex-wrap position-sticky" >
            <!-----------Barre-de-navigation----------------------------------------------------------->
            <h1 class="text-left" id="home"><a class="nav-link" href="index.php" aria-label="lien pour accéder à la page d'accueil">Paradise</a></h1>
                <nav class="nav align-items-center">
                    <a  class="nav-link" href="produits.php" aria-label="lien pour accéder à la page avec tout les produits">Produits</a>
                    <a  class="nav-link" href="login.php" aria-label="lien pour accéder à la page pour se connecter">Connexion</a>
                    <a  class="nav-link" href="panier.php" aria-label="lien pour accéder au panier">Mon panier</a>
                    <a  class="nav-link" href="profil_membre.php" aria-label="lien pour accéder à son compte">Mon compte</a>
                </nav>
<?php 

define('HOSTNAME', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', ''); //root pour la MAC et LINUX
define('DATABASE', 'paradise');

$dsn = 'mysql:host=' . HOSTNAME . ';dbname=' . DATABASE;

try { //on essaie de code...
    $pdo = new PDO($dsn, USERNAME, PASSWORD);
} catch (PDOException $e) { //...en cas d'erreur on la capture
    die('<ul><li>Erreur sur le fichier : ' . $e->getFile() . '</li><li>Erreur à la ligne ' . $e->getLine() . '</li><li>Message d\'erreur : ' . $e->getMessage() . '</li></ul>');
}


//variable d'affichage etc.

$content = "";

$champPrenom    = $_POST['prenom'] ?? null;
$champNom     = $_POST['nom'] ?? null;
$champCivilite    = $_POST['civilite'] ?? null;
$champMdp       = $_POST['mdp'] ?? null;
$champRepeatMdp       = $_POST['repeatmdp'] ?? null;
$champEmail       = $_POST['email'] ?? null;
$champAdresse       = $_POST['adresse'] ?? null;
$champTelephone       = $_POST['telephone'] ?? null;




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

    header('location:Test.php?register=true');
    exit();
  }
}
if (isset($_GET['register']) && $_GET['register'] == 'true') {
  $content .= "<div class='alert alert-success'>Inscription validée !</div>";

}







?>

              
</header>
<form class=" m-auto p-5" action="" method="post">
<h2 class="text-center mt-5 mb-5">Inscription</h2>
<?php echo $content; ?>
                <div class="form-group">
                  <label for="prenom">Prénom</label>
                  <input type="text" class="form-control" id="prenom" placeholder="Votre prénom" name="prenom" value="<?= $champPrenom; ?>"> <!-- <?= $champPrenom; ?> -->
                </div>
                <div class="form-group">
                  <label for="nom">Nom</label>
                  <input type="text" class="form-control" id="nom" placeholder="Votre nom" name="nom" value="<?= $champNom; ?>"> <!-- <?= $champNom; ?> -->
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Civilité</label>
                  <select class="form-control" id="exampleFormControlSelect1" name="civilite" value="<?= $champCivilite; ?>"> <!-- <?= $champCivilite; ?> -->
                    <option>Femme</option>
                    <option>Homme</option>
                    <option>Autre</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="mdp">Mot de passe</label>
                  <input type="password" class="form-control" id="mdp" placeholder="Mot de passe" name="mdp" value="<?= $champMdp; ?>"> <!-- <?= $champMdp; ?> -->
                </div>
                <div class="form-group">
                  <label for="mdp">Confirmation du mot de passe</label>
                  <input type="password" class="form-control" id="mdp-confirm" placeholder="Mot de passe" name="repeatmdp" value="<?= $champRepeatMdp; ?>">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="<?= $champEmail; ?>"> <!-- <?= $champEmail; ?> -->
                </div>
                <div class="form-group">
                  <label for="adresse">Adresse Postale</label>
                  <input type="text" class="form-control" id="adresse" placeholder="Adresse postale" name="adresse" value="<?= $champAdresse; ?>"> <!-- <?= $champAdresse; ?> -->
                </div>
                <div class="form-group">
                  <label for="telephone">Télephone </label>
                  <input type="tel" class="form-control" id="telephone" placeholder="Votre numéro de téléphone"  name="telephone" value="<?= $champTelephone; ?>"> <!-- <?= $champTelephone; ?> -->
                </div>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">S'inscrire à notre newsletter</label>
                </div>
            <button type="submit" value="Envoyer les données" name="envoyer" class="btn btn-primary" id="btn-inscrire" aria-label="bouton pour valider le formulaire et s'inscrire sur le site">S'inscrire</button>
            <p><a href="login.php" aria-label="lien qui mène à la page de connexion">Déja inscrit ?</a>
          </form>