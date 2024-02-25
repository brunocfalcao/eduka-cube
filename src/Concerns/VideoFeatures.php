<?php

namespace Eduka\Cube\Concerns;

trait VideoFeatures
{
    /**
     * Grabs the destination vimeo video folder URI. If the video is part
     * of a chapter, then returns that one, if not then returns the
     * course folder URI.
     *
     * @return string
     */
    public function getUploadVimeoFolderURI()
    {
        return $this?->chapter->vimeo_uri ?
                $this->chapter->vimeo_uri :
                $this->course->vimeo_uri;
    }

    public function getVimeoMetadata(array $extraData = []): array
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
}
