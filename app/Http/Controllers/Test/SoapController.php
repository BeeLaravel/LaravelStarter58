<?php
namespace App\Http\Controllers\Test;

use Artisaninweb\SoapWrapper\SoapWrapper;

use App\Soap\Request\GetConversionAmount;
use App\Soap\Response\GetConversionAmountResponse;

class SoapController extends Controller {
    protected $soapWrapper;

    public function __construct(SoapWrapper $soapWrapper) {
        $this->soapWrapper = $soapWrapper;
    }

    // 易可达接口调用
    public function goodcang() {
        $this->soapWrapper->add('Currency', function ($service) {
            $service
                ->wsdl('http://currencyconverter.kowabunga.net/converter.asmx?WSDL')
                ->trace(true)
                ->classmap([
                    GetConversionAmount::class,
                    GetConversionAmountResponse::class,
                ]);
        });

        // $response = $this->soapWrapper->call('Currency.GetConversionAmount', [
        //     'CurrencyFrom' => 'USD', 
        //     'CurrencyTo' => 'EUR', 
        //     'RateDate' => '2014-06-05', 
        //     'Amount' => '1000',
        // ]);

        $response = $this->soapWrapper->call('Currency.GetConversionAmount', [
            new GetConversionAmount('USD', 'EUR', '2014-06-05', '1000')
        ]);

        var_dump($response);
    }
}
// $this->soapWrapper->add('Currency', function ($service) {
//     $service
//         ->wsdl()
//         ->trace(true)
//         ->header() // Optional: (parameters: $namespace,$name,$data,$mustunderstand,$actor)
//         ->customHeader() // Optional: (parameters: $customerHeader) Use this to add a custom SoapHeader or extended class                
//         ->cookie()
//         ->location()
//         ->certificate()
//         ->cache(WSDL_CACHE_NONE)
//         ->options([
//             'login' => 'username',
//             'password' => 'password'
//         ])
//         ->classmap([
//             GetConversionAmount::class,
//             GetConversionAmountResponse::class,
//         ]);
// });
