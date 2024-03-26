<?php

namespace App\Http\Controllers;

use App\Models\todo;
use Illuminate\Http\Request;

class ToDoToJai extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
               $todo_lists = Todo::paginate(10);
        return view('welcome',compact('todo_lists'));
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $td_name = $request->input('title');
        $td_des = $request->input('des');

        todo::create([
            'td_name' => $td_name,
            'td_des'=> $td_des,
            'td_status' => false
        ]);
        return redirect('/');
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(Request $request, string $td_id)
    {
        $todo = Todo::where('td_id', $td_id); //Todo คือ โมเดล
        $td_name = $request->input('name');
        $td_des = $request->input('des');

        if ($todo !== null) {
            $todo->update([
                'td_name' => $td_name,
                'td_des' => $td_des,
            ]);
            return response('success', 200);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $td_id)
    {
        $todo = Todo::where('td_id',$td_id);
        if($todo != null){
            $todo -> delete();
        }
        return response('สำเร็จ',200);
    }
}
