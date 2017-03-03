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

    // function test_addStore()
    // {
    //     //Arrange
    //     $name = "Number 1 Brand";
    //     $new_brand = new Brand($name);
    //     $new_brand->save();
    //
    //     $name = "Food and Stuff";
    //     $new_store = new Store($name);
    //     $new_store->save();
    //
    //     //Act
    //     $new_brand->addStore($new_store->getId());
    //     $result = $new_brand->getStores();
    //
    //     //Assert
    //     $this->assertEquals([$new_store], $result);
    // }

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
}
?>
