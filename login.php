<?php include 'config/template/head.php'; 

if(isset($_SESSION['user'])) {
  if($_SESSION['user']['statut'] == 1) {
    header('location:profil_admin.php?connect=forbidden');
    exit();
  } else {
    header('location:profil_membre.php?connect=forbidden');
    exit();
  }
}


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
            <button type="submit" value="envoyer" name="envoyer" class="btn btn-primary" id="btn-inscrire" aria-label="bouton pour valider le formulaire et se connecter au site">Se connecter</button>
            <p><a href="inscription.php" aria-label="lien qui mène à la page d'inscription'">Pas encore de compte ? Inscrivez vous !</a>
          </form>
          </section>
          <?php include 'config/template/footer.php'; ?>