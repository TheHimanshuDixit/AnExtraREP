<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "anextrarep";

// Create connection
$conn = new mysqli(
    $servername,
    $username,
    $password
);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: "
        . $conn->connect_error);
}

// If database is not exist create one
if (!mysqli_select_db($conn, $dbname)) {
    $sql = "CREATE DATABASE " . $dbname;
    if ($conn->query($sql) === TRUE) {
        echo "";
    } else {
        echo "Error creating database: " . $conn->error;
        echo "<br>";
    }
}

if (isset($_POST['csubmit'])) {
    $email = $_POST['cemail'];

    $sql = "SELECT * FROM registeruser WHERE email = '$email' ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
?>
            <script>
                window.open("<?php echo $row["report"] ?>", "_blank");
                window.location = "index.html"
            </script>
        <?php
        }
    } else {
        ?>
        <script>
            alert("Please Enter valid email")
        </script>
<?php
    }
}

$conn->close();
?>