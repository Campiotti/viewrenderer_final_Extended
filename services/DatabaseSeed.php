<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 17.12.2017
 * Time: 11:26
 */

namespace services;
use models\Product;
use models\product_tag;
use models\Tag;
use models\User;

/**
 *
 * DatabaseSeed Test
 *
 * $dbseed = new \services\DatabaseSeed();
 * $dbseed->resetDatabase();
 */
class DatabaseSeed
{
    private $dbConnection;
    //private $queryBuilder;
/**
 * this will create a new connection to the db and delete the whole database
 * next it will create all tables with their primary keys
 * after that all constraints will be created
 * last test data is inserted in the newly created tables.
 * - New -
 * reads the two files set in the database.ini file and executes them (ddl regardless, but dml only if it's not empty)
 * You can find out what ddl and dml mean online. (Simple: ddl - tables , dml - data)
 */
    public function resetDatabase(){
        session_destroy();
		$ini = parse_ini_file('config/database.ini');
		//var_dump($ini);
        $this->dbConnection = new \PDO($ini['engine'].':host='.$ini['host'].';',$ini['username'],$ini['password']);
        //var_dump($this->dbConnection);
        //$this->queryBuilder = new QueryBuilder();
        $this->dbConnection->prepare($this->dropDatabase($ini['database']))->execute();
        $this->dbConnection->prepare($this->createDatabase($ini['database']))->execute();
        $this->dbConnection->prepare($this->useDatabase($ini['database']))->execute();
		$this->dbConnection->exec(file_get_contents('config/'.$ini['ddl']));
		if($ini['dml']!="" && strlen($ini['dml'])<1)
		    $this->dbConnection->exec(file_get_contents('config/'.$ini['dml']));
		//You could instead of using a direct .sql script also use the models and the query-builder to create tables and default data as seen below.
        /*//Create Table Statements
        $this->dbConnection->prepare('CREATE TABLE IF NOT EXISTS DBUser (ID INT PRIMARY KEY AUTO_INCREMENT,Email varchar(255),Username varchar(100),Password varchar(255),EndDate datetime);')->execute();
        $this->dbConnection->prepare('CREATE TABLE IF NOT EXISTS Tags (ID INT PRIMARY KEY AUTO_INCREMENT,TagName varchar(100));')->execute();
        $this->dbConnection->prepare('CREATE TABLE IF NOT EXISTS Product_Tag (ID INT PRIMARY KEY AUTO_INCREMENT,TagsFk int,ProductFk int);')->execute();
        $this->dbConnection->prepare('CREATE TABLE IF NOT EXISTS Product (ID INT PRIMARY KEY AUTO_INCREMENT,DBUserFK int,Productname varchar(100),Image varchar(100),Video varchar(100),Views int,Rating int, Description varchar(500) );')->execute();
        $this->dbConnection->prepare('CREATE TABLE IF NOT EXISTS Review(ID INT PRIMARY KEY AUTO_INCREMENT,DBUserFK int,ProductFk int, Title varchar(100), Content varchar(500), Rating int);')->execute();
        $this->dbConnection->prepare('CREATE TABLE IF NOT EXISTS Favourite (ID INT PRIMARY KEY AUTO_INCREMENT,ProductFK int,UserFK int);')->execute();
        $this->dbConnection->prepare('CREATE TABLE IF NOT EXISTS Codes(ID INT PRIMARY KEY AUTO_INCREMENT,Code varchar(32),Valid int);')->execute();
        //Alter Table Statements
        $this->dbConnection->prepare('ALTER TABLE Product_Tag ADD CONSTRAINT FOREIGN KEY (tagFK) REFERENCES Tag(id) ON DELETE RESTRICT;')->execute();
        $this->dbConnection->prepare('ALTER TABLE Product_Tag ADD CONSTRAINT FOREIGN KEY (productFK) REFERENCES Product(id) ON DELETE CASCADE;')->execute();
        $this->dbConnection->prepare('ALTER TABLE Favourite ADD CONSTRAINT FOREIGN KEY (DBUserFK) REFERENCES DBUser(id) ON DELETE CASCADE;')->execute();
        $this->dbConnection->prepare('ALTER TABLE Favourite ADD CONSTRAINT FOREIGN KEY (productFK) REFERENCES Product(id) ON DELETE CASCADE;')->execute();
        //$this->dbConnection->prepare('ALTER TABLE Product ADD CONSTRAINT FOREIGN KEY (Product_Tag) REFERENCES Product_Tag(id) ON DELETE RESTRICT')->execute();
        $this->dbConnection->prepare('ALTER TABLE DBUser ADD CONSTRAINT FOREIGN KEY (cartFK) REFERENCES Cart(id) ON DELETE CASCADE;')->execute();
        $this->dbConnection->prepare('ALTER TABLE Product ADD CONSTRAINT FOREIGN KEY (DBUserFK) REFERENCES DBUser(id) ON DELETE RESTRICT ')->execute();
        $this->dbConnection->prepare('ALTER TABLE Review ADD CONSTRAINT FOREIGN KEY (DBUserFK) REFERENCES DBUser(id) ON DELETE CASCADE;')->execute();


        $this->dbConnection = null;
        $this->dbConnection = DBConnection::getDbConnection();

        //Generate Base Data (Admin/Webhost User, Base Products)
        $user = new User();
        $data = [];
        $data_1 = ['email'=>'admin@admin.ch','username' =>'admin', 'password' => 'admin12','enddate' => date("Y-m-d H:i:s")];
        $data_2 = ['email'=>'ismail.buenuel@csbe.org','username' =>'ismail', 'password' => 'ismailB','enddate' => date("Y-m-d H:i:s")];
        array_push($data,$data_1);
        array_push($data,$data_2);
        foreach($data as $d){
            $_POST['data'] = $data;
            $user->clearEntity();
            $user->patchEntity($d);
            if ($user->isValid()){
                $user->save();
            }
        }


        $product = new Product();
        $prod=[];
        $prod[6] = ['userfk' =>'2','productname' =>'John Scarce', 'image' =>'ScarceIsThicc.jpg','video'=>'cars.mp4','stock' => 50,'price' => 1942, 'discount' =>0.25, 'description' =>'Hey what\'s up guys it\'s Scarce here.'];
        $prod[7] = ['userfk' =>'2','productname' =>'Jeff 21JumpStreet', 'image' =>'JmDbE.gif','video'=>'mustang.mp4','stock' => 2100,'price' => 420, 'discount' =>0.21, 'description' =>'This is imagery of god himself.'];
        $prod[8] = ['userfk' =>'1','productname' =>'Careful when using JQuery', 'image' =>'schmitz_v5.png','video'=>'GTR.mp4','stock' => 253,'price' => 10, 'discount' =>0, 'description' =>'He will find you.'];
        $prod[9] = ['userfk' =>'2','productname' =>'Phiner and Frog', 'image' =>'hqdefault.jpg','video'=>'Phineas and Ferb - AinT Got Rhythm.mp4','stock' => 253,'price' => 10, 'discount' =>0, 'description' =>$this->getLongText("phineas and ferb")];
        $prod[10]= ['userfk' =>'2','productname' =>'Build that Structure', 'image' =>'Trump.jpg','video'=>'BuildThatWall.mp4','stock' => 253,'price' => 10, 'discount' =>0, 'description' =>'Build that wall! Build that wall! Build that wall! Build that wall! Build that wall! Build that wall!'];
        $prod[11]= ['userfk' =>'2','productname' =>'High Level Audio', 'image' =>'2423747.main_image.jpg','video'=>'Phineas and Ferb Music Video - AinT Got Rhythm N8.mp3','stock' => 253,'price' => 10, 'discount' =>0, 'description' =>'Ain\'t got rythm but you got that beat!'];
        foreach ($prod as $p){
            $_POST['data'] = $prod;
            $product->clearEntity();
            $product->patchEntity($p);
            $product->save();
        }*/
    }


    private function dropDatabase($dbName){
        $stmt = "drop database if exists ".$dbName;
        return$stmt;
    }

    private function createDatabase($dbName){
        $stmt = "create database if not exists ".$dbName;
        return$stmt;
    }
    private function useDatabase($dbName){
        $stmt = "use ".$dbName;
        return$stmt;
    }

    private function getLongText(string $text){
        switch($text){
            case"bee movie":
                return"According to all known laws of aviation,

 there is no way a 🅱️ee should be able to fly.

 Its wings are too small to get its fat little body off the ground.

 The bee, of course, flies anyway

 because bees don't care what humans think is impossible.

 Yellow, black. Yellow, black. Yellow, black. Yellow, black.

 Ooh, black and yellow! Let's shake it up a little.

 Barry! Breakfast is ready!

 To find out more go watch the localhost movie hindi 2015 bajrangi bhaijaan bajrangi bhaijaan hindi today!";
                break;
            case"phineas and ferb":
                return"
We could... Fly into space And scare mummies Walk up the Eiffel Tower

Discover something new, that doesn't exist Phineas: Hey! Shampo a monkey well. Go surfing Handling with electricity and light And operate Frankenstein's brain Phineas: It is here!

See birds on mountains Paint an entire country Or restor the sister with beard Candace: Phineas!

As you can see, there's a whole loads to do, before school goes on. Phineas: Come with me, Perry! Therefore watch us 'cause Phineas and Ferb show you how it's done! Therefore watch us 'cause Phineas and Ferb show you how it's done! Candace: Mom, Phineas and Ferb are working on a title sequence!";
                break;
            default:
                return "Example Description";
        }

    }
}