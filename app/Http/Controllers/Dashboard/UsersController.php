<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.pages.users');
    }

    public function getUsersDataTable()
    {
        $data = User::select('*');
        return DataTables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
            return $btn = '
                <a id="bEdit" data-id="' . $row->id .'" data-bs-target="#editmodal" data-bs-toggle="modal" href="javascript:void(0)" class="btn btn-sm btn-primary"> <span class="fe fe-edit"> </span></a>
                <a id="bDel" data-id="' . $row->id .'" data-bs-toggle="modal" href="javascript:void(0)" class="btn  btn-sm btn-danger"><span class="fe fe-trash-2"> </span></a>
            ';
        })->addColumn('status', function ($row) {
            return $row->status == null ? __('user.status_not_active') : ucfirst($row->status);
        })->rawColumns(['action', 'status'])->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->permissions,
        ]);


        return redirect()->route('dashboard.users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request)
    {
        $id = $request->id;

        if (is_numeric($id)) {
            User::query()->where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'status' => $request->permissions,
            ]);
        }

        return redirect()->route('dashboard.users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (is_numeric($id)) {
            User::find($id)->delete();
        }

        return redirect()->route('dashboard.users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        if (is_numeric($id)) {
            User::find($id)->delete();
        }

        return redirect()->route('dashboard.users.index');
    }

}
