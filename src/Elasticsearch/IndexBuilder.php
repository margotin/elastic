<?php

declare(strict_types=1);

namespace App\Elasticsearch;

use Elastica\Client;
use Elastica\Index;
use Symfony\Component\Yaml\Yaml;

class IndexBuilder
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function create(): Index
    {
        // We name our index "blog"
        $index = $this->client->getIndex('blog');

        $settings = Yaml::parse(
            file_get_contents(
                __DIR__.'/../../config/elasticsearch_index_blog.yaml'
            )
        );

        // We build our index settings and mapping
        $index->create($settings, true);

        return $index;
    }
}