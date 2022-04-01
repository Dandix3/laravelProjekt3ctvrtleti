<?php
namespace App\Models;
use App\User;
use Illuminate\Support\Facades\DB;

class Employee extends User
{
    public $timestamps = false;
    protected $table = "employee";
    protected $primaryKey = "employee_id";

    /** Vrátí místnost zaměstnance */
    public function room()
    {
        return $this->belongsTo(Room::class, 'room', 'room_id')->first();
    }

    /** Vrátí surové klíče přiřazené k tomuto zaměstnanci */
    public function keys()
    {
        return $this->hasMany(Key::class, 'employee');
    }

    /** Vrátí všechny kláče zaměstnance */
    public function getKeys() {
        return $this->keys()
            ->join('room', 'room.room_id', '=', 'key.room')
            ->select('room.*')
            ->get();
    }

    /** Vrátí připravený dotaz na všechny zaměstnance */
    public static function getEmployees() {
        return DB::table('employee')
            ->leftjoin('room', 'room.room_id', '=', 'employee.room')
            ->select('employee.*', 'room.name AS roomName', 'room.phone AS roomPhone');
    }
}
