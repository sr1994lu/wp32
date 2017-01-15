<?php
/**
 * @src 07/25
 */

/**
 * Class UserDAO.
 */
class UserDAO
{
    private $db;

    /**
     * UserDAO constructor.
     *
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->db = $db;
    }

    public function findByLoginId($loginId)
    {
        $sql = 'SELECT * FROM users WHERE login = :login';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':login', $loginId, PDO::PARAM_INT);
        $result = $stmt->execute();
        $user = null;
        if ($result && $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id'];
            $login = $row['login'];
            $nameLast = $row['name_last'];
            $nameFirst = $row['name_first'];
            $passwd = $row['passwd'];
            $mail = $row['mail'];

            $user = new User();
            $user->setId($id);
            $user->setLogin($login);
            $user->setNameFirst($nameFirst);
            $user->setNameLast($nameLast);
            $user->setPasswd($passwd);
            $user->setMail($mail);
        }

        return $user;
    }
}
