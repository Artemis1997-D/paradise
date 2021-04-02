<?php session_start(); 


?>

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

if(isset($_SESSION['user'])) {
  header("Location:profil_membre.php?=forbidden");
  exit();
}

//variable d'affichage etc.

$content = "";

$champPseudo    = $_POST['pseudo'] ?? null;
$champPrenom    = $_POST['prenom'] ?? null;
$champNom     = $_POST['nom'] ?? null;
$champCivilite    = $_POST['civilite'] ?? null;
$champMdp       = $_POST['mdp'] ?? null;
$champRepeatMdp       = $_POST['repeatmdp'] ?? null;
$champEmail       = $_POST['email'] ?? null;
$champAdresse       = $_POST['adresse'] ?? null;
$champTelephone       = $_POST['telephone'] ?? null;




/*if (isset($_POST['envoyer'])) {

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
*/
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
              $_SESSION['user']['mdp'] = $mdp;
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


 // fermer la connexion

 /*elseif (isset($pseudo)) {
  $req = $pdo->prepare('SELECT * FROM membre WHERE `pseudo` = :pseudo');
  $req->execute(array('pseudo'=> $pseudo));
  $resultat=$req->fetch();
  var_dump($resultat[1]);
  var_dump($pseudo);

// Vérification :
  if($resultat[1] == $pseudo) {
    $content .= "<div class='alert alert-danger'>Pseudo déjà utilisé</div>";
  } */



?>

              
</header>
<section class="hero d-flex flex-column justify-content-center text-center" id="hero-login" aria-label="hero image de la page de connexion">
<form class="connexion-inscription mx-auto my-5 p-5" action="" method="post">
<h2 class="text-center mt-5 mb-5">Connexion</h2>
<?php echo $content; ?>

                <div class="form-group">
                  <label for="pseudo">Pseudo</label>
                  <input type="text" class="form-control" id="pseudo" placeholder="Votre pseudo" name="pseudo" value="<?= $champPseudo; ?>"> <!--  -->
                </div>
                <div class="form-group">
                  <label for="mdp">Mot de passe</label>
                  <input type="password" class="form-control" id="mdp" placeholder="Votre mdp" name="mdp" value="<?= $champMdp; ?>"> <!--  -->
                </div>
            <button type="submit" value="envoyer" name="envoyer" class="btn btn-primary" id="btn-inscrire" aria-label="bouton pour valider le formulaire et s'inscrire sur le site">S'inscrire</button>
            <p><a href="login.php" aria-label="lien qui mène à la page de connexion">Déja inscrit ?</a>
          </form>
          <a class="deconnexion d-flex py-5 px-0 m-auto" href="deconnexion.php" aria-label="lien qui permet de se déconnecter">Déconnexion</a>
          </section>
          <?php include 'config/template/footer.php'; ?>