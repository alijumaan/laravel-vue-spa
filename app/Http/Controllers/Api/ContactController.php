<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreContactRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contact;

class ContactController extends ApiController
{
    public function index()
    {
        $this->authorize('view-contacts');

        $contacts = Contact::latest()->get();

        return $this->respond([
            'data' => ContactResource::collection($contacts)
        ]);
    }

    public function store(StoreContactRequest $request)
    {
        Contact::create($request->validated() + [
                'user_id' => auth()->id()
            ]);

        return $this->respondCreated();
    }

    public function show(Contact $contact)
    {
        $this->authorize('view-contacts');

        $contact->update(['is_read' => 1]);

        return $this->respond([
            'data' => $contact
        ]);
    }

    public function destroy(Contact $contact)
    {
        $this->authorize('delete-contact');

        $contact->delete();

        return $this->respondNoContent();
    }
}
