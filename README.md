https://www.youtube.com/watch?v=mWYCkGuu1d8&list=PLRheCL1cXHrsh6xqxCnmoMlx5PxNuGs1v&index=18


https://www.youtube.com/watch?v=oQ7tc_VevbQ&t=2405s


https://www.youtube.com/watch?v=oQ7tc_VevbQ&t=2405s



https://www.youtube.com/watch?v=QbgniqkXkHo



https://www.youtube.com/watch?v=uNZJ3dvKwXE






<?php
// Assuming you have a database connection established
$servername = "your_server_name";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Replace 'your_user_id' with the actual user ID
$user_id = 1; // Replace with the actual user ID

// Fetch posts for the specified user
$sql = "SELECT * FROM posts WHERE user_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Display posts
    while ($row = $result->fetch_assoc()) {
        echo "Post ID: " . $row["post_id"] . "<br>";
        echo "Title: " . $row["title"] . "<br>";
        echo "Content: " . $row["content"] . "<br>";
        // Add other post details as needed
        echo "<hr>";
    }
} else {
    echo "No posts found for the user.";
}

// Close the connection
$conn->close();
?>


