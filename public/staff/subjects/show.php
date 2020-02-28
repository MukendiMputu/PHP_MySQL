<?php
    //$id = isset($_GET['id']) ? $_GET['id'] : '1';
    $id = $_GET['id'] ?? '1'; // since PHP 7.0 and later

    echo htmlspecialchars($id); // prevent html tags to be passed in
?>

<a href="staff/subjects/show.php?name=<?php echo urlencode('John Doe'); ?>">Link</a><br />
<a href="staff/subjects/show.php?company=<?php echo urlencode('Widgets&More'); ?>">Link</a><br />
<a href="staff/subjects/show.php?query=<?php echo urlencode('!#*?'); ?>">Link</a><br />