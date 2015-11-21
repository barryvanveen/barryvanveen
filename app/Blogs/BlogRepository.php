<?php
namespace Barryvanveen\Blogs;

use Barryvanveen\Database\EloquentRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BlogRepository extends EloquentRepository
{
    /**
     * return all published blogposts.
     *
     * @return Paginator
     */
    public function published($perPage = 5)
    {
        return Blog ::published()
                    ->orderedNewToOld()
                    ->simplePaginate($perPage);
    }

    /**
     * return all blogposts.
     *
     * @return Collection
     */
    public function all()
    {
        return Blog ::orderedNewToOld()
                    ->get();
    }

    /**
     * retrieve a single blogpost by its id.
     *
     * @param int $id
     *
     * @return Blog
     *
     * @throws ModelNotFoundException
     */
    public function findPublishedById($id)
    {
        return Blog ::published()
                    ->findOrFail($id);
    }

    /**
     * retrieve any (possibly unpublished) blogpost by its id.
     *
     * @param int $id
     *
     * @return Blog
     *
     * @throws ModelNotFoundException
     */
    public function findAnyById($id)
    {
        return Blog ::findOrFail($id);
    }

    /**
     * retrieve the most recently updated blogpost.
     *
     * @return Blog
     */
    public function lastUpdatedAt()
    {
        return Blog ::published()
                    ->latest('updated_at')
                    ->first();
    }
}
