<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Models\Category;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\File;
class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        
        if ($request->ajax()) {

        if (!empty($request->cat) ||!empty($request->ispro) ){

         $model = Template::with('category');

          if ($request->cat=='all') {
               
            }else{
              $model->where('cat_id',$request->cat);
            }

            if ($request->ispro=='all') {
            
            }else{

                 $model->where('is_pro',$request->ispro);
            }

        }else{

        $model = Template::with('category');

        }
           
          
           
            
              
                return DataTables::eloquent($model)
                ->addColumn('category', function (Template $template) {
                    return "<label class='label-bg-success'>".$template->category->name."<label>";  
                })->addIndexColumn()
                ->addColumn('image', function($row){
                               $img = '<img src="'.asset('tempimages/').'/'.$row->img.'" class="img-thumbnail" style="width:70px;height:70px" >';
    
                            return $img;
                    })
                    ->addColumn('action', function($row){
                               $btn = '<a href="javascript:void(0)" class=" view btn btn-success btn-sm" data_id='.$row->id.'>View</a>
                               | <a href="'.route('tempedit',['id'=>$row->id]).'" class="edit btn btn-primary btn-sm" data_id='.$row->id.'>Edit</a> | 
                               <a href="javascript:void(0)" class=" btn btn-danger btn-sm delete" data_id='.$row->id.'>Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action','category','image'])
                    ->make(true);
        }
        
        return view('template');
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


        //dd($request->all());
         $validated = $request->validate([

        'slug' => 'required|unique:templates',
        'category' => 'required',
        'ispro' => 'required',
        'title' => 'required',
        'tempfile' => 'required',
        'tempimage' => 'required|image|mimes:jpeg,png,jpg,gif,svg',

        
       
    ]);

        if ($request->hasFile('tempfile')) {
                  $orgimage = $request->file('tempfile');
            $org = time() . uniqid().'.' . $orgimage->getClientOriginalExtension();
            $destinationPath = public_path('/tempjson/');
            $orgimage->move($destinationPath, $org);  
              }else {
               $org='';  
              }

               if ($request->hasFile('tempimage')) {
            $image = $request->file('tempimage');
            $name = time() . uniqid().'.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/tempimages/');
            $image->move($destinationPath, $name);
           }else {
               $name='';  
              }

            $status=Template::create([
            'cat_id'=>$request->category,
            'name'=>$request->title,
            'slug'=>$request->slug,
            'is_pro'=>$request->ispro,
            'img'=>$name,
            'file'=>$org,



    ]);
        if ($status) {
          return redirect()->back()->with('message','Record Add Successfully');
        }else{
            return redirect()->back()->with('error','Error'); 
        }
    }  


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        

        $data=Template::where('id',$id)->first();
 return view('temp_edit')->with('temp',$data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
          $validated = $request->validate([

        
        'category' => 'required',
        'ispro' => 'required',
        'title' => 'required',
       

        
       
    ]);

        if ($request->hasFile('tempfile')) {
                  $orgimage = $request->file('tempfile');
            $org = time() . uniqid().'.' . $orgimage->getClientOriginalExtension();
            $destinationPath = public_path('/tempjson/');
            $orgimage->move($destinationPath, $org);  
              }else {
               $org=$request->hiddenjson;  
              }

               if ($request->hasFile('tempimage')) {
            $image = $request->file('tempimage');
            $name = time() . uniqid().'.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/tempimages/');
            $image->move($destinationPath, $name);
           }else {
               $name=$request->hiddentemp;  
              }

            $status=Template::where('id',$request->post_id)->update([
            'cat_id'=>$request->category,
            'name'=>$request->title,
            'is_pro'=>$request->ispro,
            'img'=>$name,
            'file'=>$org,



    ]);
        if ($status) {
          return redirect()->back()->with('message','Record Updated Successfully');
        }else{
            return redirect()->back()->with('error','Error'); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

       $status=Template::where('id',$request->op_id)->delete();

      




 
         if ($status) {
          return json_encode(['status'=>'ok']);
        }
    
    }
}
