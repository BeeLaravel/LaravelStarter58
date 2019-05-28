<?php
namespace App\Http\Controllers\Soap\Warehouse;

use Artisaninweb\SoapWrapper\SoapWrapper;

use App\Soap\Request\Weather\getRegionProvince;
use App\Soap\Response\Weather\getRegionProvinceResponse;
use App\Soap\Request\Weather\getRegionDataset;
use App\Soap\Response\Weather\getRegionDatasetResponse;
use App\Soap\Request\Weather\getRegionCountry;
use App\Soap\Response\Weather\getRegionCountryResponse;
use App\Soap\Request\Weather\getSupportCityDataset;
use App\Soap\Response\Weather\getSupportCityDatasetResponse;
use App\Soap\Request\Weather\getSupportCityString;
use App\Soap\Response\Weather\getSupportCityStringResponse;
use App\Soap\Request\Weather\getWeather;
use App\Soap\Response\Weather\getWeatherResponse;

class GoodcangController extends Controller {
    protected $soapWrapper;

    public function __construct(SoapWrapper $soapWrapper) {
        $this->soapWrapper = $soapWrapper;

        $this->soapWrapper->add('Weather', function ($service) {
            $service
                ->wsdl('http://www.webxml.com.cn/WebServices/WeatherWS.asmx?wsdl')
                ->trace(true)
                ->classmap([
                    getRegionProvince::class,
                    getRegionProvinceResponse::class,
                    getRegionDataset::class,
                    getRegionDatasetResponse::class,
                    getRegionCountry::class,
                    getRegionCountryResponse::class,
                    getSupportCityDataset::class,
                    getSupportCityDatasetResponse::class,
                    getSupportCityString::class,
                    getSupportCityStringResponse::class,
                    getWeather::class,
                    getWeatherResponse::class,
                ]);
        });
    }

    public function getRegionDataset() {
        $response = $this->soapWrapper->call('Weather.getRegionDataset');

        echo "<pre>";
        print_r($response->GetRegionDatasetResult());
    }
    public function getRegionProvince() {
        $response = $this->soapWrapper->call('Weather.getRegionProvince');

        echo "<pre>";
        print_r($response->GetRegionProvinceResult());
    }
    public function getRegionCountry() {
        $response = $this->soapWrapper->call('Weather.getRegionCountry');

        echo "<pre>";
        print_r($response->GetRegionCountryResult());
    }
    public function getSupportCityDataset() {
        $response = $this->soapWrapper->call('Weather.getSupportCityDataset', [
            'theRegionCode' => '福建',
        ]);

        echo "<pre>";
        print_r($response->GetSupportCityDatasetResult());

        // $response = $this->soapWrapper->call('Weather.getSupportCityDataset', [
        //     new getSupportCityDataset('福建')
        // ]);

        // echo "<pre>";
        // print_r($response);
    }
    public function getSupportCityString() {
        $response = $this->soapWrapper->call('Weather.getSupportCityString', [
            'theRegionCode' => '福建',
        ]);

        echo "<pre>";
        print_r($response->GetSupportCityStringResult());

        // $response = $this->soapWrapper->call('Weather.getSupportCityString', [
        //     new getSupportCityString('安徽')
        // ]);

        // echo "<pre>";
        // print_r($response);
    }
    public function getWeather() {
        $response = $this->soapWrapper->call('Weather.getWeather', [
            [
                'theCityCode' => 2210,
            ]
        ]);

        echo "<pre>";
        print_r($response->GetWeatherResult());
    }
}
// ## 函数
