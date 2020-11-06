<!doctype html>
<html lang="en">
  
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Billet simple pour l'Alaska</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/style.css">
    <link rel="icon" type="image/png" href="../public/images/favicon.png" />
    
    <script src="https://cdn.tiny.cloud/1/ztpdey7r3pk9mfbio8d0phcfh7uymugq03n8ui70exrnuk9e/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>  
    <script>
        tinymce.init({
        selector: '#myEditor',
        toolbar: 'code formatpainter pageembed permanentpen',
        toolbar_mode: 'floating',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        });
    </script>
    <script src="https://kit.fontawesome.com/aee95a7a92.js"></script>
  
    </head>
    
    <body class="fondAdmin">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php?p=posts.index">Billet simple pour l'Alaska</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li class="boutonListe">
                        <a class="btn btn-primary" href="index.php?p=posts.liste">Liste des épisodes</a>
                    </li>
                    <li>
                        <?php 
                        $auth = new App\Database\DbAuth(App\App::getInstance()->getDb());
                        if($auth->logged()==true){

                            echo ("<a href='index.php?p=admin.posts.index' class='btn btn-success'>Espace administration</a>");

                        }
                        ?>
                    </li>
                </ul>
            </div>
        </nav>

        <main role="main" class="container-fluid">

            
                <?= $content; ?>    
            

        </main>
    </body>

</html>
