<?php

namespace App\Http\Controllers;

use App\Models\MediaAsset;
use App\Http\Requests\MediaAudioRequest;
use App\Http\Requests\MediaImageRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaAssetController extends Controller
{
    public function storeAudio(MediaAudioRequest $request): JsonResponse
    {
        $file = $request->file('file');
        $disk = config('filesystems.private_disk', 'private');
        $path = $file->store('audio/'.$request->user()->center_id, $disk);
        $asset = MediaAsset::create(['center_id' => $request->user()->center_id, 'uploaded_by' => $request->user()->id, 'asset_type' => 'AUDIO', 'original_name' => Str::limit($file->getClientOriginalName(), 255, ''), 'disk' => $disk, 'path' => $path, 'mime_type' => $file->getMimeType() ?: 'audio/mpeg', 'file_size' => $file->getSize(), 'checksum' => hash_file('sha256', $file->getRealPath()), 'metadata_json' => ['duration' => null], 'status' => 'READY']);
        return response()->json(['data' => ['id' => $asset->id, 'name' => $asset->original_name, 'mime_type' => $asset->mime_type, 'url' => route('media-assets.stream', $asset)]]);
    }

    public function storeImage(MediaImageRequest $request): JsonResponse
    {
        $file = $request->file('file');
        $disk = config('filesystems.private_disk', 'private');
        $path = $file->store('images/'.$request->user()->center_id, $disk);
        $dimensions = @getimagesize($file->getRealPath()) ?: [null, null];
        $asset = MediaAsset::create([
            'center_id' => $request->user()->center_id,
            'uploaded_by' => $request->user()->id,
            'asset_type' => 'IMAGE',
            'original_name' => Str::limit($file->getClientOriginalName(), 255, ''),
            'disk' => $disk,
            'path' => $path,
            'mime_type' => $file->getMimeType() ?: 'image/webp',
            'file_size' => $file->getSize(),
            'checksum' => hash_file('sha256', $file->getRealPath()),
            'metadata_json' => [
                'width' => $dimensions[0],
                'height' => $dimensions[1],
            ],
            'status' => 'READY',
        ]);

        return response()->json(['data' => [
            'id' => $asset->id,
            'name' => $asset->original_name,
            'mime_type' => $asset->mime_type,
            'url' => route('media-assets.stream', $asset),
        ]]);
    }

    public function stream(Request $request, MediaAsset $mediaAsset)
    {
        abort_unless($mediaAsset->center_id === $request->user()->center_id && in_array($mediaAsset->asset_type, ['AUDIO', 'IMAGE'], true) && $mediaAsset->status === 'READY', 404);
        return Storage::disk($mediaAsset->disk)->response($mediaAsset->path, $mediaAsset->original_name, ['Content-Type' => $mediaAsset->mime_type, 'Content-Disposition' => 'inline; filename="'.addslashes($mediaAsset->original_name).'"']);
    }
}
