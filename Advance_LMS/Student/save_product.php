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
    if (!file_exists($itemDir)) {
        mkdir($itemDir, 0777, true);
    }

    $uploadedImages = array();
    for ($i = 1; $i <= 3; $i++) {
        $fileName = "pro_img0$i";
        if (isset($_FILES[$fileName]['name']) && !empty($_FILES[$fileName]['name'])) {
          
            $newFileName = $itemcode . "-$i." . pathinfo($_FILES[$fileName]['name'], PATHINFO_EXTENSION);
            
            $targetFilePath = $itemDir . "/" . $newFileName;

            if (move_uploaded_file($_FILES[$fileName]['tmp_name'], $targetFilePath)) {
                $uploadedImages[] = $targetFilePath;
            }
        }
    }


    date_default_timezone_set('Asia/Colombo');
    $currentDateTime = date("Y-m-d H:i:s");

    
    $sql = "INSERT INTO tb_product (item_code, category, productname, prodesc, cost_price, selling_price, status, quantity, create_by, create_date, pro_img)
            VALUES ('$itemcode', '$catogery', '$itemname', '$content', '$cost_price', '$selling_price', '$status', '$qty', '$username', '$currentDateTime','')";


    if ($conn->query($sql) === TRUE) {
        $_SESSION['item-add-ok'] = "Added";
        header("Location: ./product.php");

    } else {
    $_SESSION['item-add-error'] = "error";
    header("Location: ./product.php");

    }
} else {
$_SESSION['item-add-error'] = "error";
header("Location: ./product.php");
}
?>
