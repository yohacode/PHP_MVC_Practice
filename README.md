# PHP_MVC_Practice
Here’s a **README.md** tailored for your **custom MVC framework project**, written with clarity and professionalism for developers who want to use or contribute to your framework.

---

````markdown
# ⚙️ Custom PHP MVC Framework

A lightweight, developer-friendly custom MVC (Model-View-Controller) framework built with PHP. This framework is designed for rapid development with simplicity, flexibility, and performance in mind.

---

## 📦 Features

- ✨ Clean MVC Architecture (Controllers, Models, Views)
- 🌐 Custom Routing System (Supports GET, POST, and dynamic parameters)
- 📄 Templating Support with Custom View Class
- 🧰 Built-in Error Handling (Includes custom 404 and 500 pages)
- 🔐 Middleware Support (Authentication, CSRF, etc.)
- 📦 PSR-4 Autoloading via Composer
- 📝 Form Validation using Attributes
- 🧪 Easy to Extend and Customize

---

## 📁 Project Structure

```plaintext
project/
│
├── app/
│   ├── Controllers/
│   ├── Models/
│   ├── Views/
│   └── Middleware/
│
├── core/
│   ├── Router.php
│   ├── Controller.php
│   ├── View.php
│   └── Validator.php
│
├── public/
│   ├── index.php       # Entry point
│   └── .htaccess       # Apache rewrite rules
│
├── storage/
│   └── logs/
│
├── resources/
│   └── errors/
│       ├── 404.php
│       └── 500.php
│
├── composer.json
└── README.md
````

---

## 🚀 Getting Started

### 1. Clone the Repository

```bash
git clone https://github.com/your-username/custom-mvc-framework.git
cd custom-mvc-framework
```

### 2. Set Up Autoloading

Make sure `composer` is installed, then run:

```bash
composer dump-autoload
```

### 3. Set Up Virtual Host (Apache)

Ensure the `public/` directory is your document root.

`.htaccess` should already handle URL rewriting:

```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [QSA,L]
```

---

## 🧑‍💻 Usage

### Routing Example

In `Router.php` or your routes file:

```php
$router->get('/', 'HomeController@index');
$router->post('/login', 'AuthController@login');
$router->get('/user/{id}', 'UserController@show');
```

### Controller Example

```php
class HomeController extends Controller {
    public function index() {
        return view('home', ['title' => 'Welcome']);
    }
}
```

### View Example

```php
<!-- app/Views/home.php -->
<h1><?= $title ?></h1>
<p>This is a custom MVC framework.</p>
```

---

## 🧪 Error Handling

* **404 Error**: Custom `general.php` in `resources/errors/`
* **404 Error**: Custom `404.php` in `resources/errors/`
* **500 Error**: Custom `500.php` shows request and server info

Customize these templates as needed.

---

## ⚙️ Configuration

Coming soon — add your `config.php` in `/config` folder (you can create this manually to hold DB settings, app constants, etc.).

---

## 🛠 Planned Features

* ✅ Custom Form Validation using Attributes
* ✅ Middleware Layer
* ⏳ Session & Flash Messaging
* ⏳ Dependency Injection
* ⏳ CLI Tool for Generators (Controllers, Models, Migrations)
* ⏳ REST API Utilities

---

## 🧑‍🤝‍🧑 Contributing

Feel free to fork and submit pull requests!

1. Fork the repo
2. Create a branch: `git checkout -b feature-name`
3. Commit changes: `git commit -m "Add new feature"`
4. Push: `git push origin feature-name`
5. Open a Pull Request

---

## 🛡 License

This project is open-source under the MIT License.
See the `LICENSE` file for more details.

---

## 📬 Contact

Have questions or ideas? Open an issue or reach out to:

**Author**: \[Yohannes Zerihun]
**Email**: [johnpro3269@gmail.com](mailto:your.email@example.com)
**GitHub**: [yohacode](https://github.com/yohacode)

---

```

