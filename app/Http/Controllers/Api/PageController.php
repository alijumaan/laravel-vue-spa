<?php

namespace App\Http\Controllers\Api;

use App\Models\Page;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PageController extends ApiController
{
    public function index()
    {
        $pages = Page::all();

        return [
            'pages' => $pages
        ];
    }

    public function show(Page $page)
    {
        return $this->respond([
            'page' => $page
        ]);
    }

    public function update(Request $request, Page $page)
    {
        abort_if(!auth()->user()
            ->can('edit-page'),
            403,
            'ليس لديك الصلاحيات على التعديل!');

        $page->title = $request->title;
        $page->content = $request['content'];

        if ($page->update()) {
            return $this->respondUpdated();
        } else {
            $this->respondInternalError();
        }

    }

    public function destroy(Page $page)
    {
        abort_if(!auth()->user()
            ->can('delete-page'),
            403,
            'ليس لديك الصلاحيات لحذف الصفحة!');

        $page->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
