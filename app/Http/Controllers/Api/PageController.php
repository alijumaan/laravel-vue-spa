<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StorePageRequest;
use App\Http\Resources\PageResource;
use App\Models\Page;

class PageController extends ApiController
{
    public function index()
    {
        $pages = Page::select('id', 'slug', 'title')->get();

        return $this->respond([
            'pages' => PageResource::collection($pages)
        ]);
    }

    public function show(Page $page)
    {
        return $this->respond([
            'page' => new PageResource($page)
        ]);
    }

    public function store(StorePageRequest $request)
    {
        $this->authorize('add-page');

        Page::create($request->validated());

        return $this->respondCreated();
    }

    public function update(StorePageRequest $request, Page $page)
    {
        $this->authorize('edit-page');

        $page->update($request->validated());

        return $this->respondUpdated();
    }

    public function destroy(Page $page)
    {
        $this->authorize('delete-page');

        $page->delete();

        return $this->respondNoContent();
    }
}
