<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @method static create(array $creationData)
 * @method static findOrFail($id)
 */
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;


    protected $fillable = ['name', 'email', 'email_verified_at', 'password', 'image', 'telefon', 'remember_token', 'status'];

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
    ];

    public static function validate(\Illuminate\Http\Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|email",
            "telefon" => "required",
            "image" => "image",
        ]);
    }


    /**
     * CAR ATTRIBUTES
     * $this->attributes['id'] - int - contains the user primary key
     * $this->attributes['name'] - string - contains the user name
     * $this->attributes['email'] - string - contains the user email-adresse
     * $this->attributes['email-verified-at'] - string - contains the user email-verified
     * $this->attributes['password'] - string - contains the user password
     * $this->attributes['image'] - string - contains the user image
     * $this->attributes['telefon'] - string - contains the user telefon
     * $this->attributes['status'] - string - contains the user status
     * $this->attributes['remember_token'] - string - contains the user remember_token
     * $this->attributes['created_at'] - timestamp - contains the user creation date
     * $this->attributes['updated_at'] - timestamp - contains the user updated date
     *
     */
    public function getId()
    {
        return $this->attributes['id'];
    }

    public function getSetId($id)
    {
        $this->attributes['id'] = $id;
    }

    public function getName()
    {
        return $this->attributes['name'];
    }

    public function getSetName($name)
    {
        $this->attributes['name'] = $name;
    }

    public function getEmail()
    {
        return $this->attributes['email'];
    }

    public function getSetEmail($email)
    {
        $this->attributes['email'] = $email;
    }

    public function getEmailVerifiedAt()
    {
        return $this->attributes['email_verified_at'];
    }

    public function getSetEmailVerifiedAt($email_verified_at)
    {
        $this->attributes['email_verified_at'] = $email_verified_at;
    }

//TODO: Anzeige Passwort nur für aktuellen User erlauben
    public function getPassword()
    {
        return $this->attributes['password'];
    }

    public function getSetPassword($password)
    {
        $this->attributes['password'] = $password;
    }

    public function getImage()
    {
        return $this->attributes['image'];
    }

    public function getSetImage($image)
    {
        $this->attributes['image'] = $image;
    }

    public function getTelefon()
    {
        return $this->attributes['telefon'];
    }

    public function getSetTelefon($telefon)
    {
        $this->attributes['telefon'] = $telefon;
    }

    public function getStatus()
    {
        return $this->attributes['status'];
    }

    public function getSetStatus($status)
    {
        $this->attributes['status'] = $status;
    }
    public function getRememberToken()
    {
        return $this->attributes['remember_token'];
    }

    public function setRememberToken($value)
    {
        $this->attributes['remember_token'] = $value;
    }

    public function getUpdatedAt()
    {
        return $this->attributes['updated_at'];
    }

    public function setUpdatedAt($value)
    {
        $this->attributes['updated_at'] = $value;
    }
}
