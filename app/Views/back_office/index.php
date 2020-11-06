<?php 
    $request = new App\Config\Request();
    $token = base_convert(hash('sha256', time() . mt_rand()), 16, 36);
    $tokenSession = $request->getSession()->set('token',$token);
    $tokenSession = $request->getSession()->get('token');
?>  

<div class="container starter-template containerDefaultDeux bg-light border border-muted">
    <div class="container text-center" style="margin-bottom:30px;">
        <h4 class="text-left text-dark" style="padding-bottom:15px;">Espace Administration</h4>
        <p class="text-left" style="padding-bottom:5px;">
            <a href="?p=admin.posts.profil&id=<?=App\Database\DbAuth::getUserId();?>" class="btn btn-primary">Modifier mon profil</a>
            <a href="?p=admin.posts.deconnecter" class="btn btn-danger">Se déconnecter</a>
        </p>
        <h5 class="text-left text-dark" style="padding-bottom:5px;">Administrer les épisodes</h5>
        <p class="text-left">
            <a href="?p=admin.posts.add" style="margin-top:10px;" class="btn btn-success">Ajouter un épisode</a>
            <a href="?p=admin.posts.comment" style="margin-top:10px;" class="btn btn-outline-primary">Gérer les commentaires</a>
            <a href="?p=admin.posts.commentSignal" style="margin-top:10px;" class="btn btn-outline-danger">Gérer les commentaires signalés</a>
        </p>
        <table class="table table-striped table-responsive-sm">
            <thead>
                <tr class="text-dark">
                    <th scope="col">Date</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($posts as $post):?>
                    <tr>
                        <td><?= 'à ' . date("H:i:s", strtotime($post->date)) . ' le '  . date("d/m/Y", strtotime($post->date));?></td>
                        <td><?= $post->titre;?></td>
                        <td>
                            <a href="?p=admin.posts.edit&id=<?=$post->id?>" class="btn btn-outline-primary"><i class="fas fa-pen"></i></a>
                            <form action="?p=admin.posts.delete&id=<?=$post->id?>" method="post" style="display:inline;">
                                <input type="hidden" name="token" id="token" value="<?=$token;?>"/>
                                <button type="submit" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p class="row justify-content-center text-primary" style='font-size:18px;'>
            Pages : 
            <?php 
                for($i=1;$i <= $pagesTotales;$i++){

                    if($i == $pageCourante){

                        echo "<span style='display:flex;justify-content:flex-end;min-width:20px;font-size:18px;text-decoration:underline;'>$i</span>";
                    }else{

                        echo "<a href='index.php?p=admin.posts.index&page=$i' style='display:flex;justify-content:flex-end;min-width:20px;font-size:18px;'>$i</a>";

                    }
            
                } 
            
            ?>
        </p>
    </div>
</div>


