<?php
/**
 * @src 05/10
 */

namespace scottadminadv\classes\entity;

/**
 * Class Dept.
 */
class Dept
{
    private $deptno;
    private $dname = '';
    private $loc = '';

    /**
     * @return mixed
     */
    public function getDeptno()
    {
        return $this->deptno;
    }

    /**
     * @param mixed $deptno
     */
    public function setDeptno($deptno)
    {
        $this->deptno = $deptno;
    }

    /**
     * @return string
     */
    public function getDname(): string
    {
        return $this->dname;
    }

    /**
     * @param string $dname
     */
    public function setDname(string $dname)
    {
        $this->dname = $dname;
    }

    /**
     * @return string
     */
    public function getLoc(): string
    {
        return $this->loc;
    }

    /**
     * @param string $loc
     */
    public function setLoc(string $loc)
    {
        $this->loc = $loc;
    }
}
