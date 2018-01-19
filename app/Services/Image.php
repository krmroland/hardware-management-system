<?php

namespace App\Services;

use Intervention\Image\Facades\Image as Intervention;
use Illuminate\Support\Facades\Storage;

class Image implements \JsonSerializable
{
    /**
     * @var App\Services\Path
     */
    protected $path;

    /**
     * the image we are working with.
     *
     * @var mixed
     */
    protected $image;
    /**
     * the directory wher the image will rest.
     */
    protected $directory;

    /**
     * instantiate this class.
     *
     * @param string $directory The directory
     * @param string $name      The name
     */
    public function __construct(string $directory, string $name)
    {
        $this->setPath($directory, $name);

        $this->directory = $directory;
    }

    /**
     * laoads an instance on the class.
     *
     * @param miexed $image
     *
     * @return self
     */
    public function load($image)
    {
        $this->setImage($image);

        return $this;
    }

    /**
     * Makes a thumbnail.
     *
     * @param int $width
     * @param int $height
     */
    public function makeThumbnail($width = 100, $height = 100)
    {
        $this->store($this->getImage()->resize($width, $height));

        return $this;
    }

    /**
     * persist the image to its resting space.
     *
     * @param Image $image =
     *
     * @return self
     */
    protected function store($image)
    {
        Storage::put($this->path->storage, $image->encode(), 'public');

        return $this;
    }

    /**
     * Gets the the image we are working with.
     *
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Sets the the image we are working with.
     *
     * @param mixed $image the image
     *
     * @return self
     */
    protected function setImage($image)
    {
        $this->image = Intervention::make($image);

        return $this;
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->path();
    }

    public function jsonSerialize()
    {
        return $this->path();
    }

    public function path()
    {
        if (Storage::exists($this->path->storage)) {
            return $this->path->url;
        }

        return '/storage/default.png';
    }

    /**
     * Sets the the image path.
     *
     * @param mixed $directory
     * @param mixed $path
     *
     * @return self
     */
    protected function setPath($directory, $name)
    {
        $this->path = Path::make($directory, $name);

        return $this;
    }
}
