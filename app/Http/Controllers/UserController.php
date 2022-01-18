<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use Illuminate\Support\Facades\Hash; 
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        if ($row->role=='admin') {
                          $btn = '
                                <a href="javascript:void(0)" class="edit btn btn-primary btn-sm" data_id='.$row->id.'>Edit</a> '; 
                               
                        }else{


                            $btn = '
                                <a href="javascript:void(0)" class="edit btn btn-primary btn-sm" data_id='.$row->id.'>Edit</a> | 
                               <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data_id='.$row->id.'>Delete</a>';
                        }
                         
    
                          
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('users');
    }




    public function store(Request $request){




        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required'],
        ]);
   
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'passwordtext' =>$request->password,
            'password' => Hash::make($request->password),
        ]);

        if ($user) {
          return redirect()->back()->with('message','Record Add Successfully');
        }else{
            return redirect()->back()->with('error','Error'); 
        }

    }

 public function update(Request $request)
    {
    
       
    
        $status=User::where('id',$request->post_id)->update([
            'name' => $request->name,
            'passwordtext' =>$request->password,
            'password' => Hash::make($request->password)]);
        if ($status) {
          return redirect()->back()->with('message','Record Update Successfully');
        }else{
            return redirect()->back()->with('error','Error'); 
        }

    }

     public function destroy(Request $request)
    {

        $status=User::where('id',$request->op_id)->delete();

         if ($status) {
          return json_encode(['status'=>'ok']);
        }
    
    }
}