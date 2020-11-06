<?php

declare(strict_types=1);

namespace App\Models;

class BlogManager extends Table{

    public function getIndex():void{

        $request = new \App\Config\Request();
        $tokenSession = $request->getSession()->get('token');

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
    
        $posts = \App\App::getDb()->query("SELECT * FROM articles ORDER BY id DESC LIMIT $depart , $episodesParPage",'App\Models\BlogManager');
        $users = \App\App::getDb()->query("SELECT * FROM users ORDER BY id DESC",'App\Models\BlogManager');
        $controller = new  \App\Controller\back_office\Controller();
        $controller->render( 'back_office.index', compact('tokenSession','posts','users','pagesTotales','pageCourante'));

    }

    public function getComment():void{

        $request = new \App\Config\Request();
        $tokenSession = $request->getSession()->get('token');

        $page = $request->getGet()->get('page');
        $episodesParPage = 6;
        $episodesTotalReq = \App\App::getDb()->query('SELECT COUNT(*) AS nb FROM commentaires');
        $episodesTotal = $episodesTotalReq[0]->nb;
        $pagesTotales = ceil($episodesTotal/$episodesParPage);
        if(isset($page) AND !empty($page) AND $page > 0 AND $page <= $pagesTotales){

            $page = intval($page);
            $pageCourante = $page;

        }else{

            $pageCourante = 1;

        }

        $depart = ($pageCourante - 1)*$episodesParPage;
        $comments = \App\App::getDb()->query("SELECT * FROM commentaires ORDER BY id DESC LIMIT $depart , $episodesParPage ",'App\Models\BlogManager');
        $controller = new  \App\Controller\back_office\Controller();
        $controller->render('back_office.comment', compact('tokenSession','comments','pagesTotales','pageCourante'));


    }

    public function getCommentSignal():void{

        $request = new \App\Config\Request();
        $tokenSession = $request->getSession()->get('token');

        $page = $request->getGet()->get('page');
        $episodesParPage = 6;
        $episodesTotalReq = \App\App::getDb()->query("SELECT COUNT(*) AS nb FROM commentaires WHERE signalement = '1'");
        $episodesTotal = $episodesTotalReq[0]->nb;
        $pagesTotales = ceil($episodesTotal/$episodesParPage);
        if(isset($page) AND !empty($page) AND $page > 0 AND $page <= $pagesTotales){

            $page = intval($page);
            $pageCourante = $page;

        }else{

            $pageCourante = 1;

        }

        $depart = ($pageCourante - 1)*$episodesParPage;

        $commentSignals = \App\App::getDb()->query("SELECT * FROM commentaires WHERE signalement = '1' ORDER BY id DESC LIMIT $depart , $episodesParPage ",'App\Models\BlogManager');
        $controller = new  \App\Controller\back_office\Controller();
        $controller->render('back_office.commentSignal', compact('tokenSession','commentSignals','pagesTotales','pageCourante'));


    }

    public function getAdd():void{

        $postTable = \App\App::getInstance()->getTable('Table');
        $request = new \App\Config\Request();
        $tokenSession = $request->getSession()->get('token');
        $tokenGet = $request->getPost()->get('token');
        $titre = $request->getPost()->get('titre');
        $contenu = $request->getPost()->getWithoutHtml('contenu');
        $error = false;

        if(!empty($_POST)){
            if(isset($tokenGet) && $tokenGet == $tokenSession){
                $result = $postTable->createE([
                
                    'titre' => $titre,
                    'contenu' => $contenu

                ]);
                if($result){

                    header("Location: index?p=admin.posts.index");

                }
            }else {

                $error = true;

            }
        }

        $form = new \App\Service\BootstrapForm($_POST);
        $controller = new  \App\Controller\back_office\Controller();
        $controller->render('back_office.add', compact('error','form','tokenSession'));

    }

    public function getEdit():void{

        $postTable = \App\App::getInstance()->getTable('Table');
        $request = new \App\Config\Request();
        $tokenGet = $request->getPost()->get('token');
        $tokenSession = $request->getSession()->get('token');
        $titre = $request->getPost()->get('titre');
        $contenu = $request->getPost()->getWithoutHtml('contenu');
        $id = $request->getGet()->get('id');
        $error = false;

        if(!empty($_POST)){
            if(isset($tokenGet) && $tokenGet == $tokenSession){
                $result = $postTable->updateE($id,[
                
                    'titre' => $titre,
                    'contenu' => $contenu

                ]);
                if($result){

                    header("Location: index?p=admin.posts.index");

                }
            }else{

                $error = true;

            }
        }

        $post = $postTable->find($id);
        $form = new \App\Service\BootstrapForm($post);
        $controller = new  \App\Controller\back_office\Controller();
        $controller->render('back_office.edit', compact('error','form','tokenSession'));

    }

    public function getProfil():void{

        $postTable = \App\App::getInstance()->getTable('Table');
        $request = new \App\Config\Request();
        $tokenGet = $request->getPost()->get('token');
        $tokenSession = $request->getSession()->get('token');
        $username = $request->getPost()->get('Username');
        $password = $request->getPost()->get('Password');
        $confirm = $request->getPost()->get('Confirm');
        $id = $request->getGet()->get('id');
        
        $users = \App\App::getDb()->query("SELECT * FROM users ORDER BY id DESC",'App\Models\BlogManager');
        
        $errors = false;
        $error = false;
        $errorToken = false;
        
        if(!empty($_POST)){
            if(isset($tokenGet) && $tokenGet == $tokenSession){
                if(!empty($username) && !empty($password) && !empty($confirm)){
                    if($password === $confirm){
                        $result = $postTable->updateProfil($id,[
                        
                            'username' => $username,
                            'password' => sha1($confirm)

                        ]);
                        if($result){
                            header("Location: index?p=admin.posts.index");
                        }
                    }else{
                        $errors = true;
                    }
                }else {
                    $error = true;
                }
            }else{
                $errorToken = true;
            }
        }

        $post = \App\Database\DbAuth::getUserId();
        $form = new \App\Service\BootstrapForm($post);
        $controller = new  \App\Controller\back_office\Controller();
        $controller->render('back_office.profil', compact('form','errorToken','users','errors','error','tokenSession'));
        

    }

    public function getDelete():void{

        $postTable = \App\App::getInstance()->getTable('Table');
        $request = new \App\Config\Request();
        $postId = $request->getGet()->get('id');
        $tokenSession = $request->getSession()->get('token');
        $tokenGet = $request->getPost()->get('token');
        

        if(!empty($_POST)){

            if(isset($tokenGet) && $tokenGet == $tokenSession){
                $result = $postTable->deleteE($postId);
                if($result){

                    header("Location: index?p=admin.posts.index");
        
                }
            } else{

                header("Location: index?p=admin.posts.index");
                
            }
        }

    }

    public function getDeleteComment():void{

        $postTable = \App\App::getInstance()->getTable('Table');
        $request = new \App\Config\Request();
        $postId = $request->getGet()->get('id');
        $tokenSession = $request->getSession()->get('token');
        $tokenGet = $request->getPost()->get('token');

        if(!empty($_POST)){
            if(isset($tokenGet) && $tokenGet == $tokenSession){
                $result = $postTable->deleteC($postId);
                if($result){

                header("Location: index?p=admin.posts.comment");
                
                }
            }else{

                header("Location: index?p=admin.posts.comment");
    
            }
        }

    }

    public function getDeleteSignalement():void{

        $postTable = \App\App::getInstance()->getTable('Table');
        $request = new \App\Config\Request();
        $id = $request->getGet()->get('id');
        $tokenSession = $request->getSession()->get('token');
        $tokenGet = $request->getPost()->get('token');

        if(!empty($_POST)){
            if(isset($tokenGet) && $tokenGet == $tokenSession){
                $result = $postTable->deleteS($_GET['id'],[
                
                    'signalement' => null,

                ]);
                if($result){

                    header("Location: index?p=admin.posts.commentSignal");

                }
            } else{

                header("Location: index?p=admin.posts.commentSignal");

            }
        }

    }

}
