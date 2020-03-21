<?php
    function find_all_subjects($options=[]) {
        global $db;

        $visible = $options['visible'] ?? false;

        $sql = "SELECT * FROM subjects ";
        if($visible){
            $sql .= "WHERE visible = true ";
        }
        $sql .= "ORDER BY position ASC";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_all_pages() {
        global $db;

        $sql = "SELECT * FROM pages ";
        $sql .= "ORDER BY subject_id ASC, position ASC";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_page_by_id($page_id, $options=[]) {
        global $db;

        $visible = $options['visible'] ?? false;

        $sql = "SELECT * FROM pages ";
        $sql .= "WHERE id ='" . db_escape($db, $page_id) . "' ";
        if ($visible) {
            $sql .= "AND visible = true ";
        }
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $page = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $page;
    }

    function find_pages_by_subject_id ($subject_id, $options=[]) {
        global $db;

        $visible = $options['visible'] ?? false;

        $sql = "SELECT * FROM pages ";
        $sql .= "WHERE subject_id='" . db_escape($db, $subject_id) . "' ";
        if ($visible) {
            $sql .= "AND visible = true ";
        }
        $sql .= "ORDER BY position ASC";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_subject_by_id($subject_id, $options=[]) {
        global $db;

        $visible = $options['visible'] ?? false;

        $sql = "SELECT * FROM subjects ";
        $sql .= "WHERE id ='" . db_escape($db, $subject_id) . "' ";
        if ($visible) {
            $sql .= "AND visible = true ";
        }
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $subject = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $subject;
    }

    function insert_subject($subject) {
        global $db;

        $sql = "INSERT INTO subjects ";
        $sql .= "(menu_name, position, visible) ";
        $sql .= "VALUES (";
        $sql .= "'" . db_escape($db, $subject['menu_name']) . "',";
        $sql .= "'" . db_escape($db, $subject['position']) . "',";
        $sql .= "'" . db_escape($db, $subject['visible']) . "'";
        $sql .= ")";
        $result = mysqli_query($db, $sql);

        if($result) {
            return $new_id = mysqli_insert_id($db);
        } else {
            // INSERT failed: show error and close connexion
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function insert_page($page) {
        global $db;

        $sql = "INSERT INTO pages ";
        $sql .= "(subject_id, page_name, position, visible, content) ";
        $sql .= "VALUES (";
        $sql .= "'" . db_escape($db, $page['subject_id']) . "',";
        $sql .= "'" . db_escape($db, $page['page_name']) . "',";
        $sql .= "'" . db_escape($db, $page['position']) . "',";
        $sql .= "'" . db_escape($db, $page['visible']) . "',";
        $sql .= "'" . db_escape($db, $page['content']) . "'";
        $sql .= ")";
        $result = mysqli_query($db, $sql);

        if($result) {
            return $new_id = mysqli_insert_id($db);
        } else {
            // INSERT failed: show error and close connexion
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function update_subject($subject) {
        global $db;

        $errors = validate_subject($subject);
        if(!empty($errors)){
            return $errors;
        }

        $sql = "UPDATE subjects SET ";
        $sql .= "menu_name = '" . db_escape($db, $subject['menu_name']) . "', ";
        $sql .= "position = '" . db_escape($db, $subject['position']) . "', ";
        $sql .= "visible = '" . db_escape($db, $subject['visible']) . "' ";
        $sql .= "WHERE id ='" . db_escape($db, $subject['id']) . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);

        if($result) {
            return true;
        } else {
          // INSERT failed: show error and close connexion
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
        }
    }

    function update_page($page) {
        global $db;

        $sql = "UPDATE pages SET ";
        $sql .= "subject_id = '" . db_escape($db, $page['subject_id']) . "', ";
        $sql .= "page_name = '" . db_escape($db, $page['page_name']) . "', ";
        $sql .= "position = '" . db_escape($db, $page['position']) . "', ";
        $sql .= "visible = '" . db_escape($db, $page['visible']) . "' ,";
        $sql .= "content = '" . db_escape($db, $page['content']) . "' ";
        $sql .= "WHERE id ='" . db_escape($db, $page['id']) . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);

        if($result) {
            return true;
        } else {
          // INSERT failed: show error and close connexion
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
        }
    }

    function delete_page($id) {
        global $db;

        $sql = "DELETE FROM pages ";
        $sql .= "WHERE id ='" . db_escape($db, $id) . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);

        if($result) {
            return true;
        } else {
          // INSERT failed: show error and close connexion
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
        }
    }

    function delete_subject($id) {
        global $db;

        $sql = "DELETE FROM subjects ";
        $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);

        // For DELETE statements, $result is true/false
        if($result) {
          return true;
        } else {
          // DELETE failed
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
        }
    }

    function validate_subject($subject) {
        $errors = [];
        // menu_name
        if(is_blank($subject['menu_name'])) {
            $errors[] = "Name cannot be blank.";
        }elseif(!has_length($subject['menu_name'], ['min' => 2, 'max' => 255])) {
            $errors[] = "Name must be between 2 and 255 characters.";
        }

        // position
        // Make sure we are working with an integer
        $postion_int = (int) $subject['position'];
        if($postion_int <= 0) {
            $errors[] = "Position must be greater than zero.";
        }
        if($postion_int > 999) {
            $errors[] = "Position must be less than 999.";
        }

        // visible
        // Make sure we are working with a string
        $visible_str = (string) $subject['visible'];
        if(!has_inclusion_of($visible_str, ["0","1"])) {
            $errors[] = "Visible must be true or false.";
        }

        return $errors;
    }

    function validate_page($page) {
        $errors = [];

        // subject_id
        if(is_blank($page['subject_id'])) {
          $errors[] = "Subject cannot be blank.";
        }

        // menu_name
        if(is_blank($page['menu_name'])) {
          $errors[] = "Name cannot be blank.";
        } elseif(!has_length($page['menu_name'], ['min' => 2, 'max' => 255])) {
          $errors[] = "Name must be between 2 and 255 characters.";
        }
        $current_id = $page['id'] ?? '0';
        if(!has_unique_page_menu_name($page['menu_name'], $current_id)) {
          $errors[] = "Menu name must be unique.";
        }

        // position
        // Make sure we are working with an integer
        $postion_int = (int) $page['position'];
        if($postion_int <= 0) {
          $errors[] = "Position must be greater than zero.";
        }
        if($postion_int > 999) {
          $errors[] = "Position must be less than 999.";
        }

        // visible
        // Make sure we are working with a string
        $visible_str = (string) $page['visible'];
        if(!has_inclusion_of($visible_str, ["0","1"])) {
          $errors[] = "Visible must be true or false.";
        }

        // content
        if(is_blank($page['content'])) {
          $errors[] = "Content cannot be blank.";
        }

        return $errors;
    }


    function find_all_admins() {
        global $db;

        $sql = "SELECT * FROM admins ";
        $sql .= "ORDER BY last_name ASC, first_name ASC";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_admin_by_id($id) {
        global $db;

        $sql = "SELECT * FROM admins ";
        $sql .= "WHERE id='" . db_escape($db, $id) . "";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function insert_admin($admin) {
        global $db;

        $sql = "INSERT INTO admins ";
        $sql .= "(first_name, last_name, email, username, hashed_password) ";
        $sql .= "VALUES (";
        $sql .= "'" . db_escape($db, $subject['first_name']) . "',";
        $sql .= "'" . db_escape($db, $subject['last_name']) . "',";
        $sql .= "'" . db_escape($db, $subject['email']) . "',";
        $sql .= "'" . db_escape($db, $subject['username']) . "',";
        $sql .= "'" . db_escape($db, $subject['hashed_password']) . "'";
        $sql .= ")";
        $result = mysqli_query($db, $sql);

        if($result) {
            return $new_id = mysqli_insert_id($db);
        } else {
            // INSERT failed: show error and close connexion
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function update_admin($admin) {
        global $db;

        $sql = "UPDATE admins SET ";
        $sql .= "first_name = '" . db_escape($db, $admin['first_name']) . "', ";
        $sql .= "last_name = '" . db_escape($db, $admin['last_name']) . "', ";
        $sql .= "email = '" . db_escape($db, $admin['email']) . "', ";
        $sql .= "username = '" . db_escape($db, $admin['username']) . "' ,";
        $sql .= "hashed_password = '" . db_escape($db, $admin['hashed_password']) . "' ";
        $sql .= "WHERE id ='" . db_escape($db, $admin['id']) . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);

        if($result) {
            return true;
        } else {
          // INSERT failed: show error and close connexion
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
        }
    }

    function delete_admin($admin) {
        global $db;

        $sql = "DELETE FROM admins ";
        $sql .= "WHERE id ='" . db_escape($db, $admin) . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);

        if($result) {
            return true;
        } else {
          // INSERT failed: show error and close connexion
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
        }
    }

?>