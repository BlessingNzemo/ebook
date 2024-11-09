<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder;

class Book extends Model
{
    //
    use HasFactory;

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }


    public function scopeTitle(EloquentBuilder $query, string $title)
    {
        return $query->where('title', 'LIKE', '%' . $title . '%');
    }


    public function scopePopular(EloquentBuilder $query, $from = null, $to = null): EloquentBuilder|QueryBuilder
    {
        return $query->withCount(['reviews'=> fn (Builder $q) =>$this->dateRangeFilter($q, $from, $to)])
            ->orderBy('reviews_count', 'desc');
    }


    public function scopeHighestRated( Builder $query, $from = null, $to = null): EloquentBuilder
    {
        return $query->withAvg('reviews', 'rating')->orderBy('reviews_avg_rating', 'desc');
    }
    


    public function scopeMinReviews(Builder $query, int $minReviews = 0): Builder|QueryBuilder
    {
        return $query->withCount('reviews')->having('reviews_count', '>=', $minReviews);
    }




    public function dateRangeFilter(Builder $query, $from = null, $to = null): EloquentBuilder
    {
        if ($from && !$to) {
            $query->where('created_at', '>=', $from);
        }
        elseif (!$from && $to) {
            $query->where('created_at', '<=', $to);
        }
        elseif ($from && $to) {
            $query->whereBetween('created_at', [$from, $to]);
        }

        return $query;

    }

    public function scopeHighestRatedLastMonth(Builder $query): EloquentBuilder
    {
        return $query->highestRated(now()->subMonths(1), now())
            ->minReviews(2);
    }

    public function scopePopularLastMonth(Builder $query): EloquentBuilder
    {
        return $query->popular(now()->subMonths(1), now())
            ->minReviews(2);
    }


}
