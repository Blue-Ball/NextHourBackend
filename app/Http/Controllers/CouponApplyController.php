<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CouponCode;
use Illuminate\Support\Carbon;
use Session;
use App\Package;
use App\CouponApply;
use App\Auth;

class CouponApplyController extends Controller
{
   public function get(Request $request)
   {
   	
   	//return $request;
   		$coupon = CouponCode::where('coupon_code',$request->coupon_code)->first();
   		$plan = Package::where('id',$request->plan_id)->first();
	    if(isset($coupon) && $coupon != NULL){
	      $current_date = Carbon::now();
	      if($current_date < $coupon->redeem_by){
	        if($coupon->max_redemptions != 0){
	        	if($coupon->duration == 'once'){
	        		$user_id = Auth::user()->id;
	        		$coupon_apply = CouponApply::where('user_id',$request->user_id)->where('coupon_id',$coupon->id)->first();
		        	if(!$coupon_apply && $coupon_apply == NULL){
		        		$apply_coupon = CouponApply::create([
		                           'user_id'=>$user_id,
		                           'coupon_id'=>$coupon->id,
		                           'redeem'=> 1,
		                          ]);
		        	}else{
		        		 return back()->with('deleted','Coupon limit reached!');
		        	}
	        	}
	        	
	           $query = $coupon->update(['max_redemptions' => $coupon->max_redemptions - 1 ]);
	           
	          
	          if($coupon->amount_off != NULL){
	          	$amount = $coupon->amount_off;
	          }else{
	          	$amount = ($plan->amount * $coupon->percent_off)/100;
	          }
	          
	           Session::put('coupon_applied',[
	          	'code' => $coupon->coupon_code,
	          	'amount' => $amount,
	          	'id' => $coupon->id
	          ]);

	         return back()->with('success','Coupon '.ucfirst($coupon->coupon_code).' is applied successfully !');;
	        }
	        else{
	          
	          return back()->with('deleted','Coupon is not available !');
	        }
	      }else{
	     
	         return back()->with('deleted','Coupon Expired !');
	      }
	    }else{
	      
	        return back()->with('deleted','Coupon Invalid !');
	    }
   }
}
