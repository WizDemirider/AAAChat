<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\P2PMsg;
use App\Events\NewMessage;

class ContactsController extends Controller
{
    public function get()
    {
        // $messages = P2PMsg::all();

        // $users = User::where('phone', '!=', auth()->id())->get();

        // $contacts = [];
        // foreach ($messages as $msg) {
        //     $user = $users->find($msg->sender);
        //     if($user === null)
        //     {
        //         $user = $users->find($msg->receiver);
        //     }
        //     if(!in_array($user, $contacts, true)){
        //         array_push($contacts, $user);
        //     }
        // }

        $contacts = User::where('phone', '!=', auth()->id())->get();

        // get a collection of items where sender_id is the user who sent us a message
        // and messages_count is the number of unread messages we have from him
        $unreadIds = P2PMsg::select(\DB::raw('`sender` as sender_id, count(`sender`) as messages_count'))
            ->where('receiver', auth()->id())
            ->where('read', false)
            ->groupBy('sender')
            ->get();

        // add an unread key to each contact with the count of unread messages
        $contacts = $contacts->map(function($contact) use ($unreadIds) {
            $contactUnread = $unreadIds->where('sender', $contact->phone)->first();

            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;

            return $contact;
        });

        return response()->json($contacts);
    }

    public function getMessagesFor($phone)
    {
        // mark all messages with the selected contact as read
        P2PMsg::where('sender', $phone)->where('receiver', auth()->id())->update(['read' => true]);

        // get all messages between the authenticated user and the selected user
        $messages = P2PMsg::where(function($q) use ($phone) {
            $q->where('sender', auth()->id());
            $q->where('receiver', $phone);
        })->orWhere(function($q) use ($phone) {
            $q->where('sender', $phone);
            $q->where('receiver', auth()->id());
        })
        ->get();

        return response()->json($messages);
    }

    public function send(Request $request)
    {
        $message = P2PMsg::create([
            'sender' => auth()->id(),
            'receiver' => $request->contact_id,
            'message' => $request->text,
            'read' => FALSE,
        ]);

        broadcast(new NewMessage($message));

        return response()->json($message);
    }
}
