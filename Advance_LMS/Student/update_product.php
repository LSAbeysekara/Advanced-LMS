<?php
include('config/constant.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $itemcode = $_POST['itemcode'];
    $catogery = $_POST['catogery'];
    $itemname = $_POST['itemname'];
    $content = $_POST['prodesc'];
    $cost_price = $_POST['cost_price'];
    $selling_price = $_POST['selling_price'];
    $qty = $_POST['qty'];
    $status = $_POST['status'];
    $username = $_POST['username'];


    $targetDir = "../shop/product_items/";
    $itemDir = $targetDir . $itemcode;

    $uploadedImages = array();
    for ($i = 1; $i <= 3; $i++) {
        $fileName = "pro_img0$i";
        if (isset($_FILES[$fileName]['name']) && !empty($_FILES[$fileName]['name'])) {
            $newFileName = $itemcode . "-$i." . pathinfo($_FILES[$fileName]['name'], PATHINFO_EXTENSION);
            $targetFilePath = $itemDir . "/" . $newFileName;

            // Check if file with same name but different extension exists
            $existingFile = glob($itemDir . "/" . $itemcode . "-$i.*");
            if (!empty($existingFile)) {
                foreach ($existingFile as $file) {
                    if ($file !== $targetFilePath) {
                        unlink($file); // Delete existing file
                    }
                }
            }

            if (move_uploaded_file($_FILES[$fileName]['tmp_name'], $targetFilePath)) {
                $uploadedImages[] = $targetFilePath;
            }
        }
    }


    $sql = "UPDATE `tb_product` SET 
    `category`='$catogery', 
    `productname`='$itemname', 
    `prodesc`='$content', 
    `cost_price`='$cost_price', 
    `selling_price`='$selling_price', 
    `status`='$status', 
    `quantity`='$qty'
    WHERE `item_code`='$itemcode'";

    $res = mysqli_query($conn, $sql);


    if ($conn->query($sql) === TRUE) {
        $_SESSION['item-update-ok'] = "Updated";
        header("Location: ./listofproduct.php");

    } else {
    $_SESSION['item-update-error'] = "error";
    header("Location: ./listofproduct.php");

    }
} else {
$_SESSION['item-update-error'] = "error";
header("Location: ./listofproduct.php");
}
?>
