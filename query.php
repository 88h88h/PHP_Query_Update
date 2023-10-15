<?php
// Connect to your MySQL database
$host = "localhost"; // Change to your database host
$username = "root"; // Change to your database username
$password = ""; // Change to your database password
$database = ""; // Change to your database name

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve user input from the form
$searchBy = isset($_POST['searchBy']) ? $_POST['searchBy'] : "";
$query = isset($_POST['query']) ? $_POST['query'] : "";

// Create the SQL query based on the selected option
if ($searchBy === 'name') {
    $sql = "SELECT * FROM voter_list WHERE name_address LIKE '%$query%'";
} elseif ($searchBy === 'email') {
    $sql = "SELECT * FROM voter_list WHERE email LIKE '%$query%'";
} elseif ($searchBy === 'mobile') {
    $sql = "SELECT * FROM voter_list WHERE mobile_number LIKE '%$query%'";
} else {
    die("Invalid search option.");
}

// Execute the query
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Database Query Results</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1>Search Results</h1>
        <?php if (mysqli_num_rows($result) > 0) { ?>
            <table class="table table-bordered">
                <thead class="bg-success text-white">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['name_address'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['mobile'] . "</td>";
                        echo "<td><a href='edit.php?id=" . $row['email'] . "' class='btn btn-success btn-sm'>Edit</a></td>"; // Replace 'id' with your actual identifier column name
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        <?php } else {
            echo "No results found.";
        } ?>
    </div>

    <!-- Add Bootstrap JS and jQuery scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<?php
// Close the database connection
mysqli_close($conn);
?>