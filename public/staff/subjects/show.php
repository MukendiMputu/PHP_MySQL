<?php
    include('../../../private/initialize.php');
    require_login();
?>

<?php $page_title = 'Show Subjects'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<?php
    //$id = isset($_GET['id']) ? $_GET['id'] : '1';
    $id = $_GET['id'] ?? '1'; // since PHP 7.0 and later

    $subject = find_subject_by_id(h($id)); // prevent html tags to be passed in
?>

<div id="content">
    <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php');?>">&laquo; Back to List</a><br>
    <div class="subject show">
        <h1>Subject: <?php echo h($subject['menu_name']);?></h1>
        <div class="attributes">
            <dl>
                <dt>Menu Name</dt>
                <dd><?php echo h($subject['menu_name'])?></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd><?php echo h($subject['position'])?></dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd><?php echo $subject['visible'] == '1' ? 'true' : 'false'; ?></dd>
            </dl>
        </div>
    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>