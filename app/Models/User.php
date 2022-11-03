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


    protected $fillable = ['name',
        'email',
        'email_verified_at',
        'password',
        'image',
        'telefon',
        'balance',
        'remember_token',
        'role'];

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
     * $this->attributes['email'] - string - contains the user email-address
     * $this->attributes['email-verified-at'] - string - contains the user email-verified
     * $this->attributes['password'] - string - contains the user password
     * $this->attributes['image'] - string - contains the user image
     * $this->attributes['telefon'] - string - contains the user telefon
     * $this->attributes['role'] - string - contains the user role (client or admin)
     * $this->attributes['balance'] - string - contains the user balance
     * $this->attributes['remember_token'] - string - contains the user remember_token
     * $this->attributes['created_at'] - timestamp - contains the user creation date
     * $this->attributes['updated_at'] - timestamp - contains the user updated date
     *
     */
    public function getId()
    {
        return $this->attributes['id'];
    }

    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    public function getName()
    {
        return $this->attributes['name'];
    }

    public function setName($name)
    {
        $this->attributes['name'] = $name;
    }

    public function getEmail()
    {
        return $this->attributes['email'];
    }

    public function setEmail($email)
    {
        $this->attributes['email'] = $email;
    }

    public function getEmailVerifiedAt()
    {
        return $this->attributes['email_verified_at'];
    }

    public function setEmailVerifiedAt($email_verified_at)
    {
        $this->attributes['email_verified_at'] = $email_verified_at;
    }

    public function getPassword()
    {
        return $this->attributes['password'];
    }

    public function setPassword($password)
    {
        $this->attributes['password'] = $password;
    }

    public function getImage()
    {
        return $this->attributes['image'];
    }

    public function setImage($image)
    {
        $this->attributes['image'] = $image;
    }

    public function getRole()
    {
        return $this->attributes['role'];
    }

    public function setRole($image)
    {
        $this->attributes['role'] = $image;
    }

    public function getBalance()
    {
        return $this->attributes['balance'];
    }

    public function setBalance($image)
    {
        $this->attributes['balance'] = $image;
    }
    public function getTelefon()
    {
        return $this->attributes['telefon'];
    }

    public function setTelefon($telefon)
    {
        $this->attributes['telefon'] = $telefon;
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
