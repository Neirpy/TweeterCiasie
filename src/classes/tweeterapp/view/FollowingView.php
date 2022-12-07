<?php

namespace iutnc\tweeterapp\view;

use iutnc\mf\view\Renderer;
use iutnc\tweeterapp\model\Follow;

class FollowingView extends TweeterView implements Renderer
{
  public function render(): string
  {
    $follows = $this->data;
    $liste_followees = "";
    $liste_followers = "";
    $html = "";
    foreach ($follows[0] as $followee) {
      $liste_followees .= "<li class='tweet'><a href='{$this->router->urlFor('user', [['userId', $followee['id']]])}'>".$followee['username']."</a></li>";
    }
    foreach ($follows[1] as $follower) {
      $liste_followers .= "<li class='tweet'><a href='{$this->router->urlFor('user', [['userId', $follower['id']]])}'>".$follower['username']."</a></li>";
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

    return $html;
  }
}