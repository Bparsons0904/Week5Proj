<?php

// Check if post response
if(!empty($_POST)){
  // Set variables from post data
  $title = filter_input(INPUT_POST, 'title-form');
  $description = filter_input(INPUT_POST, 'description');
  // Check if any variables are null, dipslay error
  if ($title == null || $description == null) {
    header("LOCATION: index.php?type=error");
  } else {
    // Connect to DB
    require_once('db.php');
    // Create query to add new task to DB
    $query = 'INSERT INTO todoitems (title, description) VALUES (:title, :description)';
    $statement = $db->prepare($query);
    // Bind variables to query statement
    $statement->bindValue(':title', $title); 
    $statement->bindValue(':description', $description); 
    $statement->execute();
    $statement->closeCursor();
    // Redirect to index with success display
    header("LOCATION: index.php?type=success");
  }
}
?>

<form method="POST" action="index.php" id="add-form">
  <div class="form-group">
    <label for="title-form">Title</label>
    <input type="text" name="title-form" id="title-form" class="form-control" />
  </div>
  <div class="form-group">
    <label for="description">Description</label>
    <textarea type="text" name="description" id="description" class="form-control"></textarea>
  </div> 
  <input type="hidden" name="type" value="add" />
  <div class="row">
    <button type="submit" class="ml-auto button-add" ><i class="fas fa-plus"></i><span>Add Task</span></button>
  </div>
</form>

<!-- Display current list of tasks -->
<?php include ("toDoList.php"); ?>
