<?php
if (!function_exists('uploadImg')) {
    function uploadImg($request)
    {
        if ($request->has("upload_file")) {
            $file = $request->upload_file;
//            $ext = $file->extension();
//            $file_name = time() . '-' . 'employee.' . $ext;
            $file_name = $request->session()->pull('create_avatar');
//            $file->storeAs(config('constants.path.PATH_UPLOAD_EMPLOYEE'), $file_name);
            $request->merge(['avatar' => $file_name]);
//            $request->session()->put('create_avatar',$file_name);
        } else {
            $request->merge(['avatar' => $request['avatar']]);
//            $request->session()->put('create_avatar',$request['avatar']);
        }
        return $request;
    }

}
