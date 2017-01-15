<?php


class Customer
{
    /**
     * @var int 顧客ID
     */
    private $customerId = 0;
    /**
     * @var string 顧客名
     */
    private $custFirstName = '';
    /**
     * @var string 顧客性
     */
    private $custLastName = '';
    /**
     * @var string 住所
     */
    private $custAddress = '';
    /**
     * @var string 電話番号
     */
    private $phoneNumbers = '';
    /**
     * @var string 使用言語
     */
    private $nlsLanguage = '';
    /**
     * @var string 地域
     */
    private $nlsTerritory = '';
    /**
     * @var int クレジットカード限度額
     */
    private $creditLimit = 0;
    /**
     * @var string メールアドレス
     */
    private $custEmail = '';
    /**
     * @var int 担当者ID
     */
    private $accountMgrId = 0;
    /**
     * @var string 所在地
     */
    private $custGeoLocation = '';
    /**
     * @var string 生年月日
     */
    private $dateOfBirth;
    /**
     * @var string 既婚未婚
     */
    private $maritalStatus = '';
    /**
     * @var string 性別
     */
    private $gender = '';
    /**
     * @var string 所得水準
     */
    private $incomeLevel = '';

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    /**
     * @param int $customerId
     */
    public function setCustomerId(int $customerId)
    {
        $this->customerId = $customerId;
    }

    /**
     * @return string
     */
    public function getCustFirstName(): string
    {
        return $this->custFirstName;
    }

    /**
     * @param string $custFirstName
     */
    public function setCustFirstName(string $custFirstName)
    {
        $this->custFirstName = $custFirstName;
    }

    /**
     * @return string
     */
    public function getCustLastName(): string
    {
        return $this->custLastName;
    }

    /**
     * @param string $custLastName
     */
    public function setCustLastName(string $custLastName)
    {
        $this->custLastName = $custLastName;
    }

    /**
     * @return string
     */
    public function getCustAddress(): string
    {
        return $this->custAddress;
    }

    /**
     * @param string $custAddress
     */
    public function setCustAddress(string $custAddress)
    {
        $this->custAddress = $custAddress;
    }

    /**
     * @return string
     */
    public function getPhoneNumbers(): string
    {
        return $this->phoneNumbers;
    }

    /**
     * @param string $phoneNumbers
     */
    public function setPhoneNumbers(string $phoneNumbers)
    {
        $this->phoneNumbers = $phoneNumbers;
    }

    /**
     * @return string
     */
    public function getNlsLanguage(): string
    {
        return $this->nlsLanguage;
    }

    /**
     * @param string $nlsLanguage
     */
    public function setNlsLanguage(string $nlsLanguage)
    {
        $this->nlsLanguage = $nlsLanguage;
    }

    /**
     * @return string
     */
    public function getNlsTerritory(): string
    {
        return $this->nlsTerritory;
    }

    /**
     * @param string $nlsTerritory
     */
    public function setNlsTerritory(string $nlsTerritory)
    {
        $this->nlsTerritory = $nlsTerritory;
    }

    /**
     * @return int
     */
    public function getCreditLimit(): int
    {
        return $this->creditLimit;
    }

    /**
     * @param int $creditLimit
     */
    public function setCreditLimit(int $creditLimit)
    {
        $this->creditLimit = $creditLimit;
    }

    /**
     * @return string
     */
    public function getCustEmail(): string
    {
        return $this->custEmail;
    }

    /**
     * @param string $custEmail
     */
    public function setCustEmail(string $custEmail)
    {
        $this->custEmail = $custEmail;
    }

    /**
     * @return int
     */
    public function getAccountMgrId(): int
    {
        return $this->accountMgrId;
    }

    /**
     * @param int $accountMgrId
     */
    public function setAccountMgrId(int $accountMgrId)
    {
        $this->accountMgrId = $accountMgrId;
    }

    /**
     * @return string
     */
    public function getCustGeoLocation(): string
    {
        return $this->custGeoLocation;
    }

    /**
     * @param string $custGeoLocation
     */
    public function setCustGeoLocation(string $custGeoLocation)
    {
        $this->custGeoLocation = $custGeoLocation;
    }

    /**
     * @return string
     */
    public function getDateOfBirth(): string
    {
        return $this->dateOfBirth;
    }

    /**
     * @param string $dateOfBirth
     */
    public function setDateOfBirth(string $dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * @return string
     */
    public function getMaritalStatus(): string
    {
        return $this->maritalStatus;
    }

    /**
     * @param string $maritalStatus
     */
    public function setMaritalStatus(string $maritalStatus)
    {
        $this->maritalStatus = $maritalStatus;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender(string $gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return string
     */
    public function getIncomeLevel(): string
    {
        return $this->incomeLevel;
    }

    /**
     * @param string $incomeLevel
     */
    public function setIncomeLevel(string $incomeLevel)
    {
        $this->incomeLevel = $incomeLevel;
    }
}
