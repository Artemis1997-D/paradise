<?php 
include 'config/template/head.php'; 
?>
        </header>
<!-----------Hero_image_Inscription-------------------------------------------------------------------------------------------------->
        <section class="hero" id="hero-inscription">
          <!-----------Form_Inscription-------------------------------------------------------------------------------------------------->
          <form class="connexion-inscription">
            <h2 class="text-center mt-5 mb-5">Inscription</h2>
              <div>
                <div class="form-group" >
                  <label for="prenom">Prénom</label>
                  <input type="text" class="form-control" id="prenom" placeholder="Votre prénom">
                </div>
                <div class="form-group">
                  <label for="nom">Nom</label>
                  <input type="text" class="form-control" id="nom" placeholder="Votre nom">
                </div>
              </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Civilité</label>
                  <select class="form-control" id="exampleFormControlSelect1">
                    <option>Femme</option>
                    <option>Homme</option>
                    <option>Autre</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="mdp">Mot de passe</label>
                  <input type="password" class="form-control" id="mdp" placeholder="Mot de passe">
                </div>
                <div class="form-group">
                  <label for="mdp">Confirmation du mot de passe</label>
                  <input type="password" class="form-control" id="mdp-confirm" placeholder="Mot de passe">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" placeholder="Email">
                </div>
                <div class="form-group">
                  <label for="adresse">Adresse Postale</label>
                  <input type="text" class="form-control" id="adresse" placeholder="Adresse postale">
                </div>
                <div class="form-group">
                  <label for="telephone">Télephone</label>
                  <input type="tel" class="form-control" id="telephone" placeholder="Votre numéro de téléphone">
                </div>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">S'inscrire à notre newsletter</label>
                </div>
            <button type="submit" class="btn btn-primary" id="btn-inscrire">S'inscrire</button>
            <p><a href="login.php">Déja inscrit ?</a>
          </form>
        </section>
<?php include 'config/template/footer.php'; ?>