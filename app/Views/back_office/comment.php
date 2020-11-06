<?php 
    $request = new App\Config\Request();
    $token = base_convert(hash('sha256', time() . mt_rand()), 16, 36);
    $tokenSession = $request->getSession()->set('token',$token);
    $tokenSession = $request->getSession()->get('token');
?>

<div class="container starter-template containerDefaultDeux bg-light border border-muted">  
    <div class="container" style="margin-bottom:35px;margin-top:25px;">
        <h5 style="padding-bottom:5px;" class="text-left text-primary">Tous les commentaires</h5>
        <p class="text-left">
            <a href="?p=admin.posts.index" style="margin-top:10px;" class="btn btn-outline-primary">Retour page administrateur</a>
            <a href="?p=admin.posts.commentSignal" style="margin-top:10px;" class="btn btn-outline-danger">Gérer les commentaires signalés</a>
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
                    <?php  
                    
                    foreach($comments as $comment): ?>
                        <tr>
                            <td><?= $comment->pseudo;?></td>
                            <td><?php if(strlen($comment->commentaire)<150){
                                echo substr($comment->commentaire,0, 150);
                            } else {
                                echo substr($comment->commentaire,0, 150) . '...';
                            }
                                ?></td>
                            <td><?= 'à ' . date("H:i:s", strtotime($comment->date)) . ' le '  . date("d/m/Y", strtotime($comment->date)); ?></td>
                            <td>
                                <form action="?p=admin.posts.deleteComment&id=<?=$comment->id;?>" method="post" style="display:inline;">
                                    <input type="hidden" name="token" id="token" value="<?=$token;?>">
                                    <button type="submit" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
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

                        echo "<a href='index.php?p=admin.posts.comment&page=$i' style='display:flex;justify-content:flex-end;min-width:20px;font-size:18px;'>$i</a>";

                    }
            
                } 
            
            ?>
        </p>
    </div>
</div>