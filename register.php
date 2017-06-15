<?php



if( isset( $_POST["add"] ) ) {
        
   include('includes/functions.php');
   include('includes/connection.php');
    // set all variables to empty by default
    $username = $email = $password = "";
    
    // check to see if inputs are empty
    // create variables with form data
    // wrap the data with our function
    
    if( !$_POST["username"] ) {
        $nameError = "Please enter a username <br>";
    } else {
        $username = validateFormData( $_POST["username"] );
    }

    if( !$_POST["email"] ) {
        $emailError = "Please enter your email <br>";
    } else {
        $email = validateFormData( $_POST["email"] );
    }

    if( !$_POST["password"] ) {
        $passwordError = "Please enter a password <br>";
    } else {
        $pass = validateFormData( $_POST["password"] );
        $password=password_hash("$pass",PASSWORD_DEFAULT);
    }
    
    // check to see if each variable has data
    if( $username && $email && $password ) {
        $query = "INSERT INTO users (id, name, password, email)
        VALUES (NULL, '$username', '$password', '$email')";

        if( mysqli_query( $conn, $query ) ) {
            echo "<div class='alert alert-success'>New record in database!</div>";
            header('location:index.php');
        } else {
            echo "Error: ". $query . "<br>" . mysqli_error($conn);
        }
    }
    
}

/*
MYSQL INSERT QUERY

INSERT INTO users (id, username, password, email, signup_date, biography)
VALUES (NULL, 'jacksonsmith', 'abc123', 'jack@son.com', CURRENT_TIMESTAMP, 'Hello! I'm Jackson. This is my bio.');

*/

// mysqli_close($conn);
include('includes/header.php');
?>


    
    <body>
        <div class="container">
            <h1>MySQL Insert</h1>

            <p class="text-danger">* Required fields</p>
            
            <form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post">
                <small class="text-danger">* <?php echo isset($nameError) ? $nameError : ''; ?></small>
                <input type="text" placeholder="Username" name="username"><br><br>
                
                <small class="text-danger">* <?php echo isset($emailError) ? $emailError : ''; ?></small>
                <input type="text" placeholder="Email" name="email"><br><br>
                
                <small class="text-danger">* <?php echo isset($passwordError) ? $passwordError : ''; ?></small>
                <input type="password" placeholder="Password" name="password"><br><br>
                
                <input type="submit" name="add" value="Add Entry">
            </form>
            
       
<?php
include('includes/footer.php');
?>