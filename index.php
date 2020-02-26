<?php
require('./model/db.php');
require('./model/item_db.php');
require('./model/category_db.php');
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list-items';
    }
}

if ($action == 'list-items') {
    $category_id = filter_input(INPUT_GET, 'category_id', 
            FILTER_VALIDATE_INT);
    $category_name = get_category_name($category_id);
    $categories = get_categories();
    $items = get_items_by_category($category_id);
    $main = 'toDoList.php';
} else if ($action == 'delete_item') {
    $item_id = filter_input(INPUT_POST, 'item_id', 
            FILTER_VALIDATE_INT);
    $category_id = filter_input(INPUT_POST, 'category_id', 
            FILTER_VALIDATE_INT);
            echo "Item id: " . $item_id . "\n";
            echo "Cat id: " . $category_id . "\n";
    if ($category_id == NULL || $category_id == FALSE ||
            $item_id == NULL || $item_id == FALSE) {
        $error = "Missing or incorrect item id or category id.";
        include('../errors/error.php');
        echo $error;
        echo $item_id;
        echo $category_id;
        $main = 'toDoList.php';
    } else { 
        delete_item($item_id);
        header("Location: .?category_id=$category_id");
    }
} else if ($action == 'additem') {
    $items = get_items_by_category(NULL);
    $categories = get_categories();
    $main = 'additem.php';    
} else if ($action == 'add_item') {
    $title = filter_input(INPUT_POST, 'title_form');
    $description = filter_input(INPUT_POST, 'description');
    $category_id = filter_input(INPUT_POST, 'category_id', 
            FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE || $title == NULL || 
            $description == NULL) {
        $error = "Invalid product data. Check all fields and try again.";
        // include('../errors/error.php');
        echo "Add error";
    } else { ;
        add_item($title, $description, $category_id);
        // $main = 'toDoList.php';
        header("Location: .?category_id=$category_id");
    }
} else if ($action == 'list_categories') {
    $categories = get_categories();
    $main = 'categoryList.php';
} else if ($action == 'add_category') {
    $name = filter_input(INPUT_POST, 'name');

    // Validate inputs
    if ($name == NULL) {
        $error = "Invalid category name. Check name and try again.";
        include('view/error.php');
    } else {
        echo "Add success";
        add_category($name);
        header('Location: .?action=list_categories');  
    }
} else if ($action == 'delete_category') {
    $category_id = filter_input(INPUT_POST, 'category_id', 
            FILTER_VALIDATE_INT);
    delete_category($category_id);
    header('Location: .?action=list_categories');      // display the Category List page
}


?>
<!-- Display core of html head and nav -->
<?php include('view/header.html'); ?>
<!-- <?php include('toDoList.php') ?> -->
<?php include($main) ?>
<?php include('view/footer.php'); ?>
<?php echo $action; ?>