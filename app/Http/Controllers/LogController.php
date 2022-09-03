<?php

namespace App\Http\Controllers;

use App\Models\Ecom;
use App\Models\Log;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $logs = Log::all();
        // dd($logs[0]->merchant);
        return view('log.semua',compact('logs'));
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
        $validator = Validator::make($request->all(), [
            'awb' => ['required', 'unique:logs'],
            'merchant' => ['required'],
            'ecommerce' => ['required'],
            'ekspedisi' => ['required'],
        ]);
        if ($validator->fails()) {
            return response()
                ->json([
                    'success' => false,
                    'validations' => $validator->errors()
                ]);
        }
        $log = new Log();
        $log->awb = $request->awb;
        $log->merchants_id = $request->merchant;
        $log->ecoms_id = $request->ecommerce;
        $log->ekspedisis_id = $request->ekspedisi;
        $log->users_username = Auth::user()->username;
        $log->save();
        return response()
            ->json([
                'success' => true,
                'data' => $log
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function show(Log $log)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function edit(Log $log)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Log $log)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function destroy(Log $log)
    {
        //
    }
}
