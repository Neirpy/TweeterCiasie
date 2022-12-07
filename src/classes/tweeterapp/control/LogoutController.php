<?php

namespace iutnc\tweeterapp\control;


use iutnc\mf\control\AbstractController;
use iutnc\tweeterapp\auth\TweeterAuthentification;

class LogoutController extends AbstractController
{
  public function execute(): void
  {
    TweeterAuthentification::logout();
    \iutnc\mf\router\Router::executeRoute('home');
  }
}
{

}