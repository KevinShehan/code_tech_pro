
    <?php
    include('Pages/Header.php');
    include('Top_nav.php');
    include('Side_nav.php');
    ?>
    <!-- offcanvas -->
    <main class="mt-5 pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <span><i class="bi bi-table me-2"></i></span> Employess
                        </div>
                        <div class="card-body">

                        <caption>
        <h2>Users</h2>
    </caption>
    <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New User</a>
    <table class="table">

        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Username</th>
                <th scope="col">Password</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>
                    <img src="eye-fill.svg" alt="" srcset="">
                    <img src="pencil-square.svg" alt="" srcset="">
                    <img src="trash3.svg" alt="" srcset="">
                </td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td> <img src="eye-fill.svg" alt="" srcset="">
                    <img src="pencil-square.svg" alt="" srcset="">
                    <img src="trash3.svg" alt="" srcset="">
                </td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td> <img src="eye-fill.svg" alt="" srcset="">
                    <img src="pencil-square.svg" alt="" srcset="">
                    <img src="trash3.svg" alt="" srcset="">
                </td>
            </tr>
        </tbody>
    </table>

                            <div class="form-group row">
                                <div class="col-sm-5 offset-sm-2">
                                    <button type="submit" class="btn btn-primary" onclick="generatePassword()">Update Details</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php
    include('Pages/Footer.php');

    ?>


    <?php
    // Database configuration
    $host = 'localhost';
    $dbName = 'v1';
    $user = 'root';
    $password = '1234';

    // Create a new MySQLi instance
    $con = new mysqli($host, $user, $password, $dbName);

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Retrieve data from the database
    $query = "SELECT * FROM v1.user";
    $result = mysqli_query($con, $query);


    // Check if any records were found
    if (mysqli_num_rows($result) > 0) {
        // Start the HTML table
        echo "<table>";
        echo "<tr><th>id</th> <th>Username</th> <th>Password</th></tr>";

        // Fetch and display each row of data
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['column1'] . "</td>";
            echo "<td>" . $row['column2'] . "</td>";
            echo "<td>" . $row['column3'] . "</td>";
            echo "</tr>";
        }

        // End the HTML table
        echo "</table>";
    } else {
        echo "No records found.";
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>