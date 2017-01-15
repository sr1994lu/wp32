<?php
/**
 * WP32 06/13.
 */

/**
 * Class DeptDAO.
 */
class DeptDAO
{
    private $db;

    /**
     * DeptDAO constructor.
     *
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->db = $db;
    }

    /**
     * @param $deptno
     *
     * @return Dept $dept
     */
    public function findByPK($deptno)
    {
        $sql = 'SELECT * FROM dept WHERE deptno = :deptno';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':deptno', $deptno, PDO::PARAM_INT);
        $result = $stmt->execute();

        $dept = null;

        if ($result && $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $deptno = $row['deptno'];
            $dname = $row['dname'];
            $loc = $row['loc'];

            $dept = new Dept();
            $dept->setDeptno($deptno);
            $dept->setDname($dname);
            $dept->setLoc($loc);
        }

        return $dept;
    }

    /**
     * @return array $deptList
     */
    public function findAll()
    {
        $sql = 'SELECT * FROM dept ORDER BY deptno';
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute();

        $deptList = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $deptno = $row['deptno'];
            $dname = $row['dname'];
            $loc = $row['loc'];

            $dept = new Dept();
            $dept->setDeptno($deptno);
            $dept->setDname($dname);
            $dept->setLoc($loc);

            $deptList[$deptno] = $dept;
        }

        return $deptList;
    }

    /**
     * @param Dept $dept
     *
     * @return bool $result
     */
    public function insert(Dept $dept)
    {
        $sqlInsert = 'INSERT INTO dept (deptno, dname, loc) VALUES (:deptno, :dname, :loc)';
        $stmt = $this->db->prepare($sqlInsert);
        $stmt->bindValue(':deptno', $dept->getDeptno(), PDO::PARAM_INT);
        $stmt->bindValue(':dname', $dept->getDname(), PDO::PARAM_STR);
        $stmt->bindValue(':loc', $dept->getLoc(), PDO::PARAM_STR);
        $result = $stmt->execute();

        return $result;
    }

    /**
     * @param Dept $dept
     *
     * @return bool $result
     */
    public function update(Dept $dept)
    {
        $sql = 'UPDATE dept SET dname = :dname, loc = :loc WHERE deptno = :deptno';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':dname', $dept->getDname(), PDO::PARAM_STR);
        $stmt->bindValue(':loc', $dept->getLoc(), PDO::PARAM_STR);
        $stmt->bindValue(':deptno', $dept->getDeptno(), PDO::PARAM_INT);
        $result = $stmt->execute();

        return $result;
    }

    /**
     * @param $deptno
     *
     * @return bool $result
     */
    public function delete($deptno)
    {
        $sql = 'DELETE FROM dept WHERE deptno = :deptno';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':deptno', $deptno, PDO::PARAM_INT);
        $result = $stmt->execute();

        return $result;
    }
}
