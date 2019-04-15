<?php $title = "Administration"; ?>

<?php ob_start(); ?>

    <table>
        <p> Gérer les commentaires </p>
        <thead>
            <tr>
                <th>Auteur</th>
                <th>Commentaires</th>
                <th>Nombre de signalement</th>
                <th>postid </th>
                <th>Supprimer 
                  Modérer</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($reportedComments as $reportedComment) : ?>
            <tr>


                <td>
                    <?= $reportedComment->author(); ?>
                </td>

                <td>
                    <?= $reportedComment->comment(); ?>
                </td>

                <td>
                    <?= $reportedComment->report_nb(); ?>
                </td>

                <td>
                    <?= $reportedComment->post_id(); ?>
                </td>


                <td> <a class="deleteComment" href="delete=<?= $reportedComment->id(); ?>">Supprimer </a><br/>
               <a class="moderateComment" href="moderate=<?= $reportedComment->id(); ?>">Modérer </a> </td>

            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div id="listepost">
        <h2 id="">Liste des articles</h2>
        <table>
            <thead>
                <th>Titre de l'article</th>
                <th>Date de création</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </thead>
            <tbody>
                <?php
        foreach ($posts as $post){
   
            ?>
                <tr id="Post<?= $post->id(); ?>">
                    <td>
                        <?= $post->title(); ?>
                    </td>
                    <td>
                        <?= $post->creation_date(); ?>
                    </td>
                    <td><a class="editPost" href="editPost=<?= $post->id(); ?>">Modifier</a></td>
                    <td><a class="deletePost" href="deletePost=<?= $post->id(); ?>">Supprimer</a></td>
                </tr>
                <?php
        }
        ?>
            </tbody>
        </table>




        <h3 id="e"> Ajouter un article </h3>

        <div id="myform">
            <form method="post" action="#e">

                <?php
  if (isset($message))
  {
    echo $message, '<br />';
  }
?>
                <p>
                    <label for="title"> Titre </label><br />
                    <?php if (isset($errors) && in_array(Post::TITRE_INVALIDE, $errors)) echo 'Le titre est invalide.<br />'; ?>
                    <input type="text" id="mytitlearea" name="title" value="<?php  if (isset($news)) echo $news->title(); ?>" required>
                </p>
                <p>
                    <label for="content"> Contenu </label><br />
                    <?php if (isset($errors) && in_array(Post::CONTENU_INVALIDE, $errors)) echo 'L\’article est invalide.<br />'; ?>
                    <textarea id="myform" name="content"> <?php if(isset($news)) echo $news->content(); ?>   </textarea>
                </p>
                <p>
                    <?php
 if(isset($news) && !$news->isNew())
{
?>
                    <input type="hidden" name="id" value="<?= $news->id() ?>" />
                    <input type="submit" value="Mettre à jour" name="editPost" />
                    <button style="background-color:blue;"><a style="color:white" href="../admin/#e">Retour</a></button>
                    <?php
}
else
{
?>
                    <input type="submit" name="addPost" value="Ajouter" />
                    <?php
}
?>

                </p>
                <a href="../accueil/"> Retour au blog </a>
                <br/>
                <a href="<?= $_SERVER['REQUEST_URI']; ?>logout/"> Déconnexion </a>
            </form>
        </div>
    </div>

<?php $content = ob_get_clean(); 
require('template/admin.html');