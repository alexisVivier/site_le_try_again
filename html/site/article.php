<!DOCTYPE html>
<html>
<?php Try {
	$bdd = new PDO('mysql:host=localhost;dbname=tryagain;charset=utf8', 'root', '');
    $bdd ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
}  
    $articleId = $_GET['id'];
    $articles = $bdd->query("SELECT * FROM article ar JOIN author au ON (au.author_id = ar.author_id) AND ar.article_id =".$articleId );
    $article = $articles->fetch();
    print_r("
<head>
    <meta charset='utf-8' />
<title>".$article['article_title']."</title>
    <link href='../../css/style.css' rel='stylesheet'>
    <link href='https:\/\/fonts.googleapis.com/css?family=Lobster|Mul' rel='stylesheet'> </head>

<body id='a_Article'>
    <header id='s_header'>
        <div id='titre'> <img src='../../images/food-truck.svg' href='header.html' title='foodtruck' alt='foodtruck' id='logo_foodtruck' />
            <a id='le_try_again' href='header.html'>
                <p>Le Try Again</p>
            </a>
        </div>
        <div id='navigation'>
            <a class='nav' id='menus' href='header.html'>
                <p>Menus</p>
            </a>
            <a class='nav' id='retrouvez_nous' href='header.html'>
                <p>Retrouvez-nous</p>
            </a>
            <a class='nav' id=evenements href='header.html'>
                <p>Evenements </p>
            </a>
            <a class='nav' id='l\'equipe' href='header.html'>
                <p>L'équipe </p>
            </a>
            <a class='nav' id='a propos' href='header.html'>
                <p>A propos </p>
            </a>
            <a class='nav' id='blog' href='header.html'>
                <p>Blog </p>
            </a>
            <a class='nav' id='contact' href='header.html'>
                <p>Contact </p>
            </a>
        </div>
    </header>

    

    <section>
        <div id='title'>
            <h1>".$article['article_title']."</h1>
        </div>
        <div id='container'>
            <div id='left'> <img src='".$article['article_img']."'>
                <div id='botInfos'>
                    <?xml version='1.0' ?>
                    <!DOCTYPE svg  PUBLIC '-//W3C//DTD SVG 1.1//EN'  'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'>
                    <svg id='Layer_1' style='enable-background:new 0 0 512 512;' version='1.1' viewBox='0 0 512 512' xml:space='preserve' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'>
							<path d='M448,448c0,0,0-26.4-2.2-40.2c-1.8-10.9-16.9-25.3-81.1-48.9c-63.2-23.2-59.3-11.9-59.3-54.6c0-27.7,14.1-11.6,23.1-64.2  c3.5-20.7,6.3-6.9,13.9-40.1c4-17.4-2.7-18.7-1.9-27c0.8-8.3,1.6-15.7,3.1-32.7C345.4,119.3,325.9,64,256,64  c-69.9,0-89.4,55.3-87.5,76.4c1.5,16.9,2.3,24.4,3.1,32.7c0.8,8.3-5.9,9.6-1.9,27c7.6,33.1,10.4,19.3,13.9,40.1  c9,52.6,23.1,36.5,23.1,64.2c0,42.8,3.9,31.5-59.3,54.6c-64.2,23.5-79.4,38-81.1,48.9C64,421.6,64,448,64,448h192H448z' />
						</svg>
                    <div>
                        <p>".$article['last_name']."</p>
                        <p>".$article['first_name']."</p>
                        <p>".$article['email']."</p>
                    </div>
                </div>
            </div>
            <div id='right'>
                <p>".$article['article_txt']."</p>
            </div>
        </div>
    </section>
");