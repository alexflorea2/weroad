<?php

namespace App\Http\Controllers\Admin;

use App\Dto\TravelFromRequestDto;
use App\Events\TravelCreated;
use App\Events\TravelEdited;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTravelRequest;
use App\Http\Requests\UpdateTravelRequest;
use App\Http\Resources\TravelResource;
use App\Models\Travel;
use App\Services\TravelService;
use Psr\Log\LoggerInterface;
use Throwable;

class TravelsController extends Controller
{
    public function __construct(
        private readonly TravelService $travelService,
        private readonly LoggerInterface $logger
    ) {

    }

    public function createTravel(CreateTravelRequest $request)
    {
        $validated = $request->validated();

        try {
            $travel = $this->travelService->createTravel(
                (new TravelFromRequestDto())
                    ->setTitle($validated['title'])
                    ->setDescription($validated['description'])
                    ->setNumberOfDays($validated['numberOfDays'])
                    ->setMoods($validated['moods'])
                    ->setIsPublic($validated['isPublic'] ?? false)
            );
            TravelCreated::dispatch();

            return new TravelResource($travel->load('moods'));
        } catch (Throwable $throwable) {
            $this->logger->error('Error creating travel', [
                'exception' => $throwable,
                'request' => $validated,
            ]);

            return response()->json([
                'error' => 'todo :: create more specific error messages',
            ], 500);
        }
    }

    public function updateTravel(UpdateTravelRequest $request, string $travelUuid)
    {
        $travelToUpdate = Travel::where('id', $travelUuid)->first();

        if (! $travelToUpdate) {
            return response()->json([
                'error' => 'resource not found',
            ], 404);
        }

        $validated = $request->validated();

        try {
            $travel = $this->travelService->updateTravel(
                $travelToUpdate,
                (new TravelFromRequestDto())
                    ->setTitle($validated['title'])
                    ->setDescription($validated['description'])
                    ->setNumberOfDays($validated['numberOfDays'])
                    ->setMoods($validated['moods'])
                    ->setIsPublic($validated['isPublic'] ?? false)
            );
            TravelEdited::dispatch();

            return new TravelResource($travel->load('moods'));
        } catch (Throwable $throwable) {
            $this->logger->error('Error updating travel', [
                'exception' => $throwable,
                'request' => $validated,
            ]);

            return response()->json([
                'error' => 'todo :: create more specific error messages',
            ], 500);
        }
    }
}
