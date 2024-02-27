<?php

namespace App\Http\Controllers\Admin;

use App\Dto\TourFromRequestDto;
use App\Events\TourCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTourRequest;
use App\Http\Resources\TourResource;
use App\Services\ToursService;
use Illuminate\Http\JsonResponse;
use Psr\Log\LoggerInterface;
use Throwable;

class ToursController extends Controller
{
    public function __construct(
        private readonly ToursService $toursService,
        private readonly LoggerInterface $logger
    ) {

    }

    public function createTour(CreateTourRequest $request): TourResource|JsonResponse
    {
        $validated = $request->validated();

        try {
            $tour = $this->toursService->createTour(
                (new TourFromRequestDto())
                    ->setTravelId($validated['travelId'])
                    ->setTitle($validated['title'])
                    ->setStartingDate($validated['startingDate'])
                    ->setEndingDate($validated['endingDate'])
                    ->setPrice($validated['price'])
            );
            TourCreated::dispatch();

            return new TourResource($tour);
        } catch (Throwable $throwable) {
            $this->logger->error('Error creating tour', [
                'exception' => $throwable,
                'request' => $validated,
            ]);

            return response()->json([
                'error' => 'todo :: create more specific error messages',
            ], 500);
        }
    }
}
