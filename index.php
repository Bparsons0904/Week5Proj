<?php
    // Add database and table functions
    require('./model/db.php');
    require('./model/item_db.php');
    require('./model/category_db.php');
   
    // Set action based on if POST or GET
    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action');
        if ($action == NULL) {
            // No action provided, defaut to list-items
            $action = 'list-items';
        }
    }

    // Set success, check if part of GET
    $success = filter_input(INPUT_GET, 'success');

    // Default action, get categories by id or all
    if ($action == 'list-items') {
        // Get category ID from GET with validation
        $category_id = filter_input(INPUT_GET, 'category_id', 
                FILTER_VALIDATE_INT);
        // Get all categories
        $categories = get_categories();
        // Get all items based on category, defualt to all
        $items = get_items_by_category($category_id);
        // Set main display to toDoList
        $main = 'toDoList.php';
    // Delete to do item action
    } else if ($action == 'delete_item') {
        // Set variables from POST
        $item_id = filter_input(INPUT_POST, 'item_id', 
                FILTER_VALIDATE_INT);
        $category_id = filter_input(INPUT_POST, 'category_id', 
                FILTER_VALIDATE_INT);
        // Check if variables properly set
        if ($category_id == NULL || $category_id == FALSE ||
                $item_id == NULL || $item_id == FALSE) {
            // Add error message and display
            $error = "Missing or incorrect item id or category id.";
            $main = './errors/error.php';
        } else { 
            // Delete item and display success message
            delete_item($item_id);
            $successStatement = "Item was successfully marked as complete.";
            header("Location: .?category_id=$category_id&success=$successStatement");
        }
    // Add to do item action
    } else if ($action == 'additem') {
        // Get all items from table using NULL category
        $items = get_items_by_category(NULL);
        // Set categories to all categories
        $categories = get_categories();
        // Display additem
        $main = 'additem.php';
    // Add item to the todo table action  
    } else if ($action == 'add_item') {
        // Set variables and validate
        $title = filter_input(INPUT_POST, 'title_form');
        $description = filter_input(INPUT_POST, 'description');
        $category_id = filter_input(INPUT_POST, 'category_id', 
                FILTER_VALIDATE_INT);
        // Verify all variables set properly
        if ($category_id == NULL || $category_id == FALSE || $title == NULL || 
                $description == NULL) {
            // Display error message
            $error = "Invalid data. Check all fields and try again.";
            $main = './errors/error.php';
        } else {
            // Add item and display success message
            add_item($title, $description, $category_id);
            $successStatement = $title . " was added to the To Do List Successfully.";
            header("Location: .?category_id=$category_id&success=$successStatement");
        }
    // Display category list action
    } else if ($action == 'list_categories') {
        // Get all categories
        $categories = get_categories();
        // Display categorylist page
        $main = 'categoryList.php';
    // Add category action
    } else if ($action == 'add_category') {
        // Set name variable from POST
        $name = filter_input(INPUT_POST, 'name');
        // Validate inputs
        if ($name == NULL) {
            // Display error message
            $error = "Invalid category name. Check name and try again.";
            $main = './errors/error.php';
        } else {
            // Add category to category table
            add_category($name);
            // Display success message
            $successStatement = $name . " was added as a Category.";
            header("Location: .?action=list_categories&success=$successStatement");  
        }
    // Delete category action
    } else if ($action == 'delete_category') {
        // Set variable from POST
        $category_id = filter_input(INPUT_POST, 'category_id', 
                FILTER_VALIDATE_INT);
        // Delete category
        delete_category($category_id);
        // Display success message
        $successStatement = "Category was successfully removed.";
        header("Location: .?action=list_categories&success=$successStatement");  
    }
?>

<?php 
    // Display core of html head and nav
    include('view/header.html');
    // Display success message if active
    if ($success) {
        include('view/success.php'); 
    } 
    // Injection point for active page
    include($main);
    // Display Footer
    include('view/footer.php'); 
?>