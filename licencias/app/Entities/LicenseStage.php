<?php

namespace CityBoard\Entities;

use Illuminate\Database\Eloquent\Model;

class LicenseStage extends Model
{
    /**
     * @todo add person_position
     * tecnico, ingeniero, arquitecto
     * paso que hacen ciertas personas
     * Si solo es para el tipo de persona arquitecto
     * entonces solo muestro arquitectos
     */

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
      'date' => 'boolean',
      'date_required' => 'boolean',
      'person' => 'boolean',
      'person_required' => 'boolean',
      'number' => 'boolean',
      'number_required' => 'boolean',
      'file' => 'boolean',
      'file_required' => 'boolean',
      'objection' => 'boolean',
      'objection_required' => 'boolean',
      'optional' => 'boolean',
      'person_position_id' => 'integer',
      #JGT: Se agregan los nuevos campos
      'proceeds_visit' => 'boolean',
      'date_commition' => 'boolean',
      'date_commition_required' => 'boolean',
      'date_report' => 'boolean',
      'date_report_required' => 'boolean',
      'date_firsh_visit' => 'boolean',
      'date_firsh_visit_required' => 'boolean',
      'sanctions' => 'boolean',
      'sanctions_required' => 'boolean',
      'act' => 'boolean',
      'act_required' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'name',
      'name_required',
      'date',
      'date_required',
      'person',
      'person_required',
      'number',
      'number_required',
      'file',
      'file_required',
      'objection',
      'objection_required',
      'optional',
      'person_position_id',
      #JGT: Se agregan los nuevos campos
      'proceeds_visit',
      'date_commition',
      'date_commition_required',
      'date_report',
      'date_report_required',
      'date_firsh_visit',
      'date_firsh_visit_required',
      'sanctions',
      'sanctions_required',
      'act',
      'act_required'
    ];
}
