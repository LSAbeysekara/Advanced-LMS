<?php
include('config/constant.php');

    if(isset($_POST['submit'])){
        $act_id = $_POST['act_id'];

        $sql = "SELECT * FROM tb_activity WHERE act_id = '$act_id'";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count>0){
            
            while($row=mysqli_fetch_assoc($res)){
                $act_name = $row['act_name'];
                $file_name = $row['file_name'];
                $content = $row['content'];
                $deadline = $row['deadline'];
                $created = $row['created'];
                $c_id = $row['c_id'];
                $status = $row['status'];
            } ?>

        <?php
        }else{
            $_SESSION['add-error'] = "error";
            //header('location: add-assignment.php');
        }
        
    }
    else{
        $_SESSION['add-error'] = "error";
        //header('location: add-assignment.php');
    }

?>




<?php 
	
	// create a zip file
	$zip_file = "./assignment/".$c_id."_".$act_name.".zip";
	touch($zip_file);
	// end
	
    // open zip file
	$zip = new ZipArchive;
	$this_zip = $zip->open($zip_file);


	if($this_zip){

		// $file_with_path = "../image/1.jpg";
		// $name = "1.jpg";
		// $zip->addFile($file_with_path,$name);

		$folder = opendir('./assignment/'.$c_id."_".$act_name);

		if ($folder) {
			while (false !== ($file = readdir($folder))) {
				if ($file !== "." && $file !== "..") {
					$file_with_path = './assignment/'.$c_id."_".$act_name.'/'.$file;
					$zip->addFile($file_with_path, $file);
				}
			}
			closedir($folder);
		}
		
		
		

		// download this created zip file
		if(file_exists($zip_file))  
		{  
			//name when download
			 $demo_name = $c_id."_".$act_name."'s_answers".".zip";

		     header('Content-type: application/zip');  
		     header('Content-Disposition: attachment; filename="'.$demo_name.'"');  
		     readfile($zip_file); // auto download

		     //delete this zip file after download
		     unlink($zip_file);  
		} 




	}
	




?>