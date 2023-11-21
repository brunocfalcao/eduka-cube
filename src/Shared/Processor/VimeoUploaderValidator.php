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
        private Video|null $video,
        private VideoStorage|null $storage,
        private Variant|null $variant,
        private Course|null $course,
    ) {
    }

    public static function findUsingVideoId(int $id): self
    {
        $video = Video::select('id', 'name', 'meta_description', 'vimeo_id', 'chapter_id')
            ->with([
                'videoStorage',
                'variant' => function ($variant) {
                    $variant
                        ->select('chapter_variant.variant_id', 'chapter_variant.chapter_id', 'variants.course_id', 'variants.vimeo_project_id')
                        ->with(['course' => function ($course) {
                            $course->select('id', 'name');
                        }]);
                }
            ])
            ->where('id', $id)
            ->first();

        if (!$video) {
            return new VimeoUploaderValidator(null, null, null, null);
        }

        return new VimeoUploaderValidator($video, $video->videoStorage, $video->variant, $video->variant->course);
    }

    public function ensureDataExistsInDatabase(): self
    {
        if (!$this->video || !$this->storage || !$this->variant || !$this->course) {
            throw new Exception('Revelant resources does not exists');
        }

        return $this;
    }

    public function ensureVideoExistsOnDisk(): self
    {
        if (!$this->videoExistsOnDisk()) {
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

    public function getVimeoProjectId(): string|null
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
