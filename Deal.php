<?php

/* Instances for Deal class */

class Deal {

    private $dealId;
    private $deal_description;
    private $deal_category;
    private $businessId;
    private $business_name;

    /* Contructor for attributes of the Deal class */

    public function __construct($dId, $dD, $dC, $bId, $bN) {
        $this->dealId = $dId;
        $this->deal_description = $dD;
        $this->deal_category = $dC;
        $this->businessId = $bId;
        $this->business_name = $bN;
    }

    /* Gets values entered in createDeal and returns them to the instances */

    //public function getDealID() { return $this->dealID; }
    public function getDealDescription() {
        return $this->deal_description;
    }

    public function getDealCategory() {
        return $this->deal_category;
    }
    
    public function getBusinessId() {
        return $this->businessId;
    }
    
    public function getBusinessName() {
        return $this->business_name;
    }
}

