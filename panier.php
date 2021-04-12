<?php 
include 'config/template/head.php'; 

if(!isset($_SESSION['user']))
{
  header('location:login.php?access=forbidden');
  exit();
}

    $erreur = false;

    $action = (isset($_POST['action'])? $_POST['action']:  (isset($_GET['action'])? $_GET['action']:null )) ;
    if($action !== null)
    {
       if(!in_array($action,array('ajout', 'suppression', 'refresh')))
       $erreur=true;
    
       //récuperation des variables en POST ou GET
       $n = (isset($_POST['n'])? $_POST['n']:  (isset($_GET['n'])? $_GET['n']:null )) ;
       $l = (isset($_POST['l'])? $_POST['l']:  (isset($_GET['l'])? $_GET['l']:null )) ;
       $p = (isset($_POST['p'])? $_POST['p']:  (isset($_GET['p'])? $_GET['p']:null )) ;
       $q = (isset($_POST['q'])? $_POST['q']:  (isset($_GET['q'])? $_GET['q']:null )) ;
    
       //Suppression des espaces verticaux
       $n = preg_replace('#\v#', '',$n);
       //On vérifie que $p soit un float
       $p = floatval($p);
    
       //On traite $q qui peut être un entier simple ou un tableau d'entiers
        
       if (is_array($q)){
          $QteArticle = array();
          $i=0;
          foreach ($q as $contenu){
             $QteArticle[$i++] = intval($contenu);
          }
       }
       else
       $q = intval($q);
        
    }
    
    if (!$erreur){
       switch($action){
          Case "ajout":
             ajouterArticle($n,$l,$q,$p);
             break;
    
          Case "suppression":
             supprimerArticle($n);
             break;
    
          Case "refresh" :
             for ($i = 0 ; $i < count($QteArticle) ; $i++)
             {
                modifierQTeArticle($_SESSION['panier']['nomProduit'][$i],round($QteArticle[$i]));
             }
             break;
    
          Default:
             break;
       }
    }
    if (creationPanier())
    {
        $nbArticles=count($_SESSION['panier']['nomProduit']);
        if ($nbArticles <= 0)
        $contenu_panier .= '<div class="article d-flex m-auto"><p>Votre panier est vide</p></div>';
        else
        {
            for ($i=0 ;$i < $nbArticles ; $i++)
            {
                $contenu_panier .= '<article class="article d-flex flex-row m-auto">';
                $contenu_panier .= '<img class="image-panier mr-2" src="asset/img_produit/sand-point-road-beach.webp" alt="Bungalow" >';
                $contenu_panier .= '<div class="article flex-row">';
                $contenu_panier .= '<p class="detail d-flex flex-column align-items-start">'.htmlspecialchars($_SESSION['panier']['nomProduit'][$i]).'</p>';
                $contenu_panier .= '<p class="detail d-flex flex-column align-items-start">'.htmlspecialchars($_SESSION['panier']['localisationProduit'][$i]).'</p>';
                $contenu_panier .= '<p class="detail d-flex flex-column align-items-start">'.htmlspecialchars($_SESSION['panier']['prixProduit'][$i]).'</p>';
                $contenu_panier .= '</div>';
                $contenu_panier .= '<input type="text" size="4" name="q[]" value=" '.htmlspecialchars($_SESSION["panier"]["qteProduit"][$i]). '">';
                $contenu_panier .= '<a href=" '.htmlspecialchars("panier.php?action=suppression&l=".rawurlencode($_SESSION['panier']['nomProduit'][$i])).' ">Supprimer</a>';
                $contenu_panier .= '</article>';
                $contenu_panier .= '<hr class="divider">';
            }
            $contenu_panier .= '<div class="total d-flex flex-row">';
            $contenu_panier .= '<p>Total</p>';
            $contenu_panier .= '<p>' .MontantGlobal(). '</p>';
            $contenu_panier .= '<input type="submit" value="Rafraichir">';
            $contenu_panier .= '<input type="hidden" name="action" value="refresh">';
        }
    }
    ?>

</header>
        <section class="content">
          <h2 class="text-center mt-5 mb-5">Mes commandes</h2>
        <form method="post" action="panier.php">
        <?php echo $contenu_panier ?>


</form>
</section>

<?php include 'config/template/footer.php'; ?>

