<?php

namespace App\Http\Controllers;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response(UserResource::collection(User::all()),200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$request=json_ecode($request);
        // echo $request["information"]; die;
        $data = $request->validate([
            "name"=>"required",
            "password"=>"required",
            "information"=>"required"
        ]);
        return response(new UserResource(User::create($data)),200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // return response(["message"=>$request->input("name")],200);die();
    
        $user=User::where("name",$request->name)->first();
        if($user){
        if (Hash::check($request->password, $user->password)){
            return response(new UserResource($user),200);
        }
       
        else{
         return response(["message"=>"invalid password/username"],404);
        }
    }
    
    else{
        return response(["message"=>"user not found"],400);
       }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {
        $user=User::where("name",$request->name)->first();
        $data = $request->validate([
            "name"=>"required",
            "password"=>"required",
            "information"=>"required"
        ]);

        $user->update($data);

        return response(new UserResource($user),201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $response)
    {
        $user=User::where("name",$response->name)->first();
       
        if($user){
        
            $user->destroy();

            return response(null,204);
        }
        else{
         return response(["message"=>"no-results"],404);
        }
        
    }
}
