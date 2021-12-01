<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryCategory extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'salary_categories';

    /**
     * Fill the model with an array of attributes.
     *
     * @param  array  $attributes
     * @return $this
     *
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    protected $fillable = ['name', 'type'];
    
    /**
     * Get the group that owns the salary category.
     */
    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }
    
    /**
     * Get the position that owns the salary category.
     */
    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    /**
     * Get the salary indicators for the salary category.
     */
    public function indicators()
    {
        return $this->hasMany(\App\Models\SalaryIndicator::class, 'category_id');
    }
}
