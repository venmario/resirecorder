<?php

namespace App\Http\Controllers;

use App\Models\Ecom;
use App\Models\Log;
use App\Models\Merchant;
use App\Rules\AwbRules;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\at;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($min = null, $max = null, $merchant = null)
    {
        
        // dd($max, $min, $merchant);
        if ($min == null || $max == null) {
            $min = date('Y-m-d'); 
            $max = date('Y-m-d');           
            $max_1 = date('Y-m-d', strtotime('+1 day'));
        }else{
            $max_1 = date('Y-m-d', strtotime($max.'+1 day'));
        }
        $merchants = Merchant::all();
        // if (Auth::user()->role->nama == 'admin') {
        //     if ($merchant == null || $merchant == 'semua') {
        //         $logs = Log::whereBetween('created_at',[$min,$max_1])->get();
        //     }
        //     else{
        //         $logs = Log::whereBetween('created_at',[$min,$max_1])->where('merchants_id',$merchant)->get();                
        //     }
        //     return view('log.semua',compact('logs','min','max','merchants'));
        // }
        if ($merchant == null || $merchant == 'semua') {
            $logs = Log::whereBetween('created_at',[$min,$max_1])->get();
        }
        else{
            $logs = Log::whereBetween('created_at',[$min,$max_1])->where('merchants_id',$merchant)->get();
        }
        return view('log.semua',compact('logs','min','max','merchants'));
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
            'awb' => ['required',new AwbRules, 'unique:logs'],
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
