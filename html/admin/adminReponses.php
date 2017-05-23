<!doctype html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<title>Admin - Reservation</title>
	<link rel="stylesheet" href="../../css/style.css">
	<script src="../../js/script.js"></script>
</head>

<body id="a_admin_mail">
    <?php  
        
        try{
            $bdd=new PDO("mysql:host=localhost;dbname=tryagain; charset=utf8","root","");
        }
            catch(PDOException $e){
                die('Erreur : ' . $e->getMessage());
            }
        
        $bdd ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        
        $displayEvents = $bdd->query("SELECT * FROM reservation WHERE CURRENT_DATE < reservation_date ORDER BY reservation_date");
    
    ?>
    
	<header>
		<p>Try Again - Admin</p>
	</header>
	<h1>Reservations</h1>
    
    <?php
     while($displayEvent = $displayEvents->fetch()){
    
    print_r("
    <div id='mailContainer'>
		<div id='mailText'>
            <h2>".$displayEvent['reservation_obj']."</h2>
			<p>".$displayEvent['reservation_txt']."</p>
		</div>
		<div id='mailInformations'>
			<div id='infosReservationsLeft'>
				<p>Nom : ".$displayEvent['last_name']."</p>
				<p>Prénom : ".$displayEvent['first_name']."</p>
				<p>Date de l'évenement : ".$displayEvent['reservation_date']."</p>
			</div> 
			<div id='infosReservationsRight'>
				<p>Email : ".$displayEvent['email']."</p>
				<p>Numéro de téléphone : ".$displayEvent['tel']."</p>
				<p>Nombre de personnes : ".$displayEvent['reservation_people']."</p>
			</div>
		</div>		
	</div>");
     }
    ?>
</body>

</html>