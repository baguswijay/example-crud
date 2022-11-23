<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use DataTables;
use Exception;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function dt()
    {
        $users = DB::table('users')
            ->select([
                'users_id as id',
                'name',
                'email'
            ])
            ->whereNull('deleted_at');
        return DataTables::query($users)->addIndexColumn()->make(true);
    }

    public function store(Request $request)
    {
        try{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
            )];

            return response([
                "data"      =>$user,
                "message"   =>'Data Tersimpan'
            ], 200);
        }catch (Exception $e) {
            return response([
                "message"=>$e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::where('uuid', $id)->update([
                'name'  => $request->name,
                'email' => $request->email,
            ]);

            return response([
                "data"      => $user,
                "message"   => 'Data Terubah'
            ], 200);
        } catch (Exception $e) {
            return response([
                "message"=> $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::where('uuid', $id)->delete();

            return response([
                "message"   => 'Data Terhapus'
            ], 200);
        } catch (Exception $e) {
            return response([
                "message"=> $e->getMessage(),
            ], 500);
        }
    }
}
