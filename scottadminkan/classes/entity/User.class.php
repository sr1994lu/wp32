<?php
/**
 * @src 05/25
 */

/**
 * Class User.
 */
class User
{
    private $id;
    private $login;
    private $passwd;
    private $nameLast;
    private $nameFirst;
    private $mail;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function getPasswd()
    {
        return $this->passwd;
    }

    public function setPasswd($passwd)
    {
        $this->passwd = $passwd;
    }

    public function getNameLast()
    {
        return $this->nameLast;
    }

    public function setNameLast($nameLast)
    {
        $this->nameLast = $nameLast;
    }

    public function getNameFirst()
    {
        return $this->nameFirst;
    }

    public function setNameFirst($nameFirst)
    {
        $this->nameFirst = $nameFirst;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function setMail($mail)
    {
        $this->mail = $mail;
    }
}
