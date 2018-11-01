<?php
require_once './view/View.php';

class ProfileView extends View {

    public function __construct($model) {
        parent::__construct($model);
    }
    private function displayProfile() {
        $profiles = Profile::retrieveP();
        $s = "<div>";
        foreach ($profiles as $profile) {
            $s .=  sprintf("<div>
            <p>%s</p><p>%s:</p> <p>%s<br/></p>
            </div>\n</div>"
                , $profile->getTstamp(), $yadda->getUid(), $yadda->getContent());
        }
        return $s;
    }
    private function display1c() {
        return sprintf("%s<br/>\n"
            , $this->model->getUid());
    }
    private function yaddaForm() {
        $s = sprintf("<div id='yadda-input' style='display:flex; justify-content:center;'><h1>Create a Yadda</h1>\n
                      <form action='%s?function=Ya' method='post' id='yadda-form'>\n
                      <input type='hidden' id='output' name='uid' value='%s'/>
                      <textarea rows='4' cols='50' name='content'></textarea>
                      <p><input type='submit' value='Go!'/></p>\n
                      </form></div>"
                      , $_SERVER['PHP_SELF'], Authentication::getLoginId()
                      );
        return $s;
    }

    private function displayYadda() {
        $s = sprintf("<main class='main'>\n<div id='yadda-content'>
        %s\n%s
        </div></main>\n"
                    , $this->yaddaForm()
                    , $this->displayProfile());
        return $s;
    }

    public function display(){
       $this->output($this->displayYadda());
    }

  }
