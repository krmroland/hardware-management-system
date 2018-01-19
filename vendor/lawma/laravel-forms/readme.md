# Laravel-Forms

Laravel-Forms is  a laravel library that generates front end forms with fields, errors ,crsf_tokens,actions, method_fields using laravel's expressive syntax
 

Laravel-Forms is heavily inspired by Laravels Migrations Schemer Builder
(Illuminate\Database\Schema\Builder)

Laravel-Forms requires laravel >= 5.5.



# Table of Contents

- [Installation](#installation)
- [Basic Usage](#basic-usage)


## Installation

```
composer require lawma/larevel-forms
```

## Basic Usage
The great Laravel auto discovery package will register for you both the service provider and the Facade after installation.

Use `Form` facade in your blade views to generate the form fields

```
    {{
        Form::fields(function($form){
           $form->textField()->label("Clients Name")->name("name")
           $form->numberField()->label("AccountBalance")->name("accountBalance")->step(0.5);
           $form->button()->text('Create Client')->icon('fa fa-user');
        })->action(route("clients.store"))->method("POST")
    }}
```

* Basically the form has most of the field types the would expect namely;
    * ```$form->textField()``` 
    * ```$form->numberField()```
    * ```$form->emailField()``` 
    * ```$form->numberField() ```
    * ```$form->passwordField()```
 Every field extends the base field `Lawma\Forms\Field`  and has access to setters like the field name, field type.

##  Setting Models On Forms

You can set the model on a form, this can be useful when editing records 
 ```
 $form->model($user)
 ```
 You can as well as set the model on a specific field in rare circumstances where the form is using multiple fields
 ```
 $form->textField()->model($user)->name('name')
 ```
## Customizing Views
Out of the box , Laravel-Forms uses bootstrap 4 form fields, but you can publish them and customize them in which ever you want

* ## Todo
    * Complete The readme
    * Complete The docs



## License

Laravel-forms is released under the MIT Licence


