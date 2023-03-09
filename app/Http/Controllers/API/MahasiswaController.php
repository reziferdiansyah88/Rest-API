<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Helpers\ApiResponse;
use Exception;
use Illuminate\Support\Facades\Validator;


class MahasiswaController extends Controller
{
    /**
     * GET ALL MAHASISWA
     */
    public function mahasiswaList()
    {
         /**
           * Mahasiswa is Models -> from Models Members.php
           * createApi -> function From Helpers ApiResponse.php
          */

        $data = Mahasiswa::all();
        if ($data) {
            return response()->json([
                'code' => 200,
                'message' => 'Successfully',
                'data' => $data,
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
               // 'nim' => ['required', Rule::unique('mahasiswa,nim')],
               'nim' => 'required',
               'name' => 'required',
               'address' => 'required',
               'email' => 'required'
            ],
            [
                // required validation
                'nim.required' => 'The nim field is required.',
                'name.required' => 'The name field is required.',
                'address.required' => 'The address field is required.',
                'email.required' => 'The email field is required.',

                // unique validation
                // 'nim.unique' => 'Sorry, this nim has already been taken',
                // 'name.unique' => 'Sorry, this name has already been taken',
                // 'address.unique' => 'Sorry, this address has already been taken',
                // 'email.unique' => 'Sorry, this email has already been taken'

            ]
        );

         if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 400);
        }

       try {

         /**
           * Mahasiswa is Models -> from Models Mahasiswa.php
           * createApi -> function From Helpers ApiResponse.php
           * mahasiswa is table database
          */

        $mahasiswa = Mahasiswa::create([
            'nim' => $request->nim,
            'name' => $request->name,
            'address' => $request->address,
            'email'=> $request->email,

        ]);
        $data = Mahasiswa::where('id', '=', $mahasiswa->id)->get();
        if ($data) {
            return response()->json([
                'code' => 200,
                'message' => 'Successfully',
                'data' => $data,
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
