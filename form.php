<?php
$server="localhost";
$username="root";
$password="";
$database="student_registration";

$con= mysqli_connect($server,$username,$password,$database);

if(!$con){
    die("connection failed to this Database due to ".
    mysqli_connect_errno());
}

/*  Only run when form is submitted */
if($_SERVER["REQUEST_METHOD"] == "POST"){

    /*  Create uploads folder if not exists */
    if (!is_dir("uploads")) {
        mkdir("uploads", 0777, true);
    }

$rollno     = $_POST['rollno'];
$firstname  = $_POST['firstname'];
$lastname   = $_POST['lastname'];
$fathername = $_POST['fathername'];
$dob        = $_POST['day']."-".$_POST['month']."-".$_POST['year'];
$phone      = $_POST['countrycode'].$_POST['phone'];
$email      = $_POST['email'];
$password   = $_POST['password'];
$gender     = $_POST['gender'];
$department = isset($_POST['department']) ? implode(",", $_POST['department']) : "";
$course     = $_POST['course'];
$city       = $_POST['city'];
$address    = $_POST['address'];

 /* Handle image upload */
    $photo = $_FILES['photo']['name'];
    $tmp   = $_FILES['photo']['tmp_name'];

    move_uploaded_file($tmp, "uploads/".$photo);


$sql = "INSERT INTO  `student_registration`.`student`
(rollno, firstname, lastname, fathername, dob, phone, email, password, gender, department, course, city, address, photo)
VALUES
('$rollno','$firstname','$lastname','$fathername','$dob','$phone','$email','$password','$gender','$department','$course','$city','$address','$photo')";

if(mysqli_query($con,$sql)){
    echo "✅ Registration Successful";
}else{
    echo "❌ Error: ".mysqli_error($con);
}




   

}

?>