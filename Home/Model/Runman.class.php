<?php
namespace Home\Model;

//跑男店铺、电话
class Runman{
    
    ///跑男消息修改
    public function updata($data){
        $table = M('runningMan');
        $map = array(
            "id" =>  session("runningMan")
        );
        $re = $table->where($map)->save($data);
        if($re){
            return true;
        }else{
            return false;
        }
    }
    //跑男电话修改
    public function updata_dh($data){
        $table = M('phoneMan');
        $map = array(
            "mainid" =>  session("runningMan")
        );
        $re = $table->where($map)->save($data);
        if($re){
            return true;
        }else{
            return false;
        }
    }
    

}