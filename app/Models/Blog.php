<?php

declare(strict_types=1);

namespace App\Models;

use App\App;

class Blog extends Table{

    public function getURL():string{

        return 'index.php?p=posts.show&id=' . $this->id;

    }

    public function getExtrait():string{

        $html = '<p>' . substr($this->contenu,0, 400) . '...</p>';
        $html .= '<p><a href="' . $this->getURL() . '">Voir la suite</a></p>';
        return $html;
    }

    public function getIndex():void{

        $posts = \App\App::getDb()->query("SELECT * FROM articles ORDER BY id DESC LIMIT 2",'App\Models\Blog');
        $controller = new  \App\Controller\front_office\Controller();
        $controller->render('front_office.index', compact('posts'));

    }

    public function getListe():void{

        $request = new \App\Config\Request();
        $page = $request->getGet()->get('page');
        $episodesParPage = 4;
        $episodesTotalReq = \App\App::getDb()->query('SELECT COUNT(*) AS nb FROM articles');
        $episodesTotal = $episodesTotalReq[0]->nb;
        $pagesTotales = ceil($episodesTotal/$episodesParPage);
        if(isset($page) AND !empty($page) AND $page > 0 AND $page <= $pagesTotales){

            $page = intval($page);
            $pageCourante = $page;

        }else{

            $pageCourante = 1;

        }

        $depart = ($pageCourante - 1)*$episodesParPage;
        $posts = \App\App::getDb()->query("SELECT * FROM articles ORDER BY id DESC LIMIT $depart , $episodesParPage",'App\Models\Blog');
        $controller = new  \App\Controller\front_office\Controller();
        $controller->render('front_office.liste', compact('posts','pagesTotales','episodesTotalReq','pageCourante'));


    }

    public function getShow():void{

        $request = new \App\Config\Request();
        $getId = $request->getGet()->get('id');

        $tokenSession = $request->getSession()->get('token');
        $tokenGet = $request->getPost()->get('token');
        $error = false;

        $page = $request->getGet()->get('page');
        $postPseudo = $request->getPost()->get('pseudo');
        $postCommentaire = $request->getPost()->get('commentaire');
        $post = \App\App::getDb()->prepare('SELECT * FROM articles WHERE id = ?', [$getId], 'App\Models\Blog', true);
        $form = new \App\Service\BootstrapForm($_POST);
        $result = null;
        $verifs = null;
        $pseudo = null;
        $champs = null;
        $taillePseudo = null;
        $postTable = \App\App::getInstance()->getTable('Table');
        $previous = $postTable->precedent($getId);
        $suivant = $postTable->suivant($getId);
        
        if($champs =!empty($_POST)){
            if(isset($tokenGet) && $tokenGet == $tokenSession){
                if($verifs = (isset($postPseudo,$postCommentaire) AND !empty($postPseudo) AND !empty($postCommentaire))){

                    $pseudo = htmlspecialchars($postPseudo);
                    $commentaire = htmlspecialchars($postCommentaire);

                    if(strlen($pseudo) < 25){

                        $result = $postTable->createC([
                
                            'pseudo' => $postPseudo,
                            'commentaire' => $postCommentaire,
                            'article_id' => $getId
                            
                
                        ]);
                    }
                }
            } else {

                $error = true;

            }
        }
        

        $commentairesParPage = 4;
        $commentairesTotalReq = \App\App::getDb()->query("SELECT COUNT(*) AS nb FROM commentaires WHERE article_id = $getId ORDER BY id DESC");
        $commentairesTotal = $commentairesTotalReq[0]->nb;
        $pagesTotales = ceil($commentairesTotal/$commentairesParPage);
        if(isset($page) AND !empty($page) AND $page > 0 AND $page <= $pagesTotales){

            $page = intval($page);
            $pageCourante = $page;

        }else{

            $pageCourante = 1;

        }
        $depart = ($pageCourante - 1)*$commentairesParPage;
        $comments = \App\App::getDb()->query("SELECT * FROM commentaires WHERE article_id = $getId ORDER BY id DESC LIMIT $depart , $commentairesParPage ",'App\Models\Blog');
        $controller = new  \App\Controller\front_office\Controller();
        $controller->render('front_office.single', compact('error','tokenSession','tokenGet','pagesTotales','pageCourante','previous','suivant','post','comments','form', 'getId', 'result','verifs','champs','pseudo'));
    

    }

    public function getSignalement():void{

        $request = new \App\Config\Request();
        $id = $request->getGet()->get('id');
        $articleId = $request->getGet()->get('article_id');
        $tokenSession = $request->getSession()->get('token');
        $tokenGet = $request->getPost()->get('token');

        $postTable = \App\App::getInstance()->getTable('Table');

        if(!empty($_POST)){
            if(isset($tokenGet) && $tokenGet == $tokenSession){
                $result = $postTable->updateSignalement($id,[
                
                    'signalement' => '1',

                ]);
                if($result){

                    header("Location: index?p=posts.show&id=$articleId");

                }
            } else{

                header("Location: index?p=posts.show&id=$articleId");

            }
        }

    }

    public function login(string $username){

        return $user = \App\App::getDb()->prepare('SELECT * FROM users WHERE username = ?', [$username], null,true);

    }
    
    public function getLogin():void{

        $form = new \App\Service\BootstrapForm($_POST);
        $error = false;
        $errors = false;
        $request = new \App\Config\Request();
        $tokenGet = $request->getPost()->get('token');
        $tokenSession = $request->getSession()->get('token');
        $username = $request->getPost()->get('username');
        $password = $request->getPost()->get('password');

        if(!empty($_POST)){
            if(isset($tokenGet) && $tokenGet == $tokenSession){
                $auth = new \App\Database\DbAuth(\App\App::getInstance()->getDb());
                if($auth->login($username,$password)){

                    header('Location: index?p=admin.posts.index');

                } else{

                    $errors = true;

                }

            }else{

            $error = true;
            }
        }
        $controller = new \App\Controller\front_office\Controller();
        $controller->render('front_office.login', compact('form','error','errors','tokenSession'));

    }
}
