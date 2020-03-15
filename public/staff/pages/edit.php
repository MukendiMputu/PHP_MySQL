<?php
    require_once('../../../private/initialize.php');

    if(!isset($_GET['id'])) {
        redirect_to(url_for('/staff/pages/index.php'));
    }

    $id = $_GET['id'];

    if(is_post_request()) {
      $page = [];
      // Handle form values sent by new.php
      $page['id'] = $id;
      $page['subject_id'] = $_POST['subject_id'] ?? '';
      $page['page_name'] = $_POST['page_name'] ?? '';
      $page['position'] = $_POST['position'] ?? '';
      $page['visible'] = $_POST['visible'] ?? '';
      $page['content'] = $_POST['content'] ?? '';

      $result = update_page($page);
      redirect_to(url_for('/staff/pages/show.php?id=' . $id));

    } else {
        $page = find_page_by_id(h($id)); // prevent html tags to be passed in
    }

    $page_title = 'Edit Page';
?>

<?php include(SHARED_PATH .'/staff_header.php'); ?>

<div id="content">
    <a class="back list" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a><br/>

    <div class="page new">
        <h1>Edit Page</h1>
        <!-- the url must be sent with the id of the page to be edited -->
        <form action="<?php echo url_for('/staff/pages/edit.php?id=' . h(u($page['id']))); ?>" method="post">
            <dl>
                <dt>Page Name</dt>
                <dd><input type="text" name="page_name" value="<?php echo h($page['page_name']); ?>" /></dd>
            </dl>
            <dl>
                <dt>Subject</dt>
                <dd>
                <select name="subject_id">
                <?php $subjects = find_all_subjects();$current_page = find_subject_by_id($page['subject_id']);?>
                <?php while ($subject = mysqli_fetch_assoc($subjects)) {
                    echo "<option value=\" {$subject['menu_name']} \"";
                    if ($subject['menu_name'] == $current_page['menu_name']) {
                        echo " selected";
                    }
                    echo "> {$subject['menu_name']} </option>";
                }?>
                </select>
                </dd>
            <dl>
            <dl>
                <dt>Position</dt>
                <dd>
                <select name="position">
                    <option value="1"<?php if($page['position'] == "1") { echo " selected"; } ?>>1</option>
                </select>
                </dd>
            <dl>
                <dt>Visible</dt>
                <dd>
                    <input type="hidden" name="visible" value="0" />
                    <input type="checkbox" name="visible" value="1" <?php if($page['visible'] == "1") { echo " checked"; } ?> />
                </dd>
            </dl>
            <dl>
                <dt>Page Content</dt>
                <dd><textarea name="content" cols="60" rows="10"> <?php echo h($page['content']); ?></textarea></dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Edit Page" />
            </div>
        </form>
    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>