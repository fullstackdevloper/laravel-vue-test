<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $columns = [
            0 => 'name',
            1 => 'email',
            2 => 'created_at',
            3 => 'id',
        ];

        if ($request->ajax()) {
            $limit = $request->length;
            $start = $request->start;
            $order = $columns[$request->input('order.0.column')];
            $dir  =  $request->input('order.0.dir');
            $search = $request->input('search.value');

            $users = User::where('is_admin', 0)->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir);

            if ($search) {
                $users = $users->where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%{$search}%");
                    $query->orWhere('email', 'LIKE', "%{$search}%");
                });
            }



            $users = $users->get();

            $data = [];

            if (!empty($users)) {
                $totalData = User::count();

                $totalFiltered = $totalData;

                foreach ($users as $user) {
                    $show =  route('users.show', $user->id);

                    $nestedData['id'] = $user->id;
                    $nestedData['name'] = $user->name;
                    $nestedData['email'] = $user->email;
                    $nestedData['created_at'] = date('j M Y h:i a', strtotime($user->created_at));
                    $nestedData['action'] = "&emsp;<a href='{$show}' title='SHOW' ><span class='glyphicon glyphicon-list'></span>view</a>";
                    $data[] = $nestedData;
                }
            }
            $json_data = array(
                "draw"            => intval($request->input('draw')),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data"            => $data
            );
            return response()->Json($json_data);
        }
        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
