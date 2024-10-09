<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html"); // Redirect to login if not logged in
    exit();
}
?>
<?php
session_start();
$host = 'localhost';
$db = 'login_system';
$user = 'root'; // Change to your database username
$pass = 'Gopichand@579';     // Change to your database password

// Connect to MySQL
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    
    // Check if the username and password match
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username; // Set session
        header("Location: index.html"); // Redirect to your main page
        exit();
    } else {
        echo "Invalid username or password.";
    }
}
?>

