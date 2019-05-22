<?php
namespace App\Soap\Response;

class GetConversionAmountResponse {
    protected $GetConversionAmountResult;

    public function __construct($GetConversionAmountResult) {
        $this->GetConversionAmountResult = $GetConversionAmountResult;
    }
    public function getGetConversionAmountResult() {
        return $this->GetConversionAmountResult;
    }
}
