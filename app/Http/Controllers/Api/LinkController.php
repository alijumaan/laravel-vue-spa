<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreLinkRequest;
use App\Http\Resources\LinkResource;
use App\Models\Link;
use Symfony\Component\HttpFoundation\Response;


class LinkController extends ApiController
{

    public function index()
    {
        $links = Link::latest()->get();

        return ['links' => $links];
    }

    public function show(Link $link)
    {
        abort_if(!auth()->user()->can('show-link'),403, 'ليس لديك الصلاحيات على انشاءالرابط');

        return $this->respond([
            'link' => $link
        ]);
    }

    public function store(StoreLinkRequest $request)
    {
        abort_if(!auth()->user()->can('add-link'),403, 'ليس لديك الصلاحيات على انشاءالرابط');

        Link::create($request->validated());

        return $this->respondCreated();
    }

    public function update(StoreLinkRequest $request, Link $link)
    {
        abort_if(!auth()->user()->can('edit-link'),403, 'ليس لديك الصلاحيات على التعديل!');

        $link->update($request->validated());
    }

    public function destroy(Link $link)
    {
        abort_if(!auth()->user()->can('delete-link'),403, 'ليس لديك الصلاحيات لحذف الرابط');

        $link->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function getUrl()
    {
        if (auth()->user()->isAdmin()) {
            $links = Link::oldest()->get();
        } else {
            $links = Link::oldest()->whereAccess(TRUE)->get();
        }

        return LinkResource::collection($links);
    }
}
