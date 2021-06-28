<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;



    protected $fillable = [
        'client',
        'nama_perusahaan',
        'email',
        'kontak',
        'domain',
        'register',
        'tanggal_beli_domain',
        'tanggal_expired_domain',
        'status',
        'reminder_1',
        'reminder_2',
        'reminder_3',
        'reminder_4',
        'reminder_5',
        'reminder_6'
    ];

    public $timestamps = false;

}
