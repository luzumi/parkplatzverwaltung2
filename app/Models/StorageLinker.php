<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StorageLinker extends Model
{
    /**
     * @param array $attributes [0]=name, [1]=extension
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->attributes['original'] = $attributes[0];
        $hash = Hash::make($attributes[0]);
        $this->attributes['hash'] = $hash . $attributes[1];
        $this->save();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'original',
        'hash',
    ];

    public static function validate(Request $request)
    {
        $request->validate([
            'original' => 'required|string',
            'hash' => 'required|string'
        ]);
    }

    public function getOriginalName()
    {
        return $this->attributes['original'];
    }

    public function getHash()
    {
        return $this->attributes['hash'];
    }

    public function setOriginalName($value)
    {
        $this->attributes['original'] = $value;
    }

    public function setHash($value)
    {
        $this->attributes['hash'] = $value;
    }
}
