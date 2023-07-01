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

// // sql to create table
// $sql = "CREATE TABLE registeruser (
//     id INT(11) AUTO_INCREMENT PRIMARY KEY,
//     fullname VARCHAR(30) NOT NULL,
//     age INT(10) NOT NULL,
//     weights INT(10) NOT NULL,
//     email VARCHAR(50) NOT NULL,
//     )";

// if ($conn->query($sql) === TRUE) {
// 	echo "Table MyGuests created successfully";
// } else {
// 	echo "Error creating table: " . $conn->error;
// }

if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$age = $_POST['age'];
	$weight = $_POST['weight'];
	$email = $_POST['email'];
	$file = $_FILES['file'];
	$pdffilename = $file['name'];
	$pdftempfilename = $file['tmp_name'];
	$pdfname_seperate = explode('.', $pdffilename);
	$file_ext = strtolower(end($pdfname_seperate));
	$extensions = array("pdf");
	if (in_array($file_ext, $extensions) === false) {
?>
		<script>
			alert('Extension not allowed, please choose a PDF file.');
			window.location = 'index.html';
		</script>
		<?php
	} else {
		$filepath = 'uploads/' . $pdffilename;
		move_uploaded_file($pdftempfilename, $filepath);
		$sql = "INSERT INTO registeruser (fullname, age, weights, email, report)
		VALUES ('$name', '$age', '$weight', '$email', '$filepath')";
		if ($conn->query($sql) === TRUE) {
		?>
			<script>
				alert('Registration Successful');
				window.location = 'index.html';
			</script>
		<?php
		} else {
		?>
			<script>
				alert('Registration Failed');
				window.location = 'index.html';
			</script>
<?php
		}
	}
}

$conn->close();
?>