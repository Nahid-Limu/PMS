<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use DB;
use Validator;

use Mail;
use auth;

class ProjectController extends Controller
{
    private $fixed_mail_to_support = "theboss@email.com";
    private $sub_for_support = "Project Update";

    // Index Function 
    function projectList()  
    {
        $Project = Project::all(['id','project_name','project_description','project_assisgnTostaff','project_fileUpload','status']);
        // dd($Project);

        if(request()->ajax())
        {
            return datatables()->of($Project)

                    ->addColumn('project_fileUpload', function($data){
                        $url= asset('adminAssets/projectfile').'/'.$data->project_fileUpload; 
                        $button = " <a href='$url' type='button' class='btn btn-sm btn-outline-info'> <i class='bx bx-download'></i> Download</a>  ";
                        // $button .= '&nbsp;&nbsp;';
                        return $button;   
                    })

                    // ->editColumn('pulish_date', function ($data) {
                    //     return date('j F , Y', strtotime($data->pulish_date));
                    // })

                    ->editColumn('project_description', function ($data) {
                        $description = html_entity_decode($data->project_description);
                        return $description;
                    })

                    ->addColumn('status', function($data){
                        if ($data->status == 1) {
                            $button = " <a href='' type='button' class='btn btn-sm btn-success'> <i class='bx bx-check-circle'></i> Active</a>  ";
                        }
                        if ($data->status == 2) {
                            $button = " <a href='' type='button' class='btn btn-sm btn-danger'> <i class='bx bx-stop-circle'></i> InActive</a>  ";
                        }
                        if ($data->status == 3) {
                            $button = " <a href='' type='button' class='btn btn-sm btn-warning'> <i class='bx bx-pause-circle'></i> Hold</a>  ";
                        }
                        // $url= asset('adminAssets/projectfile').'/'.$data->status; 
                        // $button = " <a href='$url' type='button' class='btn btn-sm btn-outline-info'> <i class='bx bx-download'></i> Download</a>  ";
                        // $button .= '&nbsp;&nbsp;';
                        return $button;   
                    })
                    
                    ->addColumn('action', function($data){
            
                        $button = '<div class="d-flex justify-content-center"><button type="button" onclick="editData('.$data->id.')" name="edit" id="'.$data->id.'" class="edit btn btn-outline-success btn-sm " data-bs-toggle="modal" data-bs-target="#EditProjectModal" ><i class="bx bx-edit"> Edit</i></button>';
                        $button .= '&nbsp<button type="button" onclick="deleteModal('.$data->id.',\''.$data->project_name.'\',\'Project List\')" name="delete" id="'.$data->id.'" class="delete btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#DeleteModal" ><i class="bx bx-trash"> Delete</i></button></div>';
                        
                        return $button;
                    })
                    // ->rawColumns(['description','document','pulish_date','action'])
                    ->rawColumns(['project_description','project_fileUpload','status','action'])
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('project.projectList');
    }

    public function projectAdd(Request $request)
    {
        // dd($request->all());
        //validation [start]

        $rules = array(
            'project_name'    =>  'required',
            'project_description'     =>  'required',
            'project_assisgnTostaff'    =>  'required',
            'fileUpload' => 'required | file | mimes:pdf,doc,docx,text/plain | max:2048',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        //validation [end]

        if ($request->hasFile('fileUpload')) {

            //email data

                $data = array(
                    'senderName' => Auth::user()->name,
                    'senderEmail' => Auth::user()->email, 
                    'msg' => "Project [".$request->project_name."] is Created Successfully !!!",
                    'dateTime' => date('l jS \of F Y h:i A')
                );

                $name = Auth::user()->name;
                // for multiple email start
                    // $toemails  = [$this->mail_to, 'nahidcse244@gmail.com'];
                    $input_mail_to = Auth::user()->email;
                // for multiple email end

            //email data end
            
            $Project = new Project;

            // $Event->title = ucwords($request->title);
            $Project->project_name = $request->project_name;
            $Project->project_description =$request->project_description;
            $Project->project_assisgnTostaff =$request->project_assisgnTostaff;
            // $Project->project_fileUpload =$request->description;

                $document = $request->file('fileUpload');

                $filename = $request->project_name.'.'.$document->getClientOriginalExtension();
                $document->move(public_path().'/adminAssets/projectfile', $filename);  

            $Project->project_fileUpload =$filename;
            $Project->save();

            if ($Project->id) {

                // mail for Support start 
                    Mail::send('emailTemplate', $data, function ($message) use ($input_mail_to ,$name) {
                            
                        $message->to($this->fixed_mail_to_support)
                        ->subject($this->sub_for_support)->from($input_mail_to);
        
                    });
                // mail for Support end
                
                return response()->json(['success' => 'Project Added successfully.']);
            } else {
                return response()->json(['failed' => 'Project Added failed.']);
            }


        }
    }

    // Edit Data view Function 
    public function projectEdit($id)
    {
        $Project = Project::find($id);
        return response()->json($Project);
    }

    // Update Data Function 
    public function projectUpdate(Request $request)
    {
        // dd($request->all());

        //email data

            if ($request->status == 1) {
                $status = "Active";
            }elseif($request->status == 2){
                $status = "InActive";
            }elseif($request->status == 3){
                $status = "Hold";
            }

            $data = array(
                'senderName' => Auth::user()->name,
                'senderEmail' => Auth::user()->email, 
                'msg' => "Project [".$request->project_name."] is now ".$status,
                'dateTime' => date('l jS \of F Y h:i A')
            );

            $name = Auth::user()->name;
            // for multiple email start
                // $toemails  = [$this->mail_to, 'nahidcse244@gmail.com'];
                $input_mail_to = Auth::user()->email;
            // for multiple email end

        //email data end

        $Project = Project::find($request->id);
        // $Notice->title = ucwords($request->title);
        $Project->project_name = $request->project_name;
        $Project->project_description =$request->project_description;
        $Project->project_assisgnTostaff =$request->project_assisgnTostaff;
        $Project->status =$request->status;

        $Project->save();

        if ($Project->id) {
            
            // mail for Support start 
                Mail::send('emailTemplate', $data, function ($message) use ($input_mail_to ,$name) {
                        
                    $message->to($this->fixed_mail_to_support)
                    ->subject($this->sub_for_support)->from($input_mail_to);
    
                });
            // mail for Support end


            return response()->json(['success' => 'Project Update successfully.']);
        } else {
            return response()->json(['failed' => 'Project Update failed.']);
        }
        
    }


    // Delete Data Function 
    public function projectDelete($id)
    {
        $Project = Project::find($id);
        
        if ($Project) {
            $Project->delete();
            return response()->json(['success' => 'Project Delete Successfully....!!!']);
        } else {
            return response()->json(['failed' => 'Project Delete failed.']);
        }
    }
}
