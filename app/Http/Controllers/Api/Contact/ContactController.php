<?php

namespace App\Http\Controllers\Api\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactBanner;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //
    public function ContactBanner(){
        $contact = ContactBanner::first();
        return response()->json($contact);
    }
    public function contact(Request $request){

         $validator = Validator::make($request->all(),[
            'name' => 'nullable',
            'email' => 'required',
            'message' => 'required'
         ]);

         if($validator->fails()){
             return response()->json([
                'status' => false,
                 'errors' => $validator->errors(),
             ],422);
         }

         $contact = new Contact();
         $contact->name = $request->name;
         $contact->email = $request->email;
         $contact->message = $request->message;
         $contact->save();

          return response()->json([
            'status' => true,
            'message' => 'Thank you for contacting us. We will get back to you soon.',
            'data' => $contact
          ]);
    }
}
