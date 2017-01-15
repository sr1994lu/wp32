<?php

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

    public function findByLoginId($loginMail)
    {
        $sql = 'SELECT * FROM users WHERE us_mail = :us_mail';
        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':us_mail', $loginMail, PDO::PARAM_STR);

        $result = $stmt->execute();

        $user = null;

        if ($result && $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id'];
            $mail = $row['us_mail'];
            $name = $row['us_name'];
            $passwd = $row['us_password'];

            $user = new User();
            $user->setId($id);
            $user->setMail($mail);
            $user->setName($name);
            $user->setPasswd($passwd);
        }

        return $user;
    }
}
