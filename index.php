<!DOCTYPE html>
<html>

<head>
    <title>Database Query</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1>Query the Database</h1>
        <form method="POST" action="query.php">
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="searchBy" id="searchByName" value="name">
                    <label class="form-check-label" for="searchByName">Query by Name</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="searchBy" id="searchByEmail" value="email">
                    <label class="form-check-label" for="searchByEmail">Query by Email</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="searchBy" id="searchByMobile" value="mobile">
                    <label class="form-check-label" for="searchByMobile">Query by Mobile Number</label>
                </div>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="query" placeholder="Enter your query">
            </div>
            <button type="submit" class="btn btn-success">Search</button>
        </form>
    </div>

    <!-- Add Bootstrap JS and jQuery scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>