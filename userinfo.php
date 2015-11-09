<?php

//load and connect to MySQL database stuff
require("config.inc.php");

if (!empty($_POST)) {
	//initial query
	$query = "INSERT INTO userinfo ( user_id, first_name, last_name, expertise, birthdate, age, email, username ) VALUES ( :userid, :fname, :lname, :expertise, :birthdate, :age, :email, :username ) ";

    //Update query
    $query_params = array(
        ':userid' => $_POST['userid'],
        ':fname' => $_POST['firstname'],
				':lname' => $_POST['lastname'],
				':expertise' => $_POST['expertise'],
        ':birthdate' => $_POST['birthdate'],
				':age' => $_POST['age'],
				':email' => $_POST['email'],
        ':username' => $_POST['username']

    );

	//execute query
    try {
        $stmt   = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch (PDOException $ex) {
        // For testing, you could use a die and message.
        //die("Failed to run query: " . $ex->getMessage());

        //or just use this use this one:
        $response["success"] = 0;
        $response["message"] = "Database Error. Couldn't add post!";
        die(json_encode($response));
    }

    $response["success"] = 1;
    $response["message"] = "Username Successfully Added!";
    echo json_encode($response);

} else {
?>
		<h1>Add Comment</h1>
		<form action="userinfo.php" method="post">
		    User ID:<br />
		    <input type="number" name="userid" placeholder="user id" />
		    <br /><br />
		    First Name:<br />
		    <input type="text" name="firstname" placeholder="first name" />
		    <br /><br />
				Last Name:<br />
		    <input type="text" name="lastname" placeholder="last name" />
		    <br /><br />
				Expertise:<br />
		    <input type="number" name="expertise" placeholder="expertise level" />
		    <br /><br />
		    Birthdate:<br />
		    <input type="date" name="birthdate" placeholder="birthdate" />
		    <br /><br />
				Age:<br />
		    <input type="number" name="age" placeholder="age" />
		    <br /><br />
				Email:<br />
		    <input type="text" name="email" placeholder="email" />
		    <br /><br />
		    User Name:<br />
		    <input type="text" name="username" placeholder="username" />
		    <br /><br />
				<input type="submit" value="Add User Info" />
		</form>
	<?php
}

?>
