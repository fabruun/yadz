<?php
/**
 * view/ViewLogin.inc.php
 * @package MVC_NML_Sample
 * @author nml
 * @copyright (c) 2017, nml
 * @license http://www.fsf.org/licensing/ GPLv3
 */

require_once './view/View.php';

class LoginView extends View {

    public function __construct($model) {
        parent::__construct($model);
    }

    private function loginForm() {
        $s = sprintf("\n
        <section>


            <div class='login'>
            <form action='%s' method='post' id='login-form'>\n
            <table id='login'>\n
            <div>
                <caption style='font-size:1.3rem; font-weight:bold; padding-bottom: 10px;'>Login</caption>\n
                <tr>\n
                    <td>Userid:</td><td><input type='text' name='uid'/></td>\n
                </tr>\n
                <tr>\n
                    <td>Pwd: </td><td><input type='password' name='pwd'/></td>\n
                </tr>\n
                </div>

                    <div id='login-submit'>
                        <p>
                        <input type='submit' value='OK' id='login-btn'/>&nbsp;&nbsp;&nbsp;
                        <button onclick='window.location=./index.php?f=Y' id='login-surrender'>I Surrender</button>
                        </p>\n", $_SERVER['PHP_SELF']);

        if (!Model::areCookiesEnabled()) {
            $s .= "<tr><td colspan='2' class='err'>Cookies
            from this domain must be
                      enabled before attempting login.</td></tr>";
        }
        $s .= "          </table>\n";
        $s .= "          </form>\n</div></section>\n";
        return $s;
    }

    private function displayLogin() {
        $s = "        <main class='main'>\n";
        if (!Authentication::isAuthenticated()) {
            $s .= $this->loginForm();
        }
        $s .= "        </main>\n";
        return $s;
    }

    public function display(){
       $this->output($this->displayLogin());
    }
}
