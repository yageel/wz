<?php
namespace Home\Controller;
use Weixin\MyWechat;
use Home\Model\UsersModel;
use Redis\MyRedis;

class EmptyController extends BaseController {

    public function _empty($name){
        $cityName = strtolower(CONTROLLER_NAME);
        $this->index($cityName,$name);
    }
    protected function index($city,$value){
        echo $city,"<br/>", $value;
    }
}