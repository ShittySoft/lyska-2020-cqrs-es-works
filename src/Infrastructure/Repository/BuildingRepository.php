<?php

declare(strict_types=1);

namespace Building\Infrastructure\Repository;

use Building\Domain\Aggregate\Building;
use Building\Domain\Repository\BuildingRepositoryInterface;
use Prooph\EventStore\Aggregate\AggregateRepository;
use Rhumsaa\Uuid\Uuid;
use Webmozart\Assert\Assert;

final class BuildingRepository implements BuildingRepositoryInterface
{
    /**
     * @var AggregateRepository
     */
    private $aggregateRepository;

    public function __construct(AggregateRepository $aggregateRepository)
    {
        $this->aggregateRepository = $aggregateRepository;
    }

    public function store(Building $building) : void
    {
        $this->aggregateRepository->addAggregateRoot($building);
    }

    public function get(Uuid $id) : Building
    {
        $building =  $this->aggregateRepository->getAggregateRoot($id->toString());

        Assert::isInstanceOf($building, Building::class);

        return $building;
    }
}
