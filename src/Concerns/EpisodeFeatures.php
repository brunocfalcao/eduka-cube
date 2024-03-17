<?php

namespace Eduka\Cube\Concerns;

trait EpisodeFeatures
{
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
}
