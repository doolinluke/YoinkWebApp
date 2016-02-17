<?php

class DealTableGateway {

    private $connection;

    public function __construct($c) {
        $this->connection = $c;
    }

    public function getDeals() {
        // execute a query to get all deals
        $sqlQuery = "SELECT * FROM Deal";

        $statement = $this->connection->prepare($sqlQuery);
        $status = $statement->execute();

        if (!$status) {
            die("Could not retrieve deals");
        }

        return $statement;
    }

    public function getDealById($dealId) {
        // execute a query to get the deal with the specified id
        $sqlQuery = "SELECT * FROM deal WHERE dealId = :dealId";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "dealId" => $dealId
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not retrieve deal");
        }

        return $statement;
    }

    public function getDealAndBusiness($dealID) {
        // execute a query to get all deal details plus the business name associated to that deal
        $sqlQuery = "SELECT d.deal_description, d.deal_category, b.business_name AS Business
                    FROM business b 
                    LEFT JOIN deal d ON d.businessId = b.businessID 
                    WHERE d.dealId = :dealID";

        $params = array(
            "dealID" => $dealID
        );
        $statement = $this->connection->prepare($sqlQuery);
        $status = $statement->execute($params);

        if (!$status) {
            die("Could not retrieve Deal");
        }

        return $statement;
    }

    public function insertDeal($dD, $dC, $bId, $uId) {
        // execute a query to insert values into the deal table
        $sqlQuery = "INSERT INTO deal " .
                "(deal_description, deal_category, businessID, userId) " .
                "VALUES (:deal_description, :deal_category, :businessId, :userId)";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "deal_description" => $dD,
            "deal_category" => $dC,
            "businessId" => $bId,
            "userId" => $uId
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not insert deal");
        }

        $id = $this->connection->lastInsertId();

        return $id;
    }

    public function deleteDeal($dealId) {
        // execute a query to delete row from deal where dealId = value entered
        $sqlQuery = "DELETE FROM deal WHERE dealId = :dealId";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "dealId" => $dealId
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not delete deal");
        }

        return ($statement->rowCount() == 1);
    }

    public function updateDeal($dId, $dD, $dC, $bId) {
        // execute a query to update deal
        $sqlQuery = "UPDATE deal SET " .
                "deal_description = :deal_description, " .
                "deal_category = :deal_category, " .
                "businessId = :businessId " .
                " WHERE dealId = :dealId";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "dealId" => $dId,
            "deal_description" => $dD,
            "deal_category" => $dC,
            "businessId" => $bId
        );

        echo '<pre>';
        print_r($params);
        print_r($statement);
        echo '</pre>';

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not update deal");
        }

        return ($statement->rowCount() == 1);
    }

    public function getDealByUserId($uId) {
        // execute a query to get all deals assigned to a specific user
        $sqlQuery = "SELECT d.*, u.username AS username, b.business_name 
                FROM Deal d 
                LEFT JOIN users u ON u.id = d.userId 
                LEFT JOIN business b ON d.businessId = b.businessID 
                WHERE u.id = :id";

        $params = array(
            "id" => $uId
        );
        $statement = $this->connection->prepare($sqlQuery);
        $status = $statement->execute($params);

        if (!$status) {
            die("Could not retrieve Deal");
        }

        return $statement;
    }

    public function getDealByBusinessId($bId) {
        // execute a query to get all deals assigned to a specific business by using a join where businessId in businesss = businessId in deal
        $sqlQuery = "SELECT d.*, u.username AS username, b.business_name 
                FROM Deal d 
                LEFT JOIN users u ON u.id = d.userId 
                LEFT JOIN business b ON d.businessId = b.businessID 
                WHERE b.businessID = :businessID";

        $params = array(
            "businessID" => $bId
        );
        $statement = $this->connection->prepare($sqlQuery);
        $status = $statement->execute($params);

        if (!$status) {
            die("Could not retrieve Deal");
        }

        return $statement;
    }

}
