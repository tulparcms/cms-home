<?php

namespace App\Http\Controllers;

use App\Models\TcmsHome;
use FastRoute\Route;
use Illuminate\Http\Request;

class TcmsHomeController extends Controller{
    public function index(Request $request)
    {
        $data['deneme']=1;
        return TCMS()->loadAdminTemplate(  'admin.index', $data, HOME_FOLDER);
    }
}
