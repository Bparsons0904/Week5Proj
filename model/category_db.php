<?php
// Get all categories
function get_categories() {
    // Open database
    global $db;
    // Get categories from table
    $query = 'SELECT * FROM categories
              ORDER BY categoryID';
    $statement = $db->prepare($query);
    $statement->execute();
    $categories = $statement->fetchAll();
    $statement->closeCursor();
    // Return all categoires
    return $categories;
}

// Get category name from category ID
function get_category_name($category_id) {
    // Open database
    global $db;
    // Get category based on categoire ID
    $query = 'SELECT categoryName FROM categories
              WHERE categoryID = :category_id';
    // PDO get category from database
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $category = $statement->fetch();
    $statement->closeCursor();
    // Return specific category name
    return $category["categoryName"];
}

// Delete catagory from database
function delete_category($category_id) {
    // Open database
    global $db;
    // Delete category from database query
    $query = 'DELETE FROM categories
              WHERE categoryID = :category_id';
    // PDO delete category from database
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $statement->closeCursor();
}

function add_category($categoryName) {
    // Open database
    global $db;
    // Add category query 
    $query = 'INSERT INTO categories
                 (categoryname)
              VALUES
                 (:categoryName)';
    // PDO add category itno database
    $statement = $db->prepare($query);
    $statement->bindValue(':categoryName', $categoryName);
    $statement->execute();
    $statement->closeCursor();
}
