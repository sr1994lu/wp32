<?php


class ReportsDAO
{
    private $db;

    /**
     * ReportsDAO constructor.
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
     * findByPK.
     *
     * @param $id
     *
     * @return null|Reports
     */
    public function findByPK($id)
    {
        $sql = 'SELECT reports.id , users.us_name , users.us_mail , rp_date , rp_time_from , rp_time_to , reportcates.rc_name , rp_content , rp_created_at FROM ( reports INNER JOIN users ON reports.user_id = users.id ) INNER JOIN reportcates ON reports.reportcate_id = reportcates.id WHERE reports.id = :id';
        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $result = $stmt->execute();

        $reports = null;

        if ($result && $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id'];
            $usName = $row['us_name'];
            $usMail = $row['us_mail'];
            $rpDate = $row['rp_date'];
            $rpTimeFrom = $row['rp_time_from'];
            $rpTimeTo = $row['rp_time_to'];
            $rcName = $row['rc_name'];
            $rpContent = $row['rp_content'];
            $rpCreatedAt = $row['rp_created_at'];

            $reports = new Reports();
            $reports->setId($id);
            $reports->setUsName($usName);
            $reports->setUsMail($usMail);
            $reports->setRpDate($rpDate);
            $reports->setRpTimeFrom($rpTimeFrom);
            $reports->setRpTimeTo($rpTimeTo);
            $reports->setRcName($rcName);
            $reports->setRpContent($rpContent);
            $reports->setRpCreatedAt($rpCreatedAt);
        }

        return $reports;
    }

    /**
     * findAll.
     *
     * @return array
     */
    public function findAll()
    {
        $sql = 'SELECT reports.id, rp_date, rp_content, us_name FROM ( reports INNER JOIN users ON reports.user_id = users.id ) ORDER BY rp_date';
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute();

        $reportList = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id'];
            $rpDate = $row['rp_date'];
            $rpContent = $row['rp_content'];
            $usName = $row['us_name'];

            $reports = new Reports();
            $reports->setId($id);
            $reports->setRpDate($rpDate);
            $reports->setRpContent($rpContent);
            $reports->setUsName($usName);

            $reportList[$id] = $reports;
        }

        return $reportList;
    }

    /**
     * insert.
     *
     * @param Reports $reports
     *
     * @return int|string
     */
    public function insert(Reports $reports)
    {
        $sqlInsert = 'INSERT INTO reports (rp_date, rp_time_from, rp_time_to, reportcate_id, rp_content) 
        VALUES (:rp_date, :rp_time_from, :rp_time_to, :reportcate_id, :rp_content)';
        $stmt = $this->db->prepare($sqlInsert);

        $stmt->bindValue(':rp_date', $reports->getRpDate(), PDO::PARAM_STR);
        $stmt->bindValue(':rp_time_from', $reports->getRpTimeFrom(), PDO::PARAM_STR);
        $stmt->bindValue(':rp_time_to', $reports->getRpTimeTo(), PDO::PARAM_STR);
        $stmt->bindValue(':reportcate_id', $reports->getReportcateId(), PDO::PARAM_INT);
        $stmt->bindValue(':rp_content', $reports->getRpContent(), PDO::PARAM_STR);

        $result = $stmt->execute();

        $id = 0;

        if ($result) {
            $id = $this->db->lastInsertId();
        }

        return $id;
    }

    /**
     * update.
     *
     * @param Reports $reports
     *
     * @return bool
     */
    public function update(Reports $reports)
    {
        $sql = 'UPDATE reports SET rp_date = :rp_date, rp_time_from = :rp_time_from, rp_time_to = :rp_time_to, reportcate_id = :reportcate_id,
         rp_content = :rp_content WHERE id = :id';
        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':rp_date', $reports->getRpDate(), PDO::PARAM_STR);
        $stmt->bindValue(':rp_time_from', $reports->getRpTimeFrom(), PDO::PARAM_STR);
        $stmt->bindValue(':rp_time_to', $reports->getRpTimeTo(), PDO::PARAM_STR);
        $stmt->bindValue(':reportcate_id', $reports->getReportcateId(), PDO::PARAM_INT);
        $stmt->bindValue(':rp_content', $reports->getRpContent(), PDO::PARAM_STR);

        $result = $stmt->execute();

        return $result;
    }

    public function delete($id)
    {
        $sql = 'DELETE FROM reports WHERE id = :id';
        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':$id', $$id, PDO::PARAM_INT);

        $result = $stmt->execute();

        return $result;
    }

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
