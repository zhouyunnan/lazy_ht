<?php
namespace Home\Controller;
use Think\Controller;
class BiaodanController extends Controller {
    public function _initialize()
    {   
        $admin = session("runningMan");
        if(!$admin){
            echo json_encode(array(
                "result" => false,
                "msg"=>"错误，您未登陆"
            ));
            exit();
        }
    } 
    //查询可选表单列表
    public function find(){
        $table = M("bd");
        $Map = array(
            "mainid"=>session("runningMan"),
        );
        $res = $table->where($Map)->select();
        if($res){
            echo json_encode(array(
                "result" => true,
                "lists" => $res
            )); 
            exit();
        }else{
            echo json_encode(array(
                "result" => false,
            ));
            exit();
        }
    }
    //保存表单
    public function addbd(){
        $table = M("bd");
        $Map = array(
            "mainid"=>session("runningMan"),
        );
        $table->where($Map)->delete();

        $lists = I('post.data');
        $_json = html_entity_decode($lists);
        $_data = json_decode($_json);
        for($i = 0 ; $i < count($_data) ; $i++){
            $data = array(
                "mainid"=>session("runningMan"),
                "val"=> $_data[$i]->val,
                "name"=> $_data[$i]->name,
            );
            $table->add($data);
        }
        echo json_encode(array(
            "result" => true,
            "msg"=>"保存成功"
        ));
        exit();
    }
}