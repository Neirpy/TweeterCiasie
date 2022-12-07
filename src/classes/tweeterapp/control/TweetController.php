<?php

namespace iutnc\tweeterapp\control;

use iutnc\mf\control\AbstractController;

class TweetController extends AbstractController
{
  public function execute(): void
  {
    if (isset($_GET["tweetId"])) {
      $tweet = \iutnc\tweeterapp\model\Tweet::select()->where('id', '=', $this->request->get["tweetId"])->first();
      if (isset($tweet)) {
        $viewTweet=new \iutnc\tweeterapp\view\TweetView($tweet);
        $viewTweet->makePage();
      }
    }
  }
}