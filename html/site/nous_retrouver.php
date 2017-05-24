<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../../css/style.css">
        <meta charset="utf-8" />
        <title></title>
        <meta name="" />
    </head>

    <?php 
        include 'header.php';
    ?>
    <body id="co_nousRetrouver">
<!--        <h1>Retrouvez-nous!</h1>-->
        <section id="co_dayCardsBlock">
            <article class="co_dayCard">
                <p class="co_day">Lundi</p>
                <div class="co_locationsBlock">
                    <p>Midi - Facs</p>
                    <div class="co_separatedLine"></div>
                    <p>Soir - </p>
                </div>
            </article>
            <article class="co_dayCard">
                <p class="co_day">Mardi</p>
                <div class="co_locationsBlock">
                    <p>Midi - IMIE</p>
                    <div class="co_separatedLine"></div>
                    <p>Soir - Epitech</p>
                </div>
            </article>
            <article class="co_dayCard">
                <p class="co_day">Mercredi</p>
                <div class="co_locationsBlock">
                    <p>Midi - YNOV Campus</p>
                    <div class="co_separatedLine"></div>
                    <p>Soir - </p>
                </div>
            </article>
            <article class="co_dayCard">
                <p class="co_day">Jeudi</p>
                <div class="co_locationsBlock">
                    <p>Midi - E-Sport Academy</p>
                    <div class="co_separatedLine"></div>
                    <p>Soir - Facs</p>
                </div>
            </article>
            <article class="co_dayCard">
                <p class="co_day">Vendredi</p>
                <div class="co_locationsBlock">
                    <p>Midi - EPSI</p>
                    <div class="co_separatedLine"></div>
                    <p>Soir - </p>
                </div>
            </article>
            <article class="co_dayCard">
                <p class="co_day">Samedi</p>
                <div class="co_locationsBlock">
                    <p>Midi - </p>
                    <div class="co_separatedLine"></div>
                    <p>Soir - Hangar à bananes</p>
                </div>
            </article>
        </section>
        <div id="co_map"></div>
        <script src="../../js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false" key="AIzaSyC722LSS2-QH6rqTLTY7J4f1EwoiNYrKqo"></script>
        <script src="../../js/googleMap.js"></script>
    </body>
    <?php 
        include 'footer.php';
    ?>
</html>