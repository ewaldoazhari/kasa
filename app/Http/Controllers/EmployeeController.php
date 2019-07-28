<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Outlet;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
USE Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $employees = Employee::orderBy('created_at', 'DESC')->paginate(10);
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $outlets = Outlet::orderBy('outlet', 'ASC')->get();
        $role = Role::orderBy('name', 'ASC')->get();
        return view('employees.create', compact('role','outlets'));

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'outlet_id' => 'required|exists:outlets,id',
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:employees',
            'password' => 'required|min:6',
            'role' => 'required|string|exists:roles,name'
        ]);

        $employee = Employee::firstOrCreate([
            'email' => $request->email,

        ],
        [
            'outlet_id' => $request->outlet_id,
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'status' => true
        ]);

        $employee->assignRole($request->role);
        return redirect(route('employees.index'))->with(['success' => 'Employee: <strong>' . $employee->name . '</strong> Ditambahkan']);
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'email' => 'required|email|exists:users,email',
            'password' => 'nullable|min:6',
        ]);

        $employee = Employee::findOrFail($id);
        $password = !empty($request->password) ? bcrypt($request->password):$employee->password;
        $employee->update([
            'name' => $request->name,
            'password' => $password
        ]);
        return redirect(route('employees.index'))->with(['success' => 'Employee: <strong>' . $employee->name . '</strong> Diperbaharui']);
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect()->back()->with(['success' => 'Employee: <strong>' . $employee->name . '</strong> Dihapus']);
    }

    public function roles(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $roles = Role::all()->pluck('name');
        return view('employees.roles', compact('employee', 'roles'));
    }

    public function setRole(Request $request, $id)
    {
        $this->validate($request, [
            'role' => 'required'
        ]);

        $employee = Employee::findOrFail($id);
        $employee->syncRoles($request->role);
        return redirect()->back()->with(['success' => 'Role Sudah Di Set']);
    }

    public function rolePermission(Request $request)
    {
        $role = $request->get('role');
        $permissions = null;
        $hasPermission = null;

        $roles = Role::all()->pluck('name');

        if (!empty($role)) {
            $getRole = Role::findByName($role);
            $hasPermission = DB::table('role_has_permissions')
                ->select('permissions.name')
                ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                ->where('role_id', $getRole->id)->get()->pluck('name')->all();
            $permissions = Permission::all()->pluck('name');
        }
        return view('employees.role_permission', compact('roles', 'permissions', 'hasPermission'));
    }

    public function addPermission(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:permissions'
        ]);

        $permission = Permission::firstOrCreate([
            'name' => $request->name
        ]);
        return redirect()->back();
    }

    public function setRolePermission(Request $request, $role)
    {
        $role = Role::findByName($role);
        $role->syncPermissions($request->permission);
        return redirect()->back()->with(['success' => 'Permission to Role Saved!']);
    }

}
