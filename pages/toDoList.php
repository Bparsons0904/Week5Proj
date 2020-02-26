<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Task Number</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col" class="text-center">Complete Task</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($items as $item) : ?>
        <tr>
            <th scope="row"><?php echo $item['ItemNum']; ?></th>
            <th scope="row"><?php echo $item['Title']; ?></th>
            <th scope="row"><?php echo $item['Description']; ?></th>
            <th scope="row" class="text-center"><a
                    href="index.php?type=delete&itemNum=<?php echo $item['ItemNum']; ?>"><i
                        class="fas fa-check-square"></i></a></th>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php 
    if (isset($_GET['page']) != "additem") { ?>
        <a class="button-add" href="index.php?page=additem">
            <i class="fas fa-plus"></i><span>Add List Item</span>
        </a>
<?php }?>