<?php

namespace App\Products;

class Bundler implements \JsonSerializable
{
    protected $product;

    /**
     * instatiate the bundler class.
     *
     * @param \App\Product $product
     */
    public function __construct($product)
    {
        $this->product = $product;
    }

    /**
     * the compond Name  eg 14 sodas => 1 crate and 2 bottles.
     *
     * @return string
     */
    public function name()
    {
        //if we have no quantity then we are probably not going to
        //bother our computer instead we will abort immediately

        if (!$this->isBundled() || $this->isLessThanABundle()) {
            return $this->pieces($this->product->availableQuantity);
        }

        if ($this->product->availableQuantity <= 0) {
            return;
        }

        return $this->compoundName();
    }

    /**
     * the compound name of the bundles.
     *
     * @return string
     */
    protected function compoundName()
    {
        $pieces = $this->product->availableQuantity % $this->product->unitsPerBundle;

        if (!$pieces) {
            return $this->bundles();
        }

        return sprintf('%s and %s', $this->bundles(), $this->pieces($pieces));
    }

    /**
     * the pluralized pieces in a bundles.
     *
     * @param int $pieces The pieces
     *
     * @return string
     */
    protected function pieces($pieces)
    {
        return $this->pluralize($pieces, $this->product->unitName);
    }

    /**
     * the pluralized version of the bundles.
     *
     * @return string
     */
    protected function bundles()
    {
        $bundles = floor($this->product->availableQuantity / $this->product->unitsPerBundle);

        return $this->pluralize($bundles, $this->product->bundleName);
    }

    /**
     * Determines if bundled.
     *
     * @return bool
     */
    protected function isBundled()
    {
        return (bool) ($this->product->bundleName);
    }

    /**
     * Determines if less than a bundle.
     *
     * @return bool
     */
    protected function isLessThanABundle()
    {
        return (bool) ($this->product->availableQuantity < $this->product->unitsPerBundle);
    }

    /**
     * pluralize the qunatity eg 1 crate or 2 crates.
     *
     * @param string $count
     * @param string $string
     *
     * @return string ( description_of_the_return_value )
     */
    protected function pluralize($count, $string)
    {
        return $count.' '.str_plural($string, $count);
    }

    public function jsonSerialize()
    {
        return[
            'name' => $this->name(),
            'unitPlural' => str_plural($this->product->unitName),
            'bundlePlural' => str_plural($this->product->bundleName ?: ''),
        ];
    }

    public function __toString()
    {
        return (string) $this->name();
    }
}
