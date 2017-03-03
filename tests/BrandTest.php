<?php

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once "src/Brand.php";
require_once "src/Store.php";

$server = 'mysql:host=localhost:8889;dbname=shoes_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

class BrandTest extends PHPUnit_Framework_TestCase
{
    protected function TearDown()
    {
        Brand::deleteAll();
        Store::deleteAll();
    }

    function test_save()
    {
        //Arrange
        $name = "Food and Stuff";
        $new_brand = new Brand($name);

        //Act
        $new_brand->save();
        $result = Brand::getAll();

        //Assert
        $this->assertEquals($result, [$new_brand]);
    }

    function test_find()
    {
        //Arrange
        $name = "Food and Stuff";
        $new_brand = new Brand($name);
        $new_brand->save();

        //Act
        $result = Brand::find($new_brand->getId());

        //Assert
        $this->assertEquals($result, $new_brand);
    }

    function test_addStore()
    {
        //Arrange
        $name = "Number 1 Brand";
        $new_brand = new Brand($name);
        $new_brand->save();

        $name = "Food and Stuff";
        $new_store = new Store($name);
        $new_store->save();

        //Act
        $new_brand->addStore($new_store->getId());
        $result = $new_brand->getStores();

        //Assert
        $this->assertEquals([$new_store], $result);
    }

    function test_getStores()
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
        $test_brand->addStore($test_store->getId());
        $test_brand->addStore($test_store2->getId());
        $result = $test_brand->getStores();

        //Assert
        $this->assertEquals([$test_store, $test_store2], $result);
    }

    function test_getAll()
    {
        //Arrange
        $name = "Number 1 Brand";
        $new_brand = new Brand($name);
        $new_brand->save();

        $name2 = "Number 2 Brand";
        $new_brand2 = new Brand($name2);
        $new_brand2->save();

        //Act
        $result = Brand::getAll();

        //Assert
        $this->assertEquals([$new_brand, $new_brand2], $result);
    }

    // function test_delete()
    // {
    //     //Arrange
    //     $name = "Food and Stuff";
    //     $new_store = new Store($name);
    //     $new_store->save();
    //
    //     $name2 = "Clothes and Stuff";
    //     $new_store2 = new Store($name2);
    //     $new_store2->save();
    //
    //     //Act
    //     $new_store->delete();
    //     $result = Store::getAll();
    //
    //     //Assert
    //     $this->assertEquals($result, [$new_store2]);
    // }
}
?>
