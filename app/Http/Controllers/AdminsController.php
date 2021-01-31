<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AdminCreateRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Repositories\AdminRepository;
use App\Validators\AdminValidator;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Auth;
use Session;
use Exception;
use App\Entities\Piloto;
use Sentinel;
use Reminder;
use App\Entities\Admin;
use Mail;
use Cookie;


/**
 * Class AdminsController.
 *
 * @package namespace App\Http\Controllers;
 */
class AdminsController extends Controller
{
    /**
     * @var AdminRepository
     */
    protected $repository;

    /**
     * @var AdminValidator
     */
    protected $validator;

    /**
     * AdminsController constructor.
     *
     * @param AdminRepository $repository
     * @param AdminValidator $validator
     */
    public function __construct(AdminRepository $repository, AdminValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //forgot pass/email sender functions
     public function Forgotpass(){
        return view('admin.forgot');
     }

     public function dealForgot(Request $request){
        $admin = Admin::whereEmail($request->username)->first();
       
        // *OPTIONAL* \\
        //$user = Sentinel::findById($admin->id);
        //$reminder = Reminder::exists($user) ?: Reminder::create($user);
        // *OPTIONAL* \\

        $email = $this->sendEmail($admin);
        
        return view('admin.login');;
    }


    public function sendEmail($admin){
        Mail::send(
            'email.forgot',
            ['admin' => $admin ],
            function($message) use ($admin){
                $message->to($admin->email);
                $message->subject("Hello" . " Type your new password on this link, enjoy (:");
                
            }
        );
    }
    //
    
    //Reset Password functions
    public function FormResetPassword($id){
        $admin = Admin::find($id);
        
        return view('admin.reset-form', ['admin' => $admin]);
     }



    public function resetPassword(Request $request, $id){
        try {
            $admin = Admin::find($id);
            
            $admin->fill(['password' => $request->get('password')]);
            $admin->save();
            $response = [
                'message' => 'Password updated.',
                'data'    => $admin,
            ];

            return redirect()->route('admin.dashboard');
        } catch (ValidatorException $e) {

            return $e->getMessageBag();
        }
     }
     //
     
     //Login Functions
    public function login(){
        return view('admin.login');
    }


    public function auth(Request $request){
        $Admindata = [
            'email' => $request->get('username'),
            'password' => $request->get('password')
        ];

       try{
        if(env('PASSWORD_HASH')){
            Auth::attempt($Admindata, false);
        } else 
        {
            $Admin = $this->repository->findWhere(['email' => $request->get('username')])-> first() ;

            if(!$Admin){
                echo "Email Invalido";
                throw new Exception("Email Informado é invalido");
            } 

            if($Admin->password != $request->get('password')){
                echo "Senha Invalida";
                throw new Exception("Senha Informada é invalida");
            }
            
            Auth::login($Admin);
        }
            
            return redirect() -> route('admin.dashboard');
       } catch(Exception $e){
            $e->getMessage();
       }

    }
    //


    //logout functions
    public function logout(){
        
        Auth::logout();
        Session::flush();
        return redirect('admin/login');
        
    }
    
    protected function guard(){
        return Auth::guard('admin');
    }
    //

    public function index()
    {
        $admins = $this->repository->all();
        $pilotos_list = Piloto::all()->pluck('nome_piloto', 'id');;

        if (Auth::check()){
        return view('admin.Dashboard', [
            'pilotos_list' => $pilotos_list
        ]);
    } else {
        return redirect()->route('admin.login');
    }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AdminCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(AdminCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $admin = $this->repository->create($request->all());

            $response = [
                'message' => 'Admin created.',
                'data'    => $admin->toArray(),
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
        $admin = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $admin,
            ]);
        }

        return view('admins.show', compact('admin'));
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
        $admin = $this->repository->find($id);

        return view('admins.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AdminUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(AdminUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $admin = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Admin updated.',
                'data'    => $admin->toArray(),
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
                'message' => 'Admin deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Admin deleted.');
    }

  /*protected function loggedOut(Request $request)
    {
        return redirect('/admin/login');
    }*/

  //Alternative Method for non principal DB table
        /*$this->guard()->logout();

        $request->session()->invalidate();
        Session::flush();

        return $this->loggedOut($request) ?: redirect('/');*/

}
