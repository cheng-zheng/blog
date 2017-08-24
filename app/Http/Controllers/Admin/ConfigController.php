<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ConfigController extends CommonController
{
    //get.admin/Config   全部配置项列表
    public function index()
    {
        $data = Config::orderBy('conf_order','asc')->get();
        foreach($data as $k=>$v){
            switch($v->field_type){
                case 'input':
                    $data[$k]->_html='<input type="text" name="conf_content[]" value=" '.$v->conf_content.' ">';
                    //echo $data->_html;
                    break;
                case 'textarea':
                    $data[$k]->_html='<textarea type="text" name="conf_content[]">'.$v->conf_content.'</textarea>';
                    //echo $data->_html;
                    break;
                case 'radio'://dd($v);
                    //1|开启, 0|关闭
                    $arr = explode(',', $v->field_value);
                    //dd($arr);
                    $str = '';
                    foreach($arr as $m=>$n){
                        //1|开启
                        $r = explode('|',$n);
                        $c = $v->conf_content==$r[0] ? 'checked' : '' ;
                        $str .= '<input type="radio" name="conf_content[]"'.$c.' value=" '.$r[0].' ">'.$r[1];
                    }
                    $data[$k]->_html = $str;
                    break;
            }
        }
        //$data = Config::all();
        return view('admin.config.index',compact('data'));
    }
    //排序
    public function changeOrder()
    {
        $input = Input::all();
        $nav = Config::find($input['conf_id']);
        $nav->conf_order = $input['conf_order'];
        $re = $nav->update();
        if($re){
            $data = [
                'status'=>0,
                'msg'=>'分类排序更新成功!'
            ];
        }else{
            $data = [
                'status'=>1,
                'msg'=>'分类排序更新失败,请稍后重试!'
            ];
        }
        return $data;
    }
    public function changeContent()
    {
        $input = Input::all();
        foreach ($input['conf_id'] as $k=>$v) {
            Config::where('conf_id',$v)->update(['conf_content'=>$input['conf_content'][$k]]);
        }
        $this->putFile();
        return  back()->with('errors','更新成功');
    }
    //配置文件
    public function putFile()
    {
        $config = Config::pluck('conf_content','conf_name')->all();
        $path = base_path().'\config\web.php';
        $str = '<?php return '.var_export($config,true).';';
        file_put_contents($path, $str);
    }
    //get.admin/config/create 添加配置项
    public function create()
    {
        return view('admin.config.add');
    }

    //get.admin/config/{category}/edit    编辑配置项
    public function edit($conf_id)
    {
        $field = Config::find($conf_id);
        return view('admin.config.edit',compact('field'));
    }
    //post.admin/config    添加文章提交
    public function store()
    {
        $input = Input::except('_token');
        //dd($input);
        $rules = [
            //required不能为空
            'conf_name'=>'required',
            'conf_title'=>'required',
        ];
        $massage = [
            'conf_name.required'=>'配置项名称不能为空！',
            'conf_title.required'=>'配置项标题不能为空！',
        ];
        $validator = Validator::make($input, $rules, $massage);
        if( $validator->passes() ){
            $re = Config::create($input);
            if($re){
                return redirect('admin/config');
            }else{
                return back()->with('errors','配置项添加失败，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }
    //put.admin/config/{article} //更新分类
    public function update($conf_id)//更新
    {
        $input = Input::except('_token','_method');
        $re = Config::where('conf_id',$conf_id)->update($input);
        if($re){
            $this->putFile();
            return redirect('admin/config');
        }else{
            return back()->with('errors','文章更新失败！，请稍后重试');
        }
    }

    //delete.admin/config/{config}  删除
    public function destroy($conf_id)
    {
        $re = Config::where('conf_id',$conf_id)->delete();
        if($re){
            $this->putFile();
            $data = [
                'status'=>0,
                'msg'=>'分类删除成功！'
            ];
        }else{
            $data = [
                'status'=>0,
                'msg'=>'分类删除失败！请稍后重试'
            ];
        }
        return $data;
    }

    //get.admin/category/{category  显示单个分类信息
    public function show()
    {
        //return view('admin.config.add');
    }
}
