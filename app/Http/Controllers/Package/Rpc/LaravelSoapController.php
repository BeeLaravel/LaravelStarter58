<?php
namespace App\Http\Controllers\Package\Rpc;

use App\Soap\Request\GetConversionAmount;
use App\Soap\Response\GetConversionAmountResponse;

class LaravelSoapController extends Controller {
    protected $soapWrapper;

    public function __construct(SoapWrapper $soapWrapper) {
        $this->soapWrapper = $soapWrapper;
    }

    public function index() {
        $this->soapWrapper->add('Currency', function ($service) {
            $service
                ->wsdl('http://currencyconverter.kowabunga.net/converter.asmx?wsdl')
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
