<?php
    class PaymentPartner {
        public $id;
        public $partnerName;
        public $partnerThumbnail;

        public function __construct($id, $partnerName, $partnerThumbnail) {
            $this->id = $id;
            $this->partnerName = $partnerName;
            $this->partnerThumbnail = $partnerThumbnail;
        }

        public function getId() {
            return $this->id;
        }
    
        public function setId($id) {
            $this->id = $id;
        }
    
        public function getPartnerName() {
            return $this->partnerName;
        }
    
        public function setPartnerName($partnerName) {
            $this->partnerName = $partnerName;
        }
    
        public function getPartnerThumbnail() {
            return $this->partnerThumbnail;
        }
    
        public function setPartnerThumbnail($partnerThumbnail) {
            $this->partnerThumbnail = $partnerThumbnail;
        }
    }
?>