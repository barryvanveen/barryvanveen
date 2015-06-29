<?php
namespace Barryvanveen\Blogs;

use Barryvanveen\Database\EloquentRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BlogRepository extends EloquentRepository
{
    /**
     * return limited amount of most recent blogposts.
     *
     * @param int $amount
     *
     * @return Collection
     */
    public function latest($amount = 2)
    {
        return Blog     ::online()
                        ->past()
                        ->orderedDesc()
                        ->take($amount)
                        ->get();
    }

    /**
     * return all published blogposts.
     *
     * @return Collection
     */
    public function published()
    {
        return Blog     ::online()
                        ->past()
                        ->orderedDesc()
                        ->get();
    }

    /**
     * return all blogposts.
     *
     * @return Collection
     */
    public function all()
    {
        return Blog     ::orderedDesc()
                        ->get();
    }

    /**
     * retrieve a single blogpost by its slug.
     *
     * @param string $slug
     *
     * @return Blog
     *
     * @throws ModelNotFoundException
     */
    public function findPublishedBySlug($slug)
    {
        $id = substr($slug, 0, stripos($slug, '-'));

        // if this slug begins with an id, use it to find a blogpost
        if (is_numeric($id) && intval($id) > 0) {
            return $this->findPublishedById($id);
        }

        throw new ModelNotFoundException('Slug of blog does not contain an id');
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
        return Blog     ::online()
                        ->past()
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
        return Blog     ::findOrFail($id);
    }

    /**
     * retrieve the most recently updated blogpost.
     *
     * @return array
     */
    public function lastUpdatedAt()
    {
        return Blog     ::online()
                        ->past()
                        ->latest('updated_at')
                        ->first();
    }
}
