<?php

namespace iutnc\tweeterapp\view;

class PostView extends TweeterView implements \iutnc\mf\view\Renderer
{

  public function render(): string
  {
    $form=<<<EOT
      <form action='{$this->router->urlFor("post")}' method='post'>
        <label for='text'>Texte du tweet : </label>
        <textarea name='text' id='text' cols='30' rows='10' required placeholder="Entrez votre tweet : "></textarea>
        <input type='submit' value='Envoyer'> 
      </form>
     EOT;

    return $form;
  }
}