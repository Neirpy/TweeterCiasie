<?php
/* pour le chargement automatique des classes d'Eloquent (dans le répertoire vendor) */
require_once 'vendor/autoload.php';


$ini = parse_ini_file("./conf/config.ini");

/* une instance de connexion  */
$db = new Illuminate\Database\Capsule\Manager();

$db->addConnection($ini); /* configuration avec nos paramètres */
$db->setAsGlobal();            /* rendre la connexion visible dans tout le projet */
$db->bootEloquent();           /* établir la connexion */

echo "<hr><h2>Les utilisateurs</h2>";
$requeteUser = \iutnc\tweeterapp\model\User::select();
$lignesUser = $requeteUser->get();

foreach ($lignesUser as $ligne) {
  echo $ligne->id . " " . $ligne->fullname . " " . $ligne->username . "<br>";
}

echo "<hr> <h2>Les tweets de l'utilisateur</h2>";
$requeteTweet = \iutnc\tweeterapp\model\Tweet::select();
$lignesTweet = $requeteTweet->get();

foreach ($lignesTweet as $ligne) {
  echo $ligne->id . " " . $ligne->text . " " . $ligne->created_at . " " . $ligne->updated_at. "<br>";
}

echo "<hr> <h2>Les tweets de l'utilisateur rangé par modif</h2>";
$requeteTweetOrderModif = \iutnc\tweeterapp\model\Tweet::select()
    ->orderBy('updated_at');

$lignesOrderModif = $requeteTweetOrderModif->get();
foreach ($lignesOrderModif as $ligne) {
  echo $ligne->id . " " . $ligne->text . " " . $ligne->created_at . " " . $ligne->updated_at. "<br>";
}

echo "<hr> <h2>Les tweets de l'utilisateur >0</h2>";
$requeteTweetWhere = \iutnc\tweeterapp\model\Tweet::select()
    ->where('score', '>', 0);

$lignesWhere = $requeteTweetWhere->get();
foreach ($lignesWhere as $ligne) {
  echo $ligne->id . " " . $ligne->text . " " . $ligne->created_at . " " . $ligne->updated_at. "<br>";
}

/*$ajoutTweet = new \iutnc\tweeterapp\model\Tweet();
$ajoutTweet->author=1;
$ajoutTweet->score=0;
$ajoutTweet->text = "Mon premier tweet";
$ajoutTweet->created_at = date("Y-m-d H:i:s");
$ajoutTweet->updated_at = date("Y-m-d H:i:s");
$ajoutTweet->save();*/

//$ajoutUser = new \iutnc\tweeterapp\model\User();
//$ajoutUser->fullname = "Jean Dupont";
//$ajoutUser->username = "jdupont";
//$ajoutUser->password = "1234";
//$ajoutUser->level = 1;
//$ajoutUser->followers = 100000;
//$ajoutUser->save();

echo "<hr> <h2>Les asso one to many</h2>";

$v = \iutnc\tweeterapp\model\Tweet::where('author', '=', 7)->first();
$liste_author = $v->author()->get() ;
echo $liste_author . "<br>";

$c = \iutnc\tweeterapp\model\User::where('id' ,'=', 7)->first();
$tweet = $c->tweets()->first();
echo $tweet . "<br>";

echo "<hr> <h2>Les controlleurs : Home</h2>";

require_once 'src/classes/tweeterapp/control/HomeController.php';

$ctrl = new \iutnc\tweeterapp\control\HomeController();
$ctrl->execute();

echo "<hr> <h2>Les controlleurs : Tweet</h2>";

require_once 'src/classes/tweeterapp/control/TweetController.php';

$ctrl = new \iutnc\tweeterapp\control\TweetController();
$ctrl->execute();

echo "<hr> <h2>Les controlleurs : User</h2>";

require_once 'src/classes/tweeterapp/control/UserController.php';

$testUser = new \iutnc\tweeterapp\control\UserController();
$testUser->execute();


echo "<hr> <h2>Les routages : Test</h2>";

/* configuration et lancement d'éloquent (cf partie 1 du projet ) */

$router = new \iutnc\mf\router\Router();

$router->addRoute('home', 'list_tweets', '\iutnc\tweeterapp\control\HomeController');
$router->addRoute('view', 'view_tweet', '\iutnc\tweeterapp\control\TweetController');
$router->addRoute('user', 'view_user_tweets', '\iutnc\tweeterapp\control\UserController');


/* Après exécution de ces instruction, les attributs statiques $routes
   et $aliases de la classe Router auront les valeurs suivantes: */

/*
 * print_r(\iutnc\mf\router\Router::$routes);
 * print_r(\iutnc\mf\router\Router::$aliases);
*/

$router->setDefaultRoute('list_tweets');

$router->run();

//$router->executeRoute('home');

echo '<a href="'.$router->urlFor('view', [['tweetId',49]]).'">Un tweet</a>';
echo '<a href="'.$router->urlFor('user', [['userId',2]]).'">Un user</a>';

