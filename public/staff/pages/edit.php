<?php
    require_once('../../../private/initialize.php');

    $page_title = 'Edit Page';
?>

<?php include(SHARED_PATH .'/staff_header.php'); ?>

<div id="content">
    <a class="back list" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a><br/>

    <div class="page new">
        <h1>Edit Page</h1>

        <form action="<?php echo url_for('/staff/pages/new.php'); ?>" method="post">
            <dl>
                <dt>Page Name</dt>
                <dd><input type="text" name="page_name" value="" /></dd>
            </dl>
            <dl>
                <dt>Content</dt>
                <dd><input type="text" name="content" value="" /></dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd>
                    <input type="hidden" name="visible" value="0" />
                    <input type="checkbox" name="visible" value="1" />
                </dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Edit Page" />
            </div>
        </form>
    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>