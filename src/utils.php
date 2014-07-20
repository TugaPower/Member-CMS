<?php
    $db_host = "localhost";
    $db_username = "root";
    $db_password = "biscoitos123";
    $db_database = "tugapower";
    $db_con = NULL; // Used to store temporary connections

    /**
     * Starts a new connection with the database server.
     * If there is already an open connection, return it instead.
     *
     * @return mysqli   The database connection
     */
    function startDBConnection() {
        global $db_con, $db_host, $db_username, $db_password, $db_database;
        if($db_con == NULL) {
            $db_con = mysqli_connect($db_host, $db_username, $db_password, $db_database);
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: ". mysqli_connect_error();
                return NULL;
            }
            if($db_con != null) mysqli_query($db_con, "SET NAMES 'utf8'");
        }
        return $db_con;
    }

    function closeDBConnection() {
        global $db_con;
        if($db_con != NULL) mysqli_close($db_con);
    }