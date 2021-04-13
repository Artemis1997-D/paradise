<?php
include 'config/template/head.php';
?>
<?php
$pdo = mysqli_connect("localhost", "root", "root", "paradise");
 if(isset($_GET['id_produit'])) {
   $donnees = mysqli_query($pdo, "SELECT * FROM produits WHERE id_produit ='$_GET[id_produit]' ");
   while ($produit = $donnees->fetch_assoc()) {
    $contenu_produit .= '<section class="hero-produit d-flex flex-column justify-content-center align-items-center" aria-label="hero image de la fiche produit" style="background-image: url(asset/img_produit/' . $produit["photo_hero"] . ')">';
    $contenu_produit .= '<h2 class="text-center">' . $produit["nom_produit"] . ' </h2>';
    $contenu_produit .= '<h3 class="text-center">' . $produit["localisation"] . ' </h3>';
    $contenu_produit .= '<a class="arrow my-0 mx-auto" href="#images-produit">
                          <img class="arrow" src="../paradise/asset/img/down-arrow.svg" alt="ancre vers les images mini de la fiche produit">
                          </a>
                      </section>';
    $contenu_produit .= ' <div class="content-produit d-flex flex-column  flex-wrap m-auto" aria-label="div qui contient tout le contenu avant le footer">';
    $contenu_produit .= ' <section id="images-produit" class="images-produit d-flex flex-row justify-content-center flex-wrap my-5 mx-auto"  aria-label="images miniatures du produit sous différents angles">';
    $contenu_produit .= '   <div class="card-deck">
                              <article class="card">
                                <div>
                                  <figure><img class="card-img" src="asset/img_produit/'. $produit["photo_min1"] . '"></figure>
                                </div>
                              </article>
                            <article class="card">
                              <div>
                                <figure><img class="card-img" src="asset/img_produit/'. $produit["photo_min2"] . '"></figure>
                              </div>
                            </article>
                            <article class="card">
                              <div>
                                <figure><img class="card-img" src="asset/img_produit/'. $produit["photo_min3"] . '"></figure>
                              </div>
                            </article>
                              </div>
                            </section>';
    $contenu_produit .= '<aside>
                          <blockquote class="my-5 mx-auto"> “Le bonheur n’est pas une destination à atteindre, mais une façon de voyager”</blockquote>
                        </aside>';
    $contenu_produit .= '<section class="d-flex flex-row flex-wrap justify-content-between">
                          <div class="description">
                            <h4>Description du produit</h4>
                              <p>' . $produit["description"] . '</p>
                          </div>';
    $contenu_produit .= '<div class="add-panier">
                        <form action="" method="post">
                         <p>Il reste ' . $produit["stock"] . ' ' . $produit["categorie"] . '(s) en stock</p>
                          <input type="number" class="quantity-article" name="quantity" id="ExampleQuantity" value=" '.$quantite.'" placeholder="Entrez la quantité souhaité">';
    $contenu_produit .= '<p class="price my-4 mx-0">' . $produit["prix"]. ' €</p>
                         <a class="btn-panier border border-light" name="quantite" value="quantite" aria-label="bouton qui permet d\'ajouter un produit au panier" href="panier.php?action=ajout&amp;n=' . $produit["nom_produit"] . '&amp;l=' . $produit["localisation"] . '&amp;q=' . $quantite . '&amp;p=' . $produit['prix'] . '" onclick="window.open(this.href, "", 
                        "toolbar=no, location=no, directories=no, status=yes, scrollbars=yes, resizable=yes, copyhistory=no, width=600, height=350"); return false;">Ajouter au panier</a>
                        </form>
                          </div>
                        </section>
                      </div>';
    $contenu_produit .= '</section>';
   }

  

   };
 
 


?>
        </header>
        <div>
        <?php echo $contenu_produit ?>
             
        </div>
 <div>                 
<?php include 'config/template/footer.php'; ?>
</div>