<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;


class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the users.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        /**
         * Ajax call by datatable for listing of the users.
         */
        if ($request->ajax()) {
            $data = User::all();
            $datatable =  DataTables::of($data)
                ->filter(function ($instance) use ($request) {
                    if ($request->has('keyword') && $request->get('keyword')) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['name'], Str::lower($request->get('keyword'))) ? true : false;
                        });
                    }
                })
                ->addIndexColumn()
                ->addColumn('action', function ($user) {
                    return view('users.datatable', compact('user'));
                })
                ->rawColumns(['action'])
                ->make(true);
            return $datatable;
        }


        $users = User::paginate(25);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a new user in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['password'] = Hash::make($data['password']); //Encrypting password
        User::create($data);
        //Assign the user role to the newly added user.
        $user = User::where('email', $data['email'])->first();
        $user->assignRole('user');
        return redirect()->route('users.user.index')
            ->with('success_message', trans('users.model_was_added'));
    }

    /**
     * Display the specified user.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $data = $this->getData($request, $id);
        $user = User::findOrFail($id);
        if (!trim($data['password']))
            unset($data['password']);
        else
            $data['password'] = Hash::make($data['password']); //Encrypting password
        $user->update($data);

        return redirect()->route('users.user.index')
            ->with('success_message', trans('users.model_was_updated'));
    }

    /**
     * Remove the specified user from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            if (!$user->hasRole('super-admin'))
                $user->delete();
            else
                return redirect()->route('users.user.index')
                    ->with('error_message', trans('users.super_admin_cannot_be_deleted'));

            return redirect()->route('users.user.index')
                ->with('success_message', trans('users.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('users.unexpected_error')]);
        }
    }

    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request
     * @return array
     */
    protected function getData(Request $request, $id = 0)
    {

        $rules = [
            'name' => 'required|string|min:1|max:255',
            'email' => 'required|email|unique:users|min:1|max:255',
            'password' => 'required|string|min:1|max:255',
        ];

        //Validating unique for update ignoring the same record
        if ($id) {
            $rules = [
                'name' => 'required|string|min:1|max:255',
                'email' =>  [
                    'required',
                    'min:1',
                    'max:255',
                    Rule::unique('users')->ignore($id),
                ],
                'password' => 'nullable|string|min:1|max:255'
            ];
        }

        $data = $request->validate($rules);

        return $data;
    }
}
