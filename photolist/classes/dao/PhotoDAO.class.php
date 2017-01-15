<?php
/**
 * @src 04/13
 */

/**
 * Class PhotoDAO.
 */
class PhotoDAO
{
    private $db;

    public function __construct(PDO $db)
    {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->db = $db;
    }

    /**
     * findByPK
     * id(PK)で検索.
     *
     * @param $id
     *
     * @return null|Photo
     */
    public function findByPK($id)
    {
        $sql = 'SELECT * FROM photos WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $result = $stmt->execute();
        $photo = null;

        if ($result && $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id'];
            $phTitle = $row['ph_title'];
            $phNote = $row['ph_note'];
            $phPathSmall = $row['ph_path_s'];
            $phPathLarge = $row['ph_path_l'];

            $photo = new Photo();
            $photo->setId($id);
            $photo->setPhTitle($phTitle);
            $photo->setPhNote($phNote);
            $photo->setPhPathSmall($phPathSmall);
            $photo->setPhPathLarge($phPathLarge);
        }

        return $photo;
    }

    /**
     * findAll
     * 全写真情報検索.
     *
     * @return array
     */
    public function findAll()
    {
        $sql = 'SELECT * FROM photos ORDER BY id DESC';
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute();
        $photoList = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id'];
            $phTitle = $row['ph_title'];
            $phNote = $row['ph_note'];
            $phPathSmall = $row['ph_path_s'];
            $phPathLarge = $row['ph_path_l'];

            $photo = new Photo();
            $photo->setId($id);
            $photo->setPhTitle($phTitle);
            $photo->setPhNote($phNote);
            $photo->setPhPathSmall($phPathSmall);
            $photo->setPhPathLarge($phPathLarge);

            $photoList[$id] = $photo;
        }

        return $photoList;
    }

    /**
     * insert
     * 写真情報登録.
     *
     * @param Photo $photo
     *
     * @return int|string
     */
    public function insert(Photo $photo)
    {
        $sqlInsert = 'INSERT INTO photos (ph_title, ph_note, ph_path_s, ph_path_l) VALUES (:phTitle, :phNote, :phPathSmall, :phPathLarge)';
        $stmt = $this->db->prepare($sqlInsert);
        $stmt->bindValue(':phTitle', $photo->getPhTitle(), PDO::PARAM_INT);
        $stmt->bindValue(':phNote', $photo->getPhNote(), PDO::PARAM_STR);
        $stmt->bindValue(':phPathSmall', $photo->getPhPathSmall(), PDO::PARAM_STR);
        $stmt->bindValue(':phPathLarge', $photo->getPhPathLarge(), PDO::PARAM_STR);
        $result = $stmt->execute();

        $id = 0;

        if ($result) {
            $id = $this->db->lastInsertId();
        }

        return $id;
    }

    /**
     * updatePath
     * 1レコードに対して、写真のPATH更新.
     *
     * @param $id
     * @param $phPathSmall
     * @param $phPathLarge
     *
     * @return bool
     */
    public function updatePath($id, $phPathSmall, $phPathLarge)
    {
        $sql = 'UPDATE photos SET ph_path_s = :phPathSmall, ph_path_l = :phPathLarge WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':phPathSmall', $phPathSmall, PDO::PARAM_STR);
        $stmt->bindValue(':phPathLarge', $phPathLarge, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $result = $stmt->execute();

        return $result;
    }
}
