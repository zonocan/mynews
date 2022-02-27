<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;
use App\ProfileHistory;
use Carbon\Carbon;
class ProfileController extends Controller
{
    
        public function add()
    {
        //var_dump('add()');
        return view('admin.profile.create');
    }

    public function create(Request $request)
    {
      //var_dump($request);
      $this->validate($request, Profile::$rules);
      $profils = new Profile;
      $form = $request->all();
      
      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      
      // データベースに保存する
      $profils->fill($form);
      $profils->save();

      return redirect('admin/profile/create');

    }

    public function edit(Request $request)
    {
        $profils = Profile::find($request->id);
        if (empty($profils)) {
            abort(404);
        }
        return view('admin.profile.edit', ['profiles_form' => $profils]);
    }

    public function update(Request $request)
    {
        $this->validate($request, Profile::$rules);
        $profils = Profile::find($request->id);
        $profils_form = $request->all();
        unset($profils_form['_token']);
        
        $profils->fill($profils_form)->save();
        return redirect('admin/profile/edit');

        //プロフィールの更新履歴
        $profilehistory = new History();
        $profilehistory->profile_id = $profils->id;
        $profilehistory->edited_at = Carbon::now();
        $profilehistory->save();
        
        return redirect('admin/profile/edit');
        
    }
    

    
}
