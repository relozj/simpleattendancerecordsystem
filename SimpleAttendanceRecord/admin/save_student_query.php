<?php
    require_once 'connect.php';
    if(ISSET($_POST['save'])){
        $student_no = $_POST['student_no'];
        $firstname = $_POST['firstname'];
        $middlename = $_POST['middlename'];
        $lastname = $_POST['lastname'];
        $course = $_POST['course'];
        $section = $_POST['section'];

        // Specify the columns you are inserting into, excluding the auto-incrementing column
        $conn->query("INSERT INTO `student` (`student_no`, `firstname`, `middlename`, `lastname`, `course`, `section`) VALUES ('$student_no', '$firstname', '$middlename', '$lastname', '$course', '$section')") or die($conn->error);
        
        echo '
            <script type = "text/javascript">
                alert("Saved Record");
                window.location = "student.php";
            </script>
        ';
    }
?>
