<?php

namespace iutnc\tweeterapp\view;

use iutnc\mf\view\Renderer;

class SignupView extends TweeterView implements Renderer
{
  public function render(): string
  {
    $form = <<<EOT
      <h2>Créer un compte :</h2>
      <form action='{$this->router->urlFor("signup")}' method='post'>
        <label for='username'>Pseudo : </label>
        <input type="text" id="username" name="username"  placeholder="Votre pseudo" required>
        <label for="name">Nom et Prénom : </label>
        <input type="text" id="name" name="name"  placeholder="Votre nom et prénom" required>
        <label for="password">Mot de passe : </label>
        <input type="password" id="password" name="password" required>
        <input type='submit' value='Envoyer'> 
      </form>
    EOT;
    return $form;
  }
}
