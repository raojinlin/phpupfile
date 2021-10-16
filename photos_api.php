<?php

require_once __DIR__ . "/photos.php";
require_once __DIR__ . '/createDb.php';

$photos = new Photos(createDbConnection());

header('content-type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');

echo json_encode($photos->getPhotos());

