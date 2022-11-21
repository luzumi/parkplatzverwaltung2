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
//    Schema::create('addresses', function (Blueprint $table) {
//            $table->id();
//            $table->
//            $table->string('Land');
//            $table->integer('PLZ', false, true);
//            $table->string('Stadt');
//            $table->string('Straße');
//            $table->integer('Nummer', false, true);
//            $table->timestamps();
//        });

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




    /**
     * @return mixed
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getLand(): string
    {
        return $this->Land;
    }

    /**
     * @param mixed $Land
     */
    public function setLand(string $Land): void
    {
        $this->Land = $Land;
    }

    /**
     * @return mixed
     */
    public function getPLZ(): int
    {
        return $this->PLZ;
    }

    /**
     * @param mixed $PLZ
     */
    public function setPLZ(int $PLZ): void
    {
        $this->PLZ = $PLZ;
    }

    /**
     * @return mixed
     */
    public function getStadt(): string
    {
        return $this->Stadt;
    }

    /**
     * @param mixed $Stadt
     */
    public function setStadt(string $Stadt): void
    {
        $this->Stadt = $Stadt;
    }

    /**
     * @return mixed
     */
    public function getStrasse(): string
    {
        return $this->Strasse;
    }

    /**
     * @param mixed $Strasse
     */
    public function setStrasse(string $Strasse): void
    {
        $this->Strasse = $Strasse;
    }

    /**
     * @return mixed
     */
    public function getNummer(): int
    {
        return $this->Nummer;
    }

    /**
     * @param mixed $Nummer
     */
    public function setNummer(int $Nummer): void
    {
        $this->Nummer = $Nummer;
    }

    /**
     * @return string[]
     */
    public function getFillable(): array
    {
        return $this->fillable;
    }

    /**
     * @param string[] $fillable
     */
    public function setFillable(array $fillable): void
    {
        $this->fillable = $fillable;
    }


}
