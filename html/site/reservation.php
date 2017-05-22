<!doctype html>
<html>

<head>
	<title>Reservation</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1.0"> </head>
<link rel="stylesheet" type="text/css" href="../../css/style.css">
<?php  
        
        try{
            $bdd=new PDO("mysql:host=localhost;dbname=tryagain; charset=utf8","root","");
        }
            catch(PDOException $e){
                die('Erreur : ' . $e->getMessage());
            }
        
        $bdd ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        
        $newResa = $bdd->prepare("SELECT * FROM event WHERE CURRENT_DATE < event_date ORDER BY event_date");
    
    ?>
<body id="a_reservation">
	<section>
		<div id="descResa"> <img src="../../images/lolo.jpg">
			<p>Ciliciam vero, quae Cydno amni exultat, Tarsus nobilitat, urbs perspicabilis hanc condidisse Perseus memoratur, Iovis filius et Danaes, vel certe ex Aethiopia profectus Sandan quidam nomine vir opulentus et nobilis et Anazarbus auctoris vocabulum referens, et Mopsuestia vatis illius domicilium Mopsi, quem a conmilitio Argonautarum cum aureo vellere direpto redirent, errore abstractum delatumque ad Africae litus mors repentina consumpsit, et ex eo cespite punico tecti manes eius heroici dolorum varietati medentur plerumque sospitales. Quare talis improborum consensio non modo excusatione amicitiae tegenda non est sed potius supplicio omni vindicanda est, ut ne quis concessum putet amicum vel bellum patriae inferentem sequi; quod quidem, ut res ire coepit, haud scio an aliquando futurum sit. Mihi autem non minori curae est, qualis res publica post mortem meam futura, quam qualis hodie sit. Et eodem impetu Domitianum praecipitem per scalas itidem funibus constrinxerunt, eosque coniunctos per ampla spatia civitatis acri raptavere discursu. iamque artuum et membrorum divulsa conpage superscandentes corpora mortuorum ad ultimam truncata deformitatem velut exsaturati mox abiecerunt in flumen. Sed cautela nimia in peiores haeserat plagas, ut narrabimus postea, aemulis consarcinantibus insidias graves apud Constantium, cetera medium principem sed siquid auribus eius huius modi quivis infudisset ignotus, acerbum et inplacabilem et in hoc causarum titulo dissimilem sui.</p>
		</div>
		<form action="" method="post">
			<div id="formResa">
				<div id="infosForm">
					<div id="infosFormTitle">
						<?xml version="1.0" ?>
							<svg height="60px" version="1.1" viewBox="0 0 60 60" width="60px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
								<title/>
								<desc/>
								<defs/>
								<g fill="none" fill-rule="evenodd" id="People" stroke="none" stroke-width="1">
									<g fill="#000000" id="Icon-71">
										<path d="M32,19 L32,41 C32,41.553 31.552,42 31,42 C30.448,42 30,41.553 30,41 L30,21.414 L25.707,25.707 C25.316,26.098 24.684,26.098 24.293,25.707 C23.902,25.316 23.902,24.684 24.293,24.293 L30.293,18.293 C30.579,18.006 31.008,17.919 31.383,18.076 C31.756,18.23 32,18.596 32,19 M30,58 C14.561,58 2,45.439 2,30 C2,14.561 14.561,2 30,2 C45.439,2 58,14.561 58,30 C58,45.439 45.439,58 30,58 M30,0 C13.458,0 0,13.458 0,30 C0,46.542 13.458,60 30,60 C46.542,60 60,46.542 60,30 C60,13.458 46.542,0 30,0" id="number-one" /> </g>
								</g>
							</svg>
							<h2>Informations personelles</h2> </div>
					<div id="infosFormInputs">
						<div class="nomPrenomInfos">
							<div>
								<label for="nomReservation">Nom</label>
								<input type="text" name="nomReservation">
							</div>
							<div>
								<label for="prenomReservation">Prénom</label>
								<input type="text" name="prenomReservation">
							</div>
						</div>
						<div>
							<label for="mailReservation">Adresse mail</label>
							<input type="email"  name="mailReservation">
						</div>
						<div>
							<label for="phoneReservation">Numéro de téléphone</label>
							<input type="number"  name="phoneReservation">
						</div>
						<div>
							<label for="dateEvent">Date de l'évenement</label>
							<input type="date"  name="dateEvent"> </div>
						<div>
							<label for="numerEvent">Nb de personnes présentes</label>
							<input type="number" name="peopleEvent">
						</div> 
					</div>
				</div>
				<div id="eventTypeInputs">
					<div id="eventTypeTitle">
						<?xml version="1.0" ?>
							<svg height="60px" version="1.1" viewBox="0 0 60 60" width="60px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
								<title/>
								<desc/>
								<defs/>
								<g fill="none" fill-rule="evenodd" id="People" stroke="none" stroke-width="1">
									<g fill="#000000" id="Icon-72">
										<path d="M26.707,38.707 C26.693,38.722 26.304,39.148 26.109,40 L35,40 C35.552,40 36,40.447 36,41 C36,41.553 35.552,42 35,42 L25,42 C24.448,42 24,41.553 24,41 C24,38.85 24.975,37.639 25.239,37.349 L32.21,28.386 C32.236,28.353 32.264,28.322 32.293,28.293 C32.307,28.278 34,26.526 34,24 C34,21.794 32.206,20 30,20 C27.794,20 26,21.794 26,24 C26,24.553 25.552,25 25,25 C24.448,25 24,24.553 24,24 C24,20.691 26.691,18 30,18 C33.309,18 36,20.691 36,24 C36,27.136 34.102,29.29 33.757,29.655 L26.79,38.614 C26.764,38.646 26.736,38.678 26.707,38.707 M30,58 C14.561,58 2,45.439 2,30 C2,14.561 14.561,2 30,2 C45.439,2 58,14.561 58,30 C58,45.439 45.439,58 30,58 M30,0 C13.458,0 0,13.458 0,30 C0,46.542 13.458,60 30,60 C46.542,60 60,46.542 60,30 C60,13.458 46.542,0 30,0" id="number-two" /> </g>
								</g>
							</svg>
							<h2>Type évenement</h2> </div>
					<div id="eventTypeForm">
						<div id="typeEventOne">
							<input type="radio" name="eventType" value="anniversaire">
							<p>Anniversaire</p>
						</div>
						<div id="typeEventOne">
							<input type="radio" name="eventType" value="bapteme">
							<p>Baptême</p>
						</div>
						<div id="typeEventOne">
							<input type="radio" name="eventType" value="brunch">
							<p>Brunch</p>
						</div>
						<div id="typeEventOne">
							<input type="radio" name="eventType" value="eventCompany">
							<p>Evenement d'entreprise</p>
						</div>
						<div id="typeEventTwo">
							<input type="radio" name="eventType" value="mariage">
							<p>Mariage</p>
						</div>
						<div id="typeEventThree">
							<input type="radio" name="eventType" value="festival">
							<p>Festival</p>
						</div>
						<div id="typeEventFour">
							<input type="radio" name="eventType" value="autre">
							<p>Autre</p>
						</div>
					</div>
				</div>
				<div id="moreInfosForm">
					<div id="moreInfosFormTitle">
						<?xml version="1.0" ?>
							<svg height="60px" version="1.1" viewBox="0 0 60 60" width="60px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
								<title/>
								<desc/>
								<defs/>
								<g fill="none" fill-rule="evenodd" id="People" stroke="none" stroke-width="1">
									<g fill="#000000" id="Icon-73">
										<path d="M36,36 C36,39.309 33.309,42 30,42 C26.691,42 24,39.309 24,36 C24,35.447 24.448,35 25,35 C25.552,35 26,35.447 26,36 C26,38.206 27.794,40 30,40 C32.206,40 34,38.206 34,36 C34,33.794 32.206,32 30,32 C29.666,32 29.354,31.833 29.168,31.555 C28.982,31.276 28.948,30.924 29.077,30.615 L33.5,20 L25,20 C24.448,20 24,19.553 24,19 C24,18.447 24.448,18 25,18 L35,18 C35.334,18 35.646,18.167 35.832,18.445 C36.018,18.724 36.052,19.076 35.923,19.385 L31.429,30.172 C34.05,30.814 36,33.184 36,36 M30,58 C14.561,58 2,45.439 2,30 C2,14.561 14.561,2 30,2 C45.439,2 58,14.561 58,30 C58,45.439 45.439,58 30,58 M30,0 C13.458,0 0,13.458 0,30 C0,46.542 13.458,60 30,60 C46.542,60 60,46.542 60,30 C60,13.458 46.542,0 30,0" id="number-three" /> </g>
								</g>
							</svg>
							<h2>Informations complémentaires</h2> </div>
					<div id="textAreaMoreInfos">
						<label for="textAreaResa">Si vous avez plus d'infos à nous donner veuillez les mettre dans ce champ : </label>
						<textarea name="textResa"></textarea>
					</div>
				</div>
			</div>
			<input type="submit" value="Envoyer" name="envoyer">
            <?php 
                if(isset($_POST['envoyer'])){
                    $lastName = htmlspecialchars($_POST['nomReservation']);
                    $firstName = htmlspecialchars($_POST['prenomReservation']);
                    $mail = htmlspecialchars($_POST['mailReservation']);
                    $phone = htmlspecialchars($_POST['phoneReservation']);
                    $date = htmlspecialchars($_POST['dateEvent']);
                    $people = htmlspecialchars($_POST['peopleEvent']);
                    $eventType = htmlspecialchars($_POST['enventType']);
                    $eventTxt = htmlspecialchars($_POST['textResa']);
                    
                }
            
            ?>
		</form>
	</section>
</body>

</html>