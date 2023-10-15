<?php
// Connect to your MySQL database (same as in your previous code)
$host = "localhost"; // Change to your database host
$username = "root"; // Change to your database username
$password = "nomoregames123"; // Change to your database password
$database = "voters_schema"; // Change to your database name

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the email parameter is provided in the URL

if (isset($_GET['id'])) {
    $email = $_GET['id']; // Change from $id to $email

    // Check if the form is submitted for updating the record
    if (isset($_POST['update'])) {
        $newName = $_POST['newName'];
        $newEmail = $_POST['newEmail'];
        $newMobile = $_POST['newMobile'];

        if ($_FILES['pdfFile']['error'] === UPLOAD_ERR_OK) {
            $pdfFileName = $_FILES['pdfFile']['name'];
            $pdfTmpName = $_FILES['pdfFile']['tmp_name'];
            $pdfUploadDir = 'assets/proofs/' . $newEmail . ".pdf";

            // Move the uploaded file to the specified directory
            if (move_uploaded_file($pdfTmpName, $pdfUploadDir)) {
                echo "PDF file uploaded successfully!";
            } else {
                echo "Error uploading PDF file.";
            }
        }
        // Update the record in the database
        $updateQuery = "UPDATE voter_list SET name_address='$newName', email='$newEmail', mobile='$newMobile' WHERE email='$email'"; // Change from id to email
        if (mysqli_query($conn, $updateQuery)) {
            // Record updated successfully, redirect to query.php
            echo "<script>alert('Record updated successfully.');</script>";
            header("Location: index.php");
            exit; // Ensure script execution stops after the redirection
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }

    // Retrieve the current record for editing
    $selectQuery = "SELECT * FROM voter_list WHERE email='$email'"; // Change from id to email
    $result = mysqli_query($conn, $selectQuery);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $currentName = $row['name_address'];
        $currentEmail = $row['email'];
        $currentMobile = $row['mobile'];
    } else {
        echo "Record not found.";
    }
} else {
    echo "Invalid request.";
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Record</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1>Edit Record</h1>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="newName">Name:</label>
                <input type="text" class="form-control" name="newName" value="<?php echo $currentName; ?>">
            </div>

            <div class="form-group">
                <label for="newEmail">Email:</label>
                <input type="email" class="form-control" name="newEmail" value="<?php echo $currentEmail; ?>">
            </div>

            <div class="form-group">
                <label for="newMobile">Mobile Number:</label>
                <input type="text" class="form-control" name="newMobile" value="<?php echo $currentMobile; ?>">
            </div>

            <div class="form-group">
                <label for="pdfFile">Upload PDF Identity Proof:</label>
                <input type="file" class="form-control-file" name="pdfFile" id="pdfFile">
            </div>

            <button type="submit" class="btn btn-success" name="update">Update</button>
        </form>
    </div>

    <!-- Add Bootstrap JS and jQuery scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>