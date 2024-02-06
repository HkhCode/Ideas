<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\User;
use App\Models\Comment;
use App\Models\idea;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',
        'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function ideas()
    {
        return $this->hasMany(idea::class)->latest();
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function followings()
    {
        return $this->belongsToMany(User::class,'follower_user' ,'follower_id' , 'user_id')->withTimestamps();
    }

    public function followers()
    {
            // return $this->belongsTo(User::class, 'foreign_key', 'other_key');
        return $this->belongsToMany(User::class,'follower_user' ,'user_id' , 'follower_id')->withTimestamps();
    }

    public function follows(User $user)
    {
        return $this->followings()->where('user_id' , $user->id)->exists();
    }
    public function getImageUrl()
    {
        if($this->image) {
            return url('storage/' . $this->image);
        }
        return "https://api.dicebear.com/6.x/fun-emoji/svg?seed={$this->name}";
    }
    public function likes()
    {
        return $this->belongsToMany(idea::class , 'idea_like')->withTimestamps();
    }
    public function likesIdea(idea $idea)
    {
        return $this->likes()->where('idea_id' , $idea->id)->exists();
    }
}
