<?php

declare(strict_types=1);

namespace App\Service;

use App;

class Router{
    
    public function run(): void{

        $this->request = new App\Config\Request();

        $p = $this->request->getGet()->get('p');
        
        if(isset($p)){

            $page = $p;
        
        } else{
        
            $page = 'posts.index';
        
        }
        
        if($page == 'posts.index'){

            $controller = new App\Controller\front_office\PostsController();
            $controller->index();

        } elseif($page == 'posts.liste'){

            $controller = new \App\Controller\front_office\PostsController();
            $controller->liste();

        }elseif($page == 'posts.show'){

            $controller = new \App\Controller\front_office\PostsController();
            $controller->show();

        }elseif($page == 'posts.signalement'){

            $controller = new \App\Controller\front_office\PostsController();
            $controller->signalement();

        }elseif($page == 'posts.notFound'){

            $controller = new \App\Controller\front_office\PostsController();
            $controller->notFound();

        }elseif($page == 'posts.forbidden'){

            $controller = new \App\Controller\front_office\PostsController();
            $controller->forbidden();

        }elseif($page == 'users.login'){

            $controller = new \App\Controller\front_office\UsersController();
            $controller->login();

        }elseif($page == 'admin.posts.index'){

            $controller = new \App\Controller\back_office\PostsController();
            $controller->index();

        }elseif($page == 'admin.posts.comment'){

            $controller = new \App\Controller\back_office\PostsController();
            $controller->comment();

        }elseif($page == 'admin.posts.commentSignal'){

            $controller = new \App\Controller\back_office\PostsController();
            $controller->commentSignal();

        }elseif($page == 'admin.posts.profil'){

            $controller = new \App\Controller\back_office\PostsController();
            $controller->profil();

        }elseif($page == 'admin.posts.edit'){

            $controller = new \App\Controller\back_office\PostsController();
            $controller->edit();

        }elseif($page == 'admin.posts.add'){

            $controller = new \App\Controller\back_office\PostsController();
            $controller->add();

        }elseif($page == 'admin.posts.delete'){

            $controller = new \App\Controller\back_office\PostsController();
            $controller->delete();

        }elseif($page == 'admin.posts.deleteComment'){

            $controller = new \App\Controller\back_office\PostsController();
            $controller->deleteComment();

        }elseif($page == 'admin.posts.deleteSignalement'){

            $controller = new \App\Controller\back_office\PostsController();
            $controller->deleteSignalement();

        }elseif($page == 'admin.posts.deconnecter'){

            $controller = new \App\Controller\back_office\PostsController();
            $controller->deconnecter();

        }else{

            header('Location: index?p=posts.notFound');

        }

    }

}
