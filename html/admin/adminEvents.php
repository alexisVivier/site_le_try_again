<!doctype html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<title>Admin - Evenements</title>
	<link rel="stylesheet" href="../../css/style.css">
	<script src="../../js/script.js"></script>
</head>
<?php  try{
            $bdd=new PDO("mysql:host=localhost;dbname=tryagain; charset=utf8","root","");
        }
            catch(PDOException $e){
                die('Erreur : ' . $e->getMessage());
            }
        
        $bdd ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $newEvent = $bdd->prepare("INSERT INTO event(event_title, event_txt, event_place, event_date, event_img) VALUES (?, ?, ?, ?, ? )");
    
        $events = $bdd->query("SELECT * FROM event WHERE CURRENT_DATE<event_date ORDER BY event_date");
    
        $deleteEvent = $bdd->prepare("DELETE FROM `event` WHERE `event`.`event_id` = ?");
    ?>
<body id="a_admin_evenements">
	<header>
		<p>Try Again - Admin</p>
	</header>
	<h1>Evenements</h1>
	<div id="a_eventModifsContainer">
		<div id="addEventContainer">
			<h2>Ajouter</h2>
			<form method="post" action="" enctype="multipart/form-data">
				<div>
					<label for="eventTitle">Titre de l'évenement</label>
					<input type="text" name="eventTitle" required> </div>
				<div>
					<label for="eventTxt">Description évenement</label>
					<textarea name="eventTxt" required></textarea>
				</div>
				<div>
					<label for="eventPlace">Lieu de l'évenement</label>
					<input type="text" name="eventPlace" required> </div>
				<div>
					<label for="eventDate">Date de l'évenement</label>
					<input type="date" name="eventDate" required> </div>
                <div>
                    <label for="eventImg">Image de l'évenement</label>
                    <input type="file" size="5000" name="eventImg" required>
                </div>
				<input type="submit" value="Ajouter" name="ajouter"> 
                <?php
                    if(isset($_POST['ajouter'])){
                        
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
                        $eventTitle = htmlspecialchars($_POST['eventTitle']);
                        $eventTxt = htmlspecialchars($_POST['eventTxt']);
                        $eventPlace = htmlspecialchars($_POST['eventPlace']);
                        $eventDate = htmlspecialchars($_POST['eventDate']);
                        
                        $newEvent->bindParam('1', $eventTitle);
                        $newEvent->bindParam('2', $eventTxt);
                        $newEvent->bindParam('3', $eventPlace);
                        $newEvent->bindParam('4', $eventDate);
                        $newEvent->bindParam('5', $pathImage);
                        
                        $newEvent->execute();
                    }
                ?>
            
            </form>
		</div>
		<div id="removeEventContainer">
			<h2>Supprimer</h2>
			<form action="" method="post">
				<select name="supprEvent" id="supprEvent" required>
					<?php 
                       if(isset($_POST['suppr'])){
                            $chosenEvent = htmlspecialchars($_POST['supprEvent']);
                            $deleteEvent->bindParam('1', $chosenEvent);
                            $deleteEvent->execute();
                       }   

                        while($event = $events->fetch()){
                            print_r("<option value='".$event['event_id']."'>".$event['event_title'].' '.$event['event_date']."</option>");
                         } 

                        ?>
						<!--					Recuperer tous les articles et choisir lequel supprimer avec le nom dans la liste-->
				</select>
				<input type="submit" value="Supprimer" name="suppr"> </form>
		</div>
	</div>
</body>