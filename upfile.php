<?php

$config = require(dirname(__FILE__) . '/config.php');
require_once dirname(__FILE__) . '/photos.php';
require_once dirname(__FILE__) . '/createDb.php';

header('Content-Type: text/html; charset=utf-8');

try {
   
    // Undefined | Multiple Files | $_FILES Corruption Attack
    // If this request falls under any of them, treat it invalid.
    if (
        !isset($_FILES['upfile']['error']) ||
        is_array($_FILES['upfile']['error'])
    ) {
        throw new RuntimeException('Invalid parameters.');
    }

    // Check $_FILES['upfile']['error'] value.
    switch ($_FILES['upfile']['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('No file sent.');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Exceeded filesize limit.');
        default:
            throw new RuntimeException('Unknown errors.');
    }

    // You should also check filesize here.
    if ($_FILES['upfile']['size'] > 1000000) {
        throw new RuntimeException('Exceeded filesize limit.');
    }

    // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
    // Check MIME Type by yourself.
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    if (false === $ext = array_search(
        $finfo->file($_FILES['upfile']['tmp_name']),
        $config['upload']['validate']['extnames'],
        true
    )) {
        throw new RuntimeException('Invalid file format.');
    }

    $upload_path = $config['upload']['path'];
    if (!is_dir($upload_path)) {
      mkdir($upload_path);
      chmod($upload_path, 0777);
    }

    $upfilePath = sprintf('./uploads/%s.%s',
        sha1_file($_FILES['upfile']['tmp_name']),
        $ext
    );

    // You should name it uniquely.
    // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
    // On this example, obtain safe unique name from its binary data.
    if (!move_uploaded_file(
        $_FILES['upfile']['tmp_name'],
        $upfilePath
    )) {
        throw new RuntimeException('Failed to move uploaded file.');
    }

    $photos = new Photos(createDbConnection());
    $photos->add($upfilePath);
    echo "<p>File is uploaded successfully.</p>";
    echo "<a href='$upfilePath' target='_blank'>$upfilePath</a>";

} catch (RuntimeException $e) {

    echo "<p>{$e->getMessage()}</p>";

}

