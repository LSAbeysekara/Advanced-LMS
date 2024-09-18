<div class="nk-sidebar">           
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label"><Strong>LMS</Strong></li>
                    <li>
                        <a class="has-arrow" href="../index.php" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>

                    </li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-globe-alt menu-icon"></i><span class="nav-text">My Courses</span>
                        </a>
                        <ul aria-expanded="false">
                        <?php
                        
                        $st_id = $_SESSION['st_id'];
                        $sqls = "SELECT 
                        e.`enroll_id`,
                        e.`course_id`,
                        e.`st_id`,
                        e.`enroll_date`,
                        e.`status`,
                        e.`created_by`,
                        c.`c_name` AS `course_name`
                    FROM 
                        `tb_enrollment` e
                    JOIN 
                        `tb_courses` c ON e.`course_id` = c.`c_id`
                    WHERE 
                        e.`st_id` = '$st_id';
                    ";

                        $resultq = $conn->query($sqls);


                        while ($rows = $resultq->fetch_assoc()) { ?>

                                 <li><a href="../course_view.php?c_id=<?php echo $rows['course_id']; ?>"><?php echo $rows['course_name']; ?></a></li> 
                           
                                
                            <?php } ?>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="../journal_form.php" aria-expanded="false">
                            <i class="icon-screen-tablet menu-icon"></i><span class="nav-text">Forum</span>
                        </a>
                    </li>
                    <li>
                        <a class="has-arrow" href="../grades.php" aria-expanded="false">
                            <i class="icon-screen-tablet menu-icon"></i><span class="nav-text">Grades</span>
                        </a>

                    </li>

                    <li class="nav-label"><Strong>Resourse Hub</Strong></li>
                    <li>
                        <a class="has-arrow" href="index.php" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>

                    </li>

                    <li class="nav-label"><Strong>SHOP</Strong></li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Shop Dashboard</span>
                        </a>
                      
                            
                        
                        <ul aria-expanded="false">
                            <li><a href="../seller_dash.php">Dashboard</a></li>
                            <?php if ($_SESSION['seller']=="active"){ ?>
                                <li><a href="../product.php">Add Product</a></li>
                            <li><a href="../listproduct.php">List of Product</a></li>
                            <li><a href="../listorder.php">Orders</a></li>
                            <?php } ?>
                        </ul>

                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-screen-tablet menu-icon"></i><span class="nav-text">Product</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="../product.php">Add Categories</a></li>
                           
                            <li><a href="../listofproduct.php">List of Product</a></li>
                        </ul>
                    </li>

                    
                </ul>
            </div>
        </div>