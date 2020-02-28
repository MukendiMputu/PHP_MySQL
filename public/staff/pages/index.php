<?php require_once('../../../private/initialize.php'); ?>

<?php $page_title = 'Pages'; ?>
<?php include(SHARED_PATH.'/staff_header.php'); ?>

<?php
    $pages = [
        ["id" => "1", "position" => "1", "name" => "About us", "visible" => "1"],
        ["id" => "2", "position" => "2", "name" => "Services", "visible" => "1"],
        ["id" => "3", "position" => "3", "name" => "Leadership", "visible" => "1"],
        ["id" => "4", "position" => "4", "name" => "Contact us", "visible" => "1"]
    ]
?>


<div id="content">

    <div class="pages listing">
        <h1>Pages</h1>

        <div class="actions">
            <a class="action" href="">Create a new page</a>
        </div>

        <table class="list">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Content</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($pages as $page) { ?>
            <tr>
                <td><?php echo h($page['id']); ?></td>
                <td><?php echo h($page['position']); ?></td>
                <td><?php echo h($page['name']); ?></td>
                <td><?php echo $page['visible'] == 1 ? 'true' : 'false'; ?></td>
                <td><a class="action" href="<?php echo url_for('/staff/pages/show.php?id='. h(u($page['id']))); ?>">View</a></td>
                <td><a class="action" href="<?php ?>">Edit</a></td>
                <td><a class="action" href="<?php ?>">Delete</a></td>
            </tr>
            <?php } ?>
        </table>

    </div>
</div>

<?php include(SHARED_PATH.'/staff_footer.php'); ?>