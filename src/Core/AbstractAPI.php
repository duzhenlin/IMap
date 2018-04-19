<?php
/**
 * Created by PhpStorm.
 * User: duzhenlin
 * Date: 2018/4/19
 * Time: 13:56
 */

namespace IMap\Core;


use IMap\Core\Exceptions\HttpException;

/**
 * Class AbstractAPI
 * @package IMap\Core
 */
abstract class  AbstractAPI
{
    /**
     * @var
     */
    private $_http;
    /**
     * @var
     */
    protected $cache;

    /**
     * @return Http
     */
    protected function getHttp()
    {
        if (!$this->_http) {
            $this->_http = new Http();
        }
        return $this->_http;
    }

    /**
     * @param $method
     * @param array $args
     * @return Collection
     * @throws HttpException
     */
    public function parseJSON($method, array $args)
    {
        $http = $this->getHttp();

        $contents = $http->parseJSON(call_user_func_array([$http, $method], $args));

        $this->checkAndThrow($contents);

        return new Collection($contents);
    }

    /**
     * @param array $contents
     * @throws HttpException
     */
    protected function checkAndThrow(array $contents)
    {
        if (isset($contents['errcode']) && 0 !== $contents['errcode']) {
            if (empty($contents['errmsg'])) {
                $contents['errmsg'] = 'Unknown';
            }
            throw new HttpException($contents['errmsg'], $contents['errcode']);
        }
    }
}