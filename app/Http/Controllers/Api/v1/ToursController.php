<?php

namespace App\Http\Controllers\Api\v1;

use App\Dto\ToursFilters;
use App\Events\TourCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\TourListRequest;
use App\Http\Resources\PublicTourResource;
use App\Models\Tour;
use App\Services\ToursService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class ToursController extends Controller
{
    public function __construct(private readonly ToursService $toursService){}
    public function list(TourListRequest $request, string $travelSlug): JsonResponse{
        $requestFilters = (new ToursFilters())
            ->setSlug($travelSlug)
            ->setDateFrom($request->get('dateFrom'))
            ->setDateTo($request->get('dateTo'))
            ->setPriceFrom($request->get('priceFrom'))
            ->setPriceTo($request->get('priceTo'))
            ->setSortPrice($request->get('sortPrice'));

        $cacheKey = $requestFilters->toCacheKey();
        $cacheTime = 600;

        $resourceCollection =  Cache::tags(['tours'])->remember($cacheKey, $cacheTime, function () use ($requestFilters) {
            $tours = $this->toursService->filterTours($requestFilters);
            return PublicTourResource::collection($tours);
        });

        return response()->json($resourceCollection->response()->getData(true));
    }
}
