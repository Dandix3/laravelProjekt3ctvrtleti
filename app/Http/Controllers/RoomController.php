<?php
namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{

    public function getRooms(Request $request)
    {
        $orderBy = $request->query("orderBy");
        if ($orderBy) {
            $orderBy = explode('_', $orderBy);
            if ($orderBy[1] === "ASC") {
                $rooms = Room::all()->sortBy($orderBy[0]);
            } else {
                $rooms = Room::all()->sortByDesc($orderBy[0]);
            }
        } else {
            $rooms = Room::all();
        }
        return view('rooms/roomList', ['rooms' => $rooms]);
    }

    public function getRoom($id)
    {
        $room = Room::find($id) ?? abort(404, 'Místnost nenalezena');

        $employees = $room->employees();

        $avgWage = 0;
        if (count($employees) !== 0) {
            foreach ($employees as $employee){
                $avgWage+= $employee->wage;
            }
            $avgWage = $avgWage/count($employees);
        } else {
            $avgWage = false;
        }

        $keys = $room->getKeys();

        return view('rooms/roomDetail', ['room' => $room, 'employees' => $employees, 'keys' => $keys, 'wage' => $avgWage]);
    }
}
