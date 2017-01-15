<?php
/**
 * Entity Reports.
 */

/**
 * Class Reports.
 */
class Reports
{
    private $id;
    private $usName = '';
    private $usMail = '';
    private $rpDate;
    private $rpTimeFrom;
    private $rpTimeTo;
    private $rcName = '';
    private $rpContent = '';
    private $rpCreatedAt;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUsName(): string
    {
        return $this->usName;
    }

    /**
     * @param string $usName
     */
    public function setUsName(string $usName)
    {
        $this->usName = $usName;
    }

    /**
     * @return string
     */
    public function getUsMail(): string
    {
        return $this->usMail;
    }

    /**
     * @param string $usMail
     */
    public function setUsMail(string $usMail)
    {
        $this->usMail = $usMail;
    }

    /**
     * @return mixed
     */
    public function getRpDate()
    {
        return $this->rpDate;
    }

    /**
     * @param mixed $rpDate
     */
    public function setRpDate($rpDate)
    {
        $this->rpDate = $rpDate;
    }

    /**
     * @return mixed
     */
    public function getRpTimeFrom()
    {
        return $this->rpTimeFrom;
    }

    /**
     * @param mixed $rpTimeFrom
     */
    public function setRpTimeFrom($rpTimeFrom)
    {
        $this->rpTimeFrom = $rpTimeFrom;
    }

    /**
     * @return mixed
     */
    public function getRpTimeTo()
    {
        return $this->rpTimeTo;
    }

    /**
     * @param mixed $rpTimeTo
     */
    public function setRpTimeTo($rpTimeTo)
    {
        $this->rpTimeTo = $rpTimeTo;
    }

    /**
     * @return string
     */
    public function getRcName(): string
    {
        return $this->rcName;
    }

    /**
     * @param string $rcName
     */
    public function setRcName(string $rcName)
    {
        $this->rcName = $rcName;
    }

    /**
     * @return string
     */
    public function getRpContent(): string
    {
        return $this->rpContent;
    }

    /**
     * @param string $rpContent
     */
    public function setRpContent(string $rpContent)
    {
        $this->rpContent = $rpContent;
    }

    /**
     * @return string
     */
    public function getRpCreatedAt(): string
    {
        return $this->rpCreatedAt;
    }

    /**
     * @param string $rpCreatedAt
     */
    public function setRpCreatedAt(string $rpCreatedAt)
    {
        $this->rpCreatedAt = $rpCreatedAt;
    }
}
