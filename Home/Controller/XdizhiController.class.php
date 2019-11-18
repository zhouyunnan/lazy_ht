<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\curlModel;
class XdizhiController extends Controller {
    public function index(){
        $url = 'https://apis.map.qq.com/ws/geocoder/v1/?location=39.984154,116.307490&get_poi=1&key=OHCBZ-ME3EK-QZTJA-AI2GJ-SXE3J-SSBIG';
        $curl = new curlModel();
        $res = $curl->http_curl($url,'get');
        dump($res);
    }

    public function get(){
        $ch = curl_init();

    　　//设置选项，包括URL
    　　curl_setopt($ch, CURLOPT_URL, "http://www.nettuts.com");
    　　curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    　　curl_setopt($ch, CURLOPT_HEADER, 0);

    　　//执行并获取HTML文档内容
    　　$output = curl_exec($ch);

    　　//释放curl句柄
    　　curl_close($ch);

    　　//打印获得的数据
    　　print_r($output);
    }
}
