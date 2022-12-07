<?php

namespace iutnc\tweeterapp\control;

use http\Exception\InvalidArgumentException;
use iutnc\mf\control\AbstractController;
use iutnc\mf\router\Router;
use iutnc\tweeterapp\auth\TweeterAuthentification;

class SignupController extends AbstractController
{


  public function execute(): void
  {
    if ($this->request->method==="GET"){
      $viewSignup=new \iutnc\tweeterapp\view\SignupView();
      $viewSignup->makePage();
    }
    else {
      $username = filter_var($this->request->post["username"], FILTER_SANITIZE_SPECIAL_CHARS);
      $name = filter_var($this->request->post["name"], FILTER_SANITIZE_SPECIAL_CHARS);
      $password = filter_var($this->request->post["password"], FILTER_SANITIZE_SPECIAL_CHARS);

      try {
        TweeterAuthentification::register($username,$password,$name);
        Router::executeRoute('login');
      }
      catch (InvalidArgumentException $e){
        Router::executeRoute('add_user');
      }

    }
  }
}