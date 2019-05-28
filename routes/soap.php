<?php
Route::group([
	'prefix' => 'weather',
], function ($router) {
	Route::get('getRegionDataset', 'WeatherController@getRegionDataset')->name('weather.getRegionDataset');
	Route::get('getRegionProvince', 'WeatherController@getRegionProvince')->name('weather.getRegionProvince');
	Route::get('getRegionCountry', 'WeatherController@getRegionCountry')->name('weather.getRegionCountry');
	Route::get('getSupportCityDataset', 'WeatherController@getSupportCityDataset')->name('weather.getSupportCityDataset');
	Route::get('getSupportCityString', 'WeatherController@getSupportCityString')->name('weather.getSupportCityString');
	Route::get('getWeather', 'WeatherController@getWeather')->name('weather.getWeather');
});
