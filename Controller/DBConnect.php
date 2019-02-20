<?php

  $user = "root";
	$pass = "";
	$host = "localhost";
	$DBName = "choosencruise";

	$DBConnect = mysqli_connect($host, $user, $pass);

	if ($DBConnect === FALSE)
		echo "<p>Connection error: " . mysqli_error() . "</p>\n";
	else
	{
		if (mysqli_select_db($DBConnect,$DBName) === FALSE)
		{
			echo "<p>Could not select the \"$DBName\" " .
				"database: " . mysqli_error($DBConnect) .
				"</p>\n";
			mysqli_close($DBConnect);
			$DBConnect = FALSE;
		}
	}

    $output = "";

    if($DBConnect == TRUE)
    {
      $output = "Database is connected";
    }
    else
    {
      $output = "Could not connect to Database";
    }

    echo "<script>alert(".json_encode($output).")</script>";

?>
