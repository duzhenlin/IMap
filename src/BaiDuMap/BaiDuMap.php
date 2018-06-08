<?php
/**
 * Created by PhpStorm.
 * User: duzhenlin
 * Date: 2018/4/26
 * Time: 15:20
 */

namespace IMap\BaiDuMap;


use IMap\Core\AbstractAPI;

class BaiDuMap extends AbstractAPI
{
    public $ak;
    public $sk;
    const BAIDU_URL = 'http://api.map.baidu.com/';

    public function __construct($op)
    {
        $this->ak = $op['ak'];
        $this->sk = $op['sk'];
    }

    private function getSn($sk, $url, $querystring_arrays, $method = 'GET')
    {
        if ($method === 'POST') {
            ksort($querystring_arrays);
        }
        $querystring = http_build_query($querystring_arrays);
        return md5(urlencode($url . '?' . $querystring . $sk));
    }

    //http://api.map.baidu.com/place/v2/suggestion?query=天安门&region=北京&city_limit=true&output=json&ak=你的ak //GET请求
    public function placeSuggestion($query,$region ='全国',$city_limit =false,$location='')
    {

    }

    //http://api.map.baidu.com/place/v2/search?query=ATM机&tag=银行&region=北京&output=json&ak=您的ak
//    public function placeSearch($address)
//    {
//        $params = [
//            'address' => $address,
//            'key' => $this->key,
//        ];
//        return $this->parseJSON('get', [self::GEOCODER_ADDRESS_URL, $params]);
//    }
}