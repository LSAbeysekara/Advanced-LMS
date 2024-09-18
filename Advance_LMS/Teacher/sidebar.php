<div class="nk-sidebar">
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">Dashboard</li>
                        <li>
                            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                <i class="icon-home menu-icon"></i><span class="nav-text">My Courses</span>
                            </a>
                            <ul aria-expanded="false">
                            <?php
                        
                        $t_id = $_SESSION['tchr_id'];
                        $sqls = "SELECT * FROM `tb_courses` where t_id='$t_id'";

                        $resultq = $conn->query($sqls);


                        while ($rows = $resultq->fetch_assoc()) { ?>

                                <li><a href="./course.php?id=<?php echo $rows['c_id']; ?>"><?php echo $rows['c_name']; ?></a></li>
                           
                                

                            <?php } ?>
                            </ul>
                        </li>
                    </li>
                    <li class="nav-label">Course</li>
                        <li>
                            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                <i class="icon-speedometer menu-icon"></i><span class="nav-text">Lessons</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="./add-lesson.php?id=<?php echo $c_id ?>">Add Lesson</a></li>
                                <li><a href="./course.php?id=<?php echo $c_id ?>">Lessons</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                <i class="icon-speedometer menu-icon"></i><span class="nav-text">Assignments</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="./add-assignment.php?id=<?php echo $c_id ?>">Add an assignment</a></li>
                                <li><a href="./assignments.php?id=<?php echo $c_id ?>">Assignments</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                <i class="icon-speedometer menu-icon"></i><span class="nav-text">Students</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="./students.php?id=<?php echo $c_id ?>">Students</a></li>
                            </ul>
                        </li>
                    </li>
                </ul>
            </div>
        </div>