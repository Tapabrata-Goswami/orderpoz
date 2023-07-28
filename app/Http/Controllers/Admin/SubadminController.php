<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin;
use App\Models\BusinessSetting;
use Brian2694\Toastr\Facades\Toastr;

class SubadminController extends Controller
{
    public function add_subadmin()
    {
        return view('Admin.subadmin-add');
    }

    public function insert_subadmin(Request $request)
    {
        $data=$request->input();
        $ins=array(
            'role_id'=>'1',
            'name'=>$data['name'] ? $data['name'] : 'N/A',
            'email'=>$data['email'] ? $data['email'] : 'N/A',
            'module_access'=>json_encode($data['module_access']),
        );
        if(!empty($data['id']))
        {
            $e = admin::find($data['id']);
            if ($request['password'] == null) {
                $pass = $e['password'];
            } 
            else 
            {
                $pass = bcrypt($request['password']);
            }
            $ins['password']=$pass;
            admin::where('id',$data['id'])->update($ins);
            Toastr::success('Success! Subadmin Updated');
            return redirect()->route('panel.Subadmin.list');
            
        }
        else
        {
            if(admin::where('email',$data['email'])->exists())
            {
                Toastr::warning('Warning! Email already exists');
                return back();
            }
            else
            {
                if ($request['password'] == null || $request['password'] == '') 
                {
                    Toastr::warning('Warning! The password must be required');
                    return back();
                } 
                        
                $ins['password']=bcrypt($data['password']);
                $id=admin::create($ins);
                Toastr::success('Success! Subadmin Inserted');
                return back();
            }
        }
    }

    public function subadmin_list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search'))
        {
            $key = explode(' ', $request['search']);
            $subadmin = admin::where('admins.role_id',1)->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->Where('name', 'like', "%{$value}%")->orwhere('email', 'like', "%{$value}%");
                }
            })->orderBy('id', 'desc');
            $query_param = ['search' => $request['search']];
        }else{
            $subadmin = admin::where('admins.role_id',1)->orderBy('admins.id','desc');
            // $subadmin = subadmin::orderBy('sub_id', 'desc');
        }
        $subadmin = $subadmin->paginate(config('default_pagination'))->appends($query_param);

        return view('Admin.subadmin-list', compact('subadmin','search'));
    }

    public function update_subadmin_status($id,$status)
    {
        $data = admin::find($id);
        $data->status=$status;
        $data->save();

        Toastr::success('Success! Status updated');
        return redirect()->back();
    }

    public function edit_subadmin($id)
    {
        $subadmin = admin::where('id',$id)->orderBy('id','DESC')->first();
        return view('admin/subadmin-add',compact('subadmin'));
    }

    public function delete_subadmin($id)
    {
        $subadmin=admin::find($id);
        $subadmin->delete();
        Toastr::success('Success! Deleted');
        return redirect()->back();
    }
}
