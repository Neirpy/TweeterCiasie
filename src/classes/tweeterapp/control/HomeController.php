<?php

namespace iutnc\tweeterapp\control;

use iutnc\mf\control\AbstractController;
use iutnc\tweeterapp\view\HomeView;

class HomeController extends AbstractController {

  public function execute() : void {
    $tweets = \iutnc\tweeterapp\model\Tweet::select()
        ->orderBy('updated_at')
        ->get();
    $page=new HomeView($tweets);
    $page->makePage();
  }

}
