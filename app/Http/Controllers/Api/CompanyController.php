<?php

namespace App\Http\Controllers\Api;

use App\Actions\Company\CompanyGetAction;
use App\Dto\Company\CompanyGetDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyIndexRequest;
use App\Http\Resources\CompanyCollection;

class CompanyController extends Controller
{
    /**
     * @param CompanyIndexRequest $request
     * @param CompanyGetAction $action
     * @return CompanyCollection
     */
    public function index(CompanyIndexRequest $request, CompanyGetAction $action): CompanyCollection
    {
        $dto = CompanyGetDto::fromRequest($request);

        return CompanyCollection::make($action->execute($dto));
    }
}
