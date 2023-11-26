<?php

namespace Eduka\Cube\Shared\Processor;

use Eduka\Cube\Models\Course;
use Eduka\Cube\Models\Variant;
use Eduka\Cube\Models\Video;
use Eduka\Cube\Models\VideoStorage;
use Exception;
use Illuminate\Support\Facades\Storage;

class VimeoUploaderValidator
{
    private function __construct(
        private ?Video $video,
        private ?VideoStorage $storage,
        private ?Variant $variant,
        private ?Course $course,
    ) {
    }

    public static function findUsingVideoId(int $id, int $variantId): self
    {
        $video = Video::query()
            ->with([
                'videoStorage',
                'chapter' => function ($chapter) use ($variantId) {
                    $chapter
                        ->select('id', 'variant_id')
                        ->with([
                            'variants' => function ($variantsQuery) use ($variantId) {
                                $variantsQuery
                                    ->where('chapter_variant.variant_id', $variantId)
                                    ->with([
                                        'course' => function ($course) {
                                            $course->select('id', 'name');
                                        },
                                    ]);
                            },
                        ]);
                },
            ])
            ->where('id', $id)
            ->first();

        if (! $video) {
            return new VimeoUploaderValidator(null, null, null, null);
        }

        $variant = $video->chapter->variants->first();

        return new VimeoUploaderValidator($video, $video->videoStorage, $variant, $variant->course);
    }

    public function ensureDataExistsInDatabase(): self
    {
        if (! $this->video || ! $this->storage || ! $this->variant || ! $this->course) {
            throw new Exception('Revelant resources does not exists');
        }

        return $this;
    }

    public function refreshVariant(): self
    {
        $this->variant->fresh();

        return $this;
    }

    public function ensureVideoExistsOnDisk(): self
    {
        if (! $this->videoExistsOnDisk()) {
            throw new Exception('Video does not exist on disk');
        }

        return $this;
    }

    public function getVideoMetadata(): array
    {
        return $this->video->vimeoMetadata();
    }

    public function videoExistsOnDisk(): bool
    {
        return Storage::exists($this->storage->path_on_disk);
    }

    public function getCourseName(): string
    {
        return $this->course->name;
    }

    public function getVariant(): Variant
    {
        return $this->variant;
    }

    public function getVideoStorage(): VideoStorage
    {
        return $this->storage;
    }

    public function getVideo(): Video
    {
        return $this->video;
    }

    public function getVideoName(): string
    {
        return $this->video->name;
    }

    public function getVimeoProjectId(): ?string
    {
        return $this->variant->vimeo_project_id;
    }

    public function getVideoFilePathFromDisk(): string
    {
        return Storage::path($this->storage->path_on_disk);
    }

    public function getNotificationChannelName(): string
    {
        return 'vimeo';
    }
}
