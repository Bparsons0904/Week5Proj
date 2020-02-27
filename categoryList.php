<h3 class="text-center" id="cat-header">Current Categories</h3>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Category Name</th>
      <th scope="col" class="text-center">Delete Category</th>
    </tr>
  </thead>
  <tbody>
    <form method="POST" id="delete-category-form">
      <input type="hidden" name="action" value="delete_category">
      <input type="hidden" name="category_id" id="delete-category-value" value="">
      <!-- Loop through each category -->
      <?php foreach ($categories as $category) : ?>
        <tr>
          <td scope="row"><?php echo $category['categoryName']; ?></td>
          <td scope="row" class="text-center">
            <i class="fas fa-trash-alt" onclick="deleteCategory(<?php echo $category['categoryID']; ?>)"></i>
          </td>
        </tr>
      <?php endforeach; ?>
    </form>
  </tbody>
</table>
<hr class="mx-auto">
<div class="container" id="add-category">
  <h3 class="text-center">Add Category</h3>
  <form method="POST" id="add-form">
    <div class="row mx-auto">
      <div class="form-group" class="col-6 mx-auto" id="add-category-input">
        <label for="name">Category Name</label>
        <input type="text" name="name" id="name" class="form-control" />
      </div>
      <input type="hidden" name="action" value="add_category">
      <div class="col-6 mx-auto my-auto">
        <button type="submit" class="ml-auto button-add" ><i class="fas fa-plus"></i><span>Add Category</span></button>
      </div>
    </div>
  </form>
</div>
