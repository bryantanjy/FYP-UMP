<?php
include "databaseFYP.php";
session_start();

$query = $_POST["output"];
$result = mysqli_query($conn, "SELECT s.StudentID, s.Student_Name, s.Faculty_Code, a.SupervisorID, a.Supervisor_Name, i.IndustrialID, i.Industry_Name, e.EvaluatorID, e.Evaluator_Name 
FROM student s 
INNER JOIN evaluator e ON s.EvaluatorID = e.EvaluatorID
INNER JOIN supervisor a ON s.supervisorID = a.supervisorID
INNER JOIN industrial i ON s.IndustrialID = i.IndustrialID
WHERE s.StudentID LIKE '%".$query."%'") or die(mysqli_error($conn));

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
	    <title>Student Supervisor List</title>
        <meta name="description" content="FYP management system">
		<meta name="author" content="Bryan Tan CB20081">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="./css/coordinator.css">
    </head>
    <style>
        table{
            width: 90%;
        }
        table, th, td{
            border: 1px solid #000;
            border-collapse: collapse;
        }
        .search-bar{
            margin-left: 100px;
        }
    </style>
    <body>
        <header>
            <img src= ./img/logo1.png width=15%>
            <h1>StudFYP</h1>
        </header>
        <br>
        <div class="navbar_mid">
            <a href="coordinatorPage.php">Home</a>
            <a class="active" href="student-supervisor.php">Student</a>
            <a href="announcement.php">Announcement</a>
            <a href="view_progress_listing.php">View Progress Listing</a>
            <a href="rubric_list.php">Rubric</a>
            <a href="" style="float:right">Logout</a>
        </div>
        <div class="vertical-menu">
            <a class="active" href="student-supervisor.php">Student-Supervisor List</a>
            <a href="student-evaluator.php">Student-Evaluator List</a>
            <a href="add-student.php">Assign Student Supervisor and Evaluator</a>
            <a href="view_student_rpt.php">Summary Report</a>
        </div>
            <h3 align="center">Student-Supervisor List</h3><br>
            <main>
                <form name="frmUser" action="search_result.php" method="POST">
                <div class="search-bar">
                    <input type="text" name="output" placeholder="Search Student ID">
                    <button type="submit" name="search">Search</button><br><br>
                </div>
                    <table align="center" class="stud-table">
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Faculty</th>
                            <th>Supervisor ID</th>
                            <th>Supervisor Name</th>
                            <th>Industrial ID</th>
                            <th>Industry Name</th>
                            <th colspan="3">Actions</th>
                        </tr>
        
                        <?php
                        if(mysqli_num_rows($result) > 0){ // if one or more rows are returned do following
                            while($row = mysqli_fetch_array($result)){
                                echo "<tr>";
                                    echo "<td>".$row['StudentID']."</td>";
                                    echo "<td>".$row['Student_Name']."</td>";
                                    echo "<td>".$row['Faculty_Code']."</td>";
                                    echo "<td>".$row['SupervisorID']."</td>";
                                    echo "<td>".$row['Supervisor_Name']."</td>";
                                    echo "<td>".$row['IndustrialID']."</td>";
                                    echo "<td>".$row['Industry_Name']."</td>";
                                    echo "<td>";
                                        echo '<a href="view_student.php?StudentID='.$row['StudentID'].'">View</a>';
                                    echo "</td>";
                                    echo "<td>";
                                        echo '<a href="edit_supervisor.php?StudentID='.$row['StudentID'].'">Edit</a>';
                                    echo "</td>";
                                    echo "<td>";
                                        echo '<a href="delete_supervisor.php?StudentID='.$row['StudentID'].'">Delete</a>';
                                    echo "</td>";
                                echo "</tr>";
                            }
                        }
                        else{ // if there is no matching rows 
                            echo "No results found";
                        }
                        ?>
                        
                    </table>
                    <?php mysqli_close($conn) ?>
                </form>
            </main>
        <footer>
        <div class="footer">
            <a href="coordinatorPage.php">Home</a> |
            <a href="">Helps</a> |
            <a href="">Privacy</a> |
            <a href="">Logout</a> 
            <br>
            <h5>Copyright 2021; All Rights Reserved.</h5>
        </div>
        </footer>
    </body>
</html>