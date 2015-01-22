<?php namespace Barryvanveen\Blogs;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BlogRepository {

    /**
     * return limited amount of most recent blogposts
     *
     * @param int $amount
     *
     * @return Collection
     */
    public function latest($amount = 2) {
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
    public function all() {
        return Blog     ::online()
                        ->past()
                        ->orderedDesc()
                        ->get();
    }

    /**
     * retrieve a single blogpost by its id
     *
     * @param $id
     *
     * @return Blog
     * @throws ModelNotFoundException
     */
    public function findById($id) {
        return Blog     ::online()
                        ->past()
                        ->whereId($id)
                        ->firstOrFail();
    }

}