<?php require_once('../../../private/initialize.php'); ?>

<?php $page_title = 'Show Page'; ?>
<?php include(SHARED_PATH.'/staff_header.php'); ?>

<?php
    //$id = isset($_GET['id']) ? $_GET['id'] : '1';
    $id = $_GET['id'] ?? '1'; // since PHP 7.0 and later

    $page = find_page_by_id(h($_GET['id']));
?>

<div id="content">
    <a class="back-link" href="<?php echo url_for('/staff/pages/index.php');?>">&laquo; Back to List</a><br>
    <div class="page show">
        <h1>Page ID: <?php echo h($page['page_name']); ?></h1>
        <div class="attributes">
            <dl>
                <dt>Page name:</dt>
                <dd><?php echo h($page['page_name']) ?></dd>
            </dl>
            <dl>
                <dt>Position:</dt>
                <dd><?php echo h($page['position']) ?></dd>
            </dl>
            <dl>
                <dt>Visible:</dt>
                <dd><?php echo $page['visible'] == '1' ? 'true' : 'false' ?></dd>
            </dl>
        </div>
    </div>
</div>

<?php include(SHARED_PATH.'/staff_footer.php'); ?>