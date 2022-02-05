<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Qcloud\Sms\SmsSingleSender;
use App\Http\Controllers\Controller;

class LoginSMSController extends Controller
{
    public function create()
	{
		$phonenumber = request('phonenumber');
		logger($phonenumber);
	    try {
	        $ssender = new SmsSingleSender(config('services.qcloudsms.app_id'), config('services.qcloudsms.key'));
	        $params = [rand(1000,9999)];
	        $result = $ssender->sendWithParam("86", $phonenumber, config('services.qcloudsms.template_id'), $params, config('services.qcloudsms.sign'), "", ""); 
	        if(json_decode($result)->result==0){
		        return response()->json([
		        	'result' => 0,
		        	'phonenumber' => $phonenumber,
		        	'code' => $params[0]
		        ]);
	    	}
	    	return $result;
	        /*
	        {
				"result": 1016,
				"errmsg": "手机号格式错误",
				"ext": "",
				"isocode": "CN"
			}
			{
				"result": 0,
				"errmsg": "OK",
				"ext": "",
				"sid": "2765:349644766416437750153681158",
				"fee": 1,
				"isocode": "CN"
			}
			*/
	    } catch(\Exception $e) {
	        return  response()->json([
				'result' => false,
		    	'error' => $e,
			]);
	    }
	}
}
