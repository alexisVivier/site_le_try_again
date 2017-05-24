<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Admin - Burgers</title>
    <link rel="stylesheet" href="../../css/style.css">
    <script src="../../js/script.js"></script>
</head>
<header>
    <p>Try Again - Admin</p>
</header>
<?php  try{
            $bdd=new PDO("mysql:host=localhost;dbname=tryagain; charset=utf8","root","");
        }
            catch(PDOException $e){
                die('Erreur : ' . $e->getMessage());
            }
        
        $bdd ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        /*---------Gestion ajout burger--------*/
        /* On prépare l'entrée d'une nouvelle viande */
        $newMeat = $bdd->prepare("INSERT INTO meat(meat_name) VALUES (?)");
        /* On récup l'ID de cette nouvelle viande */
        $newMeatId = $bdd->prepare("SELECT meat_id FROM meat WHERE meat_name = ?");
        /* On envoies les ingrédients du burger en bdd */
        $ingredients = $bdd->prepare("INSERT INTO ingredient(salad, tomatoes, onions, pickles) VALUES (?, ?, ?, ?)");
        /* On récup l'id associé */
        $newIngredientId = $bdd->prepare("SELECT ingredient_id FROM ingredient WHERE salad = ? AND tomatoes = ? AND onions = ? AND pickles = ?");
        /* Enfin on Crée ce nouveau burger qui sera sélectionnable plus tard */
        $newBurger = $bdd->prepare("INSERT INTO burger(burger_name, ingredient_id, meat_id, cheese_id, sauce_id, burger_image) VALUES (?, ?, ?, ?, ?, ?)");
    
        /* Selection de tous les fromages pour afichage dynamique */
        $cheeses = $bdd->prepare("SELECT * FROM cheese");
        /* Selection de toutes les sauces pour afichage dynamique */
        $sauces = $bdd->prepare("SELECT * FROM sauces");
        /* Selection de toutes les viandes pour afichage dynamique */
        $meats = $bdd->prepare("SELECT * FROM meat");
        /*---------Fin gestion ajout burger--------*/
        
        /*---------Gestion suppression burger--------*/
        /* Dans un premier temps on selectionne tous les burgers en BDD */
        $burgers = $bdd->prepare("SELECT * FROM burger");
        /* On enlève un burger de la bdd en fonction de son id */
        $deleteBurger = $bdd->prepare("DELETE FROM `burger` WHERE `burger`.`burger_id` = ?");
        /*---------Fin gestion suppression burger--------*/
        /* On récup l'id de la nouvelle paire d'ingrédients du burger */
        $modifBurgerIngredient = $bdd->prepare("SELECT ingredient_id FROM ingredient WHERE salad = ? AND tomatoes = ? AND onions = ? AND pickles = ?");
        /* Requete finale de modif du burger séléctionné */
        $burgerUpdated = $bdd->prepare("UPDATE burger SET burger_name = ?, ingredient_id = ?, meat_id = ?, cheese_id = ?, sauce_id = ?, burger_image = ? WHERE burger_id = ?");
    
    
        /*---------Gestion modification burger--------*/
        
        
    ?>

<body id="a_admin_burgers">
    <h1>Burgers</h1>
    <div id="a_burgersModifsContainer">
        <div id="a_burgersModifsAdd">
            <h2>Ajouter</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <div>
                    <label for="burgerName">Nom du burger</label>
                    <input type="text" name="burgerName" required/> </div>
                <div>
                    <label for="meatForm">Viande</label>
                        <select name='meatForm' id='meatForm'>
                            <?php 
                            $meats->execute();
                            while($meat = $meats->fetch()){
                            print_r("
                            <option value='".$meat['meat_id']."'>".$meat['meat_name']."</option>
                            ");
                            };
                            $meats->closeCursor();
                            ?>
                            <option value="0">Insérer une nouvelle viande :</option>
                        </select>
                    </div>
                    <input type="text" name="typeViandeAddSelection"  /> 
                <div>
                    <label for="ingredientsAddSalad">Salade : </label>
                    <label for="ingredientsAddSalad"> Oui </label>
                    <input type="radio" name="ingredientsAddSalad" value="1" required/>
                    <label for="ingredientsAddSalad"> Non </label>
                    <input type="radio" name="ingredientsAddSalad" value="0" required/> </div>
                <div>
                    <label for="ingredientsAddTomatoes">Tomates : </label>
                    <label for="ingredientsAddTomatoes"> Oui </label>
                    <input type="radio" name="ingredientsAddTomatoes" value="1" />
                    <label for="ingredientsAddTomatoes"> Non </label>
                    <input type="radio" name="ingredientsAddTomatoes" value="0" /> </div>
                <div>
                    <label for="ingredientsAddOnions">Oignons : </label>
                    <label for="ingredientsAddOnions"> Oui </label>
                    <input type="radio" name="ingredientsAddOnions" value="1" />
                    <label for="ingredientsAddOnions"> Non </label>
                    <input type="radio" name="ingredientsAddOnions" value="0" /> </div>
                <div>
                    <label for="ingredientsAddPickles">Cornichons : </label>
                    <label for="ingredientsAddPickles"> Oui </label>
                    <input type="radio" name="ingredientsAddPickles" value="1" />
                    <label for="ingredientsAddPickles"> Non </label>
                    <input type="radio" name="ingredientsAddPickles" value="0" /> </div>

                    <div>
                        <select name='cheeseForm' id='cheeseForm'>
                            <?php 
                            $cheeses->execute();
                            while($cheese = $cheeses->fetch()){
                            print_r("
                            <option value='".$cheese['cheese_id']."'>".$cheese['cheese_name']."</option>
                            ");
                            };
                            $cheeses->closeCursor();
                            ?>
                        </select>
                    </div>
                    <div>
                        <select name="sauceForm" id="sauceForm">
                            <?php 
                            $sauces->execute();
                            while($sauce = $sauces->fetch()){
                            print_r("
                            <option value='".$sauce['sauce_id']."'>".$sauce['sauce_name']."</option>
                            ");
                            };
                            $sauces->closeCursor();
                            ?>
                        </select>
                    </div>
                <div>
                    <label for="eventImg">Image de l'évenement</label>
                    <input type="file" size="5000" name="eventImg" required>
                </div>

                <input type="submit" name="ajouter" value="Ajouter">
                <?php 
                if(isset($_POST['ajouter'])){
                /*On traite toutes les données du FORM*/
                    
                $erreur="";
                        /* Traitement de l'image */
                        if ($_FILES['eventImg']['error'] > 0){ 
                            $erreur .= "Erreur lors du transfert"."<br/>";
                        }
                        /* On teste la taille du fichier */
                        if ($_FILES['eventImg']['size'] > 5000) {
                            $erreur .= "Le fichier est trop volumineux"."<br/>";
                        }
                        /* On teste son extension */
                        $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
                        $extension_upload = strtolower(  substr(  strrchr($_FILES['eventImg']['name'], '.')  ,1)  );
                        if ( !in_array($extension_upload,$extensions_valides) ) {
                            $erreur .= "Extension Incorrecte"."<br/>";
                        }
                            /* Si un fichier est spécifié dans le formulaire */
                        if (isset($_FILES["eventImg"]["name"]) ) { 
                            
                            $name = $_FILES["eventImg"]["name"]; 
                            $tmp_name = $_FILES['eventImg']['tmp_name'];
                            $error = $_FILES['eventImg']['error'];

                            if (!empty($name)) {
                                $location = '../../images/';

                                if  (move_uploaded_file($tmp_name, $location.$name)){
                                    echo 'Uploaded';
                                }else{
                                    echo 'Upload failed';
                                    echo $erreur;
                                }

                            } else {
                                echo 'Please, select a file';
                            }
                        }
                        else {
                            echo $erreur;
                        }
                        
                $pathImage = $location.$name;
                $burgerName = htmlspecialchars($_POST['burgerName']);
                $meat = htmlspecialchars($_POST['meatForm']);
                $newMeatName = htmlspecialchars($_POST['typeViandeAddSelection']);
                $salad=htmlspecialchars($_POST['ingredientsAddSalad']);
                $tomatoes=htmlspecialchars($_POST['ingredientsAddTomatoes']);
                $onions=htmlspecialchars($_POST['ingredientsAddOnions']);
                $pickles=htmlspecialchars($_POST['ingredientsAddPickles']);
                $cheese=htmlspecialchars($_POST['cheeseForm']);
                $sauce=htmlspecialchars($_POST['sauceForm']);
                
                    /* On teste la séléction de viande  */
                if($meat == 0){
                /* On ajoute une nouvelle viande en BDD si une viande n'a pas été déjà insérée, ensuite on recup son ID en bdd*/
                    $newMeat->bindParam('1', $newMeatName);
                    $newMeat->execute();
                    $newMeat->closeCuror();
                /* On récup l'ID de la nouvelle viande */
                    $newMeatId->bindParam('1', $newMeatName);
                    $newMeatId->execute();
                    $meatId = $newMeatId->fetch();
                    $newMeatId->closeCursor();
                }
                    
                /* On recup l'id quatuor d'ingrédients et l'id après les avoir insérés */
                $ingredients->bindParam('1', $salad);
                $ingredients->bindParam('2', $tomatoes);
                $ingredients->bindParam('3', $onions);
                $ingredients->bindParam('4', $pickles);
                $ingredients->execute();
                
                /* On envoie les ingrédients séléctionnés */
                $newIngredientId->bindParam('1', $salad);
                $newIngredientId->bindParam('2', $tomatoes);
                $newIngredientId->bindParam('3', $onions);
                $newIngredientId->bindParam('4', $pickles);
                $newIngredientId->execute();
                $ingredientId = $newIngredientId->fetch();
                
                /* Requête finale d'ajout d'un burger après avoir recup l'ID de ingredient et de la viande */
                $newBurger->bindParam('1', $burgerName);
                $newBurger->bindParam('2', $ingredientId['0']);
                if($meat == 0){
                    $newBurger->bindParam('3', $meatId['0']);
                }else{
                    $newBurger->bindParam('3', $meat);
                }
                $newBurger->bindParam('4', $cheese);
                $newBurger->bindParam('5', $sauce);
                $newBurger->bindParam('6', $pathImage);
                $newBurger->execute();
                }
        ?>
            </form>
        </div>



        <div id="burgersModifsRemove">
            <h2>Supprimer</h2>
            <div>
                <p>Veuillez sélectionner le burger que vous voulez enlever de la carte</p>
                <form action="" method="post" >
                    <select name="supprForm" id="supprForm" required>
                        <!--OPTIONS AVEC BOUCLE POUR AVOIR TOUS LES BURGERS DISPONIBLES ET CHOISIR CELUI QU'ON VEUT SUPPRIMER-->
                        <?php 
                           if(isset($_POST['suppr'])){
                                $chosenBurger = htmlspecialchars($_POST['supprForm']);
                                $deleteBurger->bindParam('1', $chosenBurger);
                                $deleteBurger->execute();
                           }   
                            $burgers->execute();
                            while($burgerSuppr = $burgers->fetch()){
                                print_r("<option value='".$burgerSuppr['burger_id']."'>".$burgerSuppr['burger_name']."</option>");
                             } 
                            $burgers->closeCursor();
                        ?>
					</select>
                    <input type="submit" name="suppr" value="Supprimer">
                </form>
            </div>
        </div>
        <div id="burgersModifsUpdate">
            <h2>Modifier</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <div>
                    <label for="burgerUpSelection">Sélection du burger</label>
                    <select name="burgerUpSelection" required>
                        <?php
                            $burgers->execute();
                            while($burgerUpdate = $burgers->fetch()){
                            print_r("<option value='".$burgerUpdate['burger_id']."'>".$burgerUpdate['burger_name']."</option>");
                             } 
                            $burgers->closeCursor();
                        
                        ?>
                    </select>
                </div>
                <div>
                    <label for="burgerUpName">Nom du burger</label>
                    <input type="text" name="burgerUpName" required/> </div>
                <div>
                    <label for="meatUpForm">Viande</label>
                        <select name='meatUpForm' id='meatForm'>
                            <?php 
                            $meats->execute();
                            while($meatUp = $meats->fetch()){
                            print_r("
                            <option value='".$meatUp['meat_id']."'>".$meatUp['meat_name']."</option>
                            ");
                            };
                            $meats->closeCursor();
                            ?>
                            <option value="0">Insérer une nouvelle viande :</option>
                        </select>
                    </div>
                    <input type="text" name="typeViandeUpSelection"  /> 
                <div>
                    <label for="ingredientsUpSalad">Salade : </label>
                    <label for="ingredientsUpSalad"> Oui </label>
                    <input type="radio" name="ingredientsUpSalad" value="1" required/>
                    <label for="ingredientsUpSalad"> Non </label>
                    <input type="radio" name="ingredientsUpSalad" value="0" required/> </div>
                <div>
                    <label for="ingredientsUpTomatoes">Tomates : </label>
                    <label for="ingredientsUpTomatoes"> Oui </label>
                    <input type="radio" name="ingredientsUpTomatoes" value="1" />
                    <label for="ingredientsUpTomatoes"> Non </label>
                    <input type="radio" name="ingredientsUpTomatoes" value="0" /> </div>
                <div>
                    <label for="ingredientsUpOnions">Oignons : </label>
                    <label for="ingredientsUpOnions"> Oui </label>
                    <input type="radio" name="ingredientsUpOnions" value="1" />
                    <label for="ingredientsUpOnions"> Non </label>
                    <input type="radio" name="ingredientsUpOnions" value="0" /> </div>
                <div>
                    <label for="ingredientsUpPickles">Cornichons : </label>
                    <label for="ingredientsUpPickles"> Oui </label>
                    <input type="radio" name="ingredientsUpPickles" value="1" />
                    <label for="ingredientsUpPickles"> Non </label>
                    <input type="radio" name="ingredientsUpPickles" value="0" /> </div>

                    <div>
                        <select name='cheeseUpForm' id='cheeseModifForm'>
                            <?php 
                            $cheeses->execute();
                            while($cheeseUp = $cheeses->fetch()){
                            print_r("
                            <option value='".$cheeseUp['cheese_id']."'>".$cheeseUp['cheese_name']."</option>
                            ");
                            };
                            $cheeses->closeCursor();
                            ?>
                        </select>
                    </div>
                    <div>
                        <select name="sauceUpForm" id="sauceModifForm">
                            <?php 
                            $sauces->execute();
                            while($sauceUp = $sauces->fetch()){
                            print_r("
                            <option value='".$sauceUp['sauce_id']."'>".$sauceUp['sauce_name']."</option>
                            ");
                            };
                            $sauces->closeCursor();
                            ?>
                        </select>
                    </div>
                <div>
                    <label for="burgerUpImg">Image de l'évenement</label>
                    <input type="file" size="5000" name="burgerUpImg" required>
                </div>

                <input type="submit" name="modifier" value="Modifier">
                 <?php 
                if(isset($_POST['modifier'])){
                /*On traite toutes les données du FORM*/
                    
                $erreur="";
                        /* Traitement de l'image */
                        if ($_FILES['burgerUpImg']['error'] > 0){ 
                            $erreur .= "Erreur lors du transfert"."<br/>";
                        }
                        /* On teste la taille du fichier */
                        if ($_FILES['burgerUpImg']['size'] > 5000) {
                            $erreur .= "Le fichier est trop volumineux"."<br/>";
                        }
                        /* On teste son extension */
                        $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
                        $extension_upload = strtolower(  substr(  strrchr($_FILES['burgerUpImg']['name'], '.')  ,1)  );
                        if ( !in_array($extension_upload,$extensions_valides) ) {
                            $erreur .= "Extension Incorrecte"."<br/>";
                        }
                            /* Si un fichier est spécifié dans le formulaire */
                        if (isset($_FILES["burgerUpImg"]["name"]) ) { 
                            
                            $name = $_FILES["burgerUpImg"]["name"]; 
                            $tmp_name = $_FILES['burgerUpImg']['tmp_name'];
                            $error = $_FILES['burgerUpImg']['error'];

                            if (!empty($name)) {
                                $location = '../../images/';

                                if  (move_uploaded_file($tmp_name, $location.$name)){
                                    echo 'Uploaded';
                                }else{
                                    echo 'Upload failed';
                                    echo $erreur;
                                }

                            } else {
                                echo 'Please, select a file';
                            }
                        }
                        else {
                            echo $erreur;
                        }
                
                
                $pathImageUp = $location.$name;
                $burgerChosen = htmlspecialchars($_POST['burgerUpSelection']);
                $burgerNameUp = htmlspecialchars($_POST['burgerUpName']);
                $meatUp = htmlspecialchars($_POST['meatUpForm']);
                $newMeatNameUp = htmlspecialchars($_POST['typeViandeUpSelection']);
                $saladUp=htmlspecialchars($_POST['ingredientsUpSalad']);
                $tomatoesUp=htmlspecialchars($_POST['ingredientsUpTomatoes']);
                $onionsUp=htmlspecialchars($_POST['ingredientsUpOnions']);
                $picklesUp=htmlspecialchars($_POST['ingredientsUpPickles']);
                $cheeseUp=htmlspecialchars($_POST['cheeseUpForm']);
                $sauceUp=htmlspecialchars($_POST['sauceUpForm']);
                
                    /* On teste la séléction de viande  */
                if($meatUp == 0){
                /* On ajoute une nouvelle viande en BDD si une viande n'a pas été déjà insérée, ensuite on recup son ID en bdd*/
                    $newMeat->bindParam('1', $newMeatNameUp);
                    $newMeat->execute();
                    $newMeat->closeCursor();
                /* On récup l'ID de la nouvelle viande */
                    $newMeatId->bindParam('1', $newMeatNameUp);
                    $newMeatId->execute();
                    $meatId = $newMeatId->fetch();
                }
                    $modifBurgerIngredient->bindParam('1', $saladUp);
                    $modifBurgerIngredient->bindParam('2', $tomatoesUp);
                    $modifBurgerIngredient->bindParam('3', $onionsUp);
                    $modifBurgerIngredient->bindParam('4', $picklesUp);
                    $modifBurgerIngredient->execute();
                    $ingredientUp = $modifBurgerIngredient->fetch();
                    
                    $burgerUpdated->bindParam('1', $burgerNameUp);
                    $burgerUpdated->bindParam('2', $ingredientUp['0']);
                    if($meatUp == 0){
                         $burgerUpdated->bindParam('3', $meatId['0']);
                    }else{
                        $burgerUpdated->bindParam('3', $meatUp);
                    }
                    $burgerUpdated->bindParam('4', $cheeseUp);
                    $burgerUpdated->bindParam('5', $sauceUp);
                    $burgerUpdated->bindParam('6', $pathImageUp);
                    $burgerUpdated->bindParam('7', $burgerChosen);
                    $burgerUpdated->execute();
                }
        ?>
            </form>
        </div>
    </div>
</body>

</html>
