<?php 
include 'config/template/head.php'; 
?>
        </header>
<!-----------Hero_image_Connexion-------------------------------------------------------------------------------------------------->
        <section class="hero d-flex flex-column justify-content-center text-center" id="hero-login">
          <!-----------Form_Connexion-------------------------------------------------------------------------------------------------->
          <form class="connexion-inscription m-auto p-5">
            <h2 class="text-center mt-5 mb-5">Connexion</h2>
              <div class="form-group">
                <label for="pseudo">Pseudo</label>
                <input type="text" class="form-control" id="pseudo" placeholder="Entrez votre pseudo">
              </div>
              <div class="form-group">
                <label for="mdp">Mot de passe</label>
                <input type="password" class="form-control" id="mdp" placeholder="Entrez votre mot de passe">
              </div>
            <button type="submit" class="btn btn-primary" id="btn-login">Se connecter</button>
            <p><a href="#">Mot de passe oublié</a>
            <p> Nouveau chez Paradise ? <a href="inscription.php">Inscrivez vous</a>
          </form>
        </section>
<?php include 'config/template/footer.php'; ?>