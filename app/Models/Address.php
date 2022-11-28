<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Request;

/**
 * @method static where(string $string, $id)
 */
class Address extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'Land',
        'PLZ',
        'Stadt',
        'Strasse',
        'Nummer',
    ];


    public static function validate(Request $request)
    {
        $request->validate([
            'Land' => 'required|string|max:30',
            'PLZ' => 'required|integer|digits:5',
            'Stadt' => 'required|string',
            'Strasse' => 'required|string',
            'Nummer' => 'required|integer',
        ]);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
