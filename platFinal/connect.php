<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $gender = $_POST["gender"];
    $address = $_POST["address"];
    $studentID = $_POST["studentID"];
    $course = $_POST["course"];
    $section = $_POST["section"];
    $feeler = $_POST["feeler"];

    // Connect to database
    $conn = new mysqli('localhost', 'root', '', 'online_application');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("
        INSERT INTO studentuser
        (first_name, last_name, email, gender, address, studentID, course, section, feeler)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    if (!$stmt) {
        die("SQL Prepare Error: " . $conn->error);
    }

    // s = string, i = integer
    $stmt->bind_param("sssssisss",
        $first_name,
        $last_name,
        $email,
        $gender,
        $address,
        $studentID,  // integer
        $course,
        $section,
        $feeler
    );

    if (!$stmt->execute()) {
        die("SQL Execute Error: " . $stmt->error);
    }

    echo "<h2>Application Successful!</h2>";

    $stmt->close();
    $conn->close();
}
?>
