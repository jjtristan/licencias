<?php

namespace CityBoard\Http\Controllers;

use Illuminate\Http\Request;

use CityBoard\Http\Requests;
use CityBoard\Http\Controllers\Controller;
use CityBoard\Entities\License;
use CityBoard\Entities\Alert;
use CityBoard\Entities\TypeAlert;
use CityBoard\Repositories\LicenseRepository;

class AlertController extends Controller
{

    protected $licenseRepository;

    public function __construct()
    {
        $this->licenseRepository = new LicenseRepository();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $alerts = Alert::all();
        //$alerts->license();
        foreach ($alerts as $key => $value) {
            # code...
            $value->license = License::all()->where('id', $value->license_id);
            foreach ($value->license as $key => $lis) {
                # code...
                $value->expedient_number = $lis->expedient_number;
            }
            $typeA = TypeAlert::all()->where('id', $value->type_alert_id);
            foreach ($typeA as $key => $typAl) {
                # code...
                $value->type = $typAl->type;
            }
        }
        //dd($alerts);
        return view('alert.index', compact('alerts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $licence = $this->licenseRepository->selectControl();
        $typeAlert = TypeAlert::OrderBy('id','ASC')->lists('type','id');

        return view('alert.create', compact('licence', 'typeAlert'));
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
        Alert::create($request->all());
        return redirect(route('alert.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $licence = $this->licenseRepository->selectControl();
        $alert = Alert::all()->where('id', $id);
        $typeAlert = TypeAlert::OrderBy('id','ASC')->lists('type','id');
        $objetoAlerta;
        foreach ($alert as $key => $value) {
            # code...
            $objetoAlerta = $value;
        }
        //dd($objetoAlerta);
        return view('alert.edit', compact('objetoAlerta','licence', 'typeAlert'));

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
        try{
            $alert = Alert::find($id);
            //dd($alert);
            $alert->update($request->all());
            return redirect(route('alert.index'));
        }catch (Exception $e){
            \Log::info('Error creating user: '.$e);
            return \Response::json(['created' => false], 500);
        }
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
        //dd($id);
        Alert::destroy($id);
        return \Response::json(['deleted' => true], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createModal(Request $request) {
        try{

            Alert::create($request->all());
            return ['created' => true];
        }catch (Exception $e){
            \Log::info('Error creating user: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    /**
    *
    */
    public function getAlertLicenses($id) {
        $alerts = Alert::all()->where('license_id', $id);
        foreach ($alerts as $key => $value) {
            $typeA = TypeAlert::all()->where('id', $value->type_alert_id);
            foreach ($typeA as $key => $lis) {
                $value->type = $lis->type;
            }
        }
        return $alerts;
    }

    public function getTypeAlert(){
        return TypeAlert::all();
    }
}