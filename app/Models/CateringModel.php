<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CateringModel extends Model
{
    use HasFactory;
    //protected $table = 'caterings'; // Specify the table name if it differs
    protected $fillable = [
        'food_menu', // Food menu details in JSON format
        'venue',
        'invoice_id', // Unique invoice number
        'total_cost', // Minimum cost of $0.01
        'customer_name', // Customer name for the order
        'paid',
        ];

    public function invoice()
    {
        return $this->hasOne(InvoiceModel::class, 'invoice_id');
    }
}
