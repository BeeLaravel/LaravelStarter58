<?php
namespace App\Http\Controllers\Test;

use Artisaninweb\SoapWrapper\SoapWrapper;

class SoapController extends Controller {
    protected $soapWrapper;

    public function __construct(SoapWrapper $soapWrapper) {
        $this->soapWrapper = $soapWrapper;
    }

    public function soap() {
        $client = new \SoapClient('http://www.webxml.com.cn/WebServices/WeatherWS.asmx?wsdl', [
            'trace' => true,
            'exceptions' => true,
        ]);

        echo "<pre>";
        print_r($client->__getFunctions()); // 函数
        print_r($client->__getTypes()); // 类型

        $pr = $client->getRegionProvince(); // 获取省份
        print_r($pr->getRegionProvinceResult->string);

        $scs = $client->getSupportCityString([ // 获取城市
            'theRegionCode' => '福建',
        ]);
        print_r($scs->getSupportCityStringResult->string);

        $we = $client->__call('getWeather', [[ // 获取天气
            'theCityCode' => 2210,
        ]]);
        var_dump($we);
    }
    // 易可达接口调用
    public function goodcang() {
        $this->soapWrapper->add('Currency', function ($service) {
            $service
                ->wsdl('http://currencyconverter.kowabunga.net/converter.asmx?wsdl')
                ->trace(true)
                ->classmap([
                    // GetConversionAmount::class,
                    // GetConversionAmountResponse::class,
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
