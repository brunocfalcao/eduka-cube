<?php

namespace Eduka\Cube\Concerns;

use Eduka\Cube\Models\Student;
use Illuminate\Support\Facades\Storage;

trait EpisodeFeatures
{
    public function processFilename()
    {
        info('inside process filename');
    }

    /**
     * Grabs the destination vimeo episode folder URI. If the episode is part
     * of a chapter, then returns that one, if not then returns the
     * course folder URI.
     */
    public function getUploadVimeoFolderURI()
    {
        return $this?->chapter->vimeo_uri ?
            $this->chapter->vimeo_uri :
            $this->course->vimeo_uri;
    }

    /**
     * Returns the default vimeo metadata for a episode upload. Allows the
     * extra data merging with the main data array.
     */
    public function getVimeoVideoDefaultMetadata(array $extraData = []): array
    {
        return array_merge($extraData, [
            'name' => $this->name,
            'description' => $this->description,
            'embed.title.name' => 'show',
            'hide_from_vimeo' => true,
            'privacy.view' => 'unlisted',
            'privacy.download' => true,
            'privacy.embed' => 'whitelist',
            'embed_domains' => $this->course->domain,
        ]);
    }

    /**
     * Returns computed attribute 'metas', with all the meta tags
     * to be rendered in an HTML page.
     */
    public function getMetasAttribute()
    {
        return [
            'name|twitter:description' => $this->description,
            'name|twitter:card' => 'summary_large_image',
            'name|twitter:site' => $this->course->twitter_handle,
            'name|twitter:image' => Storage::url($this->filename_logo),
            'name|twitter:creator' => $this->course->twitter_handle,
            'name|twitter:title' => $this->name,

            'property|og:description' => $this->description,
            'property|og:url' => 'https://' . $this->course->domain,
            'property|og:type' => 'article',
            'property|og:image' => Storage::url($this->filename_logo),
            'property|og:title' => $this->name,
        ];
    }

    public function wasSeenByStudent(Student $student)
    {
        return $student->isEpisodeSeen($this);
    }

    public function previousEpisode() {}

    public function nextEpisode() {}

    public function hasPreviousEpisode()
    {
        return $this->previousEpisode() !== null;
    }

    public function hasNextEpisode()
    {
        return $this->nextEpisode() !== null;
    }
}
