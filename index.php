<?php
require_once('db.php');

// Check if GET and delete type - Delete task
if(!empty($_GET['type']) && $_GET['type'] === 'delete'){
    // Set variable to primary key value
    $itemNum = filter_input(INPUT_GET, 'itemNum');
    // If id is null report error
    if ($itemNum == null) {
        header("LOCATION: index.php?type=error");
    // Delete task from db
    } else {
        // Set query to delete based on itemNum primary key
        $query = 'DELETE FROM todoitems WHERE ItemNum = :itemNum';
        $statement = $db->prepare($query);
        // PDO Binding of variables
        $statement->bindValue(':itemNum', $itemNum);
        $statement->execute();
        $statement->closeCursor();
        // Display success message
        header("LOCATION: index.php?type=success");
    }
// No delete called, get all items from database
} else {
    // Set query to get all items from database
    $query = 'SELECT * FROM todoitems';
    $statement = $db->prepare($query);
    $statement->execute();
    $items = $statement->fetchAll();
    $statement->closeCursor(); 
}
?>

<!-- Display core of html head and nav -->
<?php include('pages/header.html'); ?>

<!-- Display content based on get/post/empty list -->
<section class="container">
    <?php 
        // Display success/fail message based on GET type
        if (isset($_GET['type'])) {
        switch ($_GET['type']) {
            case 'success':
                include('pages/success.html');
                break;
            case 'error':
                include('pages/error.html');
                break;
            }
        }
        // Display add item if get page set to get or post
        if ((isset($_GET['page']) && $_GET['page'] == 'additem') || (isset($_POST['type']) && $_POST['type'] == 'add')) { 
            include('pages/additem.php');
        // Display emptylist if num of rows in db is 0
        } else if ($statement->rowCount() === 0) {
            include('pages/emptyList.html');
        // Display list of tasks
        } else {
            include('pages/toDoList.php');
        }
    ?>
</section>
</body>

</html>