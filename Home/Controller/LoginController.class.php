<?php
namespace Home\Controller;
use Think\Controller;   
class LoginController extends Controller {
    //登陆api
    public function Api_LandingVerification()
    {
        session(null);
        $username = I('post.username');
        $password = I('post.password');

        $password = md5($password);
        $table = M("runningMan");
        $where = array(
            "account"=>$username,
            "password"=>$password
        );
        $re = $table->where($where)->find();
        if($re){
            session("runningMan",$re['id']);
            echo json_encode(array(
                "result" => true,
                "msg"=>"登陆成功"
            ));
        }else{
            echo json_encode(array(
                "result" => false,
                "msg"=>"登陆失败"
             ));
        }
    }
    //验证是否登陆
    public function Api_Verification()
    {
        $dn = session("runningMan");
        if($dn){
            echo json_encode(array(
                "result" => true,
            ));
        }else{
            echo json_encode(array(
                "result" => false,
            ));
        }
    }
    //退出登陆
    public function Api_exit()
    {
        session(null);
        if(!session("?runningMan")){
            echo json_encode(array(
                "result" => true,
            ));
        }else{
            echo json_encode(array(
                "result" => false,
            ));
        }
       
    }
    //修改密码
    public function Api_changepwd(){
        $dn = session("runningMan");
        if(!$dn){
            echo json_encode(array(
                "result" => false,
                "msg"=>"错误，您未登陆"
            ));
            exit();
        }
        $data = array(
            "password"=>md5(I('post.pwd'))
        );
        $map = array(
            'id'=>$dn
        );
        $re = M("runningMan")->where($map)->save($data);
        if($re){
            echo json_encode(array(
                "result" => true,
                "msg" => "修改成功"
            ));
            exit();
        }else{
            echo json_encode(array(
                "result" => false,
                "msg" => "操作失败"
            ));
            exit();
        }
    }

}