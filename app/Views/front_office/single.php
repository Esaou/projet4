<div class="container starter-template containerDefault bg-light shadow-lg p-3 mb-5 border border-secondary">
    <div class="container cadreCommentaire border border-muted rounded text-dark" style="margin-bottom:25px;">
        <h4 style="padding-bottom:20px;" class="text-primary"><?= $post->titre;?></h4>

        <p><?= $post->contenu;?></p>

        <p class="text-right" style="margin-bottom:5px;margin-top:25px;">
            <?php if($previous<$getId){

                echo ("<a class='btn btn-outline-primary'  style='margin:5px;' href='index.php?p=posts.show&id=$previous'>Episode précedent</a>");

            } if($suivant>$getId){

                echo ("<a class='btn btn-outline-primary'  style='margin:5px;' href='index.php?p=posts.show&id=$suivant'>Episode suivant</a>");

            }
            ?>
            <a class="btn btn-primary"  style="margin:5px;" href="index.php?p=posts.liste">Liste des épisodes</a>
        </p>
    </div>
    <div class="container bg-white cadreCommentaire rounded border border-muted text-dark">
        <div class="container">
            <h5 style="padding-bottom:25px;">Commentaires</h5>

            <form method="post">
                <?php 
                $request = new App\Config\Request();
                $token = base_convert(hash('sha256', time() . mt_rand()), 16, 36);
                $tokenSession = $request->getSession()->set('token',$token);
                $tokenSession = $request->getSession()->get('token');

                ?>
                <input type="hidden" name="token" id="token" value="<?=$token;?>"/>
                <?= $form->input('pseudo'); ?>
                <?= $form->textarea('commentaire'); ?>
                <button class="btn btn-success">Poster</button>
            </form>
        <?php
        if($result){
            echo('<div class="alert alert-success text-center" style="margin-top:15px;">Commentaire bien posté !</div>');
        }
        if($error){
            echo('<div class="alert alert-danger" style="margin-top:15px;">Token de sécurité périmé</div>');            
        }
        if($champs){
            if(!$verifs){
                echo('<div class="alert alert-danger" style="margin-top:15px;">Tous les champs du formulaire doivent être complétés !</div>');            
            }
            if(strlen($pseudo) >= 25){
                echo('<div class="alert alert-danger" style="margin-top:15px;">Votre pseudo ne peut contenir plus de 25 caractères !</div>');
            }
        }
        ?>
        </div>
        <div class="container" style="padding-top:50px;">
            <?php
            foreach($comments as $comment): ?>
            
                <div class="container column bg-light rounded border border-muted containerCom text-dark" style="margin-bottom:10px;">
                    <p style="margin-bottom:5px">Posté par <span class="text-primary nomCommentaire"><?= $comment->pseudo; ?></span> : </p>  
                    <p style="margin-bottom:5px"><?= $comment->commentaire;?></p>  
                    <p class="text-primary"><?= 'à ' . date("H:i:s", strtotime($comment->date)) . ' le '  . date("d/m/Y", strtotime($comment->date));?></p>
                    <?php
                        if($comment->signalement === null){
                            ?>
                            <form action="?p=posts.signalement&id=<?=$comment->id?>&article_id=<?=$comment->article_id?>" method="post" style="display:inline;">
                                <input type="hidden" name="token" id="token" value="<?=$token;?>"/>
                                <button type="submit" class="btn btn-outline-danger" style="margin-bottom:15px;">Signaler</button>
                            
                            </form>
                            <?php

                        } else {
                            
                            ?>
                            <p class="alert alert-danger">Ce commentaire a été signalé !</p>
                            <?php
                        }
                    
                    ?>
                </div>
            
            <?php endforeach;?>
        </div>
        <p class="row text-primary justify-content-center" id="tableau" style='font-size:18px;margin-bottom:30px;margin-top:30px;'>
            <?php if($pagesTotales > 0){

                echo ('Pages : ');

            }
            for($i=1;$i <= $pagesTotales;$i++){

                if($i == $pageCourante){

                    echo "<span style='display:flex;justify-content:flex-end;min-width:20px;font-size:18px;text-decoration:underline;'>$i</span>";
                }else{

                    echo "<a href='index.php?p=posts.show&page=$i&id=$getId#tableau' style='display:flex;justify-content:flex-end;min-width:20px;font-size:18px;'>$i</a>";

                }
        
            } 
            
            ?>
        </p>
    </div>
</div>