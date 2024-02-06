<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
class UserController extends Controller
{

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
        $ideas = $user->ideas()->paginate(5);

        return view('users.show',compact('user','ideas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('update' , $user);
        //
        $ideas = $user->ideas()->paginate(5);
        $editting = true;
        return view('users.edit',compact('user' , 'editting' , 'ideas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user)
    {
        $this->authorize('update' , $user);
        //
        $valodated = request()->validate([
            'name' => 'required|min:3|max:40',
            'bio' => 'nullable|min:1|max:255',
            'image' => 'image'
        ]);
        if(request()->has('image')){
            $imagePath = request()->file('image')->store('profile' , 'public');
            $valodated['image'] = $imagePath;

            Storage::disk('public')->delete($user->image ?? '');
        }
        $user->update($valodated);
        return redirect()->route('profile');
    }

    public function profile()
    {
        return $this->show(auth()->user());
    }

}
