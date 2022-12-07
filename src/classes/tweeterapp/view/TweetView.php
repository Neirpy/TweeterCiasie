<?php

namespace iutnc\tweeterapp\view;

class TweetView extends TweeterView implements \iutnc\mf\view\Renderer
{

  public function render(): string
  {
    $tweet=$this->data;
    $v = \iutnc\tweeterapp\model\Tweet::where('author', '=', $tweet->author)->first();
    $liste_author = $v->author()->first();
    $theTweet="<li class='tweet'>" . $tweet->text . "<div class='tweet-footer'> Author : <a href='{$this->router->urlFor("user",[['userId',$liste_author->id]])}'>$liste_author->fullname</a>  | Création : " . $tweet->created_at . "  Score : " . $tweet->score .  "</div></li>";
    $html="<ul>".$theTweet ."</ul>";
    return $html;
  }
}