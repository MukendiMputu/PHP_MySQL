<?php require_once('../../../private/initialize.php'); ?>

<?php $page_title = 'Show Admin User'; ?>
<?php include(SHARED_PATH.'/staff_header.php'); ?>

<?php
    //$id = isset($_GET['id']) ? $_GET['id'] : '1';
    $id = $_GET['id'] ?? '1'; // since PHP 7.0 and later

    $admin = find_admin_by_id(h($_GET['id']));
?>

<div id="content">
    <a class="back-link" href="<?php echo url_for('/staff/admins/index.php');?>">&laquo; Back to List</a><br>
    <div class="admin show">
        <h1>User ID: <?php echo h($admin['page_name']); ?></h1>
        <div class="attributes">
            <dl>
                <dt>Uname:</dt>
                <dd><?php echo h($admin['page_name']) ?></dd>
            </dl>
            <dl>
                <dt>Subject:</dt>
                <dd><?php
                        $subject = find_subject_by_id($admin['subject_id']);
                        echo $subject['menu_name'];
                    ?>
                </dd>
            </dl>
            <dl>
                <dt>Position:</dt>
                <dd><?php echo h($admin['position']) ?></dd>
            </dl>
            <dl>
                <dt>Visible:</dt>
                <dd><?php echo $admin['visible'] == '1' ? 'true' : 'false' ?></dd>
            </dl>
            <dl>
                <dt>Content:</dt>
                <dd><?php echo h($admin['content']) ?></dd>
                <dd><a class="action" href="<?php echo url_for('/index.php?id='. h(u($admin['id'])) . '&preview=true'); ?>" target="blank_" rel="noreferrer noopener">Preview</a></dd>
            </dl>
        </div>
    </div>
</div>

<?php include(SHARED_PATH.'/staff_footer.php'); ?>