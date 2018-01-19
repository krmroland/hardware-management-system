<?php

namespace Lawma\Forms;

class Date extends Field
{
    /**
     * the maximum date.
     *
     * @var string
     */
    public $maximum = '';
    /**
     * the date mode.
     *
     * @var string
     */
    public $mode = 'single';
    /**
     * the name attribute.
     *
     * @var string
     */
    public $name = 'date';

    /**
     * sets the maximum.
     *
     * @param string $max
     *
     * @return self
     */
    public function maximum($max)
    {
        $this->maximum = $max;

        return $this;
    }

    /**
     * sets the mode.
     *
     * @param string $mode
     *
     * @return self
     */
    public function mode($mode)
    {
        $this->mode = $mode;

        return $this;
    }

    /**
     * the date view.
     *
     * @return string
     */
    public function viewPath()
    {
        return 'forms::dateField';
    }

    public function viewData()
    {
        return ['date' => $this];
    }
}
