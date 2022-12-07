<?php

namespace iutnc\tweeterapp\view;



use iutnc\mf\view\Renderer;

class HomeView extends TweeterView implements Renderer
{
  public function render(): string
  {
    $tweets=$this->data;
    $liste_tweets ="";
    foreach ($tweets as $tweet) {
      $v = \iutnc\tweeterapp\model\Tweet::where('author', '=', $tweet->author)->first();
      $liste_author = $v->author()->get()[0];
      $liste_tweets .= "<li class='tweet'><a href='{$this->router->urlFor('view', [['tweetId',$tweet->id]])}'>$tweet->text</a> <div class='tweet-footer'> Auteur : <a href='{$this->router->urlFor("user",[['userId',$liste_author->id]])}'>$liste_author->fullname</a> <span class='tweet-timestamp'> | Création : $tweet->created_at </span></div></li>";
    }
    $html = "<ul>".$liste_tweets."</ul>";
    return $html;
  }

}