<?php

namespace iutnc\tweeterapp\control;

use iutnc\mf\control\AbstractController;

class LoginController extends AbstractController
{

  public function execute(): void
  {
    if ($this->request->method==="GET"){
      $viewLogin=new \iutnc\tweeterapp\view\LoginView();
      $viewLogin->makePage();
    }
    else {
      $username = filter_var($this->request->post["username"], FILTER_SANITIZE_SPECIAL_CHARS);
      $password = filter_var($this->request->post["password"], FILTER_SANITIZE_SPECIAL_CHARS);

      try {
        \iutnc\tweeterapp\auth\TweeterAuthentification::login($username,$password);
        \iutnc\mf\router\Router::executeRoute('follow');
      }
      catch (\InvalidArgumentException $e){
        \iutnc\mf\router\Router::executeRoute('login');
      }

    }
  }
}