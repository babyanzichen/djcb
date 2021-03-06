<?php
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; 
class shouquan {
  public function authe($redirect_url)
      {
    $appid =config('app.appId');
    // $redirect_url = $request->get('redirect_url');
    $redirect_uri=urlencode(config('app.HTTP_PARTH').$redirect_url);
    $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.$redirect_uri.'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
    echo"我为什么不跳呢？";
    header("Location:$url");
    //确保重定向后，后续代码不会被执行 
    exit;
  }
  public function httpGet($get_token_url) {
    $curl = curl_init($get_token_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_URL,$get_token_url);
    $res = curl_exec($curl);
    curl_close($curl);
    return json_decode($res,true);
  }
  public function httpPost($url, $json_template)
      {
    //echo "111";
    if (empty($url) || empty($json_template)) {
      //echo"222";
      return false;
    }
    $curl = curl_init();
    //初始化一个CURL会话 
    curl_setopt($curl, CURLOPT_URL, $url);
    //这是你想用PHP取回的URL地址。你也可以在用curl_init()函数初始化时设置这个选项 
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($json_template)){
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $json_template);
      //传递一个作为HTTP “POST”操作的所有数据的字符串。
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    //讲curl_exec()获取的信息以文件流的形式返回，而不是直接输出。 
    $output = curl_exec($curl);
    // print_r($output);
    return $output;
  }
  



  public function get_token($refresh = false){
    if(!is_file('access_token.json')){
      fopen('access_token.json', 'w');
      $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.config('app.appId').'&secret='.config('app.appSecret');
      echo $url;
            $result = json_decode(file_get_contents($url));
            //return($result);
            $access_token = $result->access_token;
            
            if ($result->errcode && !$access_token) {
              echo'获取失败';
                $this->error('get access_token failed.');
            } else {

                $data->expire_time = time() + 7000;
                $data->access_token = $access_token;
                print_r($data);
                $fp = fopen("access_token.json", "w");
                fwrite($fp, json_encode($data));
                fclose($fp);
                
                $this->access_token = $access_token;
        }
    }else{
        //echo"1111";
      $data = json_decode(file_get_contents("access_token.json"));
        //print_r($data);
        if ($data->expire_time < time() || $refresh) {
            $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.config('app.appId').'&secret='.config('app.appSecret');
            $result = json_decode(file_get_contents($url));
            print_r($result);
            $access_token = $result->access_token;
            
            if (!$access_token) {
                $this->error('get access_token failed.');
            } else {
                $data->expire_time = time() + 7000;
                $data->access_token = $access_token;
                $fp = fopen("access_token.json", "w");
                fwrite($fp, json_encode($data));
                fclose($fp);
                
                $this->access_token = $access_token;
            }
        } else{
         // echo"11111";
         // echo $data->access_token;
            $this->access_token = $data->access_token;
        }
        

    }
    
   
        return $this->access_token;
  }
  //推送模板信息    参数：发送给谁的openid,客户姓名，客户电话，推荐楼盘（参数自定）
  public function sendMessage($openid,$nickame,$phone,$award) {
    //获取全局token
   // echo"1111";
    $token=$this->get_token();
    //echo $token;
    $url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$token;
   // echo $url;
    //模板信息请求地址
    //发送的模板信息(微信要求json格式，这里为数组（方便添加变量）格式，然后转为json)
    $post_data = array(
      "touser"=>$openid,//推送给谁,openid
      "template_id"=>"tK0-zFRuw5NScW-KQNv5GQqXcV5QQ29zsX2Tc7cCnlg",//微信后台的模板信息id
      "url"=>"http://www.djcb123.cn/vote/reg",//下面为预约看房模板示例
      'data' => array(
        'first' => array('value' => '财富金字塔奖项申报成功',
          'color'=>'#ff0f0f'),
        'keyword1' => array('value' => '第六届财富金字塔颁奖盛典'),
        'keyword2' => array('value' =>'2017年11月18日'),
        'keyword3' => array('value' =>'点金国际传媒'),
        'remark' => array('value' => '尊敬的'.$nickame.'，您申报的奖项为“'.$award."”，请保持".$phone.'电话畅通，以便主办方与您核实信息，点击查看申请结果',
          'color'=>'#173177'),
          )
      );
    //将上面的数组数据转为json格式
    $post_data = json_encode($post_data);
    //发送数据，post方式<br>//配置curl请求
    $ch = curl_init();
    //创建curl请求
    curl_setopt($ch, CURLOPT_URL,$url);
    //设置发送数据的网址
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    //设置有返回值，0，直接显示
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
    //禁用证书验证
    curl_setopt($ch, CURLOPT_POST, 1);
    //post方法请求
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    //post请求发送的数据包
    //接收执行返回的数据
    $data = curl_exec($ch);
    //关闭句柄
    curl_close($ch);
   // print_r($data);
    $data = json_decode($data,true);
    //将json数据转成数组
   // return $data;
  }
  //获取模板信息-行业信息（参考，示例未使用）
  public function getHangye(){
    //用户同意授权后，会传过来一个code
    $token = $this->get_token();
    $url = "https://api.weixin.qq.com/cgi-bin/template/get_industry?access_token=".$token;
    //请求token，get方式
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
    $data = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($data,true);
    //将json数据转成数组
    //return $data["access_token"];
    return $data;
  }






}