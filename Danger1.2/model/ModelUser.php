<?php

require_once 'ModelA.php';

class User extends Model {
    private $uid;       // string
    private $password;  // string ll=128
    private $activated;
    private $pwd;
    private $profile;

    public function __construct($uid, $profile, $activated) {
        $this->uid = $uid;
        $this->activated = $activated;
        $this->profile = $profile;
    }

    public function setPwd($pwd) {
        $this->pwd = $pwd;
    }
    public function getPwd() {
        return $this->pwd;
    }

    public function getUid() {
        return $this->uid;
    }

    public function getFirst() {
        return $this->first;
    }

    public function getProfile() {
      return $this->profile;
    }

    public function create() {
        $sql = "insert into user (uid, password)
                        values (:uid, :pwd)";

        $dbh = Model::connect();
        try {
            $q = $dbh->prepare($sql);
            $q->bindValue(':uid', $this->getUid());
            $q->bindValue(':pwd', password_hash($this->getPwd(), PASSWORD_DEFAULT));
            $q->execute();
        } catch(PDOException $e) {
            printf("<p>Insert of user failed: <br/>%s</p>\n",
                $e->getMessage());
        }
        $dbh->query('commit');
    }

    public function changePwd() {
      $dbh = Model::connect();
      try {
        $sql = "update user";
        $sql .= " set password = :pwd ";
        $sql .= " where uid  ='" . $this->getUid() . "'";
        $q = $dbh->prepare($sql);
        $q->bindValue(':pwd', password_hash($this->getPwd(), PASSWORD_DEFAULT));
        $q->execute();
      } catch(PDOException $e) {
          printf("<p>Update of user failed: <br/>%s</p>\n",
            $e->getMessage());
      }
    }



    public function update() { /*nop*/ }
    public function delete() {
      $dbh = Model::connect();
      try {
        $sql = "delete from  user where uid = '" . $this->getUid() . "'";
       // $sql .= " where uid = '" . $this->getUid() . "'";
        $q = $dbh->prepare($sql);
        $q->execute();
      } catch(PDOException $e) {
          printf("<p>Update of user failed: <br/>%s</p>\n",
            $e->getMessage());
      }
    }

    public function activate() {
      $dbh = Model::connect();
      try {
        $sql = "update user";
        $sql .= " set activated = true";
        $sql .= " where uid = '" . $this->getUid() . "'";
        $q = $dbh->prepare($sql);
        $q->execute();
      } catch(PDOException $e) {
          printf("<p>Update of user failed: <br/>%s</p>\n",
            $e->getMessage());
      }
    }


    public function deactivate() {
      $dbh = Model::connect();
      try {
        $sql = "update user";
        $sql .= " set activated = false";
        $sql .= " where uid = '" . $this->getUid() . "'";
        $q = $dbh->prepare($sql);
        $q->execute();
      } catch(PDOException $e) {
          printf("<p>Update of user failed: <br/>%s</p>\n",
            $e->getMessage());
      }
    }


  public function __toString() {
        return sprintf("%s%s", $this->uid, $this->activated ? ' is activated' : ' is not activated');
    }

    public static function retrievem() {
        $users = array();
        $dbh = Model::connect();

        $sql = "select *";
        $sql .= " from user";
        try {
            $q = $dbh->prepare($sql);
            $q->execute();
            while ($row = $q->fetch()) {
                $user = self::createObject($row);
                array_push($users, $user);
            }
        } catch(PDOException $e) {
            printf("<p>Query of users failed: <br/>%s</p>\n",
                $e->getMessage());
        } finally {
            return $users;
        }
    }

        public static function createObject($a) {
          $act = isset($a['activated']) ? $a['activated'] : null;
               $user = new User($a['uid'], $act);
               if (isset($a['pwd1'])) {
                   $user->setPwd($a['pwd1']);
               }
               return $user;
           }
}
