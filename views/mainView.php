<?php $title = "Bonjour" ?>

<?php ob_start(); ?>
   
        <p class="mainintro"> 
    Le roman est publié par épisodes sur le site, n'hésitez pas à commenter les écrits ! Écrit par Jean Forteroche. 
    </p>
 
<?php foreach($posts as $post) : ?>
<div class="fullpost">  
    
    <h3 class="posttitle">   <?= $post->title(); ?> </h3>
    
    <p> Le  <?= $post->creation_date(); ?> </p>
    <p>
         <?= $post->content(); ?>  
</p>
     
        <a class="btnpost" href="/<?= $path; ?>/postsimple/<?= $post->id() ?>"  > Voir le post </a>
</div>
<?php endforeach; ?>
<?php $content = ob_get_clean(); ?>

<?php require('template/index.html'); ?>
