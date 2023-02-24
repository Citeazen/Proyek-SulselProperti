<?php
// Folder to browse
$dir = 'assets/img/';

// Allowed file extensions
$allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');

// Get the requested type (either 'File' or 'Image')
$type = isset($_REQUEST['Type']) ? $_REQUEST['Type'] : 'File';

// Get the list of files in the directory
$files = scandir($dir);

// Remove . and .. from the list of files
$files = array_diff($files, array('.', '..'));

// Create an empty array to hold the results
$results = array();

// Loop through the list of files and add them to the results array
foreach ($files as $file) {
  $ext = pathinfo($file, PATHINFO_EXTENSION);
  if (in_array(strtolower($ext), $allowedExtensions) && is_file($dir . '/' . $file)) {
    $results[] = array(
      'name' => $file,
      'url' => $dir . '/' . $file,
      'type' => $type,
      'size' => filesize($dir . '/' . $file),
      'lastmod' => filemtime($dir . '/' . $file),
    );
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Browse Files</title>
  <style>
    * {
      list-style: none;
      box-sizing: border-box;
    }

    .browse_image-container {
      display: flex;
      flex-wrap: wrap;
    }

    .browse_image {
      border: 1px solid #777;
      position: relative;
      padding: 5px;
      margin: 10px;
      width: 200px;
      height: 200px;
      overflow: hidden;
    }

    .browse_image img {
      max-width: 100%;
      max-height: 100%;
    }

    .browse_action {
      position: absolute;
      bottom: 5px;
/*       top: 10px; */
      right: 5px;
    }

    body {
      display: flex;
    }
  </style>
</head>

<body>
  <div class="browse_image-container">
    <?php foreach ($results as $result) : ?>
      <div class="browse_image">
            Nama: <?php echo $result['name']; ?>
        <img class="product-imgs" src="<?php echo $result['url']; ?>" alt="<?php echo $result['name']; ?>">
        <div class="browse_action">
          <button onclick="useImage('<?php echo $result['url']; ?>')">Select</button>
          <button onclick="deleteImage('<?php echo $result['url']; ?>')">Delete</button>
        </div>
      </div>
      <br>
    <?php endforeach; ?>
  </div>
  <script src="script.js"></script>
  <script>
    function deleteImage(url) {
      var confirmation = confirm("Are you sure you want to delete this image?");
      if (confirmation) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "ck-delete.php");
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onload = function() {
          if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.status === "success") {
              location.reload();
            } else {
              alert("Error deleting file.");
            }
          }
        };
        xhr.send("url=" + encodeURIComponent(url));
      }
    }

    function useImage(url) {
      window.opener.CKEDITOR.tools.callFunction(<?php echo $_GET['CKEditorFuncNum']; ?>, url);
      window.close();
    }
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      addImageModal("product-imgs");
    });
  </script>
</body>

</html>