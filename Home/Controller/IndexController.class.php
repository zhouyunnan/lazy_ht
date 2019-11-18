<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    public function add(){
        $table = M("wz");
        if(    !isset($_POST['title']) || empty($_POST['title'])
            || !isset($_POST['types']) || empty($_POST['types'])
            || !isset($_POST['user'])  || empty($_POST['user'])
            || !isset($_POST['msg'])   || empty($_POST['msg'])
        ){
            echo json_encode(array(
                "result" => false,
                "msg"=>"缺少数据"
            ));
            exit();

        }

        $data = array(
            "title"=>I('post.title'),
            "type" => I('post.types'),
            'user'=> I('post.user'),
            "msg"=>I('post.msg'),
            "time"=>time()
        );
        $res = $table->add($data);
        if($res){
              echo json_encode(array(
                  "result" => true,
                  "id"=>$res
              ));
        }else{
            echo json_encode(array(
                "result" => false,
                "msg"=>"失败"
            ));
        }
    }
    public function find(){
        $table = M("wz");
        $map = array(
            'id'=>I('get.id')
        );
        $re = $table->where($map)->find();
        if($re){
            echo json_encode(array(
                "result" => true,
                "data"=>$re
            ));
        }
    }
    public function select(){
        $table = M("wz");
        $re = $table->select();
        if($re){
            echo json_encode(array(
                "result" => true,
                "data"=>$re
            ));
        }
    }
}