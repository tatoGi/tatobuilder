<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Form extends Model
{
    use HasFactory;

    protected $fillable = ['name','title','email'];

    /**
     * Get the account associated with the Form
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function account(): HasOne
    {
        return $this->hasOne(Account::class, 'form_id', 'id');
    }

    /**
     * Get all of the fields for the Form
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fields(): HasMany
    {
        return $this->hasMany(FormField::class, 'form_id', 'id');
    }

       
    public static function rearrange($array) {
        self::_rearrange($array, 0);
    
        \App\Models\Section::all()->each(function($item) {
            $item->save();
        });
      }
    
	private static function _rearrange($array,$count, $parent = null) {
	foreach($array as $a) {
    dd($a);
    
		$count++;
		FormField::where('id', $a['id'])->update(['parent_id'=> $parent, 'order' => $count]);

		// if(isset($a['children'])) {
		// $count = self::_rearrange($a['children'], $count, $a['id']);
		
        }// }
	}
}
