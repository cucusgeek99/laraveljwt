<?php

use \Lin\Binance\BinanceWebSocket;
//require __DIR__ .'./vendor/autoload.php';

$binance=new BinanceWebSocket();

$binance->config([
    //Do you want to enable local logging,default false
    'log'=>true,
    //Or set the log name,
    //'log'=>['filename'=>'spot'],

    //Daemons address and port,default 0.0.0.0:2208
    //'global'=>'127.0.0.1:2208',

    //Heartbeat time,default 20 seconds
    //'ping_time'=>20,

    //Channel subscription monitoring time,2 seconds
    //'listen_time'=>2,

    //Channel data update time,0.1 seconds
    //'data_time'=>0.1,

    //Number of messages WS queue shuold hold, default 100
    //'queue_count'=>100,

    //baseurl
    'baseurl'=>'ws://stream.binance.com:9443',//spot default
    //'baseurl'=>'ws://fstream.binance.com',//usdt future
    //'baseurl'=>'ws://dstream.binance.com',//coin future
]);

$binance->start();
