<?php

namespace App\Http\Controllers;

use App\City;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $cities = City::all();
        return view('cities.list', compact('cities'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('cities.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $city = new City();
        $city->name     = $request->input('name');
        $city->save();
        //dung session de dua ra thong bao
        Session::flash('success', 'Tạo mới thành công');
        //tao moi xong quay ve trang danh sach tinh thanh
        return redirect()->route('cities.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $city = City::findOrFail($id);
        return view('cities.edit', compact('city'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $city = City::findOrFail($id);
        $city->name     = $request->input('name');
        $city->save();
        //dung session de dua ra thong bao
        Session::flash('success', 'Cập nhật thành công');
        //cap nhat xong quay ve trang danh sach tinh
        return redirect()->route('cities.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $city = City::findOrFail($id);
        //xoa khach hang thuoc tinh thanh nay
        $city->customers()->delete();
        $city->delete();
        //dung session de dua ra thong bao
        Session::flash('success', 'Xóa  thành công');
        //cap nhat xong quay ve trang danh sach tinh thanh
        return redirect()->route('cities.index');
    }
}
