<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class CategoriesController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.categories');
    }

    public function getUsersDataTable()
    {
        $data = Category::select('*')->with('parents');
        return DataTables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
            return $btn = '
                <a id="bEdit" data-id="' . $row->id . '" data-bs-target="#editmodal" data-bs-toggle="modal" href="javascript:void(0)" class="btn btn-sm btn-primary">
                    <span class="fe fe-edit"> </span>
                </a>

                <a id="bDel" data-id="' . $row->id . '" data-bs-toggle="modal" href="javascript:void(0)" class="btn  btn-sm btn-danger">
                    <span class="fe fe-trash-2"> </span>
                </a>
            ';
        })->addColumn('parent', function ($row) {
            return $row->parent == 0 ? __('category.main_category') : $row->parents->translate(app()->getLocale())->title;
        })->rawColumns(['action', 'parent'])->make(true);
    }

    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->except('img'));

        if ($request->file('img')) {
            $file = $request->file('img');
            $filename = Str::uuid() . $file->getClientOriginalName();
            $file->move(public_path('images/categories/'), $filename);
            $path = 'images/categories/' . $filename;
            $category->update(['img' => $path]);
        }

        return redirect()->route('dashboard.categories.index');
    }

    public function update(CategoryRequest $request)
    {
        $category = Category::find($request->id)->update($request->except('img', '_token'));

        if ($request->file('img')) {
            $file = $request->file('img');
            $filename = Str::uuid() . $file->getClientOriginalName();
            $file->move(public_path('images/categories/'), $filename);
            $path = 'images/categories/' . $filename;
            $category->update(['img' => $path]);
        }

        return redirect()->route('dashboard.categories.index');
    }

    public function destroy(string $id)
    {
        if (is_numeric($id)) {
            Category::find($id)->delete();
        }

        return redirect()->route('dashboard.users.index');
    }

}
