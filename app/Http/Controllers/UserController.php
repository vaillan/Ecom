<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helpers;
use App\User;
use File;
use Storage;
use Validator;

class UserController extends Controller
{
    public function updateUserImage(Request $request) {
        $user = User::find($request->input('id'));

        //subir imagen
        $image = $request->file('image');
        if($image){
            //asignarle un nombre unico
            $image_full = \time().'.'.$image->extension();

            //guardarla en la carpeta storage/app/users
            Storage::disk('usersImg')->put($image_full, File::get($image));

            //setear el nombre de la imagen en el objeto user
            $user->image = $image_full;
        }
        $save = $user->update() ? true : false;
        if($save) {
            $getFullUser = new Helpers();
            return response()->json(['valid' => true, 'message' => 'datos actualizados correctamente', 'user' => $getFullUser->getUserInfo($user)],200);
        }
    }

}
