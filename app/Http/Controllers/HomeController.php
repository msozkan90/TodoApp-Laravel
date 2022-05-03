<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\todo;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $id_user = $request->user()->id;
        $at=todo::where('userid','=',$id_user)->count();
        $todos=todo::where('userid','=',$id_user)->get();
        return view('home',['todos'=>$todos,'at'=>$at]);

    }
    public function delete(Request $request,$id)
    {
        $todos=todo::where('id','=',$id)->count();
        $todo=todo::where('id','=',$id)->get();
        if($todos!=0){
            if($todo[0]['userid'] == $request->user()->id){
                    $todos=todo::where('id','=',$id)->get();
                    todo::where('id','=',$id)->delete();
                return redirect()->back()->with('status','Deleted Successfully');}
                else{
                    return redirect()->back()->with('status','Something went wrong');
                }
            }
        else{
            abort(404);

            }
    }

    public function add(Request $request)
    {
        $all = $request->except('_token');
        $insert = todo::create($all);
        if($insert)
        {
            return redirect()->back()->with('status','Added Successfully');
        }
        else
        {
            return redirect()->back()->with('status','Something went wrong');
        }
    }
    public function update(Request $request)
    {
        $id = $request->route('id');
        $c = todo::where('id','=',$id)->count();
        if($c!=0)
        {
            $all=todo::where('id','=',$id)->get();
            if($all[0]['situation'] == 0){
                $all = $request->except('_token');
                $all['situation'] = 1;
                $update = todo::where('id','=',$id)->update($all);
                if($update){
                    return redirect()->back()->with('status','Updated Successfully');
                }
                else{
                    return redirect()->back()->with('status','Something went wrong');
                }
            }
            else{
                $all = $request->except('_token');
                $all['situation'] = 0;
                $update = todo::where('id','=',$id)->update($all);
                if($update){
                    return redirect()->back()->with('status','Updated Successfully');
                }
                else{
                    return redirect()->back()->with('status','Something went wrong');
                }
            }


        }
        else{
            return redirect()->back()->with('status','Something went wrong');
        }
    }
}


//if($todo[0]['userid'] == $request->user()->id){
//    if($todos!=0)
//    {
//        $todos=todo::where('id','=',$id)->get();
//        todo::where('id','=',$id)->delete();
//        return redirect()->back()->with('status','Deleted Successfully');}
//    else{
//        return redirect()->back()->with('status','Something went wrong');
//    }
//}
//else{
//    return redirect()->back()->with('status','Something went wrong');
//}
