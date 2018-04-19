<?php
/**
 * Created by PhpStorm.
 * User: duzhenlin
 * Date: 2018/4/19
 * Time: 13:24
 */

namespace IMap\QQMap;


use IMap\Core\AbstractAPI;

/**
 * Class QQMap
 * @package IMap\QQMap
 */
class QQMap extends AbstractAPI
{
    /**
     *
     */
    const PLACE_SEARCH_URL = 'http://apis.map.qq.com/ws/place/v1/search';
    /**
     *
     */
    const PLACE_SUGGESTION_URL = 'http://apis.map.qq.com/ws/place/v1/suggestion';
    /**
     *
     */
    const GEOCODER_LOCATION_URL = 'http://apis.map.qq.com/ws/geocoder/v1/?location';
    /**
     *
     */
    const GEOCODER_ADDRESS_URL = 'http://apis.map.qq.com/ws/geocoder/v1';
    const DISTANCE_URL = 'http://apis.map.qq.com/ws/distance/v1/';
    /**
     * @var
     */
    protected $key;

    /**
     * QQMap constructor.
     * @param $key
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    /**
     * 计算距离
     * @param $from
     * @param $to
     * @param string $mode
     * @return \IMap\Core\Collection
     * @throws \IMap\Core\Exceptions\HttpException
     */
    public function distance($from, $to, $mode = 'driving')
    {
        $params = [
            'mode' => $mode,
            'to' => $to,
            'from' => $from,
            'key' => $this->key,
        ];
        return $this->parseJSON('json', [self::GEOCODER_ADDRESS_URL, $params]);
    }

    public function search()
    {

    }

    /**
     * @param $address
     * @return \IMap\Core\Collection
     * @throws \IMap\Core\Exceptions\HttpException
     */
    public function address($address)
    {
        $params = [
            'address' => $address,
            'key' => $this->key,
        ];
        return $this->parseJSON('json', [self::GEOCODER_ADDRESS_URL, $params]);
    }
}