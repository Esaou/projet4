<?php 
    $request = new App\Config\Request();
    $token = base_convert(hash('sha256', time() . mt_rand()), 16, 36);
    $tokenSession = $request->getSession()->set('token',$token);
    $tokenSession = $request->getSession()->get('token');
?>  

<div class="container starter-template containerDefaultDeux bg-light border border-muted">
    <div class="container" style="margin-bottom:35px;margin-top:25px;">
        <h5 style="padding-bottom:5px;" class="text-left text-danger">Commentaires signalés</h5>
        <p class="text-left">
            <a href="?p=admin.posts.index" style="margin-top:10px;" class="btn btn-outline-primary">Retour page administateur</a>
            <a href="?p=admin.posts.comment" style="margin-top:10px;" class="btn btn-outline-primary">Gérer les commentaires</a>
        </p>
        <table class="table table-striped table-responsive-sm text-center">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">Auteur</th>
                        <th scope="col">Commentaire</th>
                        <th scope="col">Date</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($commentSignals as $commentSignal): ?>
                        <tr>
                            <td><?= $commentSignal->pseudo;?></td>
                            <td><?php if(strlen($commentSignal->commentaire)<150){
                                echo substr($commentSignal->commentaire,0, 150);
                            } else {
                                echo substr($commentSignal->commentaire,0, 150) . '...';
                            }?></td>
                            <td><?= 'à ' . date("H:i:s", strtotime($commentSignal->date)) . ' le '  . date("d/m/Y", strtotime($commentSignal->date)); ?></td>
                            <td>
                                <form action="?p=admin.posts.deleteSignalement&id=<?=$commentSignal->id?>&article_id=<?=$commentSignal->article_id?>" method="post" style="display:inline;">  
                                    <input type="hidden" name="token" id="token" value="<?=$token;?>"/>
                                    <button type="submit" style="margin-top:5px;" class="btn btn-outline-primary">Retirer signalement</button>
                                </form>
                                <form action="?p=admin.posts.deleteComment&id=<?=$commentSignal->id;?>" method="post" style="display:inline;">
                                    <input type="hidden" name="token" id="token" value="<?=$token;?>">
                                    <button type="submit" style="margin-top:5px;" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
        </table>
        <p class="row justify-content-center text-primary" style='font-size:18px;'>
            Pages : 
            <?php 
                for($i=1;$i <= $pagesTotales;$i++){

                    if($i == $pageCourante){

                        echo "<span style='display:flex;justify-content:flex-end;min-width:20px;font-size:18px;text-decoration:underline;'>$i</span>";
                    }else{

                        echo "<a href='index.php?p=admin.posts.commentSignal&page=$i' style='display:flex;justify-content:flex-end;min-width:20px;font-size:18px;'>$i</a>";

                    }
                }  
            ?>
        </p>
    </div>
</div>