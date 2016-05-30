<?php

class LoginController extends \BaseController
{

    /**
     * Display a listing of the resource.
     * GET /login
     *
     * @return Response
     */
    public function index()
    {
        return view('login.index');
    }

    /**
     * Show the form for creating a new resource.
     * GET /login/create
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * POST /login
     *
     * @return Response
     */
    public function store()
    {
        $user = array(
            'email'    => Input::get('email'),
            'password' => Input::get('password')
        );

        if (Auth::attempt($user)) {
            return Redirect::intended('admin/dashboard')->with('success', 'Vous êtes connecté');
        }

        // authentication failure! lets go back to the login page
        return redirect('login')
            ->with(array('status' => '!' , 'message' => 'Les identifiants email / mot de passe sont incorrects'))
            ->withInput();

    }

    /**
     * Display the specified resource.
     * GET /login/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * GET /login/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * PUT /login/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /login/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy()
    {
        Auth::logout();
        return redirect('/');
    }
}
