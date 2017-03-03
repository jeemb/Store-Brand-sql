# _Brands Carried By Stores & Stores carrying Brands_

#### MySQL PHP Database Program 3.3.2017

#### By Jennifer Beem

## Description

This app explores a new concept to my learning: "many-to-many" database relationships. The app displays user-inputted information about stores and brands sold in those stores. The user can update and delete individual stores and add new brands to stores and stores that sell specific brands. Because, a store can sell many brands and a brand can be sold in many different stores. 

### Application Specifications

|Behavior|Input|Output|
|--------|-----|------|
|User can input information for individual store and app displays all stores added on page| User adds "Store #1"| "Store #1" published to page|
|User can add a brand sold in stores to store page and app displays information on store's specific page|User adds "Brand 4" to "Store 1"|App displays "Brand 4" to "Store 1"'s page'|
|App allows user to edit store information.|User clicks edit button|App routes user to edit page|
|App redirects any edits made to store information back to store page to display changes.|User changes store name "Store 1" to "Store 2"|Routes back to stylist page and displays "Store 2"|

## Setup/Installation Requirements

* Clone this repository
* Open up computer terminal
* Run `$ composer install`
* Open up MAMP and set document root to this project's web folder.
* Start servers in MAMP
* Open up web browser and navigate to **`php -S localhost:8888`** to view program

## Backup MySQL Commands

* In Terminal run `/Applications/MAMP/Library/bin/mysql --host=localhost -uroot -proot`
* `CREATE DATABASE shoes;`
* `USE shoes`
* `CREATE TABLE stores (id serial PRIMARY KEY, name VARCHAR (255));`
* `CREATE TABLE brands (id serial PRIMARY KEY, name VARCHAR (255));`
* `CREATE TABLE brands_stores (id serial PRIMARY KEY, brand_id INT, store_id INT));`
* Open browser and go to: localhost:8888/phpmyadmin
* Navigate to shoes database and click "Operations"
* Copy database (structure only) and call copy "shoes_test"

## Known Bugs

None known.

## Support and contact details

Feel free to contact me at: jenniferbeem@gmail.com if any questions come up!

## Technologies Used

* PHP/Silex
* HTML/Twig
* PHPUnit for testing
* MySQL Database
* CSS/Bootstrap

### License
Copyright (c) 2017 Jennifer Beem
This software is licensed under the MIT license.
