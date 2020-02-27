<?php

// Get items based on category id, get all if null
function get_items_by_category($category_id) {
    // Open Database
    global $db;
    // Check if category id greater than 1, not null
    if (!$category_id >= 1) {
        // Query to get all items from table
        $query = 'SELECT * FROM todoitems
              ORDER BY ItemNum';
    } else {
        // Get items based on category ID
        $query = 'SELECT * FROM todoitems
              WHERE todoitems.categoryID = :category_id
              ORDER BY ItemNum';
    }
    // PDO get items from database
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $items = $statement->fetchAll();
    $statement->closeCursor();
    // Return queried to do items
    return $items;
}

// Get specific to do item
function get_item($item_id) {
    // Open database
    global $db;
    // Get item based on item ID
    $query = 'SELECT * FROM todoitems
              WHERE ItemNum = :item_id';
    // PDO get items from database
    $statement = $db->prepare($query);
    $statement->bindValue(':item_id', $item_id);
    $statement->execute();
    $item = $statement->fetch();
    $statement->closeCursor();
    // Return specific item
    return $item;
}

// Delete item from database
function delete_item($item_id) {
    // Open database
    global $db;
    // Get item based on item ID
    $query = 'DELETE FROM todoitems
              WHERE ItemNum = :item_id';
    // PDO delete item from database
    $statement = $db->prepare($query);
    $statement->bindValue(':item_id', $item_id);
    $statement->execute();
    $statement->closeCursor();
}

// Add to do item to database
function add_item($title, $description, $category_id) {
    // Open database
    global $db;
    // Set query for item to be added
    $query = 'INSERT INTO todoitems
                 (title, description, categoryID)
              VALUES
                 (:title, :description, :category_id)';
    // PDO insert item into database
    $statement = $db->prepare($query);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $statement->closeCursor();
}
?>