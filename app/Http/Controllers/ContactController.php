<?php

namespace App\Http\Controllers;

use App\Notifications\InboxMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;
use App\Admin;
use App\Post;

Class ContactController extends Controller
{
    public function __construct(){
        //methode pour injecter des données à une vue partielle  à l'appel de la classe
        view()->composer('partials.menu', function($view){
            $types = Post::pluck('post_type', 'id')->unique(); //on récupère un tableau associatif ['id'=>'post_type']
            $view->with('types', $types); //on passe les données à la vue
        });
    }

	public function show() 
	{
		return view('front.contact');
	}

	public function mailToAdmin(ContactFormRequest $message, Admin $admin)
	{   
        //send the admin an notification
        $admin->notify(new InboxMessage($message));
        
		// redirect the user back
		return redirect()->back()->with('message', 'thanks for the message! We will get back to you soon!');
	}
}