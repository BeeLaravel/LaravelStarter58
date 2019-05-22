<?php
namespace App\Soap\Request;

class GetConversionAmount {
	protected $CurrencyFrom;
	protected $CurrencyTo;
	protected $RateDate;
	protected $Amount;

	public function __construct($CurrencyFrom, $CurrencyTo, $RateDate, $Amount) {
		$this->CurrencyFrom = $CurrencyFrom;
		$this->CurrencyTo = $CurrencyTo;
		$this->RateDate = $RateDate;
		$this->Amount = $Amount;
	}

	public function getCurrencyFrom() {
		return $this->CurrencyFrom;
	}
	public function getCurrencyTo() {
		return $this->CurrencyTo;
	}
	public function getRateDate() {
		return $this->RateDate;
	}
	public function getAmount() {
		return $this->Amount;
	}
}
