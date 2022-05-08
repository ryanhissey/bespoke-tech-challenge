<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Download;
use App\Models\Info;
use App\Models\Item;
use App\Models\Weblink;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Auth;

class ItemsController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Items/Index', [
            'items' => Item::paginate(10)
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Items/Create', []);
    }

    public function store()
    {
        $type = match (request()->input('content_type')) {
            'info' => new Info([
                'header' => request('content.header'),
                'content' => request('content.content'),
            ]),
            'download' => new Download([
                'url =' => request('content.url'),
            ]),
            'WEBLINK' => new Weblink([
                'url =' => request('content.url'),
            ]),
        };
        $type->save();

        $type->item()->save(new Item(request()->only(['name', 'description'])));

        return redirect()->route('admin.items.index')->with('message', 'Successfully Created Item');
    }

    public function edit(Item $item): Response
    {
        return Inertia::render('Items/Edit', [
            'item' => $item->load('content'),
        ]);
    }

    public function update(Item $item): RedirectResponse
    {
        $item->forceFill(request()->only(['name', 'description']));

        switch ($item->content_type) {
            case 'info':
                $item->content->header = request('content.header');
                $item->content->content = request('content.content');
                break;
            case 'download':
            case 'WEBLINK':
                $item->content->url = request('content.url');
                break;
        }

        $item->push();

        return redirect()->route('admin.items.index')->with('message', 'Successfully Updated Item');
    }

    public function search(Request $request) : JsonResponse
    {
        $posts=Item::where('name', 'LIKE','%'.$request->searchTerms."%")->get();
        return response()->json($posts);
    }

    public function destroy($id): RedirectResponse
    {
        if (Auth::user()->admin) {
            Item::find($id)->delete();
            return redirect()->route('admin.items.index')->with('message', 'Successfully Deleted Item');
        }

        return redirect()->route('admin.items.index')->with('message', 'Item could not be deleted');
    }
}
