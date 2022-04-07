<?php

use Lin\Binance\Binance;
use \Lin\Binance\BinanceWebSocket;

$binance=new Binance();

//Order book
try {
    $result=$binance->system()->getDepth([
        'symbol'=>'BTCUSDT',
        'limit'=>'20',
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r($e->getMessage());
}

//Recent trades list
try {
    $result=$binance->system()->getTrades([
        'symbol'=>'BTCUSDT',
        'limit'=>'20',
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r($e->getMessage());
}

//Current average price
try {
    $result=$binance->system()->getCapitalDepositAddress([
        'coin'=>'BTC'
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r($e->getMessage());
}
//getCapitalDepositAddress