<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Key;
use App\Models\Room;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function showEditEmployee($id)
    {
        $employee = Employee::find($id) ?? abort(404, 'Zaměstnanec nenalezen');

        $rooms = [];
        foreach (Room::all() as $room) {
            $rooms[$room->room_id] = $room->name;
        }
        $keys = $employee->keys()->get();

        return view('admin/editEmployee', ['employee' => $employee, 'rooms' => $rooms, 'keys' => $keys]);
    }

    public function editEmployee(Request $request)
    {
        $employee = Employee::find($request->input('id'));

        $employee->name = $request->input('name');
        $employee->surname = $request->input('surname');
        $employee->job = $request->input('job');
        $employee->wage = $request->input('wage');
        $employee->room = $request->input('room');
        $employee->login = $request->input('login');

        $request->input('password') ?? $employee->password = Hash::make($request->input('password'));
        $request->input('admin') == 1 ? $employee->admin = 1 : $employee->admin = 0;

        $employee->save();

        $this->handleKeys($request->input('keys') ?? [], $employee);


        return view('messages/success', ['message' => 'Uživatel úspěšně upraven', 'url' => '/employees']);
    }

    protected function handleKeys($newKeys, Employee $employee) {
        // odebírání klíčů
        $ogKeys = [];
        foreach ($employee->keys()->get() as $key) {
            $ogKeys[] = $key->room;
        }
        foreach (array_diff($ogKeys, $newKeys) as $room_id) {
            $key = Key::query()->where('employee', '=', $employee->employee_id)->where('room', '=', $room_id)->first();
            $key->delete();
        }
        // přidávání klíčů
        foreach ($newKeys as $room_id) {
            if ($room_id == null) {
                continue;
            }
            $key = Key::query()->where('employee', '=', $employee->employee_id)->where('room', '=', $room_id)->first();
            if (!$key) {
                $key = new Key();
                $key->employee = $employee->employee_id;
                $key->room = $room_id;
                $key->save();
            }
        }
    }

    public function showEditRoom($id)
    {
        $room = Room::find($id) ?? abort(404, 'Místnost nenalezena');

        return view('admin/editRoom', ['room' => $room]);
    }

    public function editRoom(Request $request) {
        $room = Room::find($request->input('id'));

        $room->name = $request->input('name');
        $room->no = $request->input('no');
        $room->phone = $request->input('phone');

        $room->save();
        return view('messages/success', ['message' => 'Místnost úspěšně upravena', 'url' => '/rooms']);
    }

    public function showCreateEmployee() {
        $rooms = [];
        foreach (Room::all() as $room) {
            $rooms[$room->room_id] = $room->name;
        }

        return view('admin/createEmployee', ['rooms' => $rooms]);
    }


    public function createEmployee(Request $request) {
        $employee = new Employee;

        $employee->name = $request->input('name');
        $employee->surname = $request->input('surname');
        $employee->job = $request->input('job');
        $employee->wage = $request->input('wage');
        $employee->room = $request->input('room');
        $employee->login = $request->input('login');
        $employee->password = Hash::make($request->input('password'));

        $request->input('admin') == 1 ? $employee->admin = 1 : $employee->admin = 0;

        $employee->save();
        $this->handleKeys($request->input('keys'), $employee);
        return redirect('/employees');
    }

    public function showCreateRoom() {
        return view('admin/createRoom');
    }

    public function createRoom(Request $request) {
        try {
            $room = new Room;

            $room->name = $request->input('name');
            $room->no = $request->input('no');
            $room->phone = $request->input('phone');

            $room->save();
        } catch (Exception $e) {
            if (strpos($e->getMessage(), "key 'no'")) {
                return view('admin/createRoom', ['room' => $room, 'error' => 'Místnost s tímto číslem je již vytvořena']);
            } else if (strpos($e->getMessage(), "key 'phone'")) {
                return view('admin/createRoom', ['room' => $room, 'error' => 'Místnost s tímto telefonem je již vytvořena']);
            }
        }
    }

    // mazání
    public function deleteEmployee(Request $request) {
        $employee = Employee::find($request->input('id'));

        foreach ($employee->keys()->get() as $key) {
            $key->delete();
        }
        $employee->delete();
        return redirect('/employees');
    }

    public function deleteRoom(Request $request) {
        try {
            $room = Room::find($request->input('id'));
            $room->delete();

            return redirect('/rooms');
        } catch (Exception $e) {
            return redirect('/rooms')->withErrors(['mess' => 'Nejdříve musíte odebrat tuto místnost a klíče u zaměstnanců abyste smazali místnost', 'id' => $request->input('id')]);
        }
    }

    public function forceDeleteRoom(Request $request) {
        $room = Room::find($request->input('id'));

        $keys = $room->keys();

        $employees = $room->employees();

        foreach ($keys as $key) {
            $key->delete();
        }

        foreach ($employees as $employee) {
            $employee->room = null;
            $employee->save();
        }
        $room->delete();
    }
}
