<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Task.php";
    require_once "src/Category.php";

    $server = 'mysql:host=localhost;dbname=to_do_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);




    class TaskTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Task::deleteAll();
            Category::deleteAll();
        }

        function test_getId()
        {
            //Arrange
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $due_date = "2016-02-28";
            $test_task = new Task($description, $due_date, $id);
            $test_task->save();

            //Act
            $result = $test_task->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        // function test_getCategoryId()
        // {
        //     //Arrange
        //     $name = "Home stuff";
        //     $id = null;
        //     $test_category = new Category($name, $id);
        //     $test_category->save();
        //
        //     $description = "Wash the dog";
        //     $due_date = "2016-02-28";
        //     $test_task = new Task($description, $due_date, $id);
        //     $test_task->save();
        //
        //     //Act
        //     $result = $test_task->getCategoryId();
        //
        //     //Assert
        //     $this->assertEquals(true, is_numeric($result));
        // }

        function test_save()
        {
            //Arrange
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $due_date = "2016-02-28";
            $test_task = new Task($description, $due_date, $id);

            //Act
            $test_task->save();

            //Assert
            $result = Task::getAll();
            $this->assertEquals($test_task, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $due_date = "2016-02-28";
            $test_task = new Task($description, $due_date, $id);
            $test_task->save();


            $description2 = "Water the lawn";
            $due_date2 = "2016-02-27";
            $test_task2 = new Task($description2, $due_date2, $id);
            $test_task2->save();

            //Act
            $result = Task::getAll();

            //Assert
            $this->assertEquals([$test_task, $test_task2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $due_date = "2016-02-28";
            $test_task = new Task($description, $due_date, $id);
            $test_task->save();

            $description2 = "Water the lawn";
            $due_date2 = "2016-02-27";
            $test_task2 = new Task($description2, $due_date2, $id);
            $test_task2->save();

            //Act
            Task::deleteAll();

            //Assert
            $result = Task::getAll();
            $this->assertEquals([], $result);
        }

        // function test_deleteFromCategory()
        // {
        //     //Arrange
        //     $name = "Home Stuff";
        //     $id = null;
        //     $test_Category = new Category($name, $id);
        //     $test_Category->save();
        //
        //     $name2 = "Dinner Stuff";
        //     $id = null;
        //     $test_Category2 = new Category($name2, $id);
        //     $test_Category2->save();
        //
        //     $description = "Wash the dog";
        //     $due_date = "2016-02-28";
        //     $test_task = new Task($description, $due_date, $id);
        //     $test_task->save();
        //
        //     $description2 = "Chop the onion";
        //     $due_date2 = "2016-02-26";
        //     $test_task2 = new Task($description2, $due_date2, $id);
        //     $test_task2->save();
        //
        //     //Act
        //     Task::deleteFromCategory();
        //     $result = Task::getAll();
        //
        //     //Assert
        //     $this->assertEquals([$test_task2], $result);
        // }

        function test_find()
        {
            //Arrange
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $due_date = "2016-02-28";
            $test_task = new Task($description, $due_date, $id);
            $test_task->save();

            $description2 = "Water the lawn";
            $due_date2 = "2016-02-27";
            $test_task2 = new Task($description2, $due_date2, $id);
            $test_task2->save();

            //Act
            $result = Task::find($test_task->getId());

            //Assert
            $this->assertEquals($test_task, $result);
        }

        function testUpdate()
        {
            //Arrange
            $description = "Wash the dog";
            $id = 1;
            $test_task = new Task($description, $id);
            $test_task->save();

            $new_description = "Clean the dog";

            //Act
            $test_task->update($new_description);

            //Assert
            $this->assertEquals("Clean the dog", $test_task->getDescription());
        }

        function testDeleteTask()
        {
            //Arrange
            $description = "Wash the dog";
            $id = 1;
            $test_task = new Task($description, $id);
            $test_task->save();

            $description2 = "Water the lawn";
            $id2 = 2;
            $test_task2 = new Task($description2, $id2);
            $test_task2->save();


            //Act
            $test_task->delete();

            //Assert
            $this->assertEquals([$test_task2], Task::getAll());
        }



    }
?>
