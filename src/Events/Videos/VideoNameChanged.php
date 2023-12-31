<?php

namespace Eduka\Cube\Events\Videos;

use Eduka\Cube\Models\Video;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VideoNameChanged
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Video $video;

    public function __construct(Video $video)
    {
        $this->video = $video;
    }
}
