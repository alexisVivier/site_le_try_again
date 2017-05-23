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
        
        $newEvent = $bdd->prepare("INSERT INTO event(event_title, event_txt, event_place, event_date) VALUES (?, ?, ?, ?)");
    
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
			<form method="POST" action="">
				<div>
					<label for="eventTitle">Titre de l'évenement</label>
					<input type="text" name="eventTitle"> </div>
				<div>
					<label for="eventTxt">Description évenement</label>
					<textarea name="eventTxt"></textarea>
				</div>
				<div>
					<label for="eventPlace">Lieu de l'évenement</label>
					<input type="text" name="eventPlace"> </div>
				<div>
					<label for="eventDate">Date de l'évenement</label>
					<input type="date" name="eventDate"> </div>
				<input type="submit" value="Ajouter" name="ajouter"> 
                <?php
                    if(isset($_POST['ajouter'])){
                        $eventTitle = htmlspecialchars($_POST['eventTitle']);
                        $eventTxt = htmlspecialchars($_POST['eventTxt']);
                        $eventPlace = htmlspecialchars($_POST['eventPlace']);
                        $eventDate = htmlspecialchars($_POST['eventDate']);
                        
                        $newEvent->bindParam('1', $eventTitle);
                        $newEvent->bindParam('2', $eventTxt);
                        $newEvent->bindParam('3', $eventPlace);
                        $newEvent->bindParam('4', $eventDate);
                        $newEvent->execute();
                    }
                ?>
            
            </form>
		</div>
		<div id="removeEventContainer">
			<h2>Supprimer</h2>
			<form action="" method="post">
				<select name="supprEvent" id="supprEvent">
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