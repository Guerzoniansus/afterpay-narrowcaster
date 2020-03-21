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

        if ($action == "getOrders") {
            echo $db->getOrders();
        }

        else if ($action == "updateOrders") {
            $db->updateOrder($_POST["newAmount"]);
        }
    }
}




class DB
{
    // Moet voor iedereen telkens naar zijn of haar eigen database aangepast worden
    public $host = "localhost";
    public $databaseName = "afterpay";
    public $username = "root";     //for mamp
    public $password = "klapot";     //for mamp

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
     * @return array of Employee objects
     */
    public function getBirthdayEmployees(): array
    {
        $sql = "SELECT * FROM Employee WHERE birthday = CURDATE() AND birthdayDisplay = 'true' ORDER BY employeeName DESC";

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