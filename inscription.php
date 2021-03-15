<?php include 'config/template/head.php'; ?>
</header>
<section class="hero" id="hero-inscription">
<form class="connexion-inscription">
<h2 class="text-center mt-5 mb-5">Inscription</h2>
<div>
<div class="form-group" >
    <label for="prenom">Prénom</label>
    <input type="text" class="form-control" id="prenom" placeholder="Entrez votre prénom">
  </div>
  <div class="form-group">
    <label for="nom">Nom</label>
    <input type="text" class="form-control" id="nom" placeholder="Entrez votre nom">
  </div>
  </div>
  <div class="dropdown">
</div>
  <div class="form-group">
    <label for="mdp">Mot de passe</label>
    <input type="password" class="form-control" id="mdp" placeholder="Mot de passe">
  </div>
  <div class="form-group">
    <label for="adresse">Adresse Postale</label>
    <input type="text" class="form-control" id="adresse" placeholder="Entrez votre adresse">
  </div>
  <div class="form-group">
    <label for="telephone">Télephone</label>
    <input type="tel" class="form-control" id="telephone" placeholder="Entrez votre numéro de téléphone">
  </div>
  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">S'inscrire à notre newsletter</label>
  </div>
  <button type="submit" class="btn btn-primary">S'inscrire</button>
</form>
</section>

<?php include 'config/template/footer.php'; ?>