# Readit

Discussion forum made with PHP using ToroPHP and Twig as a template engine. It is based upon the MVC (Model View Controller) directory structure.

```
|-- app
    |-- controllers
    |-- models
    |-- views
        |-- templates
```

### Setup

1. Clone the repository
2. Run the following command:
   ```sh
   $ cd Readit
   $ composer init
   ```
Make sure you have composer installed, if not refer to [this link](https://getcomposer.org/download/)
3. On running the `init` command you'll find `composer.json` file. Add the following lines to the json file:
   ```json
   "require": {
        "torophp/torophp": "dev-master",
        "twig/twig": "^2.0"
    },
    "autoload": {
        "classmap": [
            "app"
        ]
    }
   ```
The `require` part includes ToroPHP and Twig, `autoload` part includes all the classes inside `app` folder.
4. Now run the following commands:
   ```sh
   $ composer install
   $ composer dump-autoload
   ```
5. Create a database called `readit` and import the file `public/schema.sql`
6. Start your server with `public` directory as root

Developed with ❤️ by [vrongmeal](https://github.com/vrongmeal)
