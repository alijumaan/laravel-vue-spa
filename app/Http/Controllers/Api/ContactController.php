<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreContactRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends ApiController
{
    public function index()
    {
        abort_if(!auth()->user()->can('show-message'), 403, 'ليس لديك صلاحية الوصول الى الرسالة!');

        $contacts = Contact::latest()->get();

        return $this->respond([
            'data' => ContactResource::collection($contacts)
        ]);
    }

    public function store(StoreContactRequest $request)
    {
        $userId = auth()->check() ? auth()->id() : null;

        Contact::create($request->validated() + [
                'user_id' => $userId
            ]);

        return $this->respondCreated();
    }

    public function show(Contact $contact)
    {
        abort_if(!auth()->user()->can('show-message'), 403, 'ليس لديك صلاحية الوصول الى الرسالة!');

        if (!$contact) {
            return $this->respondNotFound('لاتوجد رسائل');
        }

        $contact->update(['is_read' => 1]);

        return $this->respond([
            'data' => $contact
        ]);
    }

    public function destroy(Contact $contact)
    {
        abort_if(!auth()->user()->can('delete-message'), 403, 'ليس لديك الصلاحيات على حذف الرسالة!');

        $contact->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
