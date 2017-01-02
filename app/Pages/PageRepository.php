<?php

namespace Barryvanveen\Pages;

use Barryvanveen\Database\EloquentRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PageRepository extends EloquentRepository
{
    /**
     * return all pages.
     *
     * @return Collection
     */
    public function all()
    {
        return Page     ::orderedByTitleASC()
                        ->get();
    }

    /**
     * retrieve a single page by its slug.
     *
     * @param $slug
     *
     * @throws ModelNotFoundException
     *
     * @return Page
     */
    public function findPublishedBySlug($slug)
    {
        return Page     ::online()
                        ->whereSlug($slug)
                        ->firstOrFail();
    }

    /**
     * retrieve any (possibly unpublished) page by its id.
     *
     * @param $id
     *
     * @throws ModelNotFoundException
     *
     * @return Page|Collection|Model
     */
    public function findAnyById($id)
    {
        return Page     ::findOrFail($id);
    }
}
