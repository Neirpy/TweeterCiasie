<?php

namespace iutnc\tweeterapp\view;

class UserView extends TweeterView implements \iutnc\mf\view\Renderer
{

  public function render(): string
  {
    $user=$this->data;
    $tweets="";
    $html="";
    $v = \iutnc\tweeterapp\model\User::where('id', '=', $user[0]->id)->first();
    $liste_tweets = $v->tweets()->get();
    $author= "<li class='tweet'>Author : " . $user[0]->fullname . " | Username : " . $user[0]->username . " | Followers : " . $user[0]->followers . " | Tweets :<br>";
    foreach ($liste_tweets as $tweet) {
      $tweets .= "<li class='tweet'> <a href='{$this->router->urlFor('view', [['tweetId',$tweet->id]])}'>$tweet->text</a> | Date : $tweet->created_at | Author : $tweet->author</li>";
    }
    $html ="<ul>". $author . "<ul>" . $tweets . "</ul></li></ul>";
    return $html;
  }
}