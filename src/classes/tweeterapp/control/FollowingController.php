<?php

namespace iutnc\tweeterapp\control;

use iutnc\mf\control\AbstractController;
use iutnc\tweeterapp\auth\TweeterAuthentification;
use iutnc\tweeterapp\model\Follow;

class FollowingController extends AbstractController
{
  public function execute(): void
  {
    $followers = Follow::where('followee', '=', TweeterAuthentification::connectedUser())->get();
    $name_followers=[];

    $followees = Follow::where('follower','=', TweeterAuthentification::connectedUser())->get();
    $name_followees=[];

    foreach ($followers as $follower) {
      $follower->follower = \iutnc\tweeterapp\model\User::select()->where('id', '=', $follower->follower)->get();
      $name_followers[]=array("id"=>$follower->follower[0]->id,"username"=>$follower->follower[0]->username);
    }

    foreach ($followees as $followee) {
      $followee->followee = \iutnc\tweeterapp\model\User::select()->where('id', '=', $followee->followee)->get();
      $name_followees[]=array("id"=>$followee->followee[0]->id,"username"=>$followee->followee[0]->username);
    }

    $list_follows=[$name_followers,$name_followees];

    $viewFollowing=new \iutnc\tweeterapp\view\FollowingView($list_follows);
    $viewFollowing->makePage();

  }
}
