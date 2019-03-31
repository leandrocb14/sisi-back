<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PolygonCreateRequest;
use App\Http\Requests\PolygonUpdateRequest;
use App\Repositories\PolygonRepository;
use App\Validators\PolygonValidator;

/**
 * Class PolygonsController.
 *
 * @package namespace App\Http\Controllers;
 */
class PolygonsController extends Controller
{
    /**
     * @var PolygonRepository
     */
    protected $repository;

    /**
     * @var PolygonValidator
     */
    protected $validator;

    /**
     * PolygonsController constructor.
     *
     * @param PolygonRepository $repository
     * @param PolygonValidator $validator
     */
    public function __construct(PolygonRepository $repository, PolygonValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $polygons = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $polygons,
            ]);
        }

        return view('polygons.index', compact('polygons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PolygonCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PolygonCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $polygon = $this->repository->create($request->all());

            $response = [
                'message' => 'Polygon created.',
                'data'    => $polygon->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $polygon = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $polygon,
            ]);
        }

        return view('polygons.show', compact('polygon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $polygon = $this->repository->find($id);

        return view('polygons.edit', compact('polygon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PolygonUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PolygonUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $polygon = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Polygon updated.',
                'data'    => $polygon->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Polygon deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Polygon deleted.');
    }
}
