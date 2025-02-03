<?php

namespace App\Controller;

use App\Entity\Article;
use Attributes\DefaultEntity;
use Core\Controller\Controller;
use Core\Response\Response;

#[DefaultEntity(entityName: Article::class)]
class ArticleController extends Controller
{

    public function index():Response
    {
       // $articleRepository = new ArticleRepository();
                            // $this->getRepository()->findAll()
        $articles = $this->getRepository()->findAll();

        return $this->render('article/index', [
            'articles' => $articles
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

      //  $articleRepository = new ArticleRepository();
       $article = $this->getRepository()->find($id);

       return $this->render('article/show', [
            'article' => $article
        ]);

    }

    public function delete()
    {

        $id =null;
        if(!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $id = $_GET['id'];
        }
        if(!$id){
        return $this->redirect();
        }
       // $articleRepository = new ArticleRepository();
        $article = $this->getRepository()->find($id);

        if($article){
            $this->getRepository()->delete($article);
        }
        return $this->redirect();

    }

    //methodes suivantes : create, update, delete


    public function addArticle()
    {
    //    if(empty($_SESSION["id"])){

      //      Response::redirect("index", ["message"=>"please log in first"]);
     //   }

        $title = null;
        $content=null;

        if(!empty($_POST['title']) && !empty($_POST['content'])) {
            $title = $_POST['title'];
            $content = $_POST['content'];

        }


        if($title && $content)
        {

            $article = new Article();
            $article->setTitle($title);
            $article->setContent($content);
            $article->setUserId($_SESSION['id']);

        $id = $this->getRepository()->addArticle($article);

            return $this->redirect( ["type" =>"article",
                                    "action"=>"show",
                                "id" => $id]);
        }

        return $this->render("article/new", [
            "pageTitle" => "New Article",
        ]);
    }

}