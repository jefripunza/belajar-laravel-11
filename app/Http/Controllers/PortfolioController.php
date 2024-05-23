<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{

    public function public(string $slug)
    {
        $names = explode('-', $slug);
        $first_name = strtolower($names[0]);
        $last_name = strtolower(implode(' ', array_slice($names, 1)));

        $user = User::where('first_name', $first_name)
            ->where('last_name', $last_name)
            ->firstOrFail(); // Jika pengguna tidak ditemukan, akan secara otomatis memunculkan 404

        return view('portfolio.index', [
            'is_public' => true,
            'user' => $user,
        ]);
    }

    public function manage()
    {
        if (Auth::guest()) {
            return redirect()->route('login');
        }
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        return view('portfolio.index', [
            'is_public' => false,
            'user' => $user,
        ]);
    }

    public function editable(string $on, Request $request)
    {
        if (Auth::guest()) {
            return redirect()->route('login');
        }

        $method = $request->method();
        if (!in_array($on, ["profile", "about", "content"])) {
            return redirect()->back();
        }
        $user_id = Auth::user()->id;
        if ($method == "POST") {
            if ($on == "profile") {
                $request->validate([
                    'description' => 'nullable|string',
                    'status' => 'nullable|string|in:find-job,im-working,hiring',
                    'image_url' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:4096', // max:4096 means 4MB
                ]);
                $user = User::where('id', $user_id)->first();
                if ($request->hasFile('image_url')) {
                    $file = $request->file('image_url');
                    $uuid = (string) Str::uuid();
                    $extension = $file->getClientOriginalExtension();
                    $filename = $uuid . '.' . $extension;
                    $file->storeAs('public/images/profile', $filename);
                    $user->image_url = $filename;
                }
                if ($request->hasAny('description')) {
                    $user->description = $request->description;
                }
                if ($request->hasAny('status')) {
                    $user->status = $request->status;
                }
                $user->save();
            } else if ($on == "about") {
                //
            } else if ($on == "content") {
                //
            }
        }
        $user = User::where('id', $user_id)->first();
        return view('portfolio.editable', [
            'on' => $on,
            'user' => $user,
        ]);
    }
}
