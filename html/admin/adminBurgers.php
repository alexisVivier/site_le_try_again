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
        /*---------Fin gestion ajout burger--------*/
        
        /*---------Gestion suppression burger--------*/
        /* Dans un premier temps on selectionne tous les burgers en BDD */
        $burgers = $bdd->query("SELECT * FROM burger");
        /* On enlève un burger de la bdd en fonction de son id */
        $deleteBurger = $bdd->prepare("DELETE FROM `burger` WHERE `burger`.`burger_id` = ?");


    ?>

<body id="a_admin_burgers">
    <h1>Menu</h1>
    <div id="a_burgersModifsContainer">
        <div id="a_burgersModifsAdd">
            <h2>Ajouter</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <div>
                    <label for="burgerName">Nom du burger</label>
                    <input type="text" name="burgerName" required/> </div>
                <div>
                    <label for="typeViandeAddSelection">Viande</label>
                    <input type="text" name="typeViandeAddSelection" required /> </div>
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
                    <select name="cheeseForm" id="cheeseForm" required>
						<option value="2">American Cheese</option>
						<option value="3">Bleu</option>
						<option value="8">Brie</option>
						<option value="1">Emmental</option>
						<option value="7">Fromage de chèvre</option>
						<option value="5">Fromage à raclette</option>
						<option value="6">Monterey Jack</option>
						<option value="4">Mozzarella</option>
				</select>
                </div>
                <div>
                    <select name="sauceForm" id="sauceForm" required>
						<option value="1">Biggie</option>
						<option value="2">Ketchup</option>
						<option value="3">Mayonnaise</option>
						<option value="4">Moutarde</option>
						<option value="5">Sauce au bleu</option>
						<option value="6">Sauce au poivre</option>
						
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
                $newMeatName = htmlspecialchars($_POST['typeViandeAddSelection']);
                $salad=htmlspecialchars($_POST['ingredientsAddSalad']);
                $tomatoes=htmlspecialchars($_POST['ingredientsAddTomatoes']);
                $onions=htmlspecialchars($_POST['ingredientsAddOnions']);
                $pickles=htmlspecialchars($_POST['ingredientsAddPickles']);
                $cheese=htmlspecialchars($_POST['cheeseForm']);
                $sauce=htmlspecialchars($_POST['sauceForm']);
                /* On ajoute une nouvelle viande en BDD si une viande n'a pas été déjà insérée, ensuite on recup son ID en bdd*/
                $newMeat->bindParam('1', $newMeatName);
                $newMeat->execute();
                
                /* On récup l'ID de la nouvelle viande */
                $newMeatId->bindParam('1', $newMeatName);
                $newMeatId->execute();
                $meatId = $newMeatId->fetch();
                    
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
                $newBurger->bindParam('3', $meatId['0']);
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
                <form action="" method="post">
                    <select name="supprForm" id="supprForm" required>
                        <!--OPTIONS AVEC BOUCLE POUR AVOIR TOUS LES BURGERS DISPONIBLES ET CHOISIR CELUI QU'ON VEUT SUPPRIMER-->
                        <?php 
                           if(isset($_POST['suppr'])){
                                $chosenBurger = htmlspecialchars($_POST['supprForm']);
                                $deleteBurger->bindParam('1', $chosenBurger);
                                $deleteBurger->execute();
                           }   
                        
                            while($burger = $burgers->fetch()){
                                print_r("<option value='".$burger['burger_id']."'>".$burger['burger_name']."</option>");
                             } 

                        ?>
					</select>
                    <input type="submit" name="suppr" value="Supprimer">
                </form>
            </div>
        </div>
        <div id="burgersModifsUpdate">
            <h2>Modifier</h2>
            <form>
                <div>
                    <label for="burgerUpdateSelection">Sélection du burger</label>
                    <select name="burgerUpdateSelection" required></select>
                </div>
                <div>
                    <label for="burgerTitleUpdateSelection">Titre du burger</label>
                    <input type="text" name="burgerTitleUpdateSelection" /> </div>
                <div>
                    <label for="ingredientsUpdateSelection">Ingrédient</label>
                    <input type="radio" name="ingredientsUpdateSelection" /> </div>
                <div>
                    <label for="ingredientsUpdateSelection">Ingrédient</label>
                    <input type="text" name="ingredientsUpdateSelection" /> </div>
                <div>
                    <label for="ingredientsUpdateSelection">Ingrédient</label>
                    <input type="text" name="ingredientsUpdateSelection" /> </div>
                <div>
                    <label for="ingredientsUpdateSelection">Ingrédient</label>
                    <input type="text" name="ingredientsUpdateSelection" /> </div>
                <div>
                    <label for="typeViandeUpdateSelection">Viande</label>
                    <input type="text" name="typeViandeUpdateSelection" /> </div>
                <input type="submit" value="Modifier">
            </form>
        </div>
    </div>
</body>

</html>
