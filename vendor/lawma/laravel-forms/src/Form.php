<?php

namespace Lawma\Forms;

use Closure;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Contracts\Support\Htmlable;

class Form implements Htmlable
{
    use Macroable;
    /**
     * the form action.
     *
     * @var string
     */
    public $action = '';

    /**
     * the form method.
     *
     * @var string
     */
    public $method;

    /**
     * the forms attribute type.
     *
     * @var string
     */
    public $type = 'post';
    /**
     * the forms class attribute.
     */
    public $class = '';

    /**
     * the eloquent model to bind this form to.
     */
    public $model;

    /**
     * the form fields on this form.
     *
     * @var array
     */
    public $fields = [];

    /**
     * sets the forms action.
     *
     * @param string $action The action
     *
     * @return self
     */
    public function action($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * sets the form routing method.
     *
     * @return self
     */
    public function method($method)
    {
        return $this->setProperty('method', $method);
    }

    /**
     * sets the form type attribute.
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
     * set the form class attribute.
     */
    public function class($class)
    {
        return $this->setProperty('class', $class);
    }

    /**
     * Sets the property.
     *
     * @param string $prop  The property
     * @param string $value The value
     *
     * @return self
     */
    protected function setProperty($prop, $value)
    {
        $this->{$prop} = $value;

        return $this;
    }

    /**
     * create a new date field.
     *
     * @return App\Forms\Date
     */
    public function dateField()
    {
        return  $this->addField(resolve(Date::class));
    }

    /**
     * create a new Text field.
     *
     * @return \App\Forms\Text
     */
    public function textField()
    {
        return  $this->addField(resolve(Text::class));
    }

    /**
     * create a new Text field.
     *
     * @return \App\Forms\Text
     */
    public function passwordField()
    {
        return  $this->addField(resolve(Text::class)->type('password'));
    }

    public function customField()
    {
        return $this->addField(resolve(Custom::class));
    }

    /**
     * create a new Text field.
     *
     * @return \App\Forms\Text
     */
    public function emailField()
    {
        return  $this->addField(resolve(Text::class)->type('email'));
    }

    public function textArea()
    {
        return  $this->addField(resolve(TextArea::class));
    }

    /**
     * create a new Radio Field.
     *
     * @return \App\Forms\Radio
     */
    public function radioField()
    {
        return $this->addField(resolve(Radio::class));
    }

    public function checkboxField()
    {
        return $this->addField(resolve(CheckBoxField::class));
    }

    public function selectField()
    {
        return  $this->addField(resolve(Select::class));
    }

    /**
     * creates a new select field.
     *
     * @return \App\Forms\Number
     */
    public function numberField()
    {
        return $this->addField(resolve(Number::class));
    }

    /**
     * creates a new button field.
     *
     * @return \App\Forms\Button
     */
    public function button()
    {
        return $this->addField(resolve(Button::class));
    }

    /**
     * Adds a field to the form.
     *
     * @param App\Forms\Field $field
     */
    public function addField(Field  $field)
    {
        $this->fields[] = $field;

        return $field;
    }

    public function model($model)
    {
        return $this->setProperty('model', $model);
    }

    /**
     * render this object as html.
     *
     * @return
     */
    public function toHtml()
    {
        return view('forms::form', ['form' => $this])->render();
    }

    /**
     * specify form fields.
     *
     * @param Function $callback The callback
     */
    public function fields(Closure $callback)
    {
        $callback($this);

        return $this;
    }

    /**
     * merge two forms together.
     */
    public function merge($form)
    {
        $this->fields = array_merge($this->fields, $form->fields);

        return $this;
    }
}
