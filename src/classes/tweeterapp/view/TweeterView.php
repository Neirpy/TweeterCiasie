<?php

namespace iutnc\tweeterapp\view;


use iutnc\mf\view\AbstractView;
use iutnc\tweeterapp\auth\TweeterAuthentification;

class TweeterView extends AbstractView
{

  public function renderTopMenu () : string {
    $html = "<ul class='top-menu'>";
    if (TweeterAuthentification::connectedUser()) {
      $html .=
          <<<EOT
              <li><a href="{$this->router->urlFor("home")}">
                  <lord-icon
                      src="https://cdn.lordicon.com/kxoxiwrf.json"
                      trigger="hover"
                      style="width:60px;height:60px">
                  </lord-icon>
                 </a>
            </li>
            <li><a href="{$this->router->urlFor("follow")}">
                 <lord-icon
                    src="https://cdn.lordicon.com/jryilvyz.json"
                    trigger="hover"
                    style="width:60px;height:60px">
                </lord-icon>
                 </a>
             </li>
            <li><a href="{$this->router->urlFor("logout")}">
                  <lord-icon
                    src="https://cdn.lordicon.com/whxfxpyt.json"
                    trigger="hover"
                    style="width:60px;height:60px">
                  </lord-icon>
                </a>
            </li>
          EOT;
    } else {
      $html .=
          <<<EOT
              <li><a href="{$this->router->urlFor("home")}">
                  <lord-icon
                      src="https://cdn.lordicon.com/kxoxiwrf.json"
                      trigger="hover"
                      style="width:60px;height:60px">
                  </lord-icon>
                 </a>
            </li>
            <li><a href="{$this->router->urlFor("login")}">
                 <lord-icon
                  src="https://cdn.lordicon.com/hcuxerst.json"
                  trigger="hover"
                  style="width:60px;height:60px">
                  </lord-icon>
                 </a>
             </li>
            <li><a href="{$this->router->urlFor("signup")}">
                  <lord-icon
                    src="https://cdn.lordicon.com/zgogqkqu.json"
                    trigger="hover"
                    style="width:60px;height:60px">
                  </lord-icon>
                </a>
            </li>
          EOT;
    }
    $html .= "</ul>";
    return $html;
  }


  protected function makeBody(): string
  {
    $html=<<<EOT
    <header>
    <script src="https://cdn.lordicon.com/qjzruarw.js"></script>
      <h1> MiniTweeter </h1>
      <nav>
        {$this->renderTopMenu()}
      </nav>
    </header>
    <section>
      <div class="content">
        {$this->render()}
      </div>
    </section>
    
    
    <footer>
      <div> MiniTweeter Par Cyprien </div>
      <div id="post">
          <a href="{$this->router->urlFor("post")}">
              <lord-icon
                src="https://cdn.lordicon.com/edxgdhxu.json"
                trigger="hover"
                style="width:60px;height:60px">
              </lord-icon>
          </a>
        </div>
     </footer>
    EOT;

    return $html;
  }
}