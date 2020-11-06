<div class="container starter-template containerDefaultLogin">
    <form class="login shadow-sm p-3 mb-5 rounded bg-light border border-muted" method="post">

        <h5 class="text-primary" style="margin-bottom:20px;">Modifier mon profil</h5>
        <?php 
        $request = new App\Config\Request();
        $token = base_convert(hash('sha256', time() . mt_rand()), 16, 36);
        $tokenSession = $request->getSession()->set('token',$token);
        $tokenSession = $request->getSession()->get('token');
        ?>
        <input type="hidden" name="token" id="token" value="<?=$token;?>"/>
        <?= $form->input('Username'); ?>
        <?= $form->password('Password'); ?>
        <?= $form->password('Confirm'); ?>
        <?php

            if($error){

                ?>
                    <div class="alert alert-danger">Tous les champs doivent être complétés !</div>
                <?php

            }
            if($errorToken){

                ?>
                    <div class="alert alert-danger">Token de sécurité périmé</div>
                <?php

            }
            if($errors){

                ?>
                    <div class="alert alert-danger">Mots de passes non-identiques !</div>
                <?php

            }

        ?>
        <button class="btn btn-primary" style="margin-bottom:15px;margin-top:5px;">Sauvegarder</button>
        <a class="btn btn-outline-primary" href="index.php?p=admin.posts.index">Retour page administrateur</a>

    </form>
</div>