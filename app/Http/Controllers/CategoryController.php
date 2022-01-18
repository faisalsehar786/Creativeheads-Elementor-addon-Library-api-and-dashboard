<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use DataTables;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '
                                <a href="javascript:void(0)" class="edit btn btn-primary btn-sm" data_id='.$row->id.'>Edit</a> | 
                               <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data_id='.$row->id.'>Delete</a>';
    
                            return $btn;
    
                           
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('category');  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
        'name' => 'required|unique:categories',
       
    ]);
    
        $status=Category::create(['name'=>$request->name]);
        if ($status) {
          return redirect()->back()->with('message','Record Add Successfully');
        }else{
            return redirect()->back()->with('error','Error'); 
        }
    }  

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
    
    
    
        $status=Category::where('id',$request->post_id)->update(['name'=>$request->name]);
        if ($status) {
          return redirect()->back()->with('message','Record Update Successfully');
        }else{
            return redirect()->back()->with('error','Error'); 
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $status=Category::where('id',$request->op_id)->delete();

         if ($status) {
          return json_encode(['status'=>'ok']);
        }
    
    }
}
