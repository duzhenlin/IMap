# IMap
IMap

qq地图WebService API实现
````
  $config = [
        'qq' => [
            'Key' => 'yourKey'
        ]
    ];
    $app = new \IMap\Core\App($config);
    //地址解析（地址转坐标）
    $app->QQMap->address('济南泉城广场');
    //计算距离
    $app->QQMap->distance('39.983171,116.308479','39.996060,116.353455');
    //ip定位
    $app->QQMap->fromIp('22.22.22.22');
  ````
  
  后期会增加百度，高德api
