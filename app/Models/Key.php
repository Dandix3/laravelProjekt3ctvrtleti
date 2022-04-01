<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Key extends Model
{
    public $timestamps = false;
    protected $table = "key";
    protected $primaryKey = "key_id";

    public function rooms(): HasOne
    {
        return $this->hasOne(Room::class);
    }
}
