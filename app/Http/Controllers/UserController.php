<?php

namespace App\Http\Controllers;

use App\Models\UsersDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {
        try {
            $u_details = new UsersDetails();
            $u_details->user_id = $request->user()->id;
            $u_details->birthdate = $request->birthdate;
            $u_details->address = $request->address;
            $u_details->phone = $request->phone;

            if ($u_details->save()) {
                $response = $u_details;
                return response()->json(['status' => 'success', 'message' => 'Details added successfully!', 'data' => $response]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = $request->user();
            $u_details = UsersDetails::findOrFail($id);
            $u_details->birthdate = $request->birthdate;
            $u_details->address = $request->address;
            $u_details->phone = $request->phone;

            if ($u_details->save()) {
                $response = $u_details;
                return response()->json(['status' => 'success', 'message' => 'Details updated successfully!', 'user' => $user, 'details' => $response]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function getUser(Request $request)
    {
        $user = $request->user();
        $details = UsersDetails::where('user_id', $user->id)->get();
        return response()->json(['user' => $user, 'details' => $details, 'role' => $user->role->name]);
    }

    public function userDetails(Request $request)
    {
        $user = $request->user();
        $details = UsersDetails::where('user_id', $user->id)->get();
        return response()->json([
            'details' => $details
        ]);

    }
}
