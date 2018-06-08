<?php
/**
 * Created by PhpStorm.
 * User: duzhenlin
 * Date: 2018/4/26
 * Time: 15:44
 */

namespace IMap\Core\ServiceProviders;


use IMap\BaiDuMap\BaiDuMap;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class BaiDuMapServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['BaiDuMap'] = function () use ($pimple) {
            return new BaiDuMap($pimple['config']['baidu']);
        };
    }
}