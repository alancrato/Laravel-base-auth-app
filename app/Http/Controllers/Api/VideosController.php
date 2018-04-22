<?php

namespace App\Http\Controllers\Api;

use App\Criteria\FindPublishedAndCompletedCriteria;
use App\Repositories\VideoRepository;
use App\Http\Controllers\Controller;

class VideosController extends Controller
{
    /**
     * @var VideoRepository
     */
    private $repository;

    /**
     * VideosController constructor.
     */
    public function __construct(VideoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $this->repository->pushCriteria(new FindPublishedAndCompletedCriteria());
        return $this->repository
            ->scopeQuery(function($query){
                return $query->take(50);
            })
            ->paginate();
    }

    public function show($id)
    {
        $this->repository->pushCriteria(new FindPublishedAndCompletedCriteria());
        return $this->repository->find($id);
    }

}
