<?php

namespace App\Http\Controllers\Api\v1;

use App\Dto\ToursFilters;
use App\Events\TourCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\TourListRequest;
use App\Http\Resources\PublicTourResource;
use App\Services\ToursService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use OpenApi\Attributes as OA;

class ToursController extends Controller
{
    public function __construct(private readonly ToursService $toursService)
    {
    }

    #[OA\Get(
        path: '/tours/{travelSlug}',
        summary: 'Get tours for a specific travel including optional filters',
        tags: ['Tours'],
        parameters: [
            new OA\Parameter(
                name: 'travelSlug',
                description: 'The slug of the travel',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'string')
            ),
            new OA\Parameter(
                name: 'priceFrom',
                description: 'Filter tours starting from this price',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'integer')
            ),
            new OA\Parameter(
                name: 'priceTo',
                description: 'Filter tours up to this price',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'integer')
            ),
            new OA\Parameter(
                name: 'dateFrom',
                description: 'Filter tours starting from this date',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'string', format: 'date')
            ),
            new OA\Parameter(
                name: 'dateTo',
                description: 'Filter tours up to this date',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'string', format: 'date')
            ),
            new OA\Parameter(
                name: 'sortPrice',
                description: 'Sort tours by price',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'string')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Successful response',
                content: new OA\MediaType(
                    mediaType: 'application/json',
                )
            ),
        ]
    )]
    public function list(TourListRequest $request, string $travelSlug): JsonResponse
    {
        TourCreated::dispatch();
        $requestFilters = (new ToursFilters())
            ->setSlug($travelSlug)
            ->setDateFrom($request->get('dateFrom'))
            ->setDateTo($request->get('dateTo'))
            ->setPriceFrom($request->get('priceFrom'))
            ->setPriceTo($request->get('priceTo'))
            ->setSortPrice($request->get('sortPrice'));

        $cacheKey = $requestFilters->toCacheKey();
        $cacheTime = 600;

        $resourceCollection = Cache::tags(['tours'])->remember($cacheKey, $cacheTime, function () use ($requestFilters) {
            $tours = $this->toursService->filterTours($requestFilters);

            return PublicTourResource::collection($tours);
        });

        $response = response()->json($resourceCollection->response()->getData(true));
        $response->header('Cache-Control', 'public, max-age=3600'); // Example for 1 hour cache

        return $response;
    }
}
