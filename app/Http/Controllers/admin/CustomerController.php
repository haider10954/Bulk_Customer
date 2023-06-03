<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCustomerRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function  index ()
    {
        $customer = Customer::query()->latest()->paginate('10');
        return view('admin.pages.customers.index',compact('customer'));
    }

    public  function  create_customer_view()
    {
        $user = User::query()->get();
        return view('admin.pages.customers.create',compact('user'));
    }

    public function  add_customer(AddCustomerRequest $request)
    {
        $customer = Customer    ::create([
            'user_id' => $request->user_id,
            'name' => $request->user_name,
            'email' => $request->email,
            'phone' => $request->phone
        ]);

        if($customer)
        {
            return json_encode([
                'success' => true,
                'message' => 'Customer added successfully',
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => 'Something went wrong please try again',
            ]);
        }
    }

    public function edit_customer_view($id)
    {
        $customer = Customer::where('id' ,$id)->first();
        $user = User::query()->get();
        return view('admin.pages.customers.edit',compact('customer','user'));
    }

    public  function  edit (AddCustomerRequest $request)
    {
        $update = Customer::where('id' , $request->customer_id)->update([
            'user_id' => $request->user_id,
            'name' => $request->user_name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        if($update)
        {
            return json_encode([
                'success' => true,
                'message' => 'Customer updated successfully',
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => 'Something went wrong please try again',
            ]);
        }
    }

    public function delete_customer(Request $request)
    {
        $user = Customer::where('id',$request->id)->first();
        if($user)
        {
            Customer::where('id',$request->id)->delete();
        }
        return response()->json([
            'success' => true,
            'message' => 'Customer Record Deleted',
        ]);
    }
}
