<div class="container containerDefault bg-light shadow-lg p-3 mb-5 border border-secondary">

    <h3 class="text-primary bienvenue text-center" style="margin-top:10px;">Bienvenue sur le blog de <span style="font-style:italic;">Jean Forteroche</span></h3>
    <h5 class="text-center text-dark bg-white rounded border border-muted" style="margin-bottom:25px;padding:15px;">Vous retrouverez ici tout les épisodes du livre <span style="font-style:italic;">"Billet simple pour l'Alaska"</span></h5>  
    <div class="container-fluid row justify-content-center" style="margin-bottom:45px;">

        <img src="../public/images/livre.png" alt="livre" class="imageAccueil">

    </div>

    <?php foreach($posts as $post): ?>
    <div class="cadreEpisode border border-muted rounded text-dark" style="margin-bottom:25px;">    
        <h5>
            <a href="<?= $post->url; ?>"><?= $post->titre; ?></a>
        </h5>

        <p><?= $post->extrait;?></p>
    </div>
    <?php endforeach; ?>
    <p class="text-center" style="margin-bottom:15px;margin-top:15px;">
            <a class="btn btn-primary" href="index.php?p=posts.liste">Tous les épidodes</a>
    </p>
</div>

