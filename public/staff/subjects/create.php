<?php

require_once('../../../private/initialize.php');

if(is_post_request()) {

  // Handle form values sent by new.php
  $subject = [];
  $subject['menu_name'] = $_POST['menu_name'] ?? '';
  $subject['position'] = $_POST['position'] ?? '';
  $subject['visible'] = $_POST['visible'] ?? '';

  $new_id = insert_subject($subject);
  redirect_to(url_for('/staff/subjects/show.php?id=' . $new_id));

} else {
  redirect_to(url_for('/staff/subjects/new.php'));
}

?>
