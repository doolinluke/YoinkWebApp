<?php

class BusinessTableGateway {

    private $connection;

    public function __construct($c) {
        $this->connection = $c;
    }

    /* public function getBusinesses($sortOrder, $filterName) {
      // execute a query to get all businesss and sort by first name and to display the ward name instead of wardId by using a join where wardId in businesss = wardId in ward
      $sqlQuery = "SELECT b.*, d.deal_description AS deal_description
      FROM business b
      LEFT JOIN Deal d ON d.dealID = b.dealID " .
      (($filterName == NULL) ? "" : "WHERE b.business_name LIKE :filterName") .
      " ORDER BY " . $sortOrder;

      $statement = $this->connection->prepare($sqlQuery);
      if($filterName != NULL) {
      $params = array(
      "filterName" => "%" . $filterName . "%"
      );
      $status = $statement->execute($params);
      }
      else {
      $status = $statement->execute();
      }

      if (!$status) {
      die("Could not retrieve businesses");
      }

      return $statement;
      } */

    /* public function getBusinesses($sortOrder, $filterName) {
      // execute a query to get all businesss and sort by first name and to display the ward name instead of wardId by using a join where wardId in businesss = wardId in ward
      $sqlQuery = "SELECT * FROM Business " .
      " ORDER BY " . $sortOrder;

      $statement = $this->connection->prepare($sqlQuery);
      if($filterName != NULL) {
      $params = array(
      "filterName" => "%" . $filterName . "%"
      );
      $status = $statement->execute($params);
      }
      else {
      $status = $statement->execute();
      }

      if (!$status) {
      die("Could not retrieve businesses");
      }

      return $statement;
      } */

    public function getBusinesses() {
        // execute a query to get all businesss and sort by first name and to display the ward name instead of wardId by using a join where wardId in businesss = wardId in ward
        $sqlQuery = "SELECT * FROM Business ";

        $statement = $this->connection->prepare($sqlQuery);
        $status = $statement->execute();

        if (!$status) {
            die("Could not retrieve businesses");
        }

        return $statement;
    }

//    public function getBusinessByDealId($dealID) {
//        // execute a query to get all users assigned to a specific ward by using a join where wardId in businesss = wardId in ward
//        $sqlQuery = "SELECT b.business_name AS business_name
//                    FROM business b
//                    LEFT JOIN deal d ON d.businessId = b.businessID
//                    WHERE d.dealId = :dealID";
//
//        $params = array(
//            "dealID" => $dealID
//        );
//        $statement = $this->connection->prepare($sqlQuery);
//        $status = $statement->execute($params);
//
//        if (!$status) {
//            die("Could not retrieve Deal");
//        }
//
//        return $statement;
//    }
    
    public function getBusinessByDealId($dealId) {
        // execute a query to get all users assigned to a specific ward by using a join where wardId in businesss = wardId in ward
        $sqlQuery = "SELECT b.business_name AS business_name
                    FROM business b
                    LEFT JOIN deal d ON d.businessId = b.businessID
                    WHERE d.dealId = :dealID";

        $params = array(
            "dealID" => $dealId
        );
        $statement = $this->connection->prepare($sqlQuery);
        $status = $statement->execute($params);

        if (!$status) {
            die("Could not retrieve Deal");
        }

        return $statement;
    }

    public function getBusinessById($bId) {
        // execute a query to get the user with the specified id
        $sqlQuery = "SELECT * FROM business WHERE businessID = :id";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "id" => $bId
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not retrieve business");
        }

        return $statement;
    }

    public function getBusinessByUserId($uId, $sortOrder) {
        // execute a query to get the user with the specified id
        $sqlQuery = "SELECT * FROM business WHERE userId = :id" .
                    " ORDER BY " . $sortOrder;

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "id" => $uId
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not retrieve business");
        }

        return $statement;
    }


    public function insertBusiness($bN, $bA, $bL, $bLg, $bT, $uId) {
        $sqlQuery = "INSERT INTO business " .
                "(business_name, business_address, business_lat, business_long, business_type, userId) " .
                "VALUES (:business_name, :business_address, :business_lat, :business_long, :business_type, :userId)";

        //if ($wID == -1) {
        //$wID = NULL;
        //}

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "business_name" => $bN,
            "business_address" => $bA,
            "business_lat" => $bL,
            "business_long" => $bLg,
            "business_type" => $bT,
            "userId" => $uId
        );
        echo '<pre>';
        print_r($sqlQuery);
        print_r($params);
        print_r($_POST);
        echo '</pre>';

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not create business");
        }

        $id = $this->connection->lastInsertId();

        return $id;
    }

    public function deleteBusiness($bId) {
        $sqlQuery = "DELETE FROM business WHERE businessID = :businessID";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "businessID" => $bId
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not delete business");
        }

        return ($statement->rowCount() == 1);
    }

    public function updateBusiness($bId, $bN, $bA, $bLt, $bLg, $bT) {
        $sqlQuery = "UPDATE business SET " .
                "business_name = :business_name, " .
                "business_address = :business_address, " .
                "business_lat = :business_lat, " .
                "business_long = :business_long, " .
                "business_type = :business_type " .
                " WHERE businessID = :businessID";

        echo '<pre>';
        print_r($sqlQuery);
        echo '</pre>';

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "businessID" => $bId,
            "business_name" => $bN,
            "business_address" => $bA,
            "business_lat" => $bLt,
            "business_long" => $bLg,
            "business_type" => $bT
        );

        /* echo '<pre>';
          print_r ($_POST);
          print_r ($params);
          print_r ($sqlQuery);
          echo '</pre>'; */


        $status = $statement->execute($params);

        return ($statement->rowCount() == 1);
    }

}
