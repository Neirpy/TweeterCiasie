<?php
/* pour le chargement automatique des classes d'Eloquent (dans le répertoire vendor) */

use iutnc\tweeterapp\auth\TweeterAuthentification;

require_once 'vendor/autoload.php';


$ini = parse_ini_file("./conf/config.ini");

/* une instance de connexion  */
$db = new Illuminate\Database\Capsule\Manager();

$db->addConnection($ini); /* configuration avec nos paramètres */
$db->setAsGlobal();            /* rendre la connexion visible dans tout le projet */
$db->bootEloquent();

require_once 'src/classes/tweeterapp/control/HomeController.php';
require_once 'src/classes/tweeterapp/control/TweetController.php';
require_once 'src/classes/tweeterapp/control/UserController.php';

$router = new \iutnc\mf\router\Router();

$router->addRoute('home', 'list_tweets', '\iutnc\tweeterapp\control\HomeController', TweeterAuthentification::ACCESS_LEVEL_NONE);
$router->addRoute('view', 'view_tweet', '\iutnc\tweeterapp\control\TweetController',TweeterAuthentification::ACCESS_LEVEL_NONE);
$router->addRoute('user', 'view_user_tweets', '\iutnc\tweeterapp\control\UserController',TweeterAuthentification::ACCESS_LEVEL_NONE);
$router->addRoute('signup','signup','\iutnc\tweeterapp\control\SignupController',TweeterAuthentification::ACCESS_LEVEL_NONE);
$router->addRoute('login','login','\iutnc\tweeterapp\control\LoginController',TweeterAuthentification::ACCESS_LEVEL_NONE);
$router->addRoute('logout','logout','\iutnc\tweeterapp\control\LogoutController',TweeterAuthentification::ACCESS_LEVEL_USER);
$router->addRoute('follow','follow','\iutnc\tweeterapp\control\FollowingController',TweeterAuthentification::ACCESS_LEVEL_USER);
$router->addRoute('post', 'post_tweet', '\iutnc\tweeterapp\control\PostController',TweeterAuthentification::ACCESS_LEVEL_USER);

/* Après exécution de ces instruction, les attributs statiques $routes
   et $aliases de la classe Router auront les valeurs suivantes: */

/*
 * print_r(\iutnc\mf\router\Router::$routes);
 * print_r(\iutnc\mf\router\Router::$aliases);
*/

$vue=new \iutnc\tweeterapp\view\TweeterView();
$vue->setAppTitle("Tweeter");
$vue->addStyleSheet("/html/style.css");


$router->setDefaultRoute('list_tweets');
$router->run();
