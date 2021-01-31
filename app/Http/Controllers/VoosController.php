<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\VooCreateRequest;
use App\Http\Requests\VooUpdateRequest;
use App\Repositories\VooRepository;
use App\Services\UploadService;
use App\Entities\Piloto;

/**
 * Class VoosController.
 *
 * @package namespace App\Http\Controllers;
 */
class VoosController extends Controller
{
    /**
     * @var VooRepository
     */
    protected $repository;

    /**
     * @var VooValidator
     */
    protected $validator;


    protected $uploadService;

    /**
     * VoosController constructor.
     *
     * @param VooRepository $repository
     * @param VooValidator $validator
     */
    public function __construct(VooRepository $repository, UploadService $uploadService)
    {
        $this->repository = $repository;
        $this->uploadService = $uploadService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
    public function file_path($data){

       
        $path_info = str_replace(' ', '' , $data);
        
        $ext = pathinfo('storage/assets/images/VooImages/$path_info.jpg', PATHINFO_EXTENSION);
        
        return $path_info . '.' . $ext;
    }
    
    
     public function index()
    {
        $voos = $this->repository->all();
        $pilotos_list = Piloto::all()->pluck('nome_piloto', 'id');

        return view('admin.dashboard', [
            'pilotos_list' => $pilotos_list,
            'voos' => $voos,
        ]);
    }

    public function all()
    {
        $voo = $this->repository->all();

        return view('voo.all', [
            'voos' => $voo,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  VooCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
     
     public function store(Request $request)
    {
        try {
            
            $req = $request->all();
            $req['ativo'] = 1;

            $voo = $this->repository->create($req);
            
            $upload = $this->uploadService->Upload($request);


            $response = [
                'message' => 'Voo created.',
                'data'    => $voo,
            ];
            
            return redirect()->route('voo.index');

        } catch (ValidatorException $e) {

            return [
                'sucess' => true,
                'message' => $e->getMessageBag(),
            ];
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
        $voo = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $voo,
            ]);
        }

        return view('voos.show', compact('voo'));
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
        $voo = $this->repository->find($id);
        $pilotos_list = Piloto::all()->pluck('nome_piloto', 'id');

        return view('voo.edit', [
            'pilotos_list' => $pilotos_list,
            'voo' => $voo,
        ]);

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  VooUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(VooUpdateRequest $request, $id)
    {
        try {

            $voo = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Voo updated.',
                'data'    => $voo->toArray(),
            ];

            return redirect()->route('admin.dashboard');
        } catch (ValidatorException $e) {

            return $e->getMessageBag();
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

        
        return redirect()->route('admin.dashboard');
    }
}
