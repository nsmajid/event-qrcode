<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'name',
        'phone',
        'email',
        'address',
        'uniq_code',
        'have_arrived',
        'arrived_at',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function scopeFilter($query, $filters)
    {
        $query->when($filters['event_id'] ?? false, function ($query, $event_id) {
            return $query->where('event_id', $event_id);
        });

        $query->when($filters['key'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->orWhere('name', 'LIKE', "%$search%")
                    ->orWhere('address', 'LIKE', "%$search%")
                    ->orWhere('email', 'LIKE', "%$search%")
                    ->orWhere('phone', 'LIKE', "%$search%");
            });
        });
    }
}
