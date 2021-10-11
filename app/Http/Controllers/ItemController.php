<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Group;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return view('item.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('item.create');
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
        //dd($request->all());

        $request->validate([
            'title' => 'required',
            'dueDate' => 'required'
        ]);

        $item = new Item;
        $item->title = request('title');
        $item->dueDate = request('dueDate');
        $item->days_to_remind = request('days_to_remind');
        $item->idUser = \Auth::id();

        if (request('select_group') == 'OTHER' && request('create_group')!="") {

            //echo "you create a group";

            $group_exist = false;
            foreach (Group::all() as $group) {
                if($group->idUser == \Auth::id() && $group->title == request('create_group')){
                    $group_exist = true;
                    $item->idGroup = $group->id;
                    break;
                }
            }

            if(!$group_exist){
                $group = new Group;
                $group->title = request('create_group');
                $group->idUser = \Auth::id();
                $group->save();
                $item->idGroup = $group->id;
            }

        } elseif (request('select_group')!=null) {

            //echo "you select a group";
            $item->idGroup = request('select_group');
        } else {
            //echo "no group";
        }

        $item->save();

        return view('item.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
        $item->delete();

        return redirect()->to('items');
    }
}
