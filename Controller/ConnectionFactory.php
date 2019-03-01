<?php

/********************************************************
Connection factory

What?
Manages database connections. Keeps persistent connection
to database for effiecient query speeds.

Why?
Due to slow upstart in establishing a connection with AWS,
keeping a persistent connection with the database rather then
closing the connection after each query will make a consistent
customer experience.

Avg times:
Closing connection after each query: 7s
Attempting to get persistent connection: 200ms - 1000ms

Example use:

try {
    $DBConnect = ConnectionFactory::getFactory()->getConnection();
} catch (Exception $e) {
    echo json_encode("Error in establishing database connection: " . $e);
}


*********************************************************/

class ConnectionFactory
{
    private static $factory;
    private $db;

    /*
      Static contructor method. This method checks if there is a
      valid connection. If yes, pass back connection, if no create a
      new connection. Use to call getConnection()
    */
    public static function getFactory()
    {
        if (!self::$factory) {
            self::$factory = new ConnectionFactory();
            $db = null;
        }
        return self::$factory;
    }

    //Creates the connection with the credentials provided
    public function getConnection()
    {
        if (is_null($this->db)) {
            include("../Controller/librarypass.php");
            $this->db = new mysqli($host, $user, $pass, $DBName);
        }

        if ($this->db->connect_error) {
            throw new Exception(
              "Connect Error ("
              . $this->db->connect_errno
              . ") "
              . $this->db->connect_error
            );
        }
        return $this->db;
    }

    //Close the connection
    public function closeConnection()
    {
        if (! is_null($this->db)) {
            $this->db::close();
            $this->db = null;
        }
    }
}
