<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Lin\Binance\Binance;
use \Lin\Binance\BinanceWebSocket;

class BinanceApi extends Controller

{
    public function getPrice(){
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
    'data_time'=>1,

    //Number of messages WS queue shuold hold, default 100
    //'queue_count'=>100,

    //baseurl
    'baseurl'=>'ws://stream.binance.com:9443',//spot default
    //'baseurl'=>'ws://fstream.binance.com',//usdt future
    //'baseurl'=>'ws://dstream.binance.com',//coin future
]);

$binance->start();

$data=$binance->getSubscribe([
    'btcusdt@depth',
    'bchusdt@depth',
]);
print_r(json_encode($data));

        // $apiKey = 'xORYMdUb7BRTmHAdb6JOpy3ZJLxHhMKnbGVChthRSehbNJh4d9FUp6Yp2ihYMTJe';
        // $secretKey = 'Dcl73qdPAX0wy3reycEbA2dsKsJ8hVrRvxdIwO5aKZgYMGpi2Vs7EwM8nzE0wDb7';

        // $binance=new Binance($apiKey,$secretKey);
      //  $binance->setOptions([
            //Set the request timeout to 60 seconds by default
           //'timeout'=>10,
            
            //If you are developing locally and need an agent, you can set this
          //  'proxy'=>false,
            //More flexible Settings
            /* 'proxy'=>[
                'http'  => 'http://127.0.0.1:12333',
                'https' => 'http://127.0.0.1:12333',
                'no'    =>  ['.cn']
            ], */
            //Close the certificate
        //     'verify'=>true,
        // ]);

        // try {
        //     $result=$binance->system()->getAvgPrice([
        //         'symbol'=>'BTCUSDT'
        //     ]);
            
        //     print_r($result);
        // }catch (\Exception $e){
        //     print_r($e->getMessage());
        // }

        // try {
        //     $result=$binance->user()->getCapitalDepositAddress([
        //         'coin'=>'BTC'
        //     ]);
        //     print_r($result);
        // }catch (\Exception $e){
        //     print_r($e->getMessage());
        // }

        // $timeStamp = Carbon::now()->timestamp;
        // $query_string = 'timestamp='.$timeStamp;
        
        // $signature = hash_hmac('sha256', $query_string, $secretKey) . PHP_EOL;
        
        // $data = Http::withHeaders([
        //     'X-MBX-APIKEY' => $apiKey,
        // ])->get('https://api.binance.com/api/v3/exchangeInfo',
        //  [
        //     'timestamp' => $timeStamp,
        //     'signature' => $secretKey
        // ]
    // );
    //     if ($data) {
    //         return response()->json($data);
    //     }


    }


 
}
