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
        $input = $attributes[0];
        $extension = $attributes[1];

        $this->attributes['original'] = $input . "." . $extension;
        $hash = Hash::make($input);
        $this->attributes['hash'] = $hash . "." . $extension;
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

    /**
     * @param Request $request
     * @return void
     */
    public static function validate(Request $request)
    {
        $request->validate([
            'original' => 'required|string',
            'hash' => 'required|string'
        ]);
    }

//    public function getHash()
//    {
//        return $this->attributes['hash'];
//    }

}
