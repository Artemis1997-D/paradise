<?php 
include 'config/template/head.php'; 
?>
                </header>
                <div class="gestion-ajout d-flex flex-column justify-content-center p-2">
                    <h2 class="text-center">Bienvenue Jacques</h2>
                        <div class="admin-profil d-flex flex-row flex-wrap justify-content-around m-4">
                            <!-----------Section_de_admin_gestion_des_articles_déjà_présents-------------------------------------------------------------------------------------------------->
                            <section class="gestion-article p-5 my-3">
                                <h3>Gestion des articles</h3>
                                <hr>
                                <p>8 articles disponibles</p>
                                <table class="card-stock">
                                    <tr>
                                        <td class="p-1">Isla Paloma Panama 295 812€</td>
                                        <td class="p-1"> 5 en stock</td>
                                        <td class="p-1"><a href="#" aria-label="supprime un élément du stock">Supprimer 1 élément</a></td>
                                    </tr>
                                </table>
                            </section>
                            <br>
                            <!-----------Section_ajout_article_dans_la_liste_des_produits-------------------------------------------------------------------------------------------------->
                            <section class="ajout-article my-3">
                                <form class="formulaire-ajout-article m-auto p-5" action="" method="post">
                                    <h3>Ajout d'un article</h3>
                                    <hr>
                                    <div class="form-group">
                                    <label for="img">Image de l'article</label>
                                    <input type="file" id="img" name="img" accept="image/*">
                                    </div>
                                    <div class="form-group">
                                        <label for="ExampleArticle">Nom de l'article</label>
                                        <input type="text" class="name-article" name="name-article" id="ExampleArticle" placeholder="Entrer le nom de l'article">
                                    </div>
                                    <div class="form-group">
                                        <label for="ExampleDescription">Description</label>
                                        <input type="textarea" class="description-article" name="description-article" id="ExampleDescription" placeholder="Présentez en quelques lignes le produit">
                                    </div>
                                    <div class="form-group">
                                        <label for="ExampleLocalisation">Localisation</label>
                                        <input type="text" class="localisation-article" name="localisation-article" id="ExampleLocalisation" placeholder="Entrez la localisation du produit">
                                    </div>
                                    <div class="form-group">
                                        <label for="ExampleSuperficie">Superficie(m2)</label>
                                        <input type="number" class="superficie-article" name="superficie-article" id="ExampleSuperficie" placeholder="Entrez la superficie du produit">
                                    </div>
                                    <div class="form-group">
                                        <label for="ExampleQuantity">Quantité</label>
                                        <input type="number" class="quantity-article" name="quantity-article" id="ExampleQuantity" placeholder="Entrez la quantité souhaité">
                                    </div>
                                    <button type="submit" class="btn btn-primary" aria-label="bouton qui permet de valider le formulaire et d'ajouter un nouvel article">Ajouter</button>
                                </form>
                            </section>
                        </div>
                    <a  class="deconnexion d-flex py-3 px-0 m-auto" href="deconnexion.php" aria-label="lien qui permet de se déconnecter">Déconnexion</a>
                </div>
<?php include 'config/template/footer.php'; ?>