
<?php
// Load database credentials
require_once __DIR__ . '/db_cred.php';

class Database
{
    // Protected allows child classes like CustomerClass to access $conn
    protected $conn;

    // Database connection settings
    private $host = SERVER;
    private $dbname = DATABASE;
    private $username = USERNAME;
    private $password = PASSWD;

    // Establish database connection
    public function __construct()
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {

            $this->conn = new mysqli(
                $this->host,
                $this->username,
                $this->password,
                $this->dbname
            );

            // Set character encoding
            $this->conn->set_charset("utf8mb4");

        } catch (mysqli_sql_exception $e) {

            die("Database connection failed: " . $e->getMessage());

        }
    }

    // Get the database connection
    public function getConnection()
    {
        return $this->conn;
    }
}