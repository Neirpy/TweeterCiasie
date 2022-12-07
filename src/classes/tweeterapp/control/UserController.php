<?php

namespace iutnc\tweeterapp\control;

use iutnc\mf\control\AbstractController;

class UserController extends AbstractController
{
  public function execute(): void
  {
    if (isset($_GET["userId"])) {
      $user = \iutnc\tweeterapp\model\User::select()->where('id', '=', $this->request->get["userId"])->get();
      if (isset($user)) {
        $viewUser=new \iutnc\tweeterapp\view\UserView($user);
        $viewUser->makePage();
      }
    }
    else{
      echo "User not found";
    }
  }
}