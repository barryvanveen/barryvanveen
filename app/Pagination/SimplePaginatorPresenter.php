<?php
namespace Barryvanveen\Pagination;

use Illuminate\Contracts\Pagination\Presenter as PresenterContract;
use Illuminate\Pagination\SimpleBootstrapThreePresenter;

class SimplePaginatorPresenter extends SimpleBootstrapThreePresenter implements PresenterContract
{
    /**
     * Convert the URL window into Bootstrap HTML.
     *
     * @return string
     */
    public function render()
    {
        if (!$this->hasPages()) {
            return '';
        }

        return sprintf(
            '<ul class="pager">%s %s</ul>',
            $this->getPreviousButton(trans('general.paginator-previous')),
            $this->getNextButton(trans('general.paginator-next'))
        );
    }
}
