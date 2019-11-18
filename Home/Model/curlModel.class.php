<?php

namespace Home\Model;

class curlModel{
    public  function Curl($url,$type='get',$res = 'json',$arr = ''){
        //获取MOOK
        //1,初始化CURL
        $ch = curl_init();
        //2,设置CURL参数
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if($type == 'post'){
            curl_setopt($ch,CURLOPT_POST,1);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$arr);
        }
        //3.抓取URL并把它传递给浏览器
        $opt = curl_exec($ch);
        //4.关闭cURL资源，并且释放系统资源
        curl_close($ch);
        if($res === 'json'){
            if(curl_errno($ch)){
                return curl_error($ch);
            }else{
                return json_decode($opt,true);
            }

        }

    }
    public function http_curl($url,$type='get',$res='json',$arr=''){

        //1.初始化curl
        $ch  =curl_init();
        //2.设置curl的参数
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "media=@test.jpg");

        if($type == 'post'){
            curl_setopt($ch,CURLOPT_POST,1);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$arr);
        }
        //3.采集
        $output =curl_exec($ch);

        //4.关闭
        curl_close($ch);
        if($res=='json'){
            if(curl_error($ch)){
                //请求失败，返回错误信息
                return curl_error($ch);
            }else{
                //请求成功，返回错误信息
                return json_decode($output,true);
            }
        }
        echo var_dump( $output );
    }

}