<?php

class Brand
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
        $GLOBALS['DB']->exec("INSERT INTO brands (name) VALUES ('{$this->getName()}');");
       $this->id = $GLOBALS['DB']->lastInsertId();
    }

    function addStore($id)
    {
        $GLOBALS['DB']->exec("INSERT INTO brands_stores (brand_id, store_id) VALUES ({$this->getId()}, {$id});");
    }

    function getStores()
    {
        $returned_stores = $GLOBALS['DB']->query("SELECT stores.* FROM brands
            JOIN brands_authors ON (brands_stores.brand_id = brands.id)
            JOIN stores ON (stores.id = brands_stores.stores_id)
            WHERE brands.id = {$this->getId()};");
            if ($returned_stores) {
                return $returned_stores->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Store', ['name', 'id']);
            }
            return [];
    }

    static function find($id)
    {
        $store = $GLOBALS['DB']->query("SELECT * FROM brands WHERE id={$id}");
        return $store->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Brand", ["name"])[0];
    }

    static function getAll()
    {
        $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");
        return $returned_brands->fetchAll( PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Brand", ["name"]);
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM brands_stores;");
        $GLOBALS['DB']->exec("DELETE FROM brands;");
    }
}
?>
