<div class="container starter-template containerDefaultLogin">
    <form class="login rounded shadow-lg p-3 mb-5 bg-light text-dark border border-secondary" method="post">
        <?php 
        $request = new App\Config\Request();
        $token = base_convert(hash('sha256', time() . mt_rand()), 16, 36);
        $tokenSession = $request->getSession()->set('token',$token);
        $tokenSession = $request->getSession()->get('token');
        ?>
        <input type="hidden" name="token" id="token" value="<?=$token;?>"/>
        <?= $form->input('username'); ?>
        <?= $form->password('password'); ?>
        <button class="btn btn-success" style="margin-top:10px">Se connecter</button>
        <?php

            if($errors){

                ?>
                    <div class="alert alert-danger" style="margin-top:15px">Identifiants incorrects</div>
                <?php

            }

            if($error){

                ?>
                    <div class="alert alert-danger" style="margin-top:15px">Token de sécurité périmé</div>
                <?php

            }

        ?>
    </form>
</div>