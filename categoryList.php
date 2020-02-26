<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Name</th>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $category) : ?>
        <tr>
            <td scope="row"><?php echo $category['categoryName']; ?></td>
            <td scope="row" class="text-center">
                <form method="POST">
                    <input type="hidden" name="action" value="delete_category">
                    <input type="hidden" name="category_id" value="<?php echo $category['categoryID']; ?>">
                    <button type="submit"><i class="fas fa-check-square"></i></button>
                    
                </form></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<form method="POST" id="add-form">
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" class="form-control" />
  </div>
  <input type="hidden" name="action" value="add_category">
  <div class="row">
    <button type="submit" class="ml-auto button-add" ><i class="fas fa-plus"></i><span>Add Category</span></button>
  </div>
</form>