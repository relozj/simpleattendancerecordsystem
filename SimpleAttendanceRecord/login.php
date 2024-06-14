<?php
    require_once 'admin/connect.php';
    
    
    if (isset($_POST['student']) && !empty($_POST['student'])) {
        $student = $_POST['student'];
        $time = date("H:i", strtotime("+8 HOURS"));
        $date = date("Y-m-d", strtotime("+8 HOURS"));
        
        
        $q_student = $conn->query("SELECT * FROM `student` WHERE `student_no` = '$student'") or die(mysqli_error($conn));
        
        if ($q_student->num_rows > 0) {
            $f_student = $q_student->fetch_array();
            $student_name = $f_student['firstname'] . " " . $f_student['lastname'];
            
            
            $stmt = $conn->prepare("INSERT INTO `time` (`student_no`, `student_name`, `time`, `date`) VALUES (?, ?, ?, ?)");
            $stmt->bind_param('ssss', $student, $student_name, $time, $date);
            
            if ($stmt->execute()) {
                echo "<h3 class='text-muted'>{$student_name} <label class='text-info'>at " . date("h:i a", strtotime($time)) . "</label></h3>";
            } else {
                die("Error: " . $stmt->error);
            }
            
            $stmt->close();
        } else {
            echo "Student not found.";
        }
    } else {
        echo "Student number is not provided.";
    }
?>
