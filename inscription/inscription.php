<?php 
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=test', 'root', 'root');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

$erreur=null;
if (isset($_POST['submit'])){
    $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);  
   $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
  $password = password_hash($password, PASSWORD_DEFAULT);

    // on garde
    if ($password && $login){
                if(strlen($password)>=6){
                        //Insertion dans la base de données
                        $insertmbr = $bdd->prepare('INSERT INTO users (login, password) VALUES (?, ?)');
                        $insertmbr->execute(array($login, $password));
                       
                } else $erreur = "Le mot de passe est trop court !";
        } else $erreur = "Le pseudo n'est pas valide !";
     // else $erreur = "Veuillez remplir tous les champs !";
}
?>
<h1>Espace Membre</h1>
<form action="" method="post">
    
	<label for="login">login</label>
	<input type="text" name="login" placeholder="login"><br>
    
	<label for="password">Mot de passe</label> 
	<input type="password" name="password" id="password"><br>
	
	<input type="submit" name="submit" value="M'inscrire">
</form>
<?php
    if(isset($erreur)){
        echo $erreur;
    }
    var_dump($_POST);
?>
