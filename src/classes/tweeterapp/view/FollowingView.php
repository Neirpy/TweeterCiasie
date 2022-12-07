<?php

namespace iutnc\tweeterapp\view;

use iutnc\mf\view\Renderer;

class FollowingView extends TweeterView implements Renderer
{
  public function render(): string
  {
    $follows = $this->data;
    $liste_followees = "";
    $liste_followers = "";
    $liste_tweets = "";
    $html = "";
    foreach ($follows[0] as $followee) {
      $liste_followees .= "<li class='tweet'><a href='{$this->router->urlFor('user', [['userId', $followee['id']]])}'>".$followee['username']."</a></li>";
    }
    foreach ($follows[1] as $follower) {
      $liste_followers .= "<li class='tweet'><a href='{$this->router->urlFor('user', [['userId', $follower['id']]])}'>".$follower['username']."</a></li>";
    }

    foreach ($follows[2] as $tweet) {
      foreach ($tweet as $t) {
        $v = \iutnc\tweeterapp\model\Tweet::where('author', '=', $t->author)->first();
        $liste_authors=$v->author()->get()[0];
        $liste_tweets .= "<li class='tweet'> <a href='{$this->router->urlFor('view', [['tweetId', $t->id]])}'>$t->text</a> | Date : $t->created_at | Auteur : <a href='{$this->router->urlFor("user",[['userId',$liste_authors->id]])}'>$liste_authors->fullname</a></li>";
      }
    }
    $html .="<h2>Abonné(s) : ".count($follows[0])."</h2>";
    $html.=<<<EOT
      <ul>
       $liste_followees
      </ul>
    EOT;
    $html .="<h2>Abonnement(s) : ".count($follows[1])."</h2>";
    $html.=<<<EOT
      <ul>
       $liste_followers
      </ul>
    EOT;

    $html .="<h2>Ma TL :</h2>";
    $html.=<<<EOT
      <ul>
       $liste_tweets
      </ul>
    EOT;


    return $html;
  }
}