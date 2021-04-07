<?php 
include 'config/template/head.php'; 
if(!isset($_SESSION['user']))
{
  header('location:login.php?access=forbidden');
  exit();
}

//------------Verification_admin------------------------------------------

if($_SESSION['user']['statut'] == 0) {
      header('location:profil_membre.php?connect=forbidden');
      exit();
} 


?>
                </header>
                <div class="gestion-ajout d-flex flex-column justify-content-center p-2">
                <?php echo $content; ?>
                    <h2 class="text-center">Bienvenue Jacques</h2>
                        <div class="admin-profil d-flex flex-row flex-wrap justify-content-around m-4">
                            <!-----------Section_de_admin_gestion_des_articles_déjà_présents-------------------------------------------------------------------------------------------------->
                            <section class="gestion-article p-4 my-3">
                                <h3>Gestion des produits</h3>
                                <hr>
                                <?php echo $liste_produits; ?>
                            </section>
                            <br>
                            <!-----------Section_ajout_article_dans_la_liste_des_produits-------------------------------------------------------------------------------------------------->
                            <section class="ajout-article my-3">
                                <form class="formulaire-ajout-article m-auto p-4" action="" method="post">
                                    <h3>Ajout d'un produit</h3>
                                    <hr>
                                    <div class="form-group">
                                        <label for="photo_hero">Choisir l'image en hero</label>
                                        <input id="photo_hero" type="file" name="photo_hero" value="<?= $champHeroimg; ?>" accept="image/*" multiple>
                                    </div>
                                    <div class="form-group">
                                        <label for="photo_min1">Choisir la première image miniature pour le produit</label>
                                        <input id="photo_min1" type="file" name="photo_min1" value="<?= $champMinimg1; ?>" accept="image/*" multiple>
                                    </div>
                                    <div class="form-group">
                                        <label for="photo_min2">Choisir la deuxième image miniature pour le produit</label>
                                        <input id="photo_min2" type="file" name="photo_min2" value="<?= $champMinimg2; ?>" accept="image/*" multiple>
                                    </div>
                                    <div class="form-group">
                                        <label for="photo_min3">Choisir la troisième image miniature pour le produit</label>
                                        <input id="photo_min3" type="file" name="photo_min3" value="<?= $champMinimg3; ?>"accept="image/*" multiple>
                                    </div>
                                    <div class="form-group">
                                        <label for="nom_produit">Nom du produit</label>
                                        <input type="text" class="name-article" name="nom_produit" value="<?= $champNomProduit; ?>" id="nom_produit" placeholder="Entrer le nom de l'article">
                                    </div>
                                    <div class="form-group">
                                        <label for="categorie">Catégorie du produit</label>
                                        <input type="text" class="categorie-article" name="categorie" value="<?= $champCategorieProduit; ?>" id="categorie" placeholder="Entrer la catégorie de l'article">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <input type="textarea" class="description-article" name="description" value="<?= $champDescriptionProduit; ?>" id="description" placeholder="Présentez en quelques lignes le produit">
                                    </div>
                                    <div class="form-group">
                                        <label for="localisation">Localisation</label>
                                        <input type="text" class="localisation-article" name="localisation" value="<?= $champLocalisationProduit; ?>" id="localisation" placeholder="Entrez la localisation du produit">
                                    </div>
                                    <div class="form-group">
                                        <label for="suoerficie">Superficie(m2)</label>
                                        <input type="number" class="superficie" name="superficie" value="<?= $champSuperficieProduit; ?>" id="superficie" placeholder="Entrez la superficie du produit">
                                    </div>
                                    <div class="form-group">
                                        <label for="prix">Prix</label>
                                        <input type="number" class="prix" name="prix" value="<?= $champPrixProduit; ?>" id="prix" placeholder="Entrez le prix du produit à l'unité">
                                    </div>
                                    <div class="form-group">
                                        <label for="stock">Stock</label>
                                        <input type="number" class="stock" name="stock" value="<?= $champStockProduit; ?>" id="stock" placeholder="Entrez le stock">
                                    </div>
                                    <button type="submit" class="btn btn-primary" value="Ajouter un produit" name="ajouter" aria-label="bouton qui permet de valider le formulaire et d'ajouter un nouveau produit">Ajouter</button>
                                </form>
                            </section>
                        </div>
                    <a  class="deconnexion d-flex py-3 px-0 m-auto" href="deconnexion.php" aria-label="lien qui permet de se déconnecter">Déconnexion</a>
                </div>
<?php include 'config/template/footer.php'; ?>