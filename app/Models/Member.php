<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
class Member extends Model
{
    use HasFactory, HasApiTokens;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    //
    protected $fillable = [
    'name',
    'medicaid_id',
    'admission_date',
    'discharge_date',
];

}
