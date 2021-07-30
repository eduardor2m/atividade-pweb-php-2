<?php

require_once "src/database/connection.php";

class User
{
    private Int $id;
    private String $email;
    private String $fullname;
    private String $username;
    private String $pass;

    function __construct(String $email, String $username, String $fullname, String $pass)
    {
        $this->email = $email;
        $this->username = $username;
        $this->fullname = $fullname;
        $this->pass = $pass;
    }

    public function save()
    {
        try {
            $this->hashpass();
            $email =  $this->getEmail();
            $pass = $this->getpass();
            $username = $this->getUsername();
            $fullname = $this->getfullname();
            $stmt = connection::getConnection()->prepare('INSERT INTO users (username, email, fullname, pass) VALUES (:username, :email, :fullname, :pass)');
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":pass", $pass);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":fullname", $fullname);
            $stmt->execute();
        } catch (Exception $e) {
            echo `<div class="error-message">` . $e->getMessage() . `</div>`;
            return false;
        }
    }

    private function hashpass()
    {
        $this->setpass(password_hash($this->getpass(), PASSWORD_DEFAULT));
    }

    public static function listUsers()
    {
        try {
            $query = connection::getConnection()->query('SELECT * FROM users');
            $list = $query->fetchAll(PDO::FETCH_ASSOC);
            $users = User::mapUsers($list);
            return $users;
        } catch (Exception $e) {
            echo `<div class="error-message">` . $e->getMessage() . `</div>`;
            return false;
        }
    }

    private static function mapUsers($list)
    {
        return array_map(function ($e) {
            $user =  new User($e['email'], $e['username'], $e['fullname'], $e['pass']);
            $user->setId($e['id']);
            return $user;
        }, $list);
    }
    public static function search(String $stringDeBusca)
    {
        try {
            $stmt = connection::getConnection()->prepare('SELECT * FROM users WHERE email like :string_de_busca or username like :string_de_busca or fullname like :string_de_busca ');
            $stringDeBusca = '%' . $stringDeBusca . '%';
            $stmt->bindParam(":string_de_busca", $stringDeBusca);
            $list = $stmt->execute();
            $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $users = User::mapUsers($list);
            return $users;
        } catch (Exception $e) {
            echo `<div class="error-message">` . $e->getMessage() . `</div>`;
            return false;
        }
    }

    public static function logIn(String $email, String $pass)
    {
        try {
            $stmt = connection::getConnection()->prepare('SELECT * FROM users WHERE email = :email');
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $user = sizeof($result) > 0 ? $result[0] : NULL;
            if (is_null($user)) {
                throw new Exception("User not found");
            }
            if (!password_verify($pass, $user['pass'])) {
                throw new Exception("Invalid password");
            }
            $return = new User($user['email'], $user['username'], $user['fullname'], $user['pass']);
            $return->setId($user['id']);
            return $return;
        } catch (Exception $e) {
            echo `<div class="error-message">` . $e->getMessage() . `</div>`;
            return false;
        }
    }

    /**
     * Get the value of fullname
     *
     * @return  String
     */
    public function getfullname()
    {
        return $this->fullname;
    }

    /**
     * Set the value of fullname
     *
     * @param  String  $fullname
     *
     * @return  self
     */
    public function setfullname(String $fullname)
    {
        $this->fullname = $fullname;

        return $this;
    }

    /**
     * Get the value of id
     *
     * @return  Int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param  Int  $id
     *
     * @return  self
     */
    public function setId(Int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of username
     *
     * @return  String
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @param  String  $username
     *
     * @return  self
     */
    public function setUsername(String $username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of email
     *
     * @return  String
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param  String  $email
     *
     * @return  self
     */
    public function setEmail(String $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of pass
     *
     * @return  String
     */
    public function getpass()
    {
        return $this->pass;
    }

    /**
     * Set the value of pass
     *
     * @return  String
     */
    public function setpass(String $pass)
    {
        $this->pass = $pass;

        return $this;
    }
}
