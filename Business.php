<?php
class Business {
    private $businessId;
    private $business_name;
    private $business_address;
    private $business_lat;
    private $business_long;
    private $business_type;
    
    /*Contructor for attributes of the Patient class*/
    public function __construct($bId, $bN, $bA, $bLt, $bLg, $bT) {
        $this->businessId = $bId;
        $this->business_name = $bN;
        $this->business_address = $bA;
        $this->business_lat = $bLt;
        $this->business_long = $bLg;
        $this->business_type = $bT;
    }
    
    /*Gets values entered in createPatient and returns them to the instances*/
    public function getBusinessID() { return $this->businessId; }
    public function getBusinessName() { return $this->business_name; }
    public function getBusinessAddress() { return $this->business_address; }
    public function getBusinessLatitude() { return $this->business_lat; }
    public function getBusinessLongitude() { return $this->business_long; }
    public function getBusinessType() { return $this->business_type; }
}
