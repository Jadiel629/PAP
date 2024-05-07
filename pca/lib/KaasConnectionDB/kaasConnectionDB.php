<?php
/*
    Author: Caascii Africano
    Copyrigh: 2023 - onionbuisness
    Version: 1.0.0
    Facebook: Carlos Avelino  (Кааскии Африкано) 
    Created at: 31/12/2023
    Updated at: 01/01/2024 - 02:42
*/

// Setting datatypes strict declaraction
declare(strict_types=1);

// Class
// --------------------------------------------------------------------------------------------------------------
class KaasConnectionDB
{

    // Class Propierties, all useful below
    // --------------------------------------------------------------------------------------------------------------
    private string $conn = "mysql:host=".MYSQL_HOST.";dbname=".MYSQL_DBNAME.";charset=".MYSQL_CHAR.";";
    private $cmd = null;

    // Magic method of class to build connection with the database
    public function __construct()
    {

        // Checking if all drivers are avaiable
        if (!$this->check_mysql_drivers()) {
            echo '<script>console.log("[ERROR] »» Cannot connect with MySQL, Verify if all useful pdo extensions are available and try again")</script>';
            exit(1);
        } else {

            // Execute connection if all settings are okay
            $this->cmd = new PDO(
                $this->conn,
                MYSQL_USER,
                MYSQL_PASS,
                array(PDO::ATTR_PERSISTENT)
            );
        }
    }

    // Class Method for database settings, all below
    // --------------------------------------------------------------------------------------------------------------

    // Method who checks if all useful drivers are available
    private function check_mysql_drivers(): bool
    {

        // Get all available extensions
        $extensions = get_loaded_extensions();

        // Checking if "PDO" and "pdo_mysql" are available
        if (!in_array("PDO", $extensions) and !in_array("pdo_mysql", $extensions))
            return false;

        return true;
    }

    // Method to check if exists data on the table
    private function is_table_null(string $sql_statemant): bool
    {

        $stack = [];

        // Check whether there is data or not to update or delete rows.
        if (preg_match("/^UPDATE\b/i", $sql_statemant)) {

            // UPDATE
            $stack = explode(" ", $sql_statemant);
            $table_name = $stack[1];
        } elseif (preg_match("/^DELETE FROM\b/i", $sql_statemant)) {

            // DELETE
            $stack = explode(" ", $sql_statemant);
            $table_name = $stack[2];
        }


        // Fetch all data on the database
        $stmt = $this->cmd->query("SELECT * FROM {$table_name};");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        #print_r($result); die("testando metodo checkkk"); 

        // Check if data fetched is greater than 0.
        if (count($result) <= 0)
            return true;


        return false;
    }

    // Generic methods for querying the database, all below
    // --------------------------------------------------------------------------------------------------------------
    // Generic query methods
    public function select(string $sql, array $data = [])
    {
        $result = null;

        // Check if the SELECT statement is written correctly
        if (!preg_match('/^SELECT\b/i', $sql)) {
            echo '<script>console.log("You have problems with the syntax of SELECT Statements")</script>';
            exit(2);
        }

        // Check whether was passed the second param or not
        if (array_count_values($data) == null) {

            // Make query withouth params 
            $stmt = $this->cmd->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {

            // Make query with the params
            $stmt = $this->cmd->prepare($sql);
            $stmt->execute($data);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
           
        }


        #echo "<pre>";
        #print_r($result); die("testando select");
        return $result;
    }

    // Generic query method to insert data
    public function insert(string $sql, array $data = [])
    {

        // Check if the INSERT statement is written correctly
        if (!preg_match('/^INSERT INTO\b/i', $sql)) {
            echo '<script>console.log("You have problems with the syntax of INSERT INTO Statements")</script>';
            exit(2);
        }

        // Check whether was passed the second param or not
        if (array_count_values($data) == null) {

            // Make query withouth params 
            $stmt = $this->cmd->prepare($sql);
            $stmt->execute();
        } else {

            // Make query with the params
            $stmt = $this->cmd->prepare($sql);
            $stmt->execute($data);
        }
    }

    // Generic query method to update data
    public function update(string $sql, array $data = [])
    {

        // Check if the UPDATE statement is written correctly
        if (!preg_match('/^UPDATE\b/i', $sql)) {
            echo '<script>console.log("You have problems with the syntax of UPDATE Statements")</script>';
            exit(2);
        }

        // Check if the table is null
        if ($this->is_table_null($sql)) {
            echo '<script>window.alert("No records were found in the table");</script>';
            exit(3);
        }

        // Check whether was passed the second param or not
        if (array_count_values($data) == null) {

            // Make query withouth params 
            $stmt = $this->cmd->prepare($sql);
            $stmt->execute();
        } else {

            // Make query with the params
            $stmt = $this->cmd->prepare($sql);
            $stmt->execute($data);
        }
    }

    // Generic query method to delete data
    public function delete(string $sql, array $data = [])
    {

        // Check if the DELETE statement is written correctly
        if (!preg_match('/^DELETE FROM\b/i', $sql)) {
            echo '<script>console.log("You have problems with the syntax of DELETE FROM Statements")</script>';
            exit(2);
        }

        // Check if the table is null
        if ($this->is_table_null($sql)) {
            echo '<script>window.alert("No records were found in the table");</script>';
            exit(3);
        }

        // Check whether was passed the second param or not
        if (array_count_values($data) == null) {

            // Make query withouth params 
            $stmt = $this->cmd->prepare($sql);
            $stmt->execute();
        } else {

            // Make query with the params
            $stmt = $this->cmd->prepare($sql);
            $stmt->execute($data);
        }
    }
}
