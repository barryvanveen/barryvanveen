<?php

use Barryvanveen\Forms\AdminPageForm;
use Barryvanveen\Pages\Commands\CreatePageCommand;
use Barryvanveen\Pages\Commands\UpdatePageCommand;
use Barryvanveen\Pages\Page;
use Barryvanveen\Pages\PageRepository;
use Flyingfoxx\CommandCenter\CommandBus;
use Illuminate\Http\RedirectResponse;
use Laracasts\Validation\FormValidationException;

class AdminPageController extends BaseController
{
    /** @var PageRepository */
    private $pagesRepository;

    /** @var CommandBus */
    private $commandBus;

    /** @var AdminPageForm */
    private $adminPageForm;

    /**
     * @param PageRepository $pagesRepository
     * @param CommandBus     $commandBus
     * @param AdminPageForm  $adminPageForm
     */
    public function __construct(PageRepository $pagesRepository, CommandBus $commandBus, AdminPageForm $adminPageForm)
    {
        $this->pagesRepository = $pagesRepository;
        $this->commandBus     = $commandBus;
        $this->adminPageForm  = $adminPageForm;
    }

    /**
     * Return all pages.
     *
     * @return View
     */
    public function index()
    {
        Head::title('Pagina\'s -- overzicht');

        $pages = $this->pagesRepository->all();

        return View::make('pages.admin.index', compact('pages'));
    }

    /**
     * Create page.
     *
     * @return View
     */
    public function create()
    {
        Head::title('Pagina\'s -- toevoegen');

        // empty oage to populate form
        $page = new Page();

        return View::make('pages.admin.create', compact('page'));
    }

    /**
     * Store a new page.
     *
     * @return View
     */
    public function store()
    {
        $this->adminPageForm->validate(Request::only([
            'title',
            'text',
            'online',
        ]));

        $this->commandBus->execute(
            new CreatePageCommand(
                Request::get('title'),
                Request::get('text'),
                Request::get('online')
            )
        );

        Flash::success(trans('general.pagina-toegevoegd'));

        return Redirect::route('admin.page');
    }

    /**
     * Edit page by its id.
     *
     * @param $id
     *
     * @return View
     */
    public function edit($id)
    {
        Head::title('Pagina\'s -- aanpassen');

        $page = $this->pagesRepository->findAnyById($id);

        return View::make('pages.admin.edit', compact('page'));
    }

    /**
     * Update page with posted data.
     *
     * @param $id
     *
     * @return RedirectResponse
     *
     * @throws FormValidationException
     */
    public function update($id)
    {
        $this->adminPageForm->validate(Request::only([
            'title',
            'text',
            'online',
        ]));

        $this->commandBus->execute(
            new UpdatePageCommand(
                $id,
                Request::get('title'),
                Request::get('text'),
                Request::get('online')
            )
        );

        Flash::success(trans('general.pagina-aangepast'));

        return Redirect::route('admin.page');
    }
}
