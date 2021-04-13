<?php 
include 'config/template/head.php'; 

    if(!isset($_SESSION['user']))
    {
    header('location:login.php?access=forbidden');
    exit();
    }

    if($_SESSION['user']['statut'] == 1) {
        header('location:profil_admin.php?connect=forbidden');
        exit();
    } 

?>           
                </header>
                <section class="member-profil p-5">
                    <!----Emplacement_où_sera_affiché_connexion_réussie------------------------------------>
                    <?php echo $content; ?>
                    <h2 class="text-center">Bienvenue <?= $_SESSION['user']['pseudo']; ?></h2>
                        <article class="card">
                            <h3 class="m-auto"> Vos coordonnées</h3>
                            <hr>
                            <div class="coordonnees pl-5">
                                <div>
                                    <h3>Adresse postale</h3>
                                    <p><?= $_SESSION['user']['adresse']; ?></p>
                                </div>
                                <div>
                                    <h3>Adresse email</h3>
                                    <p><?= $_SESSION['user']['email']; ?></p>
                                </div>
                                <div>
                                    <h3>Numéro de téléphone</h3>
                                    <p>+33 <?= $_SESSION['user']['telephone']; ?></p>
                                </div> 
                            </div>
                        </article>
                    <a class="deconnexion d-flex py-5 px-0 m-auto" href="deconnexion.php" aria-label="lien qui permet de se déconnecter">Déconnexion</a>
                </section>
<?php include 'config/template/footer.php'; ?>