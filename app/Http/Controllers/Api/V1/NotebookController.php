<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Notebook;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\V1\NotebookResource;
use App\Http\Resources\V1\NotebookCollection;
use App\Filters\V1\NotebooksFilter;
use App\Http\Requests\V1\StoreNotebookRequest;
use App\Http\Requests\V1\UpdateNotebookRequest;
use Illuminate\Support\Arr;
use App\Http\Requests\V1\BulkStoreNotebookRequest;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="L5 Notebook OpenApi",
 *      description="L5 Swagger OpenApi for Notebook",
 *      @OA\Contact(
 *          email="wolk0193@gmail.com"
 *      ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="https://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 * 
 * @OA\Get(
 *     path="/api/v1/notebooks/{id}",
 *     tags={"Notebooks"},
 *     @OA\Parameter(
 *         in="path",
 *         name="id",
 *         required=true,
 *     ),
 *     description="Home page",
 *     @OA\Response(response="200", description="Success"),
 *     @OA\Response(response="404", description="Not Found"),
 * )
 * 
 * @OA\Get(
 *     path="/api/v1/notebooks",
 *     tags={"Notebooks"},
 *     description="Home page",
 *     @OA\Response(response="200", description="Success"),
 *     @OA\Response(response="404", description="Not Found"),
 * )
 * 
 * @OA\Post (
 *      path="/api/v1/notebooks",
 *      tags={"Notebooks"},
 *      @OA\RequestBody(
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              @OA\Schema(
 *                  @OA\Property(
 *                      type="object",
 *                      @OA\Property(
 *                          property="name",
 *                          type="string"
 *                      ),
 *                      @OA\Property(
 *                          property="phone",
 *                          type="string"
 *                      ),
 *                      @OA\Property(
 *                          property="email",
 *                          type="email"
 *                      ),
 *                      @OA\Property(
 *                          property="birth_date",
 *                          type="date"
 *                      ),
 *                      @OA\Property(
 *                          property="photo",
 *                          type="string"
 *                      ),
 *                      @OA\Property(
 *                          property="company",
 *                          type="string"
 *                      )
 *                  ),
 *                  example={
 *                      "name": "example name",
 *                      "phone": "836518294",
 *                      "email": "test@mail.test",
 *                      "birthDate": "1999-11-11 11:11:11",
 *                      "photo": "photo.jpg",
 *                      "company": "company name"
 *                  }
 *              )
 *          )
 *      ),
 *      @OA\Response(response=200, description="Success"),
 *      @OA\Response(response="404", description="Not Found")
 * )
 * 
 * @OA\Post (
 *      path="/api/v1/notebooks/bulk",
 *      description="Use an array of objects to insert several items at once",
 *      tags={"Notebooks"},
 *      @OA\RequestBody(
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              @OA\Schema(
 *                  @OA\Property(
 *                      type="object",
 *                      @OA\Property(
 *                          property="name",
 *                          type="string"
 *                      ),
 *                      @OA\Property(
 *                          property="phone",
 *                          type="string"
 *                      ),
 *                      @OA\Property(
 *                          property="email",
 *                          type="email"
 *                      ),
 *                      @OA\Property(
 *                          property="birth_date",
 *                          type="date"
 *                      ),
 *                      @OA\Property(
 *                          property="photo",
 *                          type="string"
 *                      ),
 *                      @OA\Property(
 *                          property="company",
 *                          type="string"
 *                      )
 *                  ),
 *                  example={
 *                      "name": "example name",
 *                      "phone": "836518294",
 *                      "email": "test@mail.test",
 *                      "birthDate": "1999-11-11 11:11:11",
 *                      "photo": "photo.jpg",
 *                      "company": "company name"
 *                  }
 *              )
 *          )
 *      ),
 *      @OA\Response(response=200, description="Success"),
 *      @OA\Response(response="404", description="Not Found")
 * )
 * 
 * @OA\Put (
 *      path="/api/v1/notebooks/{id}",
 *      tags={"Notebooks"},
 *      @OA\Parameter(
 *          in="path",
 *          name="id",
 *          required=true,
 *      ),
 *      @OA\RequestBody(
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              @OA\Schema(
 *                  @OA\Property(
 *                      type="object",
 *                      @OA\Property(
 *                          property="name",
 *                          type="string"
 *                      ),
 *                      @OA\Property(
 *                          property="phone",
 *                          type="string"
 *                      ),
 *                      @OA\Property(
 *                          property="email",
 *                          type="email"
 *                      ),
 *                      @OA\Property(
 *                          property="birth_date",
 *                          type="date"
 *                      ),
 *                      @OA\Property(
 *                          property="photo",
 *                          type="string"
 *                      ),
 *                      @OA\Property(
 *                          property="company",
 *                          type="string"
 *                      )
 *                  ),
 *                  example={
 *                      "name": "example name",
 *                      "phone": "836518294",
 *                      "email": "test@mail.test",
 *                      "birthDate": "1999-11-11 11:11:11",
 *                      "photo": "photo.jpg",
 *                      "company": "company name"
 *                  }
 *              )
 *          )
 *      ),
 *      @OA\Response(response=200, description="Success"),
 *      @OA\Response(response="404", description="Not Found")
 * )
 * 
 * @OA\Patch (
 *      path="/api/v1/notebooks/{id}",
 *      tags={"Notebooks"},
 *      @OA\Parameter(
 *          in="path",
 *          name="id",
 *          required=true,
 *      ),
 *      @OA\RequestBody(
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              @OA\Schema(
 *                  @OA\Property(
 *                      type="object",
 *                      @OA\Property(
 *                          property="name",
 *                          type="string"
 *                      ),
 *                      @OA\Property(
 *                          property="phone",
 *                          type="string"
 *                      ),
 *                      @OA\Property(
 *                          property="email",
 *                          type="email"
 *                      ),
 *                      @OA\Property(
 *                          property="birth_date",
 *                          type="date"
 *                      ),
 *                      @OA\Property(
 *                          property="photo",
 *                          type="string"
 *                      ),
 *                      @OA\Property(
 *                          property="company",
 *                          type="string"
 *                      )
 *                  ),
 *                  example={
 *                      "name": "example name",
 *                      "email": "test@mail.test",
 *                      "company": "company name"
 *                  }
 *              )
 *          )
 *      ),
 *      @OA\Response(response=200, description="Success"),
 *      @OA\Response(response="404", description="Not Found")
 * )
 * 
 * @OA\Delete(
 *     path="/api/v1/notebooks/{id}",
 *     tags={"Notebooks"},
 *     @OA\Parameter(
 *         in="path",
 *         name="id",
 *         required=true,
 *     ),
 *     description="Home page",
 *     @OA\Response(response="200", description="Success"),
 *     @OA\Response(response="404", description="Not Found"),
 * )
 */

class NotebookController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // ?????????????? ?????? ????????????, ???????? ?????? ????????????????, ???????? ?????????????? ?????????????????????????????? ????????????
        $filter = new NotebooksFilter();
        $filterItems = $filter->transform($request); // ['column', 'operator', 'value']

        if (count($filterItems) == 0) {
            return new NotebookCollection(Notebook::paginate());
        } else {
            $notebooks = Notebook::where($filterItems)->paginate();
            return new NotebookCollection($notebooks->appends($request->query())); // ???????????? ?????????????????? ???? ???????????? ????????????
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNotebookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNotebookRequest $request)
    {
        // ???????????? ???????????? ?? ????. POST ????????????
        return new NotebookResource(Notebook::create($request->all()));
    }

    public function bulkStore(BulkStoreNotebookRequest $request)
    {
        // ???????????? ???????????? ?? ???? ?????????? ?????????????????? ????????????. ???????????? ????????????????. ?????????? ?? ???????????? ?????????????? ???????????????? birthDate ???? birth_date ?????? ????????????.
        $bulk = collect($request->all())->map(function($arr, $key) {
            return Arr::except($arr, ['birthDate']);
        });

        Notebook::insert($bulk->toArray());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notebook  $notebook
     * @return \Illuminate\Http\Response
     */
    public function show(Notebook $notebook)
    {
        // ?????????????? ???? {id}
        return new NotebookResource($notebook);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNotebookRequest  $request
     * @param  \App\Models\Notebook  $notebook
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNotebookRequest $request, Notebook $notebook)
    {
        // PUT ?? PATCH ??????????????
        $notebook->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notebook  $notebook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notebook $notebook)
    {
        // ?????????????? ???????????? ???? {id}
        $notebook->delete();
    }
}
