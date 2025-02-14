<?php namespace October\Test\Models;

use Model;

/**
 * Location Model
 */
class Location extends Model
{
    use \October\Rain\Database\Traits\Sortable;
    use \October\Rain\Database\Traits\SimpleTree;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'october_test_locations';

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    /**
     * @var array fillable fields
     */
    protected $fillable = ['custom_country_id', 'city_id', 'name'];

    /**
     * @var array jsonable fields
     */
    protected $jsonable = ['available_services'];

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'country' => Country::class,
        'city' => City::class,
    ];

    /**
     * getCountryOptions
     */
    public function getCountryOptions()
    {
        return Country::lists('name', 'id');
    }

    /**
     * getCityOptions
     */
    public function getCityOptions($scopes = null)
    {
        if (!empty($scopes['country']->value)) {
            return City::whereIn('custom_country_id', array_keys($scopes['country']->value))->lists('name', 'id');
        }
        else {
            return City::lists('name', 'id');
        }
    }
}
