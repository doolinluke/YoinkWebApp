<?php

class DealTableGateway {

    private $connection;

    public function __construct($c) {
        $this->connection = $c;
    }

    public function getDeals() {
        // execute a query to get all managers
        $sqlQuery = "SELECT * FROM Deal";

        $statement = $this->connection->prepare($sqlQuery);
        $status = $statement->execute();

        if (!$status) {
            die("Could not retrieve deals");
        }

        return $statement;
    }
    
    /*public function getDeals($sortOrder) {
        // execute a query to get all patients
        $sqlQuery = "SELECT p.*, w.dealName AS dealName
                    FROM patient p
                    LEFT JOIN deal w ON w.dealID = p.dealID
                    ORDER BY " . $sortOrder;

        $statement = $this->connection->prepare($sqlQuery);
        
        $status = $statement->execute($params);

        if (!$status) {
            die("Could not retrieve patients");
        }

        return $statement;
    }*/

    public function getDealById($dealId) {
        // execute a query to get the manager with the specified id
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

    public function insertDeal($dD, $dC, $bId) {
        // execute a query to insert values into the deal table
        $sqlQuery = "INSERT INTO deal " .
                "(deal_description, deal_category, businessID) " .
                "VALUES (:deal_description, :deal_category, :businessID)";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "deal_description" => $dD,
            "deal_category" => $dC,
            "businessID" => $bId
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
        $sqlQuery = "DELETE FROM deal WHERE dealID = :dealID";

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

    public function updateDeal($dId, $dD, $dC, $bId, $bN) {
        // execute a query to update deal
        $sqlQuery = "UPDATE deal SET " .
                "deal_description = :deal_description, " .
                "deal_category = :deal_category, " .
                "businessId = :businessId, " .
                "business_name = :business_name " .
                "WHERE dealID = :dealID";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "dealId" => $dealId,
            "deal_description" => $dD,
            "deal_category" => $dC,
            "businessId" => $bId,
            "business_name" => $bN
        );

        $status = $statement->execute($params);
        
        if (!$status) {
            die("Could not update deal");
        }

        return ($statement->rowCount() == 1);
    }

}
