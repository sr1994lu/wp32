<?php
/**
 * @src 03/13
 */

/**
 * Class Photo.
 */
class Photo
{
    private $id;
    private $phTitle = '';
    private $phNote = '';
    private $phPathSmall = '';
    private $phPathLarge = '';

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
    public function getPhTitle(): string
    {
        return $this->phTitle;
    }

    /**
     * @param string $phTitle
     */
    public function setPhTitle(string $phTitle)
    {
        $this->phTitle = $phTitle;
    }

    /**
     * @return string
     */
    public function getPhNote(): string
    {
        return $this->phNote;
    }

    /**
     * @param string $phNote
     */
    public function setPhNote(string $phNote)
    {
        $this->phNote = $phNote;
    }

    /**
     * @return string
     */
    public function getPhPathSmall(): string
    {
        return $this->phPathSmall;
    }

    /**
     * @param string $phPathSmall
     */
    public function setPhPathSmall(string $phPathSmall)
    {
        $this->phPathSmall = $phPathSmall;
    }

    /**
     * @return string
     */
    public function getPhPathLarge(): string
    {
        return $this->phPathLarge;
    }

    /**
     * @param string $phPathLarge
     */
    public function setPhPathLarge(string $phPathLarge)
    {
        $this->phPathLarge = $phPathLarge;
    }
}
