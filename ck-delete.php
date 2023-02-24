<?php
if (isset($_POST['url'])) {
    $file = $_POST['url'];
    if (file_exists($file) && unlink($file)) {
        echo json_encode(array('status' => 'success'));
        exit;
    }
}
echo json_encode(array('status' => 'error'));
