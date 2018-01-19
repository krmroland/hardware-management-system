<?php

namespace Lawma\Forms;

class Button extends Field
{
    /**
     * button icon.
     *
     * @var string
     */
    public $icon = 'fa fa-save';

    /**
     * button text.
     *
     * @var string
     */
    public $text = 'save';

    /**
     * button type.
     *
     * @var string
     */
    public $type = 'submit';

    /**
     * the view button.
     *
     * @return VieIlluminate\View\View
     */
    public function viewPath()
    {
        return 'forms::button';
    }

    /**
     * the data that will be passed to the view when being rendered.
     *
     * @return array
     */
    public function viewData()
    {
        return ['button' => $this];
    }

    /**
     * set the button text.
     *
     * @param string $text
     *
     * @return self
     */
    public function text($text)
    {
        return $this->setProperty('text', $text);
    }

    /**
     * set the button type.
     *
     * @param string $type
     *
     * @return self
     */
    public function type($type)
    {
        return $this->setProperty('type', $type);
    }

    /**
     * set the button icon.
     *
     * @param string $icon
     *
     * @return self
     */
    public function icon($icon)
    {
        return $this->setProperty('icon', $icon);
    }
}
