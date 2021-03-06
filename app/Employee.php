<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = ['IDNumber', 'type', 'fullname', 'byname', 'designation', 'avatar', 'division_id', 'section_id'];
}
