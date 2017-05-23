<!doctype html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<title>Admin - Article</title>
	<link rel="stylesheet" href="../../css/style.css">
	<script src="../../js/script.js"></script>
</head>

<body id="a_admin_article">
	<header>
		<p>Try Again - Admin</p>
	</header>
    <?php  
        try{
            $bdd=new PDO("mysql:host=localhost;dbname=tryagain; charset=utf8","root","");
        }
            catch(PDOException $e){
                die('Erreur : ' . $e->getMessage());
            } 
        $bdd ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            /* On met l'auteur en premier en bdd pour récup on id et le réutiliser dans la dernière requête */
        $articleAuthor = $bdd->prepare("INSERT INTO author(first_name, last_name, email) VALUES (?,?,?)");
        $authorId = $bdd->prepare("SELECT author_id FROM author WHERE first_name = ? AND last_name = ?");
        $newArticle = $bdd->prepare("INSERT INTO article(article_title, article_txt, author_id, article_date, article_img) VALUES (?,?,?,CURRENT_DATE, ?)");
    
            /* Supprimer un article */
        /* Dans un premier temps on selectionne tous les articles en BDD */
        $articles = $bdd->query("SELECT * FROM article");
        /* On enlève un burger de la bdd en fonction de son id */
        $deleteArticle = $bdd->prepare("DELETE FROM `article` WHERE `article`.`article_id` = ?");


    ?>
	<h1>Article</h1>
	<div id="a_articleModifsContainer">
		<div id="addArticleContainer">
			<h2>Ajouter</h2>
			<form method="POST" action="adminArticle.php" enctype="multipart/form-data">
				<div>
					<label for="articleTitle">Titre de l'article</label>
					<input type="text" name="articleTitle"> </div>
				<div>
					<label for="contenuArticle">Article</label>
					<textarea name="articleTxt"></textarea>
				</div>
				<div>
					<label for="auteurFirstName">Prénom de l'auteur</label>
					<input type="text" name="auteurFirstName"> </div>
				<div>
					<label for="auteurLastName">Nom de l'auteur</label>
					<input type="text" name="auteurLastName"> </div>
                <div>
					<label for="auteurMail">Email auteur</label>
					<input type="mail" name="auteurMail"> </div>
                <div>
                    <label for="articleImg">Image de l'évenement</label>
                    <input type="file" size="5000" name="articleImg">
                </div>
				<input type="submit" value="Ajouter" name="ajouter"> 
                <?php 
                    if(isset($_POST['ajouter'])){
                        /* traitement des données */
                        
                        
                         $erreur="";
                        /* Traitement de l'image */
                        if ($_FILES['articleImg']['error'] > 0){ 
                            $erreur .= "Erreur lors du transfert"."<br/>";
                        }
                        /* On teste la taille du fichier */
                        if ($_FILES['articleImg']['size'] > 5000) {
                            $erreur .= "Le fichier est trop volumineux"."<br/>";
                        }
                        /* On teste son extension */
                        $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
                        $extension_upload = strtolower(  substr(  strrchr($_FILES['articleImg']['name'], '.')  ,1)  );
                        if ( !in_array($extension_upload,$extensions_valides) ) {
                            $erreur .= "Extension Incorrecte"."<br/>";
                        }
                            /* Si un fichier est spécifié dans le formulaire */
                        if (isset($_FILES["articleImg"]["name"]) ) { 
                            
                            $name = $_FILES["articleImg"]["name"]; 
                            $tmp_name = $_FILES['articleImg']['tmp_name'];
                            $error = $_FILES['articleImg']['error'];

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
                        $firstName = htmlspecialchars($_POST['auteurFirstName']);
                        $lastName = htmlspecialchars($_POST['auteurLastName']);
                        $mail = htmlspecialchars($_POST['auteurMail']);
                        $articleTitle = htmlspecialchars($_POST['articleTitle']);
                        $articleTxt = htmlspecialchars($_POST['articleTxt']);
                        /* Execution des requêtes */
                        $articleAuthor->bindParam('1', $firstName);
                        $articleAuthor->bindParam('2', $lastName);
                        $articleAuthor->bindParam('3', $mail);
                        $articleAuthor->execute();
                        
                        $authorId->bindParam('1', $firstName);
                        $authorId->bindParam('2', $lastName);
                        $authorId->execute();
                        $author = $authorId->fetch();
                        
                        $newArticle->bindParam('1', $articleTitle);
                        $newArticle->bindParam('2', $articleTxt);
                        $newArticle->bindParam('3', $author['0']);
                        $newArticle->bindParam('4', $pathImage);
                        $newArticle->execute();
                    }
                ?>
            </form>
		</div>
		<div id="removeArticleContainer">
			<h2>Supprimer</h2>
			<form action="" method="post">
                <select name="supprArticle" id="supprArticle">
                    <?php 
                       if(isset($_POST['suppr'])){
                            $chosenArticle = htmlspecialchars($_POST['supprArticle']);
                            $deleteArticle->bindParam('1', $chosenArticle);
                            $deleteArticle->execute();
                       }   

                        while($article = $articles->fetch()){
                            print_r("<option value='".$article['article_id']."'>".$article['article_title'].' '.$article['article_date']."</option>");
                         } 

                        ?>
				
					<!--					Recuperer tous les articles et choisir lequel supprimer avec le nom dans la liste-->
					
				</select>
				<input type="submit" value="Supprimer" name="suppr"> </form>
		</div>
	</div>
</body>

</html>