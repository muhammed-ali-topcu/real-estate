<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyImageController extends Controller
{
    public function upload(Property $property, Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $property->addMedia($request->file('image'))->toMediaCollection('images');
        }

        return back()->with('success', __('Image uploaded successfully.'));
    }

    public function delete(Property $property, int $mediaId)
    {
        $media = $property->getMedia('images')->find($mediaId);

        if ($media) {
            $media->delete();
            return back()->with('success', __('Image deleted successfully.'));
        }

        return back()->with('error', __('Image not found.'));
    }
}
