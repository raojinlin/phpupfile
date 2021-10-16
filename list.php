<html>

<head>
    <title>Photos</title>
    <style type="text/css">
        body {
            padding: 0;
        }
        
        img {
            float: left;
        }
    </style>
</head>

<body>
<?php

$config = require(__DIR__ . '/config.php');
require_once __DIR__ . "/photos.php";
require_once __DIR__ . '/createDb.php';


$photos = new Photos(createDbConnection());

foreach ($photos->getPhotos() as $photo) {
    echo "<img src='${photo['name']}' />";
}

?>
</body>
</html>
