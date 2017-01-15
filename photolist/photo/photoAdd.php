<?php
/**
 * @src 11/13
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/photolist/classes/Conf.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/photolist/classes/libs/Smarty.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/photolist/classes/entity/Photo.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/photolist/classes/dao/PhotoDAO.class.php';

$smarty = new Smarty();
$smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/photolist/templates');
$smarty->setCompileDir($_SERVER['DOCUMENT_ROOT'].'/oh/wp32/photolist/templates_c');

$tplPath = 'photo/photoAdd.tpl';

$isRedirect = false;

// *******************
//
// *******************
$addPhotoTitle = $_POST['addPhotoTitle'];
$addPhotoNote = $_POST['addPhotoNote'];

$addPhotoTitle = trim('addPhotoTitle');
$addPhotoNote = trim('addPhotoNote');

$fileArray = $_FILES['addPhotoFile'];

$photo = new Photo();
$photo->setPhTitle($addPhotoTitle);
$photo->setPhNote($addPhotoNote);

$validationMsgs = [];

if (strlen($addPhotoTitle) == 0) {
    $validationMsgs[] = 'タイトルの入力は必須です。';
}

if (!is_uploaded_file($fileArray['tmp_name'])) {
    $validationMsgs[] = 'ファイルが指定されていないか、ファイルアップロードが失敗しました。';
} elseif ($fileArray['type'] !== 'image/png' && $fileArray['type'] !== 'image/jpeg') {
    $validationMsgs[] = '対応できない画像ファイルが指定されました。JPEG または PNG顔像ファイルを指定してください。';
}

if (empty($validationMsgs)) {
    try {
        $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $photoDAO = new PhotoDAO($db);
        $db->beginTransaction();

        $id = $photoDAO->insert($photo);

        if ($id !== 0) {
            $imageSizeArray = getimagesize($fileArray['tmp_name']);
            $width = $imageSizeArray[0];
            $height = $imageSizeArray[1];
            $imageType = $imageSizeArray[2];

            $upDir = $_SERVER['DOCUMENT_ROOT'].APP_ROOT.UP_FILE_DIR.'/';

            $phPathSmall = 'upfile-'.$id.'-Small.jpg';
            $phPathLarge = 'upfile-'.$id.'-Large.jpg';

            if ($imageType == 3) {
                $image = imagecreatefrompng($fileArray['tmp_name']);
            } else {
                $image = imagecreatefromjpeg($fileArray['tmp_name']);
            }

            $newHeightSmall = 60;
            $rateX = $height / $newHeightSmall;
            $newWidthSmall = $width / $rateX;

            $canvasSmall = imagecreatetruecolor($newWidthSmall, $newHeightSmall);
            imagecopyresampled($canvasSmall, $image, 0, 0, 0, 0, $newWidthSmall, $newHeightSmall, $width, $height);
            imagejpeg($canvasSmall, $upDir.$phPathSmall, 100);
            imagedestroy($canvasSmall);

            if ($width <= 400) {
                move_uploaded_file($fileArray['tmp_name'], $upDir.$phPathLarge);
            } else {
                $newWidthLarge = 400;
                $rateY = $width / $newWidthLarge;
                $newHeightLarge = $height / $rateY;

                $canvasLarge = imagecreatetruecolor($newWidthLarge, $newHeightLarge);
                imagecopyresampled($canvasLarge, $image, 0, 0, 0, 0, $newWidthLarge, $newHeightLarge, $width, $height);
                imagejpeg($canvasLarge, $upDir.$phPathLarge, 100);
                imagedestroy($canvasLarge);
            }

            $result = $photoDAO->updatePath($id, $phPathSmall, $phPathLarge);

            if ($result) {
                $db->commit();
                $isRedirect = true;
            } else {
                $db->rollBack();

                $smarty->assign('errorMsg', '情報登録に失敗しました。もう一度はじめからやり直してください。');

                $tplPath = 'error.tpl';
            }
        } else {
            $db->rollBack();

            $smarty->assign('errorMsg', '情報登録に失敗しました。もう一度はじめからやり直してください。');

            $tplPath = 'error.tpl';
        }
    } catch (PDOException $e) {
        $db->rollBack();

        print_r($e);

        $smarty->assign('errorMsg', 'DB接続に失敗しました。');

        $tplPath = 'error.tpl';
    } finally {
        $db = null;
    }
}

if ($isRedirect) {
    $_SESSION['flashMsg'] = '写真を登録しました。';
    header('Location: /oh/wp32/photolist/photo/showPhotoList.php');

    exit;
} else {
    if (!empty($validationMsgs)) {
        $smarty->assign('validationMsgs', $validationMsgs);
        $smarty->assign('photo', $photo);
    }

    $smarty->display($tplPath);
}
