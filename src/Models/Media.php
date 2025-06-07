<?php

namespace Skokosioulis\LaravelMedia\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media';

    protected $fillable = [
        'name',
        'file_name',
        'mime_type',
        'disk',
        'path',
        'size',
        'type',
        'metadata',
        'alt_text',
        'description',
        'collection_name',
        'order_column',
        'checksum',
    ];

    protected $casts = [
        'metadata' => 'array',
        'size' => 'integer',
        'order_column' => 'integer',
    ];

    protected $appends = [
        'url',
        'human_readable_size',
        'extension',
    ];

    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getUrlAttribute(): string
    {
        return Storage::disk($this->disk)->url($this->path);
    }

    public function getHumanReadableSizeAttribute(): string
    {
        $bytes = $this->size;
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function getExtensionAttribute(): string
    {
        return pathinfo($this->name, PATHINFO_EXTENSION);
    }

    public function isImage(): bool
    {
        return Str::startsWith($this->mime_type, 'image/');
    }

    public function isVideo(): bool
    {
        return Str::startsWith($this->mime_type, 'video/');
    }

    public function isAudio(): bool
    {
        return Str::startsWith($this->mime_type, 'audio/');
    }

    public function isPdf(): bool
    {
        return $this->mime_type === 'application/pdf';
    }

    public function isDocument(): bool
    {
        $documentMimes = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'text/plain',
        ];

        return in_array($this->mime_type, $documentMimes);
    }

    public function getTypeFromMimeType(): string
    {
        if ($this->isImage()) {
            return 'image';
        }

        if ($this->isVideo()) {
            return 'video';
        }

        if ($this->isAudio()) {
            return 'audio';
        }

        if ($this->isDocument()) {
            return 'document';
        }

        return 'file';
    }

    public function delete(): ?bool
    {
        // Delete the physical file
        if (Storage::disk($this->disk)->exists($this->path)) {
            Storage::disk($this->disk)->delete($this->path);
        }

        return parent::delete();
    }

    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    public function scopeInCollection($query, string $collection)
    {
        return $query->where('collection_name', $collection);
    }

    public function scopeImages($query)
    {
        return $query->where('type', 'image');
    }

    public function scopeDocuments($query)
    {
        return $query->where('type', 'document');
    }

    public function scopeVideos($query)
    {
        return $query->where('type', 'video');
    }

    public function scopeAudio($query)
    {
        return $query->where('type', 'audio');
    }
}
