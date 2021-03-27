<?php 
include 'config/template/head.php'; 
?>
        </header>

<!-----------Hero_image_Inscription-------------------------------------------------------------------------------------------------->
        <section class="hero d-flex flex-column justify-content-center text-center" id="hero-inscription" aria-label="hero image de la page d'inscription">
          <!-----------Form_Inscription-------------------------------------------------------------------------------------------------->
          <form class="connexion-inscription mx-auto my-5 p-5" action="" method="post">
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
                  <input type="password" class="form-control" id="mdp-confirm" placeholder="Mot de passe" name="repeatmdp" value="<?= $champRepeatMdp; ?>" >
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="<?= $champEmail; ?>"> <!-- <?= $champEmail; ?> -->
                </div>
                <div class="form-group">
                  <label for="adresse">Adresse Postale</label>
                  <input type="text" class="form-control" id="adresse" placeholder="Adresse postale" name="adresse" value=""> <!-- <?= $champAdresse; ?> -->
                </div>
                <div class="form-group">
                  <label for="telephone">Télephone</label>
                  <input type="tel" class="form-control" id="telephone" placeholder="Votre numéro de téléphone" name="telephone" value=""> <!-- <?= $champTelephone; ?> -->
                </div>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">S'inscrire à notre newsletter</label>
                </div>
            <button type="submit" value="Envoyer les données" name="envoyer" class="btn btn-primary" id="btn-inscrire" aria-label="bouton pour valider le formulaire et s'inscrire sur le site">S'inscrire</button>
            <p><a href="login.php" aria-label="lien qui mène à la page de connexion">Déja inscrit ?</a>
          </form>
        </section>
<?php include 'config/template/footer.php'; ?>