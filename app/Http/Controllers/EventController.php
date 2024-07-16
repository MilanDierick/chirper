<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Throwable;

class EventController extends Controller
{
    use AuthorizesRequests;

    /**
     * @throws Throwable
     */
    public function index(Request $request)
    {
        $events = Event::paginate(12);

        if ($request->expectsJson()) {
            $html = '';
            foreach ($events as $event) {
                $html .= view('events.partials.event-card', compact('event'))->render();
            }

            return response()->json([
                'html'          => $html,
                'next_page_url' => $events->nextPageUrl(),
            ]);
        }

        return view('events.index', compact('events'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Event::class);

        $data = $request->validate([
            'title'          => ['required', 'string'],
            'description'    => ['nullable', 'string'],
            'prerequisites'  => ['nullable', 'string'],
            'spots'          => ['required', 'integer'],
            'spots_taken'    => ['required', 'integer'],
            'waitlist'       => ['required', 'integer'],
            'waitlist_taken' => ['required', 'integer'],
            'status_id'      => ['required', 'exists:event_statuses,id'],
            'start'          => ['required', 'date'],
            'end'            => ['required', 'date'],
            'grace'          => ['required', 'date'],
            'address'        => ['required'],
            'mail_subject'   => ['required'],
            'mail_body'      => ['required'],
            'classes'        => ['required', 'array'],
            'sorting'        => ['required', 'integer'],
            'author'         => ['required', 'exists:users,id'],
            'image'          => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            Log::info('Image file provided');
            $data['image'] = $request->file('image')->store('event_images', 'public');
        }

        return Event::create($data);
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $this->authorize('update', $event);

        $data = $request->validate([
            'title'          => ['required'],
            'description'    => ['nullable'],
            'prerequisites'  => ['nullable'],
            'spots'          => ['required', 'integer'],
            'spots_taken'    => ['required', 'integer'],
            'waitlist'       => ['required', 'integer'],
            'waitlist_taken' => ['required', 'integer'],
            'start'          => ['required', 'date'],
            'end'            => ['required', 'date'],
            'grace'          => ['required', 'date'],
            'address'        => ['required'],
            'mail_subject'   => ['required'],
            'mail_body'      => ['required'],
            'classes'        => ['required'],
            'sorting'        => ['required'],
            'author'         => ['required', 'exists:users,id'],
            'image'          => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $data['image'] = $request->file('image')->store('event_images', 'public');
        }

        $event->update($data);

        return $event;
    }

    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);

        $event->delete();

        return response()->json();
    }

    public function export(Event $event)
    {
        $this->authorize('export', $event);

        return response()->json();
    }
}
