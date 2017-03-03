<?php

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once "src/Store.php";

$server = 'mysql:host=localhost:8889;dbname=shoes_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

class StoreTest extends PHPUnit_Framework_TestCase
{
    protected function TearDown()
    {
        Store::deleteAll();
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
