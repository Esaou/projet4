<div class="container starter-template containerDefaultLogin" style="background-color:rgba(0,0,0,0);">
    <form class="container shadow-sm p-3 mb-5 rounded bg-light border border-muted" method="post">
        <?php 
        $request = new App\Config\Request();
        $token = base_convert(hash('sha256', time() . mt_rand()), 16, 36);
        $tokenSession = $request->getSession()->set('token',$token);
        $tokenSession = $request->getSession()->get('token');
        ?>
        <input type="hidden" name="token" id="token" value="<?=$token;?>"/>
        <?= $form->input('titre'); ?>
        <?= $form->textAreaEditor('contenu'); ?>
        <?php

            if($error){

                ?>
                    <div class="alert alert-danger">Token de sécurité périmé</div>
                <?php

            }
        ?>
        <button class="btn btn-outline-success" style="margin-top:10px;">Sauvegarder</button>
        <a class="btn btn-primary" href="index.php?p=admin.posts.index" style="margin-top:10px;">Retour page administrateur</a>

    </form>
</div>
