<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class DashboardSettingController extends Controller
{
    public function account()
    {
        $user = Auth::user();
        return view('pages.dashboard-account',[
            'user' => $user
        ]);
    }

    public function update(Request $request, $redirect)
    {
        $data = ($request->except('nickname','game_id','server_id'));
        $item = Auth::user();

        $data['photo'] = $request->file('photo')->store('assets/user', 'public');

        $item->update($data);

        return redirect()->route($redirect);
    }
}