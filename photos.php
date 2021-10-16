<?php

class Photos {
    private $db;
    public function __construct(PDO $db) {
        $this->db = $db;
    }
    
    public function add($name) {
        return $this->db
            ->query(sprintf('insert into photos (name) values ("%s") on duplicate key update name=values(name)', $name))
            ->execute();
    }
    
    public function getPhotos() {
        $photos = $this->db->query('select * from photos')->fetchAll();
        return array_map(function ($item) {
            return array(
                'name' => $item['name'],
                'id' => $item['id']
            );
        }, $photos);
    }
}