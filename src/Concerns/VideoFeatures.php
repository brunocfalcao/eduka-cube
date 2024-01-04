<?php

namespace Eduka\Cube\Concerns;

trait VideoFeatures
{
    public function vimeoMetadata(array $extraData = []): array
    {
        return array_merge($extraData, [
            'name' => $this->name,
            'description' => $this->description,
            'embed.title.name' => 'show',
            'hide_from_vimeo' => true,
            'privacy.view' => 'unlisted',
            'privacy.embed' => 'whitelist',
            // The embed domains are all domains part of the user admin course.
            'embed_domains' => $this->createdBy->courses->first()->domains->pluck('name'),
        ]);
    }
}
