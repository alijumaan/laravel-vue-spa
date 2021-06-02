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

        return $this->respond(['links' => $links]);
    }

    public function show(Link $link)
    {
        $this->authorize('show-link');

        return $this->respond(['link' => $link]);
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
            $links = Link::oldest()->get();
        } else {
            $links = Link::oldest()->whereAccess(TRUE)->get();
        }

        return $this->respond([
            'data' => LinkResource::collection($links)
        ]);
    }
}
