<?php

namespace App\Http\Controllers;

use App\Models\StudentCompl;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function AllComplaints(){
        $complaints = StudentCompl::latest()->get();
        return view('admin_user.all_complaints', compact('complaints'));
    }
}
