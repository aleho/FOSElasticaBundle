<?php

/*
 * This file is part of the FOSElasticaBundle package.
 *
 * (c) FriendsOfSymfony <https://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FOS\ElasticaBundle\Configuration;

/**
 * Index template configuration class.
 *
 * @author Dmitry Balabka <dmitry.balabka@intexsys.lv>
 *
 * @phpstan-import-type TConfig from IndexConfigInterface
 */
class IndexTemplateConfig implements IndexConfigInterface
{
    use IndexConfigTrait;

    /**
     * Index name patterns.
     *
     * @var string
     */
    private $indexPatterns;

    /**
     * Constructor expects an array as generated by the Container Configuration builder.
     *
     * @phpstan-param TConfig $config
     */
    public function __construct(array $config)
    {
        $this->elasticSearchName = $config['elasticsearch_name'] ?? $config['name'];
        $this->name = $config['name'];
        // @phpstan-ignore-next-line Ignored because of a bug in PHPStan (https://github.com/phpstan/phpstan/issues/5091)
        $this->settings = $config['settings'] ?? [];
        // @phpstan-ignore-next-line Ignored because of a bug in PHPStan (https://github.com/phpstan/phpstan/issues/5091)
        $this->config = $config['config'];
        // @phpstan-ignore-next-line Ignored because of a bug in PHPStan (https://github.com/phpstan/phpstan/issues/5091)
        $this->mapping = $config['mapping'];

        if (!isset($config['index_patterns'])) {
            throw new \InvalidArgumentException('Index "index_patterns" value must be set');
        }

        $this->indexPatterns = $config['index_patterns'];
    }

    /**
     * Gets index name pattern.
     */
    public function getIndexPatterns(): string
    {
        return $this->indexPatterns;
    }
}
