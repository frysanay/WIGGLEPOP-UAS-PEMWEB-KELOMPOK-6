<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'description',
        'reference_image',
        'budget',
        'final_price',
        'payment_proof',
        'status',
        'admin_note',
    ];

    protected $casts = [
        'budget'      => 'decimal:2',
        'final_price' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending'           => 'Menunggu Review',
            'awaiting_payment'  => 'Menunggu Pembayaran',
            'process'           => 'Sedang Dibuat',
            'done'              => 'Selesai',
            'cancelled'         => 'Dibatalkan',
            default             => ucfirst($this->status),
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending'           => 'yellow',
            'awaiting_payment'  => 'orange',
            'process'           => 'blue',
            'done'              => 'green',
            'cancelled'         => 'red',
            default             => 'gray',
        };
    }
}
