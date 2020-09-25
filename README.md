# Laravel View Identifiers

A quick way to set view identifiers to main HTML DOM element in [Laravel 5](http://laravel.com/). Let's call those identifiers: global classes and global id.


## Documentation

* [Possibilities](#possibilities)
* [Installation](#installation)
* [Configuration](#configuration)
    - [Converting Styles](#converting-styles)
    - [Auto Discovery](#auto-discovery)
* [Usage](#usage)
    - [Defaults](#defaults)
    - [Own Identifiers](#own-identifiers)
* [If You Need Help](#if-you-need-help)
* [Credits](#credits)
* [License](#license)


## Possibilities

This package gives you the possibility:
- to set identifiers on main HTML elements depending on some backend criteria
- to easily detect in JavaScript or CSS what page is loaded
- to make DOM manipulations in JavaScript only on certain set of pages, __for example__ on all Admin Panel pages
- to set some styles only on certain set of pages, __for example__ on all Article View pages, but not in Admin Panel

etc.


## Installation

__For older versions of Laravel (not tested yet) see: [Laravel 5.0-5.4](https://github.com/hypnotract/laravel-view-identifiers/tree/5.0.0) and [Laravel 5.5](https://github.com/hypnotract/laravel-view-identifiers/tree/5.5.0).__

```bash
composer require hypnotract/laravel-view-identifiers
```


## Configuration
You can publish the config file to change the default settings.

```bash
php artisan vendor:publish --provider="Hypnotract\ViewIdentifier\ServiceProvider" --tag=config
```

#### Converting Styles

##### Supported Values and Examples

__kebab__ converts strings into "kebab-case"

__snake__ converts strings into "snake_case"

__camel__ converts strings into "camelCase"

__studly__ converts strings into "StudlyCase"

#### Auto Discovery

By default, auto discovery is enabled. It means that classes and id will be set up for you, depending on controller and action name.

##### Controllers Namespace

If your controllers namespace differs from the default one `App\Http\Controllers`, you can set your own namespace.


## Usage

#### Defaults

By default, classes and id auto discovery is enabled, and you can set these to the needed HTML elements right away.

```html
<div class="content {{ ViewIdentifier::class()->get() }}">
```

```html
<html id="{{ ViewIdentifier::id()->get() }}" lang="en">
```

```html
<body id="{{ ViewIdentifier::id()->get() }}" class="{{ ViewIdentifier::class()->get() }}">
```

To disable auto discovery, see [Configure Auto Discovery](#auto-discovery).

##### Examples

`App\Http\Controllers\Web\PageController::show` will get the __id__ `web-page-show` and the __class__: `web page show`.

`App\Http\Controllers\Admin\PageController::edit` will get the __id__ `admin-page-edit` and the __class__: `admin page edit`.

`App\Http\Controllers\ArticleController::view` will get the __id__ `article-view` and the __class__: `article view`.

#### Own Identifiers

If you want to set your own or any additional identifiers, you can do it like so:

```php
\ViewIdentifier::id()->set('whateverId');

\ViewIdentifier::class()->push('whateverClass');
\ViewIdentifier::class()->push('whateverSecondClass');
```

You can pass strings in any case style you want, as those will be converted to the styles set in configuration file.

##### Examples

```php
use ViewIdentifier;

class AdminController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        ViewIdentifier::class()->push('adminPanel');
    }
}

class ArticlesController extends AdminController
{
    public function __construct()
    {
        parent::__construct();

        ViewIdentifier::class()->push('article');
    }
    
    public function index()
    {
        ViewIdentifier::class()->push('index');
        
        $articles = Article::index()->paginate(25);
    
        return View::make('admin.articles.index')->with(compact('articles'));
    }
}
```

And the result __class__ in `ViewIdentifier::class()->get()` will be: `admin-panel article index`.


## If You Need Help

Please submit all issues and questions using GitHub issues and I will try to help you.


## Credits

* [Denis Dostali](https://github.com/hypnotract)


## License

*Laravel View Identifiers* is free software distributed under the terms of the MIT license.
