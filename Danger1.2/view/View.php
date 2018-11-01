<?php
/**
 * view/View.inc.php
 * @package MVC_NML_Sample
 * @author nml
 * @copyright (c) 2017, nml
 * @license http://www.fsf.org/licensing/ GPLv3
 */
require_once './model/ModelA.php';

abstract class View {

    protected $model;

    public function __construct($model) {
        $this->model = $model;
    }

    private function top() {
        $s = sprintf("<!doctype html>
<html>
  <head>
    <meta charset='utf-8'/>
    <title>Yadda&#179; &trade;</title>

    <link rel='stylesheet' href='./css/style.css'/>

  </head>
  <body>\n
");
        return $s;
    }

    private function bottom() {
        $s = sprintf("
  </body>
  <script src='app.js'></script>
</html>");
        return $s;
    }

    private function topmenu() {
        $s = sprintf("        <header>
            <h1>Yadda<sup>3 &trade;</sup></h1>\n
            <ul id='menu'>\n
                <li><a href='%s?function=Ya'>Home</a></li>\n",
                $_SERVER['PHP_SELF']);
        if (Authentication::isAuthenticated()) {
          $tt = '';
          if ($this->model->getProfile === 'admin') {
            $tt = "<li><a href='%s?function=Ub'>Edit Users</a></li>";
          }
            $s .= sprintf("
                <li><a href='%s?function=Ya'>Yaddas</a></li>\n
                <li><a href='%s?function=Ub'>Edit Users</a></li>\n
                  %s",
              $_SERVER['PHP_SELF'],
              $_SERVER['PHP_SELF']
            ,$tt
            );

        } else {
            $s .= sprintf("
			<li><a href='%s?function=U'>Register User</a></li>\n",
                $_SERVER['PHP_SELF']);
        }
        if (!Authentication::isAuthenticated()) {
            $s .= sprintf("
			<li><a href='%s?function=A'>Login</a></li>\n"
                    , $_SERVER['PHP_SELF']);
        } else {
            $s .= sprintf("
			<li><a href='%s?function=Z'>Logout</a></li>\n"
                    , $_SERVER['PHP_SELF']);
        }
        $s .= sprintf("             </ul>\n        </header>\n");

        if (Authentication::isAuthenticated()) {
            $s .= sprintf("%8s<div id='user-welcome'><h1>Welcome to Yadda, $%s</h1></div>\n", " ", Authentication::getLoginId());
        }
        return $s;
    }

    public function output($s) {
        print($this->top());
        print($this->topmenu());
        printf("%s", $s);
        print($this->bottom());
    }

	public	function output1( $s ) {
		printf( "%s", $s );

	}
}
