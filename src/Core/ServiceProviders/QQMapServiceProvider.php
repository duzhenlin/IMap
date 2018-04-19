<?php
/**
 * Created by PhpStorm.
 * User: duzhenlin
 * Date: 2018/4/19
 * Time: 13:22
 */

namespace IMap\Core\ServiceProviders;

use IMap\QQMap\QQMap;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class QQMapServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['QQMap'] = function () use ($pimple) {
            return new QQMap($pimple['config']['qq']['Key']);
        };
    }
}