
<?php

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the todos.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Sample data - we'll use database later
        $todos = [
            ['id' => 1, 'title' => 'Learn Laravel 12', 'completed' => false],
            ['id' => 2, 'title' => 'Build a Todo App', 'completed' => false],
            ['id' => 3, 'title' => 'Master Tailwind CSS', 'completed' => true],
        ];

        return view('todos.index', compact('todos'));
    }

    /**
     * Show the form for creating a new todo.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * Store a newly created todo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validation will be added later
        return redirect()->route('todos.index');
    }

    /**
     * Display the specified todo.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        return view('todos.show', compact('id'));
    }

    /**
     * Show the form for editing the specified todo.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        return view('todos.edit', compact('id'));
    }

    /**
     * Update the specified todo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        return redirect()->route('todos.index');
    }

    /**
     * Remove the specified todo.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        return redirect()->route('todos.index');
    }
}