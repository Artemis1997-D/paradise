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




if (isset($_POST['envoyer'])) {

  extract($_POST);

  $pseudoAdmin = "admin";
  $mdpAdmin = "Admin1!";
  
  if (($pseudoAdmin == $pseudo) && ($mdpAdmin == $mdp)) { //administrateur
    $_SESSION['user']['pseudo'] = $pseudo;
    $_SESSION['user']['mdp'] = $mdp;
    $_SESSION['user']['statut'] = 1;

    header('location:profil_admin.php');
    $content .= '<div style="background:green;padding:1%;">Vous être connecté en tant que admin</div>';
    exit();
  } else {
    $content .= '<div style="background:red;padding:1%;">Erreur d\'identification</div>';
  }        

  
}








?>

              
</header>
<form class=" m-auto p-5" action="" method="post">
<h2 class="text-center mt-5 mb-5">Connexion</h2>
<?php echo $content; ?>
                <div class="form-group">
                  <label for="prenom">Prénom</label>
                  <input type="text" class="form-control" id="prenom" placeholder="Votre pseudo" name="pseudo"> <!-- <?= $champPrenom; ?> -->
                </div>
                <div class="form-group">
                  <label for="mdp">Nom</label>
                  <input type="text" class="form-control" id="nom" placeholder="Votre mdp" name="mdp"> <!-- <?= $champNom; ?> -->
                </div>
            <button type="submit" value="envoyer" name="envoyer" class="btn btn-primary" id="btn-inscrire" aria-label="bouton pour valider le formulaire et s'inscrire sur le site">S'inscrire</button>
            <p><a href="login.php" aria-label="lien qui mène à la page de connexion">Déja inscrit ?</a>
          </form>