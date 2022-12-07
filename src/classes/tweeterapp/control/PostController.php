<?php

namespace iutnc\tweeterapp\control;


use iutnc\mf\control\AbstractController;
use iutnc\mf\router\Router;
use iutnc\tweeterapp\auth\TweeterAuthentification;

class PostController extends AbstractController
{
  public function execute(): void
  {
    if (count($this->request->get)>0 && count($this->request->post) === 0) {
      $viewPost = new \iutnc\tweeterapp\view\PostView();
      $viewPost->makePage();
    }
    else{
      $tweet = new \iutnc\tweeterapp\model\Tweet();
      $tweet->text = filter_var($this->request->post["text"], FILTER_SANITIZE_SPECIAL_CHARS);
      $tweet->author = TweeterAuthentification::connectedUser();
      $tweet->save();

      Router::executeRoute('home');

    }

  }

}