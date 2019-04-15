<?php if(!isset($_SESSION['login'])): ?>

<?php $title = "Page de connexion";  ?>

<?php ob_start(); ?> 
 
        <p>Veuillez saisir vos identifiants  :</p>
       <form action="" method="post">
	<h1> Connexion </h1>
	<p>
		<label for="login">Identifiant</label><br />
		<input type="text" id="login" name="login" required>
	</p>
	<p>
		<label for="password">Mot de passe</label><br />
		<input type="password" name="password" id="password" required>
        <?php  ?> 
	</p>
	<p>
		<input class="button primary" type="submit" value="se connecter">
	</p>
</form>

<?php endif; ?>
<?php if(isset($_SESSION['login']) && isset($_POST['login']) && isset($_POST['password'])) : ?>
	<p>Vous êtes connecté</p>
	<p><a href="views/AdminView.php">Aller vers l'administration</a></p>
<?php endif; ?>
<?php $content = ob_get_clean(); ?>
     
<?php require('template/admin.html'); ?>
