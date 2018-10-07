<?php

namespace App\Http\Controllers\Frontend\Subscribe;

use App\Http\Controllers\Frontend\FrontendController;
use App\Models\Subscribe;
use App\Notifications\Subscribe\SubscribeNotification;
use App\Notifications\Subscribe\UnsubscribeNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required'
        ]);

        $subscriber = Subscribe::where('email', $request->email)->First();


        if($subscriber && $subscriber->is_active == 1){

            $response = ['status' => false, 'message' => 'You have already subscribe with us.'];

        }elseif ($subscriber && $subscriber->is_active == 0){

            $subscriber['is_active'] = true;

            $subscriber->save();

            $subscriber->notify(new SubscribeNotification());

            $response = ['status' => true, 'message' => 'Your newsletter subscription successfully done.'];

        }else{

            $subscribe = Subscribe::create($request->all());

            $subscribe->notify(new SubscribeNotification());

            $response = ['status' => true, 'message' => 'Your newsletter subscription successfully done.'];
        }

        return response()->json($response);
    }

    public function unSubscribe($email)
    {
        $subscriber = Subscribe::where('email', $email)->FirstOrFail();

        $subscriber['is_active'] = false;

        $subscriber->save();

        $subscriber->notify(new UnsubscribeNotification());

        return redirect()->route('un-subscribe.success')->with(['successMessage' => 'You have successfully unsubscribe to newsletter.']);
    }

    public function reSubscribe($email)
    {
        $subscriber = Subscribe::where('email', $email)->FirstOrFail();

        $subscriber['is_active'] = TRUE;

        $subscriber->save();

        $subscriber->notify(new SubscribeNotification());

        return redirect()->route('un-subscribe.success')->with(['successMessage' => 'You have successfully resubscribe to newsletter.']);
    }

    public function success()
    {
        return view('customer.subscribe.message');
    }
}
