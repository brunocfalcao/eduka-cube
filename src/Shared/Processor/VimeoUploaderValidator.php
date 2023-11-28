<?php

namespace Eduka\Cube\Shared\Processor;

use Eduka\Cube\Models\Course;
use Eduka\Cube\Models\Video;
use Eduka\Cube\Models\VideoStorage;
use Exception;
use Illuminate\Support\Facades\Storage;

class VimeoUploaderValidator
{
    private function __construct(
        private Video|null $video,
        private VideoStorage|null $storage,
        private Course|null $course,
    ) {
    }

    public static function findUsingVideoId(int $id, int $courseId): self
    {
        $video = Video::query()
            ->with([
                'videoStorage',
            ])
            ->where('id', $id)
            ->first();

        if (!$video) {
            return new VimeoUploaderValidator(null, null, null);
        }

        $course = Course::find($courseId);

        if (!$course) {
            return new VimeoUploaderValidator(null, null, null);
        }

        return new VimeoUploaderValidator($video, $video->videoStorage, $course);
    }

    public function ensureDataExistsInDatabase(): self
    {
        if (!$this->video || !$this->storage || !$this->course) {
            throw new Exception('Revelant resources does not exists');
        }

        return $this;
    }

    /**
     * @return self
     */
    public function refreshCourse(): self
    {
        $this->course->fresh();

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
        return $this->getCourse()->name;
    }

    public function getCourse(): Course
    {
        return $this->course;
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
        return $this->course->vimeo_project_id;
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
