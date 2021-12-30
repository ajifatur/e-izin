<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserIndicator extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user__indicators';

    /**
     * Fill the model with an array of attributes.
     *
     * @param  array
     */
    protected $fillable = ['month', 'year', 'value'];
    
    /**
     * Get the user that owns the indicator.
     */
    public function user()
    {
        return $this->belongsTo(Group::class, 'user_id');
    }

    /**
     * Get the salary category that owns the indicator.
     */
    public function salary_category()
    {
        return $this->belongsTo(SalaryCategory::class, 'category_id');
    }
}
