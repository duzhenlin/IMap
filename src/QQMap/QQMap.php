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
     * 地点搜索（search接口）
     */
    const PLACE_SEARCH_URL = 'http://apis.map.qq.com/ws/place/v1/search';
    /**
     * 关键字的补完与提示
     */
    const PLACE_SUGGESTION_URL = 'http://apis.map.qq.com/ws/place/v1/suggestion';
    /**
     * 逆地址解析（坐标转地址）
     */
    const GEOCODER_LOCATION_URL = 'http://apis.map.qq.com/ws/geocoder/v1';
    /**
     * 地址解析（地址转坐标）
     */
    const GEOCODER_ADDRESS_URL = 'http://apis.map.qq.com/ws/geocoder/v1';
    /**
     * 计算距离
     */
    const DISTANCE_URL = 'http://apis.map.qq.com/ws/distance/v1';
    /**
     * ip定位
     */
    const LOCATION_IP_URL = 'http://apis.map.qq.com/ws/location/v1/ip';
    /**
     * 坐标转换
     */
    const COORD_TRANSLATE_URL = 'http://apis.map.qq.com/ws/coord/v1/translate';
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
     * 地址解析（地址转坐标）
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
        return $this->parseJSON('get', [self::GEOCODER_ADDRESS_URL, $params]);
    }

    /**
     * 逆地址解析（坐标转地址）
     * @param $location
     * @param int $coord_type
     * @param int $get_poi
     * @return \IMap\Core\Collection
     * @throws \IMap\Core\Exceptions\HttpException
     */
    public function location($location, $coord_type = 5, $get_poi = 0)
    {
        $params = [
            'location' => $location,
            'coord_type' => $coord_type,
            'get_poi' => $get_poi,
            'key' => $this->key,
        ];
        return $this->parseJSON('get', [self::GEOCODER_LOCATION_URL, $params]);
    }

    /**
     * ip定位
     * @param $ip
     * @return \IMap\Core\Collection
     * @throws \IMap\Core\Exceptions\HttpException
     */
    public function fromIp($ip = false)
    {
        $params = ['key' => $this->key];
        if ($ip) {
            $params['ip'] = $ip;
        }
        return $this->parseJSON('get', [self::LOCATION_IP_URL, $params]);
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
        return $this->parseJSON('get', [self::DISTANCE_URL, $params]);
    }


    /**
     * 地点搜索（search接口）
     * @param $keyword
     * @param $boundary
     * @param int $page_size
     * @param int $page_index
     * @param bool $filter
     * @param bool $orderby
     * @return \IMap\Core\Collection
     * @throws \IMap\Core\Exceptions\HttpException
     *
     * http://lbs.qq.com/webservice_v1/guide-search.html#boundary_detail
     * http://lbs.qq.com/webservice_v1/guide-search.html#filter_detail
     * http://lbs.qq.com/webservice_v1/guide-search.html#orderby_detail
     */
    public function search($keyword, $boundary, $page_index = 1, $page_size = 20, $filter = false, $orderby = false)
    {
        $params = [
            'keyword' => $keyword,
            'boundary' => $boundary,
            'page_index' => $page_index,
            'page_size' => $page_size,
            'key' => $this->key,
        ];
        if ($filter) {
            $params['filter'] = $filter;
        }
        if ($orderby) {
            $params['orderby'] = $orderby;
        }
        return $this->parseJSON('get', [self::PLACE_SEARCH_URL, $params]);
    }


}