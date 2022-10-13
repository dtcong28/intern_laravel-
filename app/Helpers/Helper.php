<?php
if (!function_exists('uploadImg')) {
    function uploadImg($request)
    {
        if ($request->has("upload_file")) {
            $file = $request->upload_file;
            $ext = $file->extension();
            $file_name = time() . '-' . 'employee.' . $ext;
            $file->storeAs(config('constants.path.PATH_UPLOAD_EMPLOYEE'), $file_name);
            $request->merge(['avatar' => $file_name]);
        } else {
            $request->merge(['avatar' => $request['avatar']]);
        }
        return $request;
    }
}
