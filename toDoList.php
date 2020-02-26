<form action="index.php" method="GET" id="cat_change">
    <input type="hidden" name="action" value="list-items">
    <select name="category_id" onchange="categorySelect()">
        <option value="0">Show All</option>
        <?php foreach ( $categories as $category ) : ?>
            <option value="<?php echo $category['categoryID']; ?>" <?=($category['categoryID'] == filter_input(INPUT_GET, 'category_id', 
            FILTER_VALIDATE_INT)) ? 'selected':'';?>><?php echo $category['categoryName']; ?>
            </option>
        <?php endforeach; ?>
    </select>
</form>

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
        <?php foreach ($items as $item) : ?>
        <tr>
            <td scope="row"><?php echo $item['ItemNum']; ?></td>
            <td scope="row"><?php echo $item['Title']; ?></td>
            <td scope="row"><?php echo $item['Description']; ?></td>
            <td scope="row"><?php echo get_category_name($item['categoryID']); ?></td>
            
            <td scope="row" class="text-center">
                <form method="POST">
                    <input type="hidden" name="action" value="delete_item">
                    <input type="hidden" name="item_id" value="<?php echo $item['ItemNum']; ?>">
                    <input type="hidden" name="category_id" value="<?php echo $item['categoryID']; ?>">
                    <button type="submit"><i class="fas fa-check-square"></i></button>
                    
                </form></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php 
    if (isset($_GET['action']) != "additem") { ?>
        <a class="button-add" href="index.php?action=additem">
            <i class="fas fa-plus"></i><span>Add List Item</span>
        </a>
    <?php }
    if (isset($_GET['action']) != "list_categories") { ?>
        <a class="button-add" href="index.php?action=list_categories">
            <i class="fas fa-plus"></i><span>List Categories</span>
        </a>
<?php }?>