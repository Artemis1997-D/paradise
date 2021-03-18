<?php 
include 'config/template/head.php'; 
?>
                </header>
                <div class="gestion-ajout">
                    <h2>Bienvenue Jacques</h2>
                        <div class="admin-profil">
                            <!-----------Section_de_admin_gestion_des_articles_déjà_présents-------------------------------------------------------------------------------------------------->
                            <section class="gestion-article">
                                <h3>Gestion des articles</h3>
                                <hr>
                                <p>8 articles disponibles</p>
                                <table class="card-stock">
                                    <tr>
                                        <td>Isla Paloma Panama 295 812€</td>
                                        <td> 5 en stock</td>
                                        <td><a href="#">Supprimer 1 élément</a></td>
                                    </tr>
                                </table>
                            </section>
                            <br>
                            <!-----------Section_ajout_article_dans_la_liste_des_produits-------------------------------------------------------------------------------------------------->
                            <section class="ajout-article">
                                <form class="formulaire-ajout-article" action="" method="post">
                                    <h3>Ajout d'un article</h3>
                                    <hr>
                                    <div class="form-group">
                                        <label for="ExampleArticle">Nom de l'article</label>
                                        <input type="text" class="name-article" name="" id="ExampleArticle" placeholder="Entrer le nom de l'article">
                                    </div>
                                    <div class="form-group">
                                        <label for="ExampleDescription">Description</label>
                                        <input type="textarea" class="description-article" name="" id="ExampleDescription" placeholder="Présentez en quelques lignes le produit">
                                    </div>
                                    <div class="form-group">
                                        <label for="ExampleLocalisation">Localisation</label>
                                        <input type="text" class="localisation-article" name="" id="ExampleLocalisation" placeholder="Entrez la localisation du produit">
                                    </div>
                                    <div class="form-group">
                                        <label for="ExampleSuperficie">Superficie(m2)</label>
                                        <input type="number" class="superficie-article" name="" id="ExampleSuperficie" placeholder="Entrez la superficie du produit">
                                    </div>
                                    <div class="form-group">
                                        <label for="ExampleQuantity">Quantité</label>
                                        <input type="number" class="quantity-article" name="" id="ExampleQuantity" placeholder="Entrez la quantité souhaité">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Ajouter</button>
                                </form>
                            </section>
                        </div>
                    <a  href="deconnexion.php">Déconnexion</a>
                </div>
                <hr>
<?php include 'config/template/footer.php'; ?>