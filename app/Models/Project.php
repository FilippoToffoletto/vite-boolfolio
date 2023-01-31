<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'client_name', 'cover_image','summary','cover_image_original', 'category_id'];


    //relazione  con la cartella categories appartengono una categoria
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function technologies(){
        return $this->belongsToMany(Technology::class);
    }

    public static function generateSlug($string){
        $slug = Str::slug($string, '-');

        $original_slug = $slug;
        $c=1;
        $exists = Project::where('slug', $slug)->first();
        while($exists){
            $slug = $original_slug . '-' . $c;
            $exists = Project::where('slug', $slug)->first();
            $c++;
        }
        return $slug;
    }
}
