<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Exception;
use Illuminate\Support\Facades\Validator;

/**
* No Helpers file 
* Response here
*/

class MahasiswaController extends Controller
{
    /**
     * GET ALL MAHASISWA
     */
    public function mahasiswaList(Request $request)
    {
         /**
           * Mahasiswa is Models -> from Models Members.php
          */
        // $dataMahasiswa = Mahasiswa::all();
        // $name = $request->input('name');
        // PAGINATION 10
        $dataMahasiswa = Mahasiswa::simplePaginate(10);

        if ($dataMahasiswa) {
            return response()->json([
                'code' => 200,
                'message' => 'Success',
                'data' => $dataMahasiswa,
           ], 200);
        }
        else {
          return response()->json([
                'code' => 400,
                'message' => 'Failed',
                'data' => null,
           ], 400);
        }
    }

    /**
     * CREATE MAHASISWA
     */
    public function mahasiswaCreate (Request $request) {
    $validator = Validator::make(
          $request->all(),
            [
              // required and unique => Unique validation check by model
               'nim' => 'required|unique:App\Models\Mahasiswa,nim',
               'name' => 'required|unique:App\Models\Mahasiswa,name',
               'address' => 'required',
               'email' => 'required|unique:App\Models\Mahasiswa,email'
            ],
            [
                // required validation
                'nim.required' => 'The nim field is required.',
                'name.required' => 'The name field is required.',
                'address.required' => 'The address field is required.',
                'email.required' => 'The email field is required.',
            ]
        );

        // response validation
         if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 400);
        }

       try {
         /**
           * Mahasiswa is Models -> from Models Mahasiswa.php
           * mahasiswa is table database
          */
        $mahasiswa = Mahasiswa::create([
            'nim' => $request->nim,
            'name' => $request->name,
            'address' => $request->address,
            'email'=> $request->email,

        ]);
        $dataMahasiswa = Mahasiswa::where('id', '=', $mahasiswa->id)->get();
        if ($dataMahasiswa) {
            return response()->json([
                'code' => 200,
                'message' => 'Success',
                'data' => $dataMahasiswa,
           ], 200);
        }
        else {
          return response()->json([
                'code' => 400,
                'message' => 'Failed',
                'data' => null,
           ], 400);
        }
       } catch (Exception $error) {
         return response()->json([
                'code' => 400,
                'message' => 'Failed',
                'data' => null,
           ], 400);
       }
   
      }

    /**
    * UPDATE MAHASISWA
    */
    public function mahasiswaUpdate(Request $request, $id) {
      $validator = Validator::make(
            $request->all(),
            // required and unique update
            [
               'nim' => 'required',
               'name' => 'required',
               'address' => 'required',
               'email' => 'required'
            ],
            [
                // required validation update
                'nim.required' => 'The nim field is required.',
                'name.required' => 'The name field is required.',
                'address.required' => 'The address field is required.',
                'email.required' => 'The email field is required.',
            ]
        );

        // response validation
         if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 400);
        }

       try {
        $mahasiswa = Mahasiswa::findOrFail($id);
         /**
           * Mahasiswa is Models -> from Models Mahasiswa.php
           * mahasiswa is table database
          */
        $mahasiswa -> update([
            'nim' => $request->nim,
            'name' => $request->name,
            'address' => $request->address,
            'email'=> $request->email,

        ]);

        $dataMahasiswa = Mahasiswa::where('id', '=', $mahasiswa->id)->get();
      
        if ($dataMahasiswa) {
            return response()->json([
                'code' => 200,
                'message' => 'Success',
                'data' => $dataMahasiswa,
           ], 200);
        }
        else {
          return response()->json([
                'code' => 400,
                'message' => 'Failed',
                'data' => null,
           ], 400);
        }
       } catch (Exception $error) {
         return response()->json([
                'code' => 400,
                'message' => 'Failed',
                'data' => null,
           ], 400);
       }

    }

    /**
    * DETAIL MAHASISWA
    */
    public function mahasiswaDetail(string $id) {
         /**
           * Mahasiswa is Models -> from Models Mahasiswa.php
          */
      $dataMahasiswa = Mahasiswa::where('id', '=', $id)->get();
       if ($dataMahasiswa) {
            return response()->json([
                'code' => 200,
                'message' => 'Success',
                'data' => $dataMahasiswa,
           ], 200);
        }
        else {
          return response()->json([
                'code' => 400,
                'message' => 'Failed',
                'data' => null,
           ], 400);
        }
      
    }

    /**
    * DELETE MAHASISWA
    */

  public function mahasiswaDelete(string $id)
    {
      try {

        /**
        * mahasiswa is table database
        * Mahasiswa is Models -> from Models Mahasiswa.php
        * $id id mahasiswa
        */

       $mahasiswa = Mahasiswa::findOrFail($id);
       $dataMahasiswa =  $mahasiswa -> delete();

       if ($dataMahasiswa) {
           return response()->json([
                'code' => 200,
                'message' => 'Success Delete Mahasiswa',
                'data' => null,
           ], 200);
        } 
        else {
         return response()->json([
                'code' => 400,
                'message' => 'Failed',
                'data' => null,
           ], 400);
        }

      } catch (Exception $error) {
          return response()->json([
                'code' => 400,
                'message' => 'Failed',
                'data' => null,
           ], 400);
      }
    }
}
