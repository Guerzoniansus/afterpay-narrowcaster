<?php

class Employee {
    public $employeeID;
    public $employeeName;
    public $function;
    public $birthday;
    public $birthdayDisplay;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"])) {
        $db = new DB();
        $action = $_POST["action"];

        switch ($action) {
            case "getOrders":
                echo $db->getOrders();
                break;
            case "updateOrders":
                $db->updateOrder($_POST["newAmount"]);
                break;
            case "updateBirthdayDisplay":
                $db->updateBirthdayDisplay($_POST["employeeID"], $_POST["newValue"]);
                break;
        }
    }
}




class DB
{
    // Moet voor iedereen telkens naar zijn of haar eigen database aangepast worden
    public $host = "localhost";
    public $databaseName = "afterpay";
    public $username = "root";
    public $password = "klapot";

    /**
     * @return string
     */
    private function getConnectionString()
    {
        $dns = "mysql:host=$this->host;dbname=$this->databaseName";
        return $dns;
    }

    /**
     * @return PDO
     */
    private function createConnection()
    {
        $conn = new PDO($this->getConnectionString(), $this->username, $this->password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $conn;
    }

    /**
     * Change "birthdayDisplay" for employee with employeeID to a new value (true or false)
     * @param int $employeeID
     * @param string $newValue
     * @return bool if operation went successful or not
     */
    public function updateBirthdayDisplay(int $employeeID, string $newValue) {
        $sqlEdit = "UPDATE Employee SET birthdayDisplay = :newValue WHERE employeeID = :employeeID";

        $stmtEdit = $conn = $this->createConnection()->prepare($sqlEdit);

        $stmtEdit->bindValue(":newValue", $newValue, PDO::PARAM_STR);
        $stmtEdit->bindValue(":employeeID", $employeeID, PDO::PARAM_INT);

        $result = false;
        if ($stmtEdit->execute()) {
            $result = true;
        }

        $conn = null;
        return $result;
    }

    /**
     * @return array with ALL employees as Employee objects, sorted by employeeID, ascending
     */
    public function getAllEmployees(): array
    {
        $sql = "SELECT * FROM Employee ORDER BY employeeID ASC";

        $conn = $this->createConnection();
        $stmtSelect = $conn->prepare($sql);
        $stmtSelect->execute();

        $rows = $stmtSelect->fetchAll(PDO::FETCH_CLASS, "Employee");

        $conn = null;
        return $rows;
    }

    /**
     * @return array of Employee objects
     */
    public function getBirthdayEmployees(): array
    {
        $sql = "SELECT * FROM Employee WHERE DATE_FORMAT(birthday, '%m-%d') = DATE_FORMAT(CURRENT_DATE(), '%m-%d') AND birthdayDisplay = 'true' ORDER BY employeeName DESC";
      
        $conn = $this->createConnection();
        $stmtSelect = $conn->prepare($sql);
        $stmtSelect->execute();

        $rows = $stmtSelect->fetchAll(PDO::FETCH_CLASS, "Employee");

        $conn = null;
        return $rows;
    }


    /**
     * @return int order amount, returns -1 if something wentwrong
     */
    public function getOrders(): int
    {
        $sqlEdit = "SELECT amount FROM Orders WHERE ID = 1";
        $result = -1;

        $conn = $this->createConnection();
        $stmtEdit = $conn->prepare($sqlEdit);

        if ($stmtEdit->execute()) {
            $result = $stmtEdit->fetch()['amount'];

        }

        $conn = null;
        return $result;
    }

    /**
     * @param int $newAmount
     * @return bool if the update went successful or not
     */
    public function updateOrder(int $newAmount)
    {
        $sqlEdit = "UPDATE Orders SET amount = :newAmount WHERE ID = 1";

        $stmtEdit = $conn = $this->createConnection()->prepare($sqlEdit);

        $stmtEdit->bindValue(":newAmount", $newAmount, PDO::PARAM_INT);

        $result = false;
        if ($stmtEdit->execute() && $stmtEdit->rowCount() == 1) {
            $result = true;
        }

        $conn = null;
        return $result;
    }


}