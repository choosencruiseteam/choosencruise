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
?>

<!-- Print DB Status to hidden field-->
<div id="Database-Status" style="display: none;">
<?php
    if($DBConnect == TRUE)
    {
      $output = "Database is connected";
      echo json_encode($output);
    }
    else
    {
      $output = "Could not connect to Database";
      echo json_encode($output);
    }
?>
</div>
