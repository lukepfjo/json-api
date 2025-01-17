<?php

declare(strict_types=1);

namespace TiMacDonald\JsonApi;

use JsonSerializable;
use stdClass;

final class Link implements JsonSerializable
{
    use Concerns\Meta;

    /**
     * @internal
     *
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    private $href;

    /**
     * @param string $href
     * @param array<string, mixed> $meta
     * @return self
     */
    public static function self($href, $meta = [])
    {
        return new self('self', $href, $meta);
    }

    /**
     * @param string $href
     * @param array<string, mixed> $meta
     * @return self
     */
    public static function related($href, $meta = [])
    {
        return new self('related', $href, $meta);
    }

    /**
     * @param string $type
     * @param string $href
     * @param array<string, mixed> $meta
     */
    public function __construct($type, $href, $meta = [])
    {
        $this->type = $type;

        $this->href = $href;

        $this->meta = $meta;
    }

    /**
     * @return array{href: string, meta: stdClass}
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return [
            'href' => $this->href,
            'meta' => (object) $this->meta,
        ];
    }
}
