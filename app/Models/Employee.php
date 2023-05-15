<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_id',
        'position_id',
        'name',
        'token'
    ];

    public function company() {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function position() {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }

    public function review() {
        return $this->hasMany(Review::class, 'employee_id', 'id');
    }
}
