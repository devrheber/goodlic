<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUsPage extends Model
{
    use HasFactory;
    protected $table = "about_us_page";
    public $timestamps = false;
    protected $fillable = [
        "section_1_title","section_1_description","section_1_image","section_2_title","section_2_description","section_2_image","section_2_first_image",
        "section_2_first_heading","section_2_first_sub_heading","section_2_second_image","section_2_second_heading","section_2_second_sub_heading","section_2_third_image","section_2_third_heading","section_2_third_sub_heading","section_3_title","section_3_description","section_3_image"
    ];
}
