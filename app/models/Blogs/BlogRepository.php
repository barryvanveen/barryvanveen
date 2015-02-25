<?php namespace Barryvanveen\Blogs;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BlogRepository
{
    /**
     * return limited amount of most recent blogposts
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
     * return all published blogposts
     *
     * @return Collection
     */
    public function pastAndOnline()
    {
        return Blog     ::online()
                        ->past()
                        ->orderedDesc()
                        ->get();
    }

    /**
     * return all blogposts
     *
     * @return Collection
     */
    public function all()
    {
        return Blog     ::orderedDesc()
                        ->get();
    }

    /**
     * retrieve a single blogpost by its slug
     *
     * @param $slug
     *
     * @return Blog
     * @throws ModelNotFoundException
     */
    public function findBySlug($slug)
    {
        return Blog     ::online()
                        ->past()
                        ->whereSlug($slug)
                        ->firstOrFail();
    }
}
