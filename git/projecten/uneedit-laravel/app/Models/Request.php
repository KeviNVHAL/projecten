<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    // Define the table name (since 'request' is a reserved word, make sure it's in quotes in the database)
    protected $table = 'repair_requests';

    // Define the fillable fields
    protected $fillable = [
        'device_type',
        'device_name',
        'problem',
        'telephone',
        'email',
    ];
}
