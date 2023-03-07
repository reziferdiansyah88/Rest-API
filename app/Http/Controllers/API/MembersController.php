<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Members;
use App\Helpers\ApiResponse;
use Exception;

class MembersController extends Controller
{
    /**
     * GET ALL MEMBERS
     */
    public function membersList()
    {
         /**
           * Members model
           */
        $data = Members::all();
        
        if ($data) {
          return ApiResponse::createApi(200, 'Success', $data);
        } else {
          return ApiResponse::createApi(400, 'Failed');
        }
        
    }

    /**
     * CREATE MEMBERS 
     */
    public function membersCreate(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required',
                'address' => 'required',
            ]);

            /**
           * members table database
           * Members model
           */
            $members = Members::create([
                'username' => $request->username,
                'address' => $request->address,
            ]);

        $data = Members::where('id', '=', $members->id)->get();

        if ($data) {
          return ApiResponse::createApi(200, 'Success', $data);
        } else {
          return ApiResponse::createApi(400, 'Failed');
        }

        } catch (Exception $error) {
            return ApiResponse::createApi(400, 'Failed');
        }
    }

    /**
     * DETAIL MEMBERS
     */
    public function membersDetail(string $id)
    {
        // Members MODEL
        // $id id members
         $data = Members::where('id', '=', $id)->get();

        if ($data) {
          return ApiResponse::createApi(200, 'Success', $data);
        } else {
          return ApiResponse::createApi(400, 'Failed');
        }

    }

    /**
     * DELETE MEMBERS
     */
    public function membersDelete(string $id)
    {
        //
    }
}
