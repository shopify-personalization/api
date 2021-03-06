<?php

namespace ETest\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use ETest\Http\Requests\Admin\QuestionTestCreateRequest;
use ETest\Http\Requests\Admin\QuestionTestUpdateRequest;
use ETest\Http\Resources\Admin\QuestionTestResource;
use ETest\Http\Resources\Admin\QuestionTestResourceCollection;
use ETest\Http\Services\Admin\QuestionTestService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class QuestionTestAdminController extends Controller
{
    private $service;

    public function __construct(QuestionTestService $service)
    {
        $this->service = $service;
    }

	/**
     * Paginate
     * @group QuestionTest
     * @authenticated
     *
     * @queryParam id required The fund id. Example: 1
     *
     * @response {
     * "data": [
     *   {
     *    "id": 10,
     *    "created_at": "2019-09-04 10:43:47",
     *    "updated_at": "2019-09-04 10:43:47"
     *   },
     *   {
     *    "id": 9,
     *    "created_at": "2019-09-04 08:56:43",
     *    "updated_at": "2019-09-04 08:56:43"
     *   }
     *  ],
     *  "links": {
     *     "first": "{url}?page=1",
     *     "last": "{url}?page=1",
     *     "prev": null,
     *     "next": null
     *  },
     *  "meta": {
     *     "current_page": 1,
     *     "from": 1,
     *     "last_page": 1,
     *     "path": "{url}",
     *     "per_page": 10,
     *     "to": 2,
     *     "total": 2
     *   }
     * }
     */
    public function index(Request $request)
    {
        try {
            $input = $request->all();
            $questionTest = $this->service->index($input);

            return new QuestionTestResourceCollection($questionTest);
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }

	/**
     * Create
     * @group QuestionTest
     * @authenticated
     *
     * @bodyParam is_active int required The is active. Example: 1
     *
     * @response {
     *  "is_active": 0,
     *  "updated_at": "2019-09-05 02:34:34",
     *  "created_at": "2019-09-05 02:34:34",
     *  "id": 11
     * }
     *
     */
    public function store(QuestionTestCreateRequest $request)
    {
        try {
            $input = $request->all();
            $questionTest = $this->service->store($input);

            return response()->json(new QuestionTestResource($questionTest));
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }

	/**
     * Show
     * @group QuestionTest
     * @authenticated
     *
     *
     * @response {
     *  "is_active": 0,
     *  "updated_at": "2019-09-05 02:34:34",
     *  "created_at": "2019-09-05 02:34:34",
     *  "id": 11
     * }
     *
     */
    public function show($id)
    {
        try {
            $questionTest = $this->service->show($id);

            return response()->json(new QuestionTestResource($questionTest));
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }

	/**
     * Update
     * @group QuestionTest
     * @authenticated
     *
     * @bodyParam is_active int optional The is active. Example: 1
     *
     * @response {
     *  "is_active": 0,
     *  "updated_at": "2019-09-05 02:34:34",
     *  "created_at": "2019-09-05 02:34:34",
     *  "id": 11
     * }
     *
     */
    public function update(QuestionTestUpdateRequest $request, $id)
    {
        $input = $request->all();
        try {
            $questionTest = $this->service->update($input, $id);

            return response()->json(new QuestionTestResource($questionTest));
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }

	/**
     * Destroy
     * @group QuestionTest
     * @authenticated
     *
     * @response {
     *  "is_active": 0,
     *  "updated_at": "2019-09-05 02:34:34",
     *  "created_at": "2019-09-05 02:34:34",
     *  "id": 11
     * }
     *
     */
    public function destroy($id)
    {
        try {
            $questionTest = $this->service->destroy($id);

            return response()->json(new QuestionTestResource($questionTest));
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }
}
