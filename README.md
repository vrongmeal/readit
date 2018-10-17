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

1. Clone the repository and `cd` into it
2. Run the following commands to install all dependencies
    ```shell
    $ composer install
    $ composer dump-autoload
    ```
3. Create a database called `readit` and import the file `public/schema.sql`
4. Start your server with `public` directory as root

Developed with ❤️ by [vrongmeal](https://github.com/vrongmeal)
