<?php include 'config/template/head.php'; ?>
</header>
<section class="hero">
<form class="connexion-inscription">
<h2 class="text-center mt-5 mb-5">Connexion</h2>
<div class="form-group">
    <label for="pseudo">Pseudo</label>
    <input type="text" class="form-control" id="pseudo" placeholder="Entrez votre pseudo">
  </div>
  <div class="form-group">
    <label for="mdp">Mot de passe</label>
    <input type="password" class="form-control" id="mdp" placeholder="Entrez votre mot de passe">
  </div>
  <button type="submit" class="btn btn-primary">Se connecter</button>
</form>
</section>
<?php include 'config/template/footer.php'; ?>