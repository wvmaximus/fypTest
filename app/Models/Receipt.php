<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;
    protected $table = 'receipts'; // Specify the table name if it differs
    protected $fillable = [
        'name', 'item', 'totalPaid', 'description', 'status'
    ];
}
