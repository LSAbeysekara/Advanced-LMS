<?php
include('config/constant.php');

if (isset($_GET['id'])) {
    $file = $_GET['id'];

    $filePath = "./lessons/" . $file;

    if (file_exists($filePath)) {
        ?>

        <!-- Display the file content in a new tab -->
        <script>
            window.onload = function() {
                var filePath = "<?php echo $filePath; ?>";
                var newWindow = window.open(filePath, '_blank');
                newWindow.focus();
            };
        </script>

        <?php
        //echo '<meta http-equiv="refresh" content="0;url=./course.php">';
        ?>


    <?php
    } else {
        echo "File does not exist: " . $filePath;
    }
} else {
    $_SESSION['assignment-view-error'] = "error";
    //header('location: course.php');
}
?>
