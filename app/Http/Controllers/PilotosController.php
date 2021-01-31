<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PilotoCreateRequest;
use App\Http\Requests\PilotoUpdateRequest;
use App\Repositories\PilotoRepository;
use App\Validators\PilotoValidator;

/**
 * Class PilotosController.
 *
 * @package namespace App\Http\Controllers;
 */
class PilotosController extends Controller
{
    /**
     * @var PilotoRepository
     */
    protected $repository;

    /**
     * @var PilotoValidator
     */
    protected $validator;

    /**
     * PilotosController constructor.
     *
     * @param PilotoRepository $repository
     * @param PilotoValidator $validator
     */
    public function __construct(PilotoRepository $repository, PilotoValidator $validator)
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
        $pilotos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $pilotos,
            ]);
        }

        return view('pilotos.index', compact('pilotos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PilotoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PilotoCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $piloto = $this->repository->create($request->all());

            $response = [
                'message' => 'Piloto created.',
                'data'    => $piloto->toArray(),
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
        $piloto = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $piloto,
            ]);
        }

        return view('pilotos.show', compact('piloto'));
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
        $piloto = $this->repository->find($id);

        return view('pilotos.edit', compact('piloto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PilotoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PilotoUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $piloto = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Piloto updated.',
                'data'    => $piloto->toArray(),
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
                'message' => 'Piloto deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Piloto deleted.');
    }
}
