<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Room extends Model
{
    public $timestamps = false;
    protected $table = "room";
    protected $primaryKey = "room_id";

    /** Vrátí všechny zaměstnance s touto místností */
    public function employees()
    {
        return $this->hasMany(Employee::class, 'room')->get();
    }

    /** Vrátí surové klíče přiřazené k této místnosti */
    public function keys()
    {
        return $this->hasMany(Key::class, 'room', 'room_id')->get();
    }

    /** Vrátí všechny zaměstnance kteří mají klíč od této místnosti */
    public function getKeys() {
        return DB::table('employee')
            ->leftjoin('key', 'employee.employee_id', "=", 'key.employee')
            ->where('key.room', '=', $this->room_id)
            ->select('employee.*')
            ->get();
    }
}
