<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return view('projects.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();



        $project = Project::create( $data );

        return redirect('projects')->with([
            'status'    => 200,
            'message'   => 'Berhasil!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $row = Project::find($id);


        return view('projects.edit', [
            'row' => $row
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project, $id)
    {
        //
        $data = $request->except([ '_method' ]);

        //abort_if( ! $permohonan, 403, 'Forbidden' );

        $find = $project->find( $id );

        foreach($data as $key => $value) {
            $find->{$key} = $value;
        }


        $permohonanBaru = $find->save();

        return redirect('projects')->with([
            'status'    => 200,
            'message'   => 'Berhasil!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {

            $find = Project::findOrFail( $id );
            $find->delete();

            return redirect('projects')->with([
                'status'    => 200,
                'message'   => 'Berhasil!'
            ]);

        }
        catch( \Exception $e ) {

            return redirect('projects')->with([
                'status'    => 400,
                'message'   => $e->getMessage()
            ]);

        }





    }

    public function orders( $id ) {
        return [];
    }
}
