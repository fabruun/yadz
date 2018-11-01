<?php
require_once './view/View.php';

class YaddaView extends View {

    public function __construct($model) {
        parent::__construct($model);
    }
    private function displayManyYaddas() {
        $yaddas = array();
        $yaddas = Yadda::retrievem();
        $s = "<div id='yadda-output'>";
        foreach ($yaddas as $yadda) {
            $s .=  sprintf("<div id='yadda'>
            <div id='d-yadda'>
            <b id='yadda-username'>
            @%s
            </b>
            <p>
            %s:
            </p>
            <p>
            %s
            </p>

            <div>
            <input type='submit' value='Reply' id='yadda-reply'/>
            </div></div>
            </div><br/>\n"
                , $yadda->getUid(), $yadda->getTstamp(), $yadda->getContent());
        }
        return $s;
    }
    private function display1c() {
        return sprintf("%s<br/>\n"
            , $this->model->getUid());
    }
    private function yaddaForm() {
        $s = sprintf("<h1>Yaddas Timeline</h1>\n
                      <form action='%s?function=Ya' method='post' id='yadda-form'>\n
                      <input type='hidden' id='output' name='uid' value='%s'/>
                      <textarea rows='4' cols='50' name='content' placeholder='Create a Yadda'></textarea>
                      <input type='submit' value='Publish' class='input-btn'/>\n
                      </form></div>"
                      , $_SERVER['PHP_SELF'], Authentication::getLoginId()
                      );
        return $s;
    }

    private function displayYadda() {
        $s = sprintf("<main class='main'>\n%s\n%s</main>\n"
                    , $this->yaddaForm()
                    , $this->displayManyYaddas());
        return $s;
    }

    public function display(){
       $this->output($this->displayYadda());
    }

  }
