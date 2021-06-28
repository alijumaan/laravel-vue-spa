<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreLinkRequest;
use App\Http\Resources\LinkResource;
use App\Models\Link;


class LinkController extends ApiController
{

    public function index()
    {
        $links = Link::latest()->get();

        return $this->respond([
            'links' => LinkResource::collection($links),
        ]);
    }

    public function show(Link $link)
    {
        $this->authorize('view-link');

        return $this->respond([
            'link' => new LinkResource($link)
        ]);
    }

    public function store(StoreLinkRequest $request)
    {
        $this->authorize('add-link');

        Link::create($request->validated());

        return $this->respondCreated();
    }

    public function update(StoreLinkRequest $request, Link $link)
    {
        $this->authorize('edit-link');

        $link->update($request->validated());

        return $this->respondUpdated();
    }

    public function destroy(Link $link)
    {
        $this->authorize('delete-link');

        $link->delete();

        return $this->respondNoContent();
    }

    public function getUrl()
    {
        if (auth()->user()->isAdmin()) {
            $url = Link::oldest()->get();
        } else {
            $url = Link::oldest()->whereAccess(TRUE)->get();
        }

        return $this->respond([
            'url' => LinkResource::collection($url)
        ]);
    }
}
