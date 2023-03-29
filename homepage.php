<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hotel Database Title Page</title>
        <link rel="stylesheet" href="TitleStyle.css">        
    </head>
    <body>
        <div class="inTheBack">
            <nav>
                <img src="Images/TranspLogo.png" class="logo">
                <ul>
                    <li><a href="">About Us</a></li>
                    <li><a href="">Employee Registration</a></li>
                    <li><a href="#" onclick="document.getElementById('id01').style.display='block'">Sign Up</a></li>
                </ul>
                <button class="booking2">Book A Visit</button>

            </nav>
            <div class="container">
                <div class="Advertisement">
                    <img src="Images/TitleImage.png" class="ad">
                </div>
                <div class="text-container">    
                    <h1>Your One Stop Shop For Booking a Hotel</h1>
                    <p>We have contracts with five major hotel chains to give
                        you the best deals and the best rooms. Login above to 
                        begin booking.</p>
                    <div class="btn">
                        <button onclick=" booking()">Book Now</button>
                            <script>
                                function booking(){
                                    window.open("index.html");
                                }
                            </script>
                    </div>
                </div>
            </div>
        </div>
        <div id="id01" class="modal">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">X</span>
            <form class="modal-content" action="/action_page.php">
              <div class="containment">
                <h1>Sign Up</h1>
                <p>Please fill in this form to create an account.</p>
                <hr>
                <label for="email"><b>Username</b></label>
                <input type="text" placeholder="Enter a Username" name="email" required>
          
                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" required>
          
                <label for="psw-repeat"><b>Repeat Password</b></label>
                <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
          
                <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>
          
                <div class="clearfix">
                  <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                  <button type="submit" onclick="class="signup">Sign Up</button>
                </div>
              </div>
            </form>
          </div>
        <div>
            <script>
                // Get the modal
                var modal = document.getElementById('id01');
                
                // When the user clicks anywhere outside of the modal, close it
                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }
            </script> 
        </div>
        <?php

        // Replace these values with your actual PostgreSQL server details
        $host = "localhost";
        $port = "5432";
        $dbname = "logindb";
        $user = "postgres";
        $password = "eli";
        
        // Connect to the PostgreSQL database
        $conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
        
        // Check if the connection was successful
        if (!$conn) {
            die("Connection failed: " . pg_last_error());
        }
        
        // Check if the user submitted the registration form
        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
            // Sanitize the user input to prevent SQL injection attacks
            $username = pg_escape_string($_POST['username']);
            $password = pg_escape_string($_POST['password']);
            $confirm_password = pg_escape_string($_POST['confirm_password']);
        
            // Check if the password and confirm password fields match
            if ($password != $confirm_password) {
                die("Passwords do not match");
            }
        
            // Hash the user's password for security
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
            // Insert the user's registration information into the database
            $result = pg_query($conn, "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')");
        
            // Check if the query was successful
            if (!$result) {
                die("Query failed: " . pg_last_error());
            }
        
            // Start a new session for the user
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['loggedin'] = true;
        
            // Redirect the user to the home page
            header("Location: homepage.php");
            exit;
        }
        
        // Close the database connection
        pg_close($conn);
        
        ?>
    </body>
</html>