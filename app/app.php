<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Task.php";
    require_once __DIR__."/../src/Category.php";

    $app = new Silex\Application();

    // $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=to_do';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('categories' => Category::getAll(), 'tasks' => Task::getAll()));
    });

    ////////////////////////
    ///////CATEGORIES//////
    ///////////////////////

    // Gets page with category-list and add-category form
    $app->get("/categories", function() use ($app) {
        return $app['twig']->render('categories.html.twig', array('categories' => Category::getAll()));
    });

    // Posts categories to category-list page
    $app->post("/categories", function() use ($app) {
        $category = new Category($_POST['name']);
        $category->save();
        return $app['twig']->render('categories.html.twig', array('categories' => Category::getAll()));
    });

    // Clears all categories and returns homepage
    $app->post("/delete_categories", function() use ($app) {
       Category::deleteAll();
       return $app['twig']->render('index.html.twig');
    });

    // Gets a specific category with associated tasks and add-task form
    $app->get("/categories/{id}", function($id) use ($app) {
        $category = Category::find($id);
        return $app['twig']->render('category.html.twig', array('category' => $category, 'tasks' => $category->getTasks(), 'all_tasks' => Task::getAll()));
    });

   // Gets page to edit a specific category
   $app->get("/categories/{id}/edit", function($id) use ($app) {
       $category = Category::find($id);
       return $app['twig']->render('category_edit.html.twig', array('category' => $category));
    });

    // Updates specific category page
   $app->patch("/categories/{id}", function($id) use ($app) {
       $new_name = $_POST['name'];
       $category = Category::find($id);
       $category->update($new_name);
       return $app['twig']->render('category.html.twig', array('category' => $category, 'tasks' => $category->getTasks(), 'all_tasks' => Task::getAll()));
    });

    // Assigns new category to a task
    $app->post("/add_categories", function() use ($app) {
       $category = Category::find($_POST['category_id']);
       $task = Task::find($_POST['task_id']);
       $task->addCategory($category);
       return $app['twig']->render('task.html.twig', array('task' => $task, 'tasks' => Task::getAll(), 'categories' => $task->getCategories(), 'all_categories' => Category::getAll()));
    });

   ////////////////////////
   ///////TASKS///////////
   ///////////////////////

    // Gets page with task-list and add-task form
    $app->get("/tasks", function() use ($app) {
        return $app['twig']->render('tasks.html.twig', array('tasks' => Task::getAll()));
    });


    // Posts tasks to task-list page
    $app->post("/tasks", function() use ($app) {
        $description = $_POST['description'];
        $due_date = $_POST['due_date'];
        $task = new Task($description, $due_date, $id = null);
        $task->save();
        return $app['twig']->render('tasks.html.twig', array('tasks' => Task::getAll()));
    });

    // Clears all tasks and returns homepage
    $app->post("/delete_tasks", function() use ($app) {
       Task::deleteAll();
       return $app['twig']->render('index.html.twig');
    });

    // Gets page for a specific task
    $app->get("/tasks/{id}", function($id) use ($app) {
        $task = Task::find($id);
        return $app['twig']->render('task.html.twig', array('task' => $task, 'categories' => $task->getCategories(), 'all_categories' => Category::getAll()));
    });

    // Gets page to edit a specific task
    $app->get("/task/{id}/edit", function($id) use ($app) {
        $task = Task::find($id);
        return $app['twig']->render('task_edit.html.twig', array('task' => $task));
    });

    // Updates a specific task page
    $app->patch("/tasks/{id}", function($id) use ($app) {
        $new_description = $_POST['description'];
        $new_due_date = $_POST['due_date'];
        $new_completion = $_POST['completion'];
        $task = Task::find($id);
        $task->update($new_description, $new_due_date, $new_completion);
        return $app['twig']->render('task.html.twig', array('task' => $task, 'all_tasks' => Task::getAll()));
    });

    // Assigns a task to a category
   $app->post("/add_tasks", function() use ($app) {
        $category = Category::find($_POST['category_id']);
        $task = Task::find($_POST['task_id']);
        $category->addTask($task);
        return $app['twig']->render('category.html.twig', array('category' => $category, 'categories' => Category::getAll(), 'tasks' => $category->getTasks(), 'all_tasks' => Task::getAll()));
    });

    // Gets page with completed tasks
    $app->get("/completed_tasks", function() use ($app) {
        $tasks = Task::findCompletedTasks();
        return $app['twig']->render('completed_tasks.html.twig', array('completed_tasks' => $tasks));
    });

    return $app;

?>
