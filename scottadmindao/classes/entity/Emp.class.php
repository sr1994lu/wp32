<?php
/**
 * WP32 05/13.
 */

/**
 * Class Emp.
 */
class Emp
{
    private $empno;
    private $ename = '';
    private $job = '';
    private $mgr;
    private $hiredate = '';
    private $sal;
    private $comm;
    private $deptno;

    /**
     * @return mixed
     */
    public function getEmpno()
    {
        return $this->empno;
    }

    /**
     * @param $empno
     */
    public function setEmpno($empno)
    {
        $this->empno = $empno;
    }

    /**
     * @return string
     */
    public function getEname(): string
    {
        return $this->ename;
    }

    /**
     * @param string $ename
     */
    public function setEname(string $ename)
    {
        $this->ename = $ename;
    }

    /**
     * @return string
     */
    public function getJob(): string
    {
        return $this->job;
    }

    /**
     * @param string $job
     */
    public function setJob(string $job)
    {
        $this->job = $job;
    }

    /**
     * @return mixed
     */
    public function getMgr()
    {
        return $this->mgr;
    }

    /**
     * @param $mgr
     */
    public function setMgr($mgr)
    {
        $this->mgr = $mgr;
    }

    /**
     * @return string
     */
    public function getHiredate(): string
    {
        return $this->hiredate;
    }

    /**
     * @param string $hiredate
     */
    public function setHiredate(string $hiredate)
    {
        $this->hiredate = $hiredate;
    }

    /**
     * @return mixed
     */
    public function getSal()
    {
        return $this->sal;
    }

    /**
     * @param $sal
     */
    public function setSal($sal)
    {
        $this->sal = $sal;
    }

    /**
     * @return mixed
     */
    public function getComm()
    {
        return $this->comm;
    }

    /**
     * @param $comm
     */
    public function setComm($comm)
    {
        $this->comm = $comm;
    }

    /**
     * @return mixed
     */
    public function getDeptno()
    {
        return $this->deptno;
    }

    /**
     * @param $deptno
     */
    public function setDeptno($deptno)
    {
        $this->deptno = $deptno;
    }
}
