<?php
namespace Home\Controller;
use Think\Controller;   
use Home\Model\Runman;
class RunController extends Controller {

     //验证是否登陆
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
    //修改
    public  function set(){
        $changeM = new Runman();
        $re = $changeM->updata($_POST);
        if($re){
            echo json_encode(array(
                "result" => true,
                "msg"=>"更改成功"
            ));
        }else{
            echo json_encode(array(
                "result" => false,
                "msg"=>"更改失败"
            ));
        }
    }
    //查询
    public function fin(){
        $table = M('runningMan');
        $map = array(
            "id" =>  session("runningMan")
        );
        $re = $table->where($map)->find();
        if($re){
            echo json_encode(array(
                "result" => true,
                "content"=>$re
            ));
        }else{
            echo json_encode(array(
                "result" => false,
            ));
        }
    }
    //修改电话
    public function setphone(){
        $changeM = new Runman();
        $re = $changeM->updata_dh($_POST);
        $postdata = $_POST;

        $keyi = "";
        foreach ($postdata as $key => $valuse){
             $keyi = $key;
        }
        if($re){
            echo json_encode(array(
                "result" => true,
                "msg"=>"更改成功",
                "content"=>$postdata[$keyi]
            ));
        }else{
            echo json_encode(array(
                "result" => false,
                "msg"=>"更改失败"
            ));
        }
    }
    //查询电话
    public function findphone(){
        $table = M('phoneMan');
        $map = array(
            "id" =>  session("runningMan")
        );
        $re = $table->where($map)->find();
        if($re){
            echo json_encode(array(
                "result" => true,
                "content"=>$re
            ));
        }else{
            echo json_encode(array(
                "result" => false,
            ));
        }
    }

    //查询邮箱
    public function findemail(){
        $table =  M('emailMan');
        $map = array(
            "manid" => session("runningMan")
        );
        $res = $table->where($map)->select();
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
    //添加邮箱
    public function addemail(){
        $table =  M('emailMan');
        $map = array(
            "manid" =>  session("runningMan")
        );
        $count = $table->where($map)->count();
        if($count > 1){
            echo json_encode(array(
                "result" => false,
                "msg" => "超出数量限制"
            ));
            exit();
        }else{
            $data = array(
                'email'=>I('email'),
                "manid"=>session("runningMan")
            );
            $re = $table->add($data);
            if($re){
                echo json_encode(array(
                    "result" => true,
                    "msg" => "保存成功"
                ));
                exit();
            }else{
                echo json_encode(array(
                    "result" => false,
                    "msg" => "保存失败"
                ));
                exit();
            }

        }
    }
    //删除邮箱
    public function delemail(){
        $table =  M('emailMan');
        $map = array(
            "manid" =>  session("runningMan"),
            "id"=>I('post.id')
        );
        $re = $table->where($map)->delete();
            if($re){
                echo json_encode(array(
                    "result" => true,
                    "msg" => "删除成功"
                ));
                exit();
            }else{
                echo json_encode(array(
                    "result" => false,
                    "msg" => "删除失败"
                ));
                exit();
            }
        
    }
    //添加派送员
    public function addpaisyuan(){
        $table  =  M('paisongyuanMan');
        $data = array(
            "manid"=>session("runningMan"),
            "name"=>I('post.name'),
            "phone"=>I('post.phone')
        );
        $re = $table->add($data);
        if($re){
            echo json_encode(array(
                "result" => true,
                "msg" => "添加成功"
            ));
            exit();
        }else{
            echo json_encode(array(
                "result" => false,
                "msg" => "添加失败"
            ));
            exit();
        }
    }
    //查询派送员
    public function finpaisyuan(){

        $table  =  M('paisongyuanMan');
        $map = array(
            "manid"=>session("runningMan"),
        );
        $res = $table->where($map)->select();
        if($res){
            echo json_encode(array(
                "result" => true,
                "lists"=>$res
            ));
            exit();
        }else{
            echo json_encode(array(
                "result" => false,
            ));
            exit();
        }
    }
    //删除派送员
    public function delectpsy(){
        $table  =  M('paisongyuanMan');
        $map = array(
            "manid"=>session("runningMan"),
            "id"=>I('post.id')
        );
        $re = $table->where($map)->delete();
        if($re){
            echo json_encode(array(
                "result" => true,
                "msg"=>"删除成功"
            ));
            exit();
        }else{
            echo json_encode(array(
                "result" => false,
                "msg"=>"删除失败"
            ));
            exit();
        }
    }
}
