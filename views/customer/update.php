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


































<?php
// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php_project";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Replace 'your_user_id' with the actual user ID
$user_id = 8; // Replace with the actual user ID

// Fetch posts for the specified user
$sql = "SELECT * FROM order_detailes WHERE order_code = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Display posts
    ?><table class="table table-striped table-sm table-bordered">
    <thead>
        <tr class="text-center">
            <th>ID</th>
            <th>Order Code</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>quantity</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody><?
    while ($row = $result->fetch_assoc()) {
        // echo "Post ID: " . $row["id"] . "<br>";
        // echo "Title: " . $row["order_code"] . "<br>";
        // echo "Content: " . $row["price"] . "<br>";
        // // Add other post details as needed
        // echo "<hr>";
        ?>
        <tr>
           <td>' . $row["id"] . '</td>
           <td>' . . $row["order_code"] . '</td>
           <td>' . . $row["price"] . '</td>
        </tr><?
    }
    ?>
    </tbody>
      </table><?
} else {
    echo "No orders found for this customer.";
}

// Close the connection
$conn->close();
?>














<?php
class Database
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "php_project";
    private $conn;

    // Constructor to establish the database connection
    public function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Fetch orders for a specified user
    public function getOrders($user_id)
    {
        $user_id = $this->conn->real_escape_string($user_id); // Sanitize input

        $sql = "SELECT * FROM order_detailes WHERE order_code = '$user_id'";
        $result = $this->conn->query($sql);

        return $result;
    }

    // Close the database connection
    public function closeConnection()
    {
        $this->conn->close();
    }
}

// Instantiate the Database class
$database = new Database();

// Replace 'your_user_id' with the actual user ID
$user_id = 8; // Replace with the actual user ID

// Fetch orders for the specified user
$result = $database->getOrders($user_id);

if ($result->num_rows > 0) {
    // Display orders
    ?>
    <table class="table table-striped table-sm table-bordered">
        <thead>
            <tr class="text-center">
                <th>ID</th>
                <th>Order Code</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["order_code"] . "</td>";
                echo "<td>" . $row["product_name"] . "</td>"; // Adjust column names
                echo "<td>" . $row["price"] . "</td>";
                echo "<td>" . $row["quantity"] . "</td>"; // Adjust column names
                echo "<td>Action</td>"; // Replace with the appropriate action column content
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <?php
} else {
    echo "No orders found for this customer.";
}

// Close the database connection
$database->closeConnection();
?>
