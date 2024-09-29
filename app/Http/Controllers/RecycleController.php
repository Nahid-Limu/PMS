<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recycle;
use App\Models\Project;
use DB;
use Validator;

class RecycleController extends Controller
{
    // recycleProjectList Function 
    function recycleProjectList()  
    {
        // $RecycleProjects = Project::whereNotNull('deleted_at')->get();
        $RecycleProjects = DB::table('projects')
                ->whereNotNull('deleted_at')
                ->get(['id','project_name','deleted_at']);
        // dd($RecycleProjects);

        if(request()->ajax())
        {
            return datatables()->of($RecycleProjects)

                    ->editColumn('deleted_at', function ($data) {
                        return date('j F , Y', strtotime($data->deleted_at));
                    })
                    
                    ->addColumn('action', function($data){
            
                        $button = '<div class="d-flex justify-content-center"><button type="button" onclick="restoreData('.$data->id.')" name="restore" id="'.$data->id.'" class="edit btn btn-outline-info btn-sm " ><i class="bx bx-reset"> Restore</i></button>';
                        
                        return $button;
                    })
                    // ->rawColumns(['description','document','pulish_date','action'])
                    ->rawColumns(['deleted_at','action'])
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('recycle.recycleProjectList');
    }

        // Project Restore Function 
        public function projectRestore($id)
        {
            
            $Project = Project::withTrashed()->find($id);
            // dd($Project);

            if ($Project) {
                $Project->restore();
                return response()->json(['success' => 'Project Restore Successfully....!!!']);
            } else {
                return response()->json(['failed' => 'Project Restore failed.']);
            }
        }
}
