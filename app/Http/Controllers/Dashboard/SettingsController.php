<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingsRequest;
use App\Models\Setting;

class SettingsController extends Controller
{
    public function update(SettingsRequest $request, Setting $setting)
    {
        $setting->update($request->except('logo', 'favicon'));

        $logo = Helper::uploadImage($request, 'logo','images/logo/');
        if ($logo != null)
            $setting->update(['logo' => $logo]);

        $favicon = Helper::uploadImage($request, 'favicon','images/favicon/');
        if ($favicon != null)
            $setting->update(['favicon' => $favicon]);

        return redirect()->back();
    }
}
