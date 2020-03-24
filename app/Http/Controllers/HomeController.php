<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Messaging\CloudMessage;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');            
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $user = Auth::user();
        if ($user->role() != "docente") {
                return redirect('/a/');
        }

        return view('home');
    }

    public function sendNotification(){
        $title = 'Hola Testing';
        $body = 'Ponte a trabajar';
        $imageUrl = 'http://microz.tech/logo.png';


        $deviceToken = "esI5uRrBhOQ:APA91bFLpbAZJDIuraAHOBw-3H1qNjSt6wi1Eeu_GaQTXQ9dWnh4z1oRCKdxmnzQ1ctur7oxpdmt4yi7zcfOyBkn2qu6cMHx5arVaYAihyhv0fUWnJi_IxIdo6nyuSJfp2Uhf-ou_Idk";
        $deviceToken2 = "fkInoj9e3B8:APA91bFbbyK2idg2EmxVug4j3FhvYgJy0eH8NUi-BlywLkU-fANmg328it65Pj1t79lNSf9gmc5HFomrcQdhWX3m3s5rZmOSLg6-4JN-NAnjNUAdjeR0ksdurB0haKIeNEMzznZrvJ5L";

        $tokens = [$deviceToken, $deviceToken2];
        $messaging = (new Firebase\Factory())->createMessaging();

        //Especific Device
            $message = CloudMessage::withTarget('token', $deviceToken)
            ->withNotification([
                                'title' => $title,
                                'body' => $body,
                                'image' => $imageUrl,
                            ]) // optional
            ->withData(['key' => 'value']);

        $messaging->send($message);

        //Multiples Devices

        $message = CloudMessage::
            new([
                                'title' => $title,
                                'body' => $body,
                                'image' => $imageUrl,
                            ]) // optional
            ->withData(['key' => 'value']);

        $messaging->sendMulticast($message, $tokens);

    }

    public function memoria(){
        return view('juegosDidacticos.memoria');
    }
}
