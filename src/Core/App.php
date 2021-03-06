<?php
/**
 * Created by PhpStorm.
 * User: duzhenlin
 * Date: 2018/4/19
 * Time: 12:04
 */

namespace IMap\Core;


use Pimple\Container;
use Symfony\Component\HttpFoundation\Request;

class App extends Container
{
    protected static $valid_config_key = [
        'qq',
        'amap',
        'baidu'
    ];
    protected $providers = [
        ServiceProviders\QQMapServiceProvider::class,
    ];

    public function __construct($config)
    {
        parent::__construct();
        $config = $this->filterConfig($config);
        $this['config'] = function () use ($config) {
            return new Config($config);
        };

        if ($this['config']['debug']) {
            error_reporting(E_ALL);
        }
        $this->registerProviders();
        $this->registerBase();
        HTTP::setDefaultOptions($this['config']->get('guzzle', ['timeout' => 5.0]));
    }

    /**
     * 注册基本服务
     */
    protected function registerBase()
    {
        $this['request'] = function () {
            return Request::createFromGlobals();
        };
    }


    /**
     *  注册服务
     */
    protected function registerProviders()
    {
        foreach ($this->providers as $provider) {
            $this->register(new $provider());
        }
    }

    /**
     * 过滤配置
     * @param $config
     * @return mixed
     */
    protected function filterConfig($config)
    {
        foreach ($config as $key => $val) {
            if (!in_array($key, self::$valid_config_key)) {
                unset($config[$key]);
            }
        }
        return $config;
    }

    public function addProvider($provider)
    {
        array_push($this->providers, $provider);

        return $this;
    }

    public function setProviders(array $providers)
    {
        $this->providers = [];

        foreach ($providers as $provider) {
            $this->addProvider($provider);
        }
    }

    public function getProviders()
    {
        return $this->providers;
    }

    public function __get($id)
    {
        return $this->offsetGet($id);
    }

    public function __set($id, $value)
    {
        $this->offsetSet($id, $value);
    }
}