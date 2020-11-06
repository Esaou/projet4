<div class="container starter-template containerDefault bg-light shadow-lg p-3 mb-5 border border-secondary" >
    <h3 class="text-center text-primary" style="margin-bottom:35px;margin-top:10px;">Liste des épisodes</h3>

    <?php foreach($posts as $post): ?>
    <div class="cadreEpisode rounded border border-muted text-dark" style="margin-bottom:25px;">    
        <h5>
            <a href="<?= $post->url; ?>"><?= $post->titre; ?></a>
        </h5>

        <p><?= $post->extrait;?></p>
    </div>
    <?php endforeach; ?>
    <p class="row text-primary" style='font-size:18px;margin-top:20px;margin-bottom:40px;'>
        Pages : 
        <?php 
        for($i=1;$i <= $pagesTotales;$i++){

            if($i == $pageCourante){

                echo "<span style='display:flex;justify-content:flex-end;min-width:20px;font-size:18px;text-decoration:underline;'>$i</span>";
            }else{

                echo "<a href='index.php?p=posts.liste&page=$i' style='display:flex;justify-content:flex-end;min-width:20px;font-size:18px;'>$i</a>";

            }
    
        } 
        
        ?>
    </p>
</div>