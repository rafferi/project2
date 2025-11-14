<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    private $employees;

    public function __construct() {
        $this->employees = [
            1 => [
                'name' => 'влад',
                'surname' => 'перепёлкин',
                'salary' => 10000,
            ],
            2 => [
                'name' => 'саша',
                'surname' => 'бойкова',
                'salary' => 52000,
            ],
            3 => [
                'name' => 'вася',
                'surname' => 'яковлева',
                'salary' => 3000,
            ],
            4 => [
                'name' => 'андрей',
                'surname' => 'тишкин',
                'salary' => 4000,
            ],
            5 => [
                'name' => 'нина',
                'surname' => 'седунова',
                'salary' => 5000,
            ],
        ];
    }

    public function showOne($id)
    {
        if (isset($this->employees[$id])) {
            $employee = $this->employees[$id];
            echo "Имя: " . $employee['name'] .'<br>' . "Фамилия: " . '<br>' . $employee['surname'] . '<br>' . "Зарплата: "  . $employee['salary'];
        } else {
            echo "Работника с таким номером не существует";
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
