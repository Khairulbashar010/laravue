<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;


class CustomerController extends Controller
{
    protected $user;

    public function __construct() {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function viewBill() {
        try {
            $bill = $this->user->bills()->whereMonth('bill_month', date('m'))->with('biller:id,name,email')->select('biller_id', 'bill_month', 'amount', 'status')->first();
            return response()->json([
                'message' => "Data fetched!",
                'success'=> true,
                'data' => $bill,
                'token' => request()->bearerToken(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Error occured",
                'success'=> false,
                'token' => request()->bearerToken(),
            ]);
        }
    }
}
