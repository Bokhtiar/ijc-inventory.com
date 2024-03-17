<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompnayRequest;
use App\Http\Requests\CompnayUpdateRequest;
use App\Models\Company;
use App\Traits\HttpResponseTrait;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    use HttpResponseTrait;

    /** reosurce list without paginate */
    public function index()
    {
        $data = Company::latest()->where('status', 1)->get();
        return $this->HttpSuccessResponse('Company list.', $data, 200);   
    }

    /** resource store */
    public function store(CompnayRequest $request)
    {
        $company = Company::create([
            "name" => $request->name
        ]);
        return $this->HttpSuccessResponse('Company created.', $company, 201);   
    }

    /** resource store */
    public function show($id)
    {
        $company = Company::find($id);
        return $this->HttpSuccessResponse('Company details.', $company, 200);
    }

    /** resource update */
    public function update( CompnayUpdateRequest $request ,$id)
    {
        $company = Company::find($id);
        $data = $company->update([
            "name" => $request->name
        ]);
        return $this->HttpSuccessResponse('Company updated.', $data, 201);   
    }

    /** resource delete */
    public function destroy($id)
    {
       
        $company = Company::find($id);
        $company->delete();
        return $this->HttpSuccessResponse('Company deleted.', $company, 204);
    }
}
