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
     * ALL MEMBERS
     */
    public function membersList()
    {
         /**
           * Members is Models -> from Models Members.php
           * createApi -> function From Helpers ApiResponse.php
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
           * members is table database
           * Members is Models -> from Models Members.php
           * createApi -> function From Helpers ApiResponse.php
           */

            $members = Members::create([
                'username' => $request->username,
                'address' => $request->address,
            ]);

        $data = Members::where('id', '=', $members->id)->get();

        if ($data) {
          return ApiResponse::createApi(200, 'Success', $data);
        } 
        else {
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
      
        /**
           * Members is Models -> from Models Members.php
           * $id id members
           * createApi -> function From Helpers ApiResponse.php
           */

         $data = Members::where('id', '=', $id)->get();

        if ($data) {
          return ApiResponse::createApi(200, 'Success', $data);
        } else {
          return ApiResponse::createApi(400, 'Failed');
        }
    }


     /**
     * UPDATE MEMBERS
     */

     public function membersUpdate(Request $request, $id) {

      try {
        $request -> validate([
          'username' => 'required',
          'address' => 'required'
        ]);

         /**
           * members is table database
           * Members is Models -> from Models Members.php
           * $id id members
           * createApi -> function From Helpers ApiResponse.php
           */
       $members = Members::findOrFail($id);

        $members -> update([
           'username' => $request->username,
           'address' => $request->address,
        ]);


        // GET DATA UPDATE UPDATE
        $data = Members::where('id', '=', $members->id)->get();

        if ($data) {
          return ApiResponse::createApi(200, 'Success', $data);
        } 
        else {
          return ApiResponse::createApi(400, 'Failed');
        }
     
        } catch (Exception $error) {
            return ApiResponse::createApi(400, 'Failed');
        }
     }


    /**
     * DELETE MEMBERS
     */
    public function membersDelete(string $id)
    {
      try {

        /**
        * members is table database
        * Members is Models -> from Models Members.php
        * $id id members
        * createApi -> function From Helpers ApiResponse.php
        */

       $members = Members::findOrFail($id);
       $data =  $members -> delete();

       if ($data) {
          return ApiResponse::createApi(200, 'Success Delete Members');
        } 
        else {
          return ApiResponse::createApi(400, 'Failed');
        }

      } catch (Exception $error) {
        return ApiResponse::createApi(400, 'Failed');
      }
    }
}
