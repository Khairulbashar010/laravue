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

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function getCustomers()
    {
        try {
            $customers = $this->user
            ->customers()
            ->select('id','name','email','address')
            ->get();
            return response()->json([
                'message' => "Data fetched!",
                'data' => $customers,
                'success'=> true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Error occured",
                'success'=> false
            ]);
        }
    }

    public function createCustomer(Request $request) {
        $data = $request->only('name', 'email', 'password', 'address');
        $validator = Validator::make($data, [
            'name'  => 'required|max:70',
            'email' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|email|max:255|unique:users',
            'password'  => 'required|min:8',
            'address'  => 'required|max:200',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages(),
                'success' => false,
            ], 200);
        }
        try {
            $customer = $this->user->customers()->create([
                "name" => $data['name'],
                "email" => $data['email'],
                "password" => bcrypt($data['password']),
                "address" => $data['address'],
                "parent_id" => $this->user->id,
                "role_id" => 2,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Customer added',
                'data' => $customer
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success'=> false
            ]);
        }
    }

    public function editCustomer($customerId) {
        try {
            $customer = $this->user->customers()->select('id', 'name', 'email', 'address')->findOrFail($customerId);
            return response()->json([
                'message' => "Customer data fetched!",
                'data' => $customer,
                'success'=> true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Error occured",
                'success'=> false
            ]);
        }
    }

    public function updateCustomer(Request $request)
    {
        try {
            $data = $request->only('id', 'name', 'email', 'password', 'address', 'parent_id');
            $validator = Validator::make($data, [
                'id'  => 'required',
                'name'  => 'required|max:70',
                'email'     => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|email|max:255|unique:users,email,'.$data['id'],
                'password'  => 'required|min:8',
                'address'  => 'required|max:200',
                'parent_id'  => 'required',
            ]);
            if($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors(),
                    'success'=> false
                ]);
            }

            $customer = $this->user->customers()->findOrFail($data['id']);
            if($customer->parent_id != $data['parent_id']){
                return response()->json([
                    'message' => 'Not authorized',
                    'success'=> false
                ], 401);
            }

            $customer->name = $data['name'];
            $customer->email = $data['email'];
            $customer->password = bcrypt($data['password']);
            $customer->address = $data['address'];
            $customer->save();

            return response()->json([
                'message' => 'Data updated!',
                'data' => $customer,
                'success'=> true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Error occured",
                'success'=> false
            ]);
        }
    }

    public function deleteCustomer($customerId)
    {
        try {
            $customer = $this->user->customers()->findOrFail($customerId);
            if ($customer->role_id != 2) {
                return response()->json([
                    'message' => "Not a customer!",
                    'success'=> false
                ]);
            }
            $customer->customers()->delete();
            $customer->bills()->delete();
            $customer->delete();

            return response()->json([
                'message' => "Removed customer!",
                'success'=> true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Error occured",
                'success'=> false
            ]);
        }
    }
}
