<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class RestProjectsController extends Controller
{
    //

    public function index(request $request) {

        $projects = Project::query();
        $projects->when( $request->search, function( $query ){
            return $query->where( request('searchBy'), 'like', '%' . request('search') . '%' );
        }, function( $query ) {
            return $query->where('client', 'like', '%' . request('search') . '%');
        });

        $projects->when( $request->order, function($query, $order){
            $query->orderBy(request('orderBy'), $order);
        }, function( $query ){
            $query->orderBy('id', 'DESC');
        });





        return $projects->paginate( 20 )->appends([
            'order' => $request->order,
            'orderBy' => $request->orderBy,
            'search' => $request->search,
            'searchBy' => $request->searchBy,
        ]);
    }
}
