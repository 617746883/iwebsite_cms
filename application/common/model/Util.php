<?php
namespace app\common\model;
use think\Db;
use think\Request;
class Util extends \think\Model
{
	public static function get_area_config_set()
	{
		$data = model('common')->getSysset('area_config');

		if (empty($data)) {
			$data = self::get_area_config_data();
		}
		return $data;
	}

	public static function get_area_config_data()
	{
		return array('new_area'=>1,'address_street'=>1);
	}

	public static function pwd_encrypt($string, $operation, $key = 'key')
	{
		$key = md5($key);
		$key_length = strlen($key);
		$string = ($operation == 'D' ? base64_decode($string) : substr(md5($string . $key), 0, 8) . $string);
		$string_length = strlen($string);
		$rndkey = $box = array();
		$result = '';
		$i = 0;

		while ($i <= 255) {
			$rndkey[$i] = ord($key[$i % $key_length]);
			$box[$i] = $i;
			++$i;
		}

		$j = $i = 0;

		while ($i < 256) {
			$j = ($j + $box[$i] + $rndkey[$i]) % 256;
			$tmp = $box[$i];
			$box[$i] = $box[$j];
			$box[$j] = $tmp;
			++$i;
		}

		$a = $j = $i = 0;

		while ($i < $string_length) {
			$a = ($a + 1) % 256;
			$j = ($j + $box[$a]) % 256;
			$tmp = $box[$a];
			$box[$a] = $box[$j];
			$box[$j] = $tmp;
			$result .= chr(ord($string[$i]) ^ $box[($box[$a] + $box[$j]) % 256]);
			++$i;
		}

		if ($operation == 'D') {
			if (substr($result, 0, 8) == substr(md5(substr($result, 8) . $key), 0, 8)) {
				return substr($result, 8);
			}

			return '';
		}

		return str_replace('=', '', base64_encode($result));
	}

	public static function send_sms_captcha($mobile, $captcha, $type)
	{
	    $log = Db::name('sms_log')
        	->where('mobile', $mobile)
        	->where('type', $type)
        	->order('createtime', 'desc')
        	->find();
	    if((time() - $log['createtime']) < 120){
	    	return array('code'=>-1,'msg'=>'120秒内不允许重复发送','data'=>'');
	    }	        
	    $row = Db::name('sms_log')->insert(array('mobile'=>$mobile,'code'=>$captcha,'type'=>$type,'createtime'=>time()));
	    if(!$row) {
	    	return array('code'=>-2,'msg'=>'发送失败!','data'=>'123');
	    }	
	    $shopset = model('common')->getSysset();  
	    $set=Db::name('shop_sms_set')->find();   
	    $send = array();

	    if (!empty($set['aliyun_new'])) {
	    	$send = self::sendSMS($mobile,$captcha,'SMS_148614721','TIANRUN');
	    } else {
	    	$content = '【' . $shopset['shop']['name'] . '】您的验证码是：'.$captcha.'      5分钟内有效，请妥善保管。';	    
        	$send = self::sendSMS($mobile,$content);
	    }
	    if($send['status'] !== 1) {
	    	return array('code'=>-1,'msg'=>'发送失败!!!','data'=>$send);
	    }       
	    return array('code'=>1,'msg'=>'发送成功','data'=>$send);
	}

	public static function sendSMS($mobile, $message = '', $templatecode = '', $signname = '')
    {
        if(!check_mobile($mobile)){
            return array('status'=>0, 'msg' => '手机号码格式有误');
        }
        if (empty($message)) {
            return array('status'=>0, 'msg' => '信息内容不能为空');
        }
        $set=Db::name('shop_sms_set')->find();
        if(!empty($set['emay'])) {
        	vendor('Emay.Emay');
			$emay = new \Emay();
			$emay->appid = $set['emay_appid'];
	        $emay->encryptKey = $set['emay_pw'];
			$result=$emay->SendSMS($mobile, $message);
			$result = get_object_vars($result);
			if(!empty($result['plaintext'])){
	            return array('status'=>1, 'msg' => $result);
	        }else{
	            return array('status'=>0, 'msg' => $result);
	        }
        } elseif (!empty($set['meilian'])) {
        	vendor('meilian.Meilian');
        	$config = array('username' => $set['meilian_username'],'password_md5' => $set['meilian_password_md5'],'apikey' => $set['meilian_apikey']);
			$meilian = new \Meilian();
			$meilian->config = $config;
			$result = $meilian->sendSMS($mobile, $message);
			if($result) {
	            return array('status'=>1, 'msg' => $result);
	        } else {
	            return array('status'=>0, 'msg' => '发送失败');
	        }
        } elseif (!empty($set['aliyun_new'])) {
        	vendor('alisms.SignatureHelper');
        	$params = Array (
		        "code" => $message
		    );
        	$option = array('keyid' => $set['aliyun_new_keyid'], 'keysecret' => $set['aliyun_new_keysecret'], 'phonenumbers' => $mobile, 'signname' => $signname, 'templatecode' => $templatecode, 'templateparam' => $params);
        	$aliyun_new = new \SignatureHelper();
			$result = $aliyun_new->sendSms($option);return $result;
			if ($result['Message'] != 'OK') {
				return array('status' => 0, 'msg' => '短信发送失败(错误信息: ' . $result['Message'] . ')');
			}
        }
    }

}