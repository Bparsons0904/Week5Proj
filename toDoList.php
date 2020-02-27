<div class="row text-center" id="cat-drop-down">
    <h3 class="my-auto">Active Category: </h3>
    <form action="index.php" method="GET" id="cat-change" class="my-auto">
        <input type="hidden" name="action" value="list-items">
        <select class="form-control"  name="category_id" onchange="categorySelect()">
            <option value="0">Show All Categories</option>
            <!-- Loop through each category  -->
            <?php foreach ( $categories as $category ) : ?>
                <option value="
                    <?php echo $category['categoryID']; ?>" 
                    <?=($category['categoryID'] == filter_input  (INPUT_GET, 'category_id', 
                    FILTER_VALIDATE_INT)) ? 'selected':'';?>><?php echo $category['categoryName']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>
</div>

<?php
    // If the to do list table is not empty diplay full list
    if (count($items) != 0) {
?>
<section>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Task Number</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Category</th>
                <th scope="col" class="text-center">Complete Task</th>
            </tr>
        </thead>
        <tbody>
        <form method="POST" id="delete-item-form">
            <input type="hidden" name="action" value="delete_item">
            <input type="hidden" name="item_id" id="itemValue" value="<?php echo $item['ItemNum']; ?>">
            <input type="hidden" name="category_id" id="categoryValue" value="<?php echo $item['categoryID']; ?>">
            <?php foreach ($items as $item) : ?>
            <tr>
                <td scope="row"><?php echo $item['ItemNum']; ?></td>
                <td scope="row"><?php echo $item['Title']; ?></td>
                <td scope="row"><?php echo $item['Description']; ?></td>
                <td scope="row"><?php echo get_category_name($item['categoryID']); ?></td>
                
                <td scope="row" class="text-center">
                    <i class="fas fa-check-square" id="delete-item" onclick="deleteItem(<?php echo $item['ItemNum']; ?>, <?php echo $item['categoryID']; ?>)"></i>
                </td>
            </tr>
            <?php endforeach; ?>
            </form>
        </tbody>
    </table>
</section>

<!-- Display empty table message -->
<?php } else { ?>
    <h1 class="text-center" id="no-tasks">You Have No <?php echo get_category_name($category_id); ?> Tasks To Complete</h1>
    <a id="add-item" href="index.php?page=additem"></a>
<?php } ?>   

<!-- Display Add Item Button -->
<?php 
    if ($action != "additem") { ?>
        <a class="button-add" href="index.php?action=additem">
            <i class="fas fa-plus"></i><span>Add To Do Item</span>
        </a>
<?php }?>