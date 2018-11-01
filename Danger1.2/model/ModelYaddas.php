<?php
/**
 * model/ModelYadda.inc.php
 * @package MVC_NML_Sample
 * @author nml
 * @copyright (c) 2017, nml
 * @license http://www.fsf.org/licensing/ GPLv3
 */
require_once './model/DbP.php';
require_once './model/DbH.php';
require_once './model/ModelIf.php';
require_once './model/ModelA.php';

class Yadda extends Model {
    private $uid;
    private $tstamp;
    private $content;


    public function __construct(  $uid
                                , $tstamp
                                , $content) {
        $this->uid = $uid;
        $this->tstamp = $tstamp;
        $this->content = $content;
    }

    public function getUid() {
        return $this->uid;
    }
    public function getContent() {
        return $this->content;
    }
    public function getTstamp() {
        return $this->tstamp;
    }

    public function create() {
        $sql = "insert into yadda (uid, tstamp, content)
                        values (:uid, current_timestamp, :content)";

        $dbh = Model::connect();
        try {
            $q = $dbh->prepare($sql);
            $q->bindValue(':uid', $this->getUid());
            $q->bindValue(':content', $this->getContent());
            $q->execute();
        } catch(PDOException $e) {
            printf("<p>Insert failed: <br/>%s</p>\n",
                $e->getMessage());
        }
        $dbh->query('commit');
    }
    public function update() {}
    public function delete() {}


    public static function retrieve1($content) {
        $yaddas = array();
        $dbh = Model::connect();

        $sql = "select *";
        $sql .= " from yadda";
        $sql .= " where content = :content";
        try {
            $q = $dbh->prepare($sql);
            $q->bindValue(':content', $content);
            $q->bindValue(':uid', $uid);
            $q->execute();
            while ($row = $q->fetch()) {
                $yadda = self::createObject($row);
                array_push($yaddas, $yadda);
            }
        } catch(PDOException $e) {
            printf("<p>Query failed: <br/>%s</p>\n",
                $e->getMessage());
        } finally {
            return $yadda;
        }
    }


    public static function retrieveCo() {
    $yaddas = array();
    $dbh = Model::connect();

    $sql = "select *";
    $sql .= " from yadda";
    try {
        $q = $dbh->prepare($sql);
        $q->execute();
        while ($row = $q->fetch()) {
            $yadda = self::createObject($row);
            array_push($yaddas, $yadda);
        }
    } catch(PDOException $e) {
        printf("<p>Query failed: <br/>%s</p>\n",
            $e->getMessage());
    } finally {
        return $yaddas;
    }
}

        public static function retrievem() {
        $yaddas = array();
        $dbh = Model::connect();

        $sql = "select *";
        $sql .= " from yadda";
        $sql .= " order by tstamp desc";
        try {
            $q = $dbh->prepare($sql);
            $q->execute();
            while ($row = $q->fetch()) {
                  $yadda= self::createObject($row);
                array_push($yaddas, $yadda);
            }
        } catch(PDOException $e) {
            printf("<p>Query failed: <br/>%s</p>\n",
                $e->getMessage());
        } finally {
            return $yaddas;
        }
    }


        public static function createObject($a) {
          $yadda = new Yadda($a['uid'], $a['tstamp'], $a['content']);{
            return $yadda;
          }
        }


}
