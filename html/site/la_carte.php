<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../../css/style.css">
        <meta charset="utf-8" />
        <title>La Carte : Tout nos burgers maison et nos formules</title>
        <meta name="description_la_carte" content="Donnez vous envie avec nos fomules et nos burgers maison à thème geek! Soyez séduis par notre bière d'Astrub. Jetez un œil à nos frites maison." />
    </head>
    
    <?php 
        include 'header.php';
    ?>

    <?php try {
	$bdd = new PDO('mysql:host=localhost;dbname=tryagain;charset=utf8', 'root', '');
    $bdd ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
    }  
    $burgers = $bdd->query("SELECT b.burger_name, b.burger_image, i.salad, i.tomatoes, i.onions, i.pickles, m.meat_name, c.cheese_name, s.sauce_name FROM burger b JOIN ingredient i ON (b.ingredient_id = i.ingredient_id) JOIN meat m ON (b.meat_id = m.meat_id) JOIN cheese c ON (b.cheese_id = c.cheese_id) JOIN sauces s ON (b.sauce_id = s.sauce_id)");
    ?>
    
    <body id="co_laCarte">
<!--        <h1>La Carte</h1>-->
        <section id="co_formules">
            <h2>Nos Formules</h2>
            <section id="co_blockFormules">
                <article class="co_oneFormule" id="co_leNoob">
                    <div class="co_circle"></div>
                    <h3>Le noob</h3>
                    <ul>
                        <li><p>Burger Small</p></li>
                        <li><p>Frites Small</p></li>
                        <li><p>Boisson</p></li>
                    </ul>
                    <div class="co_circlePrice">
                        <p>8€</p>
                    </div>
                </article>
                <article class="co_oneFormule" id="co_leCasual">
                    <div class="co_circle"></div>
                    <h3>Le Casual</h3>
                    <ul>
                        <li><p>Burger Medium</p></li>
                        <li><p>Frites Medium</p></li>
                        <li><p>Boisson</p></li>
                    </ul>
                    <div class="co_circlePrice">
                        <p>11€</p>
                    </div>
                </article>
                <article class="co_oneFormule" id="co_leBossFinal">
                    <div class="co_circle"></div>
                    <h3>Le Boss Final</h3>
                    <ul>
                        <li><p>Burger XXL</p></li>
                        <li><p>Frites XXL</p></li>
                        <li><p>Boisson</p></li>
                    </ul>
                    <div class="co_circlePrice">
                        <p>16€</p>
                    </div>
                </article>
            </section>
        </section>
        <section id="co_burgers">
            <h2>Nos Burgers</h2>
            <section id="co_burgersBlock">
            <?php
                 while($burger = $burgers->fetch()){
                    /* Nos ingrédients en bdd sont des booléens, il faut donc leur donner une valeur avant de les afficher */
                    if($burger['salad'] == 1 ){
                        $salad = 'Salade';
                    }else{
                        $salad = 'Sans salade';
                    };
                    if($burger['tomatoes'] == 1 ){
                        $tomatoes = 'Tomates';
                    }else{
                        $tomatoes = 'Sans tomates';
                    };
                    if($burger['onions'] == 1 ){
                        $onions = 'Oignons';
                    }else{
                        $onions = 'Sans oignons';
                    };
                    if($burger['pickles'] == 1 ){
                        $pickles = 'Cornichons';
                    }else{
                        $pickles = ' ';
                    };

                    print_r("
                        <article class='co_burgerBlock'>
                            <h3>".$burger['burger_name']."</h3>
                            <div class='co_burgerCard'>
                                <div class='co_svgBurgerBlock'>
                                    <img src='".$burger['burger_image']."'/>
                                </div>
                                <div class='co_burgerInformationsBlock'>
                                    <p>".$burger['meat_name']."</p>
                                    <ul class='co_burgerIngredients'>
                                        <li><p>".$burger['cheese_name']."</p></li>
                                        <li><p>".$burger['sauce_name']."</p></li>
                                        <li><p>".$salad."</p></li>
                                        <li><p>".$tomatoes."</p></li>
                                        <li><p>".$onions."</p></li>
                                        <li><p>".$pickles."</p></li>
                                    </ul>
                                </div> 
                            </div>
                        </article>
                    ");
                 }; 
            ?>
            </section>
        </section>
        <section id="co_frites">
            <!--<div id="co_filter">
                <h2>Nos Frites</h2>
                <p>Avec du fromage ? (+1€)</p>
            </div>-->
            <img src="../../images/burger_and_fries_wallpaper.png"/>
            <h2>Nos Frites</h2>
            <p>
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                <path style="fill:#FFC473;" d="M472.176,334.577c0,13.288,10.815,24.103,24.103,24.103h15.72v106.893H0V215.076h509.966
                    c1.299,0,2.044-1.069,1.991-2.106h0.042v97.504h-15.72C482.991,310.474,472.176,321.289,472.176,334.577z"/>
                <path style="fill:#FFB74D;" d="M472.176,334.577c0,13.288,10.815,24.103,24.103,24.103h15.72v106.893H255.245V215.076h254.721
                    c1.299,0,2.044-1.069,1.991-2.106h0.042v97.504h-15.72C482.991,310.474,472.176,321.289,472.176,334.577z"/>
                <path style="fill:#FF9A00;" d="M177.695,406.887c-26.042,0-47.159,21.117-47.159,47.159c0,3.982,0.493,7.839,1.425,11.528h91.467
                    c0.933-3.689,1.425-7.545,1.425-11.528C224.854,428.004,203.737,406.887,177.695,406.887z"/>
                <circle style="fill:#FF8900;" cx="322.525" cy="346.345" r="39.823"/>
                <g>
                    <path style="fill:#FF9A00;" d="M169.699,215.076h-81.47c-5.062,7.682-7.996,16.872-7.996,26.755
                        c0,26.912,21.819,48.731,48.731,48.731s48.731-21.819,48.731-48.731C177.695,231.949,174.76,222.758,169.699,215.076z"/>
                    <path style="fill:#FF9A00;" d="M509.966,215.076H0c0,0-0.493-157.333,148.949-168.651l106.265,48.406l255.58,116.43
                        C512.753,212.153,512.114,215.076,509.966,215.076z"/>
                </g>
                <path style="fill:#E57500;" d="M291.096,111.17c-3.228,17.889-17.711,31.879-35.851,34.363c-1.897,0.262-3.846,0.398-5.816,0.398
                    c-23.391,0-42.349-18.958-42.349-42.349c0-10.008,3.469-19.22,9.285-26.461l38.88,17.711L291.096,111.17z"/>
                <path style="fill:#FF8900;" d="M509.997,215.076H255.245V94.832l255.58,116.43c0.735,0.334,1.105,0.954,1.165,1.598
                    C512.093,213.934,511.34,215.076,509.997,215.076z"/>
                <path style="fill:#C06100;" d="M291.096,111.17c-3.228,17.889-17.711,31.879-35.851,34.363V94.832L291.096,111.17z"/>

                </svg>
                Laissez vous tentez par un nappage de fromage (+1€)
            </p>
        </section>
        <section id="co_boissons">
            <h2>Les Boissons</h2>
            <section id="co_boissonsBlock">
                <article id="co_sansAlcool" class="co_boissonBlock">
                    <div class="co_titleBoissonBlock">
                        <h3>Sans Alcool (33cl)</h3>
                        <img src="../../images/pegi3.png"/>
                    </div>
                    
                    <ul>
                        <li><p>Coca-Cola</p></li>
                        <li><p>Coca-Cola Zero</p></li>
                        <li><p>7-up</p></li>
                        <li><p>Orangina</p></li>
                        <li><p>Ice Tea</p></li>
                        <li><p>Eau Minéral</p></li>
                    </ul>
                </article>
                <article id="co_alcool" class="co_boissonBlock">
                    <div class="co_titleBoissonBlock">
                        <img src="../../images/18.png"/>
                        <h3>Alcool (50cl)</h3>
                        
                    </div>
                    <ul>
                        <li><p>Bière d'Astrub</p></li>
                    </ul>
                </article>
            </section>
        </section>
        
        
        
    </body>
    <?php 
        include 'footer.php';
    ?>
</html>