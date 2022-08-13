<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::when($request->input('sortBy'),function($query) use($request) {
            $request->input('sortDesc') == "true" ? $query->orderByDesc($request->input('sortBy')) : $query->orderBy($request->input('sortBy'));
        })->when($request->input('name'),function($query) use($request) {
            $query->where('name','LIKE','%'.$request->input('name').'%');
        })->when($request->input('username'),function($query) use($request) {
            $query->where('username','LIKE','%'.$request->input('username').'%');
        })->when($request->input('type'),function($query) use($request) {
            $query->where('type',$request->input('type'));
        })->when($request->input('global'),function($query) use($request) {
            $query->where('name','LIKE','%'.$request->input('global').'%')->orWhere('username','LIKE','%'.$request->input('global').'%');
        })->paginate(10)->withQueryString();
        return Inertia::render('Users/Index',[
            'records' => $users
        ])->table();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
            'username' => 'required',
            'type' => 'required|in:USER,ADMIN,SUPERADMIN',
        ]);

        User::create([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'type' => $request->input('type')
        ]);

        return redirect()->back()->with('success','با موفقیت انجام شد');
    }
}
