<?php

return [
  'database' => [
      'host' => '127.0.0.1',
      'port' => 3306,
      'user' => 'root',
      'password' => 'root'
  ],
  'upload' => [
      'path' => './uploads',
      'validate' => [
          'extnames' => array(
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
          )
      ]
  ]
];
