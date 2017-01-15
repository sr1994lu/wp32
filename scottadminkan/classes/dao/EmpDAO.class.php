<?php
/**
 * WP32 06/13.
 */

/**
 * Class EmpDAO.
 */
class EmpDAO
{
    private $db;

    /**
     * EmpDAO constructor.
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
     * @param $empno
     *
     * @return Emp|null
     */
    public function findByPK($empno)
    {
        $sql = 'SELECT * FROM emp WHERE empno = :empno';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':empno', $empno, PDO::PARAM_INT);
        $result = $stmt->execute();
        $emp = null;
        if ($result && $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $empno = $row['empno'];
            $ename = $row['ename'];
            $job = $row['job'];
            $mgr = $row['mgr'];
            $hiredate = $row['hiredate'];
            $sal = $row['sal'];
            $comm = $row['comm'];
            $deptno = $row['deptno'];

            $emp = new Emp();
            $emp->setEmpno($empno);
            $emp->setEname($ename);
            $emp->setJob($job);
            $emp->setMgr($mgr);
            $emp->setHiredate($hiredate);
            $emp->setSal($sal);
            $emp->setComm($comm);
            $emp->setDeptno($deptno);
        }

        return $emp;
    }

    /**
     * @return array
     */
    public function findAll()
    {
        $sql = 'SELECT * FROM emp ORDER BY empno';
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute();
        $empList = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $empno = $row['empno'];
            $ename = $row['ename'];
            $job = $row['job'];
            $mgr = $row['mgr'];
            $hiredate = $row['hiredate'];
            $sal = $row['sal'];
            $comm = $row['comm'];
            $deptno = $row['deptno'];

            $emp = new Emp();
            $emp->setEmpno($empno);
            $emp->setEname($ename);
            $emp->setJob($job);
            $emp->setMgr($mgr);
            $emp->setHiredate($hiredate);
            $emp->setSal($sal);
            $emp->setComm($comm);
            $emp->setDeptno($deptno);
            $empList[$empno] = $emp;
        }

        return $empList;
    }

    /**
     * @param Emp $emp
     *
     * @return bool
     */
    public function insert(Emp $emp)
    {
        $sqlInsert = 'INSERT INTO emp (empno, ename, job, mgr, hiredate, sal, comm, deptno) 
        VALUES (:empno, :ename, :job, :mgr, :hiredate, :sal, :comm, :deptno)';
        $stmt = $this->db->prepare($sqlInsert);
        $stmt->bindValue(':empno', $emp->getEmpno(), PDO::PARAM_INT);
        $stmt->bindValue(':ename', $emp->getEname(), PDO::PARAM_STR);
        $stmt->bindValue(':job', $emp->getJob(), PDO::PARAM_STR);
        $stmt->bindValue(':mgr', $emp->getMgr(), PDO::PARAM_INT);
        $stmt->bindValue(':hiredate', $emp->getHiredate(), PDO::PARAM_STR);
        $stmt->bindValue(':sal', $emp->getSal(), PDO::PARAM_INT);
        $stmt->bindValue(':comm', $emp->getComm(), PDO::PARAM_INT);
        $stmt->bindValue(':deptno', $emp->getDeptno(), PDO::PARAM_INT);
        $result = $stmt->execute();

        return $result;
    }

    /**
     * @param Emp $emp
     *
     * @return bool
     */
    public function update(Emp $emp)
    {
        $sql = 'UPDATE emp SET ename = :ename, job = :job, mgr = :mgr, hiredate = :hiredate,
         sal = :sal, comm = :comm, deptno = :deptno WHERE empno = :empno';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':ename', $emp->getEname(), PDO::PARAM_STR);
        $stmt->bindValue(':job', $emp->getJob(), PDO::PARAM_STR);
        $stmt->bindValue(':mgr', $emp->getMgr(), PDO::PARAM_INT);
        $stmt->bindValue(':hiredate', $emp->getHiredate(), PDO::PARAM_STR);
        $stmt->bindValue(':sal', $emp->getSal(), PDO::PARAM_INT);
        $stmt->bindValue(':comm', $emp->getComm(), PDO::PARAM_INT);
        $stmt->bindValue(':deptno', $emp->getDeptno(), PDO::PARAM_INT);
        $stmt->bindValue(':empno', $emp->getEmpno(), PDO::PARAM_INT);
        $result = $stmt->execute();

        return $result;
    }

    /**
     * @param $empno
     *
     * @return bool
     */
    public function delete($empno)
    {
        $sql = 'DELETE FROM emp WHERE empno = :empno';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':empno', $empno, PDO::PARAM_INT);
        $result = $stmt->execute();

        return $result;
    }

    /**
     * findByEnameKeyword.
     *
     * @param $keyword
     *
     * @return array
     */
    public function findByEnameKeyword($keyword)
    {
        $sql = 'SELECT * FROM emp WHERE ename LIKE :keyword ORDER BY empno';
        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':keyword', '%'.$keyword.'%', PDO::PARAM_STR);

        $result = $stmt->execute();

        $empList = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $empno = $row['empno'];
            $ename = $row['ename'];
            $job = $row['job'];
            $mgr = $row['mgr'];
            $hiredate = $row['hiredate'];
            $sal = $row['sal'];
            $comm = $row['comm'];
            $deptno = $row['deptno'];

            $emp = new Emp();
            $emp->setEmpno($empno);
            $emp->setEname($ename);
            $emp->setJob($job);
            $emp->setMgr($mgr);
            $emp->setHiredate($hiredate);
            $emp->setSal($sal);
            $emp->setComm($comm);
            $emp->setDeptno($deptno);

            $empList[$empno] = $emp;
        }

        return $empList;
    }

    /**
     * mgrMap.
     *
     * @return Emp[]
     */
    public function mgrMap()
    {
        $sqlemp = 'SELECT DISTINCT mgr FROM emp ORDER BY mgr';
        $stmt = $this->db->prepare($sqlemp);
        $result = $stmt->execute();

        $emp = null;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $mgr = $row['mgr'];

            $emp = new Emp();
            $emp->setMgr($mgr);
            $mgrList[] = $emp;
        }

        return $mgrList;
    }
}
