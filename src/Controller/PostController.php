<?php

namespace App\Controller;

use App\Entity\Post;
use Attributes\DefaultEntity;
use Core\Controller\Controller;
use Core\Response\Response;



#[DefaultEntity(entityName: Post::class)]
class PostController extends Controller
{


    public function index():Response
    {


        return $this->render("post/index", [
            "posts"=> $this->getRepository()->findAll()
        ]);
    }

    public function show():Response
    {


        $id =null;
        if(!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $id = $_GET['id'];
        }
        if(!$id){
            return $this->redirect();
        }

        $post = $this->getRepository()->find($id);
        if(!$post){
            return $this->redirect();
        }


        return $this->render("post/show", ["post"=>$post]);
    }


    public function create():Response
    {
        $title = null;
        $content=null;

        if(!empty($_POST['title']) && !empty($_POST['content'])) {
            $title = $_POST['title'];
            $content = $_POST['content'];

        }


        if($title && $content)
        {

            $post = new Post();
            $post->setTitle($title);
            $post->setContent($content);

            $id = $this->getRepository()->save($post);
            return $this->redirect([
                "type"=>"post",
                "action"=>"show",
                "id"=>$id
            ]);
        }

        return $this->render("post/create", []);
    }

    public function delete():Response
    {
        $id =null;
        if(!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $id = $_GET['id'];
        }
        if(!$id){
            return $this->redirect();
        }
        $post = $this->getRepository()->find($id);
        if(!$post){
            return $this->redirect();
        }

        $this->getRepository()->delete($post);

        return $this->redirect([
            "type"=>"post",

        ]);
    }

    public function edit():Response
    {
        $id =null;
        if(!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $id = $_GET['id'];

        }
        if(!$id){
            return $this->redirect();
        }
        $post = $this->getRepository()->find($id);
        if(!$post){
            return $this->redirect();
        }

        $title = null;
        $content=null;

        if(!empty($_POST['title']) && !empty($_POST['content'])) {
            $title = $_POST['title'];
            $content = $_POST['content'];
        }
        if($title && $content)
        {
            $post->setTitle($title);
            $post->setContent($content);
           $id = $this->getRepository()->edit($post);
           return $this->redirect([
               "type"=>"post",
               "action"=>"show",
               "id"=>$id
           ]);
        }



        return $this->render("post/edit", ["post"=>$post]);
    }

}