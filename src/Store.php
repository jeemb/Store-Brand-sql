<?php

class Store
{
    private $name;

    function __construct($name, $id=null)
    {
        $this->name = $name;
        $this->id = $id;
    }

    function getName()
    {
        return $this->name;
    }

    function setName($new_name)
    {
        $this->name = $new_name;
    }

    function getId()
    {
        return $this->id;
    }

    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO stores (name) VALUES ('{$this->getName()}');");
       $this->id = $GLOBALS['DB']->lastInsertId();
    }

    function update($name)
     {
         $this->setName($name);
         $GLOBALS['DB']->exec("UPDATE stores SET name = '{$this->name}' WHERE id = {$this->id}");
     }

    function delete()
    {
        $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
        $GLOBALS['DB']->exec("DELETE FROM brands_stores WHERE brand_id = {$this->getId()};");
    }

    static function getAll()
    {
        $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
        return $returned_stores->fetchAll( PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Store", ["name"]);
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM brands_stores;");
        $GLOBALS['DB']->exec("DELETE FROM stores;");
    }
}




?>
