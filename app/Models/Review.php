<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rating',
        'description',
        'reviewer_id',
        'employee_id'
    ];

    public function getEmployee() {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    public function getReviewer() {
        return $this->belongsTo(Reviewer::class, 'reviewer_id', 'id');
    }
}
