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

    $liste_tweets = [];

    foreach ($followers as $follower) {
      $follower->follower = \iutnc\tweeterapp\model\User::select()->where('id', '=', $follower->follower)->first();
      $name_followers[]=array("id"=>$follower->follower->id,"username"=>$follower->follower->username);
    }

    foreach ($followees as $followee) {
      $followee->followee = \iutnc\tweeterapp\model\User::select()->where('id', '=', $followee->followee)->first();
      $name_followees[]=array("id"=>$followee->followee->id,"username"=>$followee->followee->username);
      $liste_tweets []=$followee->followee->tweets()->get();
    }

    $list_follows=[$name_followers,$name_followees,$liste_tweets];

    $viewFollowing=new \iutnc\tweeterapp\view\FollowingView($list_follows);
    $viewFollowing->makePage();

  }
}
