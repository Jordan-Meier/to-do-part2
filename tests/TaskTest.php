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
            $completion = 0;
            $test_task = new Task($description, $due_date, $completion, $id);
            $test_task->save();

            //Act
            $result = $test_task->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            //Arrange
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $due_date = "2016-02-28";
            $completion = 0;
            $test_task = new Task($description, $due_date, $completion, $id);

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
            $completion = 0;
            $test_task = new Task($description, $due_date, $completion, $id);
            $test_task->save();


            $description2 = "Water the lawn";
            $due_date2 = "2016-02-27";
            $completion2 = 1;
            $test_task2 = new Task($description2, $due_date2, $completion2, $id);
            $test_task2->save();

            //Act
            $result = Task::getAll();

            //Assert
            $this->assertEquals([$test_task2, $test_task], $result);
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
            $completion = 0;
            $test_task = new Task($description, $due_date, $completion, $id);
            $test_task->save();

            $description2 = "Water the lawn";
            $due_date2 = "2016-02-27";
            $completion2 = 1;
            $test_task2 = new Task($description2, $due_date2, $completion2, $id);
            $test_task2->save();

            //Act
            Task::deleteAll();

            //Assert
            $result = Task::getAll();
            $this->assertEquals([], $result);
        }



        function test_find()
        {
            //Arrange
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $due_date = "2016-02-28";
            $completion = 0;
            $test_task = new Task($description, $due_date, $completion, $id);
            $test_task->save();

            $description2 = "Water the lawn";
            $due_date2 = "2016-02-27";
            $completion2 = 1;
            $test_task2 = new Task($description2, $due_date2, $completion2, $id);
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
            $due_date = "2016-03-01";
            $completion = 0;
            $test_task = new Task($description, $due_date, $completion, $id);
            $test_task->save();

            $new_description = "Clean the dog";
            $new_due_date = "2016-03-05";
            $new_completion = 1;

            //Act
            $test_task->update($new_description, $new_due_date, $new_completion);

            //Assert
            $this->assertEquals(["Clean the dog", "2016-03-05", 1], [$test_task->getDescription(), $test_task->getDueDate(), $test_task->getCompletion()]);
        }

        function testDelete()
        {
            //Arrange
            $name = "Work stuff";
            $id = 1;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "File reports";
            $id2 = 2;
            $due_date = "2016-09-10";
            $completion = 0;
            $test_task = new Task($description, $due_date, $completion, $id2);
            $test_task->save();

            //Act
            $test_task->addCategory($test_category);
            $test_task->delete();

            //Assert
            $this->assertEquals([], $test_category->getTasks());
        }

        function testAddCategory()
        {
            //Arrange
            $name = "Work stuff";
            $id = 1;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "File reports";
            $id = 2;
            $due_date = "2016-09-10";
            $completion = 0;
            $test_task = new Task($description, $due_date, $completion, $id);
            $test_task->save();

            //Act
            $test_task->addCategory($test_category);

            //Assert
            $this->assertEquals($test_task->getCategories(), [$test_category]);
        }

        function testGetCategories()
        {
            //Arrange
            $name = "Work stuff";
            $id = 1;
            $test_category = new Category($name, $id);
            $test_category->save();

            $name2 = "Volunteer stuff";
            $id2 = 2;
            $test_category2 = new Category($name2, $id2);
            $test_category2->save();

            $description = "File reports";
            $id3 = 3;
            $due_date = "2016-09-10";
            $completion = 0;
            $test_task = new Task($description, $due_date, $completion, $id3);
            $test_task->save();

            //Act
            $test_task->addCategory($test_category);
            $test_task->addCategory($test_category2);

            //Assert
            $this->assertEquals($test_task->getCategories(), [$test_category, $test_category2]);
        }

        function test_findCompletedTasks()
        {
            //Arrange
            // $name = "Home stuff";
            // $id = null;
            // $test_category = new Category($name, $id);
            // $test_category->save();

            $description = "Wash the dog";
            $due_date = "2016-02-28";
            $completion = 1;
            $id = null;
            $test_task = new Task($description, $due_date, $completion, $id);
            $test_task->save();

            $description2 = "Water the lawn";
            $due_date2 = "2016-02-27";
            $completion2 = 1;
            $id = null;
            $test_task2 = new Task($description2, $due_date2, $completion2, $id);
            $test_task2->save();

            //Act
            $result = Task::findCompletedTasks();

            //Assert
            $this->assertEquals([$test_task2, $test_task], $result);
        }

    }
?>
