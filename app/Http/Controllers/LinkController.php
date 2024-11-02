<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use Illuminate\Support\Facades\Log;


class LinkController extends Controller
{
    public function index(){
        return view('link.index');
    }
    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
        ]);

        $originalURL = $request->url;

        // check for the ame url
        $link = Link::where('original_url', $originalURL)->first();

        if ($link) {
            return response()->json(['short_url' => url('/').'/'.$link->short_hash]);
        }

        $shortHash = $this->generateUniqueHash();

        $link = Link::create([
            'original_url' => $originalURL,
            'short_hash' => $shortHash,
            'ip_address' => $request->ip(),
        ]);

        return response()->json(['short_url' => url('/').'/'.$link->short_hash]);
    }

    private function generateUniqueHash($length = 5)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//        for ($i = 0; $i<100000000; $i++) {
//            //
//        }
        do {
            $shortHash = substr(str_shuffle(str_repeat($characters, $length)), 0, $length);
        } while (Link::where('short_hash', $shortHash)->exists());

        return $shortHash;
    }

    public function redirect($hash)
    {
        $link = Link::where('short_hash', $hash)->firstOrFail();
        return redirect()->away($link->original_url);
    }
}
