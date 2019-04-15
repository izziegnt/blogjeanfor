<?php $title = "Chapitre par chapitre"; ?>
<?php ob_start(); ?>

<h1> Billet simple pour l'Alaska </h1>

<h3 class="posttitle">
    <?= $post->title(); ?>
</h3>

<p>Le
    <?= $post->creation_date(); ?>
</p>
<p>
    <?= $post->content(); ?>
</p>

 <a href="/blogjeanfor/accueil/"> Retour à la liste des chapitres </a> <br/><br/>

<form id="newComment" action="" method="post">

    <h3> Ajouter un commentaire </h3>
    <p> <input type="text" id="author" name="author" placeholder="pseudo" required> </p>

    <p> <textarea id="comment" name="comment" placeholder="Commentaire" required></textarea> </p>

    <input type="hidden" id="post_id" name="post_id" value="<?= $post->id(); ?>">


    <?php  if(isset($errors)){echo $errors;} ?>

    <p> <input type="submit" value="Ajouter" name="addComment"> </p>

</form>
<div id="comments">
    <?php foreach($comments as $comment) : ?>
    <p>
        <?= $comment->author(); ?>

        le
        <?= $comment->comment_date(); ?>
        <a class="reportcomment" href="<?= $_SERVER['REQUEST_URI']; ?>/report=<?= $comment->id() ?>">Signaler</a>
        <p>
            <?=$comment->comment(); ?>
        </p>
        <?php endforeach; ?>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('template/post.html'); ?>