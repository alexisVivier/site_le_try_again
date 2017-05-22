<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <meta charset="utf-8" />
    <title></title>
    <meta name="" />
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

    <body id="co_blog">
        <h1>Blog</h1>
        <?php
        $articles = $bdd->query("SELECT * FROM article");
        while ($article= $articles->fetch()) { 
            print_r("
            <section id='co_articlesBlock'>
                <a id='button_article' href='article.php?id=".$article['article_id']."'>
                    <article class='co_article' id='".$article['article_id']."'>
                        <h2>".$article['article_title']."</h2>
                        <div class='co_imageContainer'>
                            <img src='../../images/switch%20local%20two%20players.jpg' />
                            <div class='co_vitre'></div>
                        </div>
                        <div class='co_bubble'>

                            <div class='co_triangleBubbleContainer'>
                                <div class='co_triangleBubble'></div>
                            </div>
                            <div class='co_pContainer'>
                                <p>".$article['article_txt']."</p>
                            </div>
                            
                        </div>
                    </article>
                </a>
            </section>
                "); }; ?>
            <script type="text/javascript" src="../../js/jquery-3.2.1.min.js"></script>
            <script type="text/javascript" src="../../js/blog.js"></script>
    </body>

</html>
