<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $fillable = ['username'];

    // Define the one-to-many relationship with Education
    public function educations()
    {
        return $this->hasMany(Education::class);
    }

    // Define the one-to-many relationship with WorkExperience
    public function workExperiences()
    {
        return $this->hasMany(WorkExperience::class);
    }
}
