<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCustomerRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    public function  index ()
    {
        $customer = Customer::query()->latest()->paginate('10');
        $users = User::get();
        return view('admin.pages.customers.index',compact('customer','users'));
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

    public function importCustomer(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls',
            'users' => 'required|array',
        ]);

        $getAllUser = User::query()->pluck('id');


        $file = $request->file('excel_file');
        $users = $request->input('users');
        if($users[0] == 'all')
        {
            $users = $getAllUser;
        }

        // Read the Excel file and get the customer data
        $data = Excel::toArray([], $file)[0];

        $totalCustomers = count($data);
        $totalUsers = count($users);

        $customersPerUser = (int) ($totalCustomers / $totalUsers);

        // Assign customers to users
        $assignedCustomers = collect($data)->map(function ($row, $index) use ($users, $customersPerUser) {
            $userId = $users[$index % count($users)];
            return [
                'name' => $row[0],
                'email' => $row[2],
                'phone' => $row[1],
                'user_id' => $userId,
            ];
        });

        // Save the assigned customers to the db
        DB::beginTransaction();
        try {
            foreach ($assignedCustomers as $customer) {
                Customer::create($customer);
            }
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'All Customers are imported successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Something went Wrong'
            ]);
        }
    }
}
