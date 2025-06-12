<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $title
 * @property string $description
 * @property string $property_type
 * @property string $listing_type
 * @property string $price
 * @property string $currency
 * @property string|null $bedrooms
 * @property int|null $bathrooms
 * @property string|null $area
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string|null $latitude
 * @property string|null $longitude
 * @property string $status
 * @property int $featured
 * @property int|null $year_built
 * @property string|null $amenities
 * @property string|null $admin_notes
 * @property string|null $approved_at
 * @property int|null $approved_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $approvedBy
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\PropertyFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereAdminNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereAmenities($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereApprovedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereBathrooms($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereBedrooms($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereListingType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property wherePropertyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereYearBuilt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property withoutTrashed()
 * @mixin \Eloquent
 */
class Property extends Model
{
    /** @use HasFactory<\Database\Factories\PropertyFactory> */
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'title',
        'description',
        'property_type',
        'listing_type',
        'price',
        'currency',
        'bedrooms',
        'bathrooms',
        'area',
        'address',
        'city',
        'state',
        'country',
        'latitude',
        'longitude',
        'status',
        'featured',
        'year_built',];

    protected $casts = [


    ];
    protected $dates = [
        'approved_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}
