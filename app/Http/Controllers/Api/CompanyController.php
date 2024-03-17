<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Traits\HttpResponseTrait;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    use HttpResponseTrait;

    public function index()
    {
        $data = Company::latest()->where('status', 1)->get();
        return $this->HttpSuccessResponse('Company list', $data, 200);   
    }
}
