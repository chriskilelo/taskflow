<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Priority extends Model
{
    /** @use HasFactory<\Database\Factories\PriorityFactory> */
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'level',
        'description',
        'is_active',
        'created_by'
    ];

     // Accessor for created_at attribute
     public function getCreatedAtAttribute($value)
     {
         return Carbon::parse($value)->format('Y-m-d');
     }
 
     public function scopeFilter($query, array $filters)
     {
         $query->when($filters['search'] ?? null, function ($query, $search) {
             $query->where(function ($query) use ($search) {
                 $query->where('level', 'like', '%' . $search . '%')
                     ->orWhere('description', 'like', '%' . $search . '%');
             });
         })->when($filters['trashed'] ?? null, function ($query, $trashed) {
             if ($trashed === 'with') {
                 $query->withTrashed();
             } elseif ($trashed === 'only') {
                 $query->onlyTrashed();
             }
         });
     }
 
     public function resolveRouteBinding($value, $field = null)
     {
         return $this->where($field ?? 'id', $value)->withTrashed()->firstOrFail();
     }
}
