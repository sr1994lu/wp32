<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/pagination/Customer.class.php';

$dsn = 'mysql:host=mariadb;dbname=wp32sql;charset=utf8';
$username = 'wp32sqlusr';
$password = 'hogehoge';

$linePerPage = 20;

$pageNo = 1;

if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $pageNo = $_GET['page'];
}

$offset = $linePerPage * ($pageNo - 1);

$customerList = [];

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $sqlCount = 'SELECT COUNT(*) AS count FROM customers';
    $stmt = $db->prepare($sqlCount);
    $result = $stmt->execute();
    if ($result && $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $rowCount = $row['count'];
    }

    $totalPage = ceil($rowCount / $linePerPage);

    $sqlList = 'SELECT * FROM customers ORDER BY customer_id LIMIT :limit OFFSET :offset';
    $stmt = $db->prepare($sqlList);
    $stmt->bindValue(':limit', $linePerPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $result = $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $customerId = $row['customer_id'];
        $custFirstName = $row['cust_first_name'];
        $custLastName = $row['cust_last_name'];
        $custAddress = $row['cust_address'];
        $phoneNumbers = $row['phone_numbers'];
        $nlsLanguage = $row['nls_language'];
        $nlsTerritory = $row['nls_territory'];
        $creditLimit = $row['credit_limit'];
        $custEmail = $row['cust_email'];
        $accountMgrId = $row['account_mgr_id'];
        $custGeoLocation = $row['cust_geo_location'];
        $dateOfBirth = $row['date_of_birth'];
        $maritalStatus = $row['marital_status'];
        $gender = $row['gender'];
        $incomeLevel = $row['income_level'];

        $customer = new Customer();
        $customer->setCustomerId($customerId);
        $customer->setCustFirstName($custFirstName);
        $customer->setCustLastName($custLastName);
        $customer->setCustAddress($custAddress);
        $customer->setPhoneNumbers($phoneNumbers);
        $customer->setNlsLanguage($nlsLanguage);
        $customer->setNlsTerritory($nlsTerritory);
        $customer->setCreditLimit($creditLimit);
        $customer->setCustEmail($custEmail);
        $customer->setAccountMgrId($accountMgrId);
        $customer->setCustGeoLocation($custGeoLocation);
        $customer->setDateOfBirth($dateOfBirth);
        $customer->setMaritalStatus($maritalStatus);
        $customer->setGender($gender);
        $customer->setIncomeLevel($incomeLevel);

        $customerList[] = $customer;
    }
} catch (PDOException $e) {
    echo 'DB接続に失敗しました。';
} finally {
    $db = null;
}
?>

<!doctype html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>WP32 サンプル10 | ページネーション | 顧客リスト</title>
  <style>
    table {
      border-collapse: collapse;
    }

    table th {
      border: solid 1px black;
      text-align: left;
    }

    table td {
      border: solid 1px black;
    }
  </style>
</head>
<body>
  <h1>顧客リスト</h1>
  <p>全部で<?= $rowCount ?>件あります。</p>
  <p class="pager">
      <?php
      if ($pageNo == 1) {
          ?>
        &lt;&lt;最初へ
        &lt;前へ
          <?php

      } else {
          $prevPageNo = $pageNo - 1; ?>
        <a href="/oh/wp32/pagination/showCustomerList.php?page=1">
          &lt;&lt;最初へ</a>&nbsp;
        <a
          href="/oh/wp32/pagination/showCustomerList.php?page=<?= $prevPageNo ?>"><?= $prevPageNo ?>&let;前へ</a>&nbsp;
          <?php

      }
      for ($pages = 1;
           $pages <= $totalPage;
           $pages++) {
          if ($pages == $pageNo) {
              ?>
              <?= $pages ?>&nbsp;
              <?php

          } else {
              ?>
            <a
              href="/oh/wp32/pagination/showCustomerList.php?page=<?= $pages ?>"><?= $pages ?></a>&nbsp;
              <?php

          }
          if ($pages != $totalPage) {
              ?>
            |&nbsp;
              <?php

          }
          if ($pageNo == $totalPage) {
              ?>
            次へ&gt;
            最後へ&gt;&gt;
              <?php

          } else {
              $nextPageNo = $pageNo + 1; ?>
            <a
              href="/oh/wp32/pagination/showCustomerList.php?page=<?= $nextPageNo ?>">次へ&gt;</a>&nbsp;
            <a
              href="/oh/wp32/pagination/showCustomerList.php?page=<?= $totalPage ?>">最後へ&gt;&gt;</a>
              <?php

          } ?>
          <?php

      }
      ?>
  </p>
  <table>
    <thead>
    <tr>
      <th>No</th>
      <th>顧客ID</th>
      <th>顧客指名</th>
      <th>電話番号</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($customerList as $idx => $customer) {
        $no = $idx + 1; ?>
      <tr>
        <td><?= $no ?></td>
        <td><?= $customer->getCustomerId() ?></td>
        <td><?= $customer->getCustFirstName() ?>
          &nbsp;<?= $customer->getCustLastName() ?></td>
        <td><?= $customer->getPhoneNumbers() ?></td>
      </tr>
        <?php

    }
    ?>
    </tbody>
  </table>
</body>
</html>
