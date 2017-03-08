<?php

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once "src/Store.php";
require_once "src/Brand.php";

$server = 'mysql:host=localhost:8889;dbname=shoes_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

class StoreTest extends PHPUnit_Framework_TestCase
{
    protected function TearDown()
    {
        Store::deleteAll();
        Brand::deleteAll();
    }

    function test_save()
    {
        //Arrange
        $name = "Food and Stuff";
        $new_store = new Store($name);

        //Act
        $new_store->save();
        $result = Store::getAll();

        //Assert
        $this->assertEquals($result, [$new_store]);
    }

    function test_getAll()
    {
        //Arrange
        $name = "Food and Stuff";
        $new_store = new Store($name);
        $new_store->save();

        $name = "New Store Name";
        $new_store2 = new Store($name);
        $new_store2->save();

        //Act
        $result = Store::getAll();

        //Assert
        $this->assertEquals([$new_store, $new_store2], $result);
    }


    function test_update()
    {
        //Arrange
        $name = "Food and Stuff";
        $new_store = new Store($name);
        $new_store->save();

        //Act
        $new_name = "Clothes and Stuff";
        $new_store->update($new_name);
        $result = $new_store->getName();

        //Assert
        $this->assertEquals($result, "Clothes and Stuff");
    }

    function test_find()
    {
        //Arrange
        $name = "Food and Stuff";
        $new_store = new Store($name);
        $new_store->save();

        //Act
        $result = Store::find($new_store->getId());

        //Assert
        $this->assertEquals($result, $new_store);
    }

    function test_addBrand()
    {
        //Arrange
        $name = "Food and Stuff";
        $new_store = new Store($name);
        $new_store->save();

        $name = "Number 1 Brand";
        $new_brand = new Brand($name);
        $new_brand->save();

        //Act
        $new_store->addBrand($new_brand->getId());
        $result = $new_store->getBrands();

        //Assert
        $this->assertEquals($new_brand, $result[0]);
    }

    function test_getBrands()
    {
        //Arrange
        $name = "Brand #1";
        $test_brand = new Brand($name);
        $test_brand->save();

        $name2 = "Brand #2";
        $test_brand2 = new Brand($name2);
        $test_brand2->save();

        $name = "Food and Stuff";
        $test_store = new Store($name);
        $test_store->save();

        $name2 = "Food and Stuff Too";
        $test_store2 = new Store($name2);
        $test_store2->save();

        //Act
        $test_store->addBrand($test_brand->getId());
        $test_store->addBrand($test_brand2->getId());
        $result = $test_store->getBrands();

        //Assert
        $this->assertEquals([$test_brand, $test_brand2], $result);
    }



    function test_delete()
    {
        //Arrange
        $name = "Food and Stuff";
        $new_store = new Store($name);
        $new_store->save();

        $name2 = "Clothes and Stuff";
        $new_store2 = new Store($name2);
        $new_store2->save();

        //Act
        $new_store->delete();
        $result = Store::getAll();

        //Assert
        $this->assertEquals($result, [$new_store2]);
    }
}
?>
