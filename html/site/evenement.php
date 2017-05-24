<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title> page évènement</title>
    <link href="../../css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster|Muli" rel="stylesheet">
</head>
<?php
Try {
	$bdd = new PDO('mysql:host=localhost;dbname=tryagain;charset=utf8', 'root', '');
    $bdd ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
}
    
?>

    <body id="s_evenement">
        <div id="titre">
            <h1> Evénements</h1>
        </div>
        <?php
        $events = $bdd->query("SELECT * FROM event");
        while ($event = $events->fetch()) { 
            print_r("
    <div class='un_evenement'>
        <div class='cercle'> </div>
        <div class='cercle2'> </div>
        <div class='image_event'>
            <img title='image évènement' alt='image de l'évènement' src='".$event['event_img']."'  />
        </div>
         <div class='event'>
            <h2 class='event_nom'>".$event['event_title']."</h2>
            <p class='contenue_event'>
            ".$event['event_txt']."
            </p>
            <div class='infos'>
                <p>".$event['event_date']."</p>
                <p>".$event['event_place']."</p>
             </div>
         </div>
    </div>
     "); }; ?>
    </body>

</html>
