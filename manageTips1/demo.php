<?php
// Assuming you have established a database connection
// $conn is the variable representing the database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_mindloop";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the selected checkboxes
    $selectedCheckboxes = $_POST['checkboxes'];

    // Prepare the SQL statement
    // $sql = "INSERT INTO your_table (checkbox_values) VALUES (?)";
    $sql = "INSERT INTO your_table (checkboxes) VALUES (?)";


    // Prepare the statement
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Combine the selected checkbox values into a comma-separated string
        $checkboxValues = implode(",", $selectedCheckboxes);

        // Bind the combined values as a single parameter and execute the statement
        mysqli_stmt_bind_param($stmt, "s", $checkboxValues);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            // Close the statement
            mysqli_stmt_close($stmt);

            // Close the database connection
            mysqli_close($conn);

            // Redirect to a success page or display a success message
            echo "Checkboxes inserted successfully!";
        } else {
            echo "Error executing the statement: " . mysqli_error($conn);
        }
    } else {
        echo "Error preparing the statement: " . mysqli_error($conn);
    }
}
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <h1>Hello, world!</h1>
    <form method="post" action="">
    <div class="form-group">
        <label for="checkboxes"><b>Select Options</b></label><br>
        <?php
        // Assuming you have an array of options
        $options = array(
            'Science',
            'Mathematics',
            'Physics',
            'Chemestry',
            'Englsih'
        );
        ?>
        <div class="form-check">
            <?php
            foreach ($options as $option) {
                ?>
                <label class="form-check-label mr-3">
                    <input class="form-check-input" type="checkbox" name="checkboxes[]" value="<?php echo $option; ?>" id="<?php echo $option; ?>">
                    <?php echo $option; ?>
                </label>
                <?php
            }
            ?>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>