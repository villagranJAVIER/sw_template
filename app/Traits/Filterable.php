<?php

namespace App\Traits;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

trait Filterable
{
    public function getFiltersBase(array $filters): object
    {
        $start = !empty($filters['startDate']) ? Carbon::parse($filters['startDate']) : Carbon::now()->startOfMonth();
        $end = !empty($filters['endDate']) ? Carbon::parse($filters['endDate']) : Carbon::now()->addDay();

        return (object)[
            'direction'     => $filters['direction'] ?? 'desc',
            'order'         => $filters['order'] ?? 'created_at',
            'rows'          => $filters['rows'] ?? 5,
            'search'        => $filters['search'] ?? null,
            'startDate'     => $start->startOfDay()->format('Y-m-d'),
            'endDate'       => $end->endOfDay()->format('Y-m-d'),
        ];
    }
}
