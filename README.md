# LaraveLLama

**LaraveLLama** is your top choice for building modern, full-stack web applications with artificial intelligence, right from your local environment.

Start your project effortlessly with a Laravel 10 installation. LaraveLLama also comes with Vue.js and Vue Router pre-configured! Plus, it includes the Ollama API, offering functionalities for model management, prompt generation, format setting, and more.

This repository is perfect for developers eager to harness the power of AI in their applications. Experience the convenience of having the Ollama API fully integrated and ready to use in your Laravel projects.

![image](https://github.com/xndrgit/xndr-laravellama/assets/115892862/bfb499ce-238e-4fb9-a0ef-dd0c0e3e30c1)

**Just do it! Join the Future of Web Development!**

## A sneak peek into what we have here🙈:
![image](https://github.com/xndrgit/xndr-laravellama/assets/115892862/5b166163-bbf8-4172-911d-12b0827096a4)

## Prerequisites 🛠️
Before you begin, ensure that you have the following prerequisites installed on your system:
- PHP >= 8.2 (XAMPP 8.2 for easy PHP setup)
- OLLAMA installed and running

## Contact Information 📞
Feel free to reach out to me if you have any questions or need assistance:
- Instagram: [xndr.ig](https://www.instagram.com/xndr.ig/)
- Gmail: [mymails.xander@gmail.com](mailto:mymails.xander@gmail.com)


## How to start use it?🛠

### clone the repo
```bash
git clone https://github.com/xndrgit/xndr-laravellama.git your-project-name
```
### rename .env-example to .env

### that's it!
```bash
npm install
composer install
npm run dev
php artisan serve
```

## How was integrated ollama in laravel? How it works?🛠

### If you use laravel 10.x, please use the following version V1.0.5

```bash
https://github.com/cloudstudio/ollama-laravel/releases/tag/v1.0.5
```

### Installation

```bash
composer require cloudstudio/ollama-laravel
```

### Configuration

```bash
php artisan vendor:publish --tag="ollama-laravel-config"
```

Published config file:

```php
return [
    'model' => env('OLLAMA_MODEL', 'llama2'),
    'url' => env('OLLAMA_URL', 'http://127.0.0.1:11434'),
    'default_prompt' => env('OLLAMA_DEFAULT_PROMPT', 'Hello, how can I assist you today?'),
    'connection' => [
        'timeout' => env('OLLAMA_CONNECTION_TIMEOUT', 300),
    ],
];
```

### Usage

#### Basic Usage

```php
use Cloudstudio\Ollama\Facades\Ollama;

$response = Ollama::agent('You are a weather expert...')
    ->prompt('Why is the sky blue?')
    ->model('llama2')
    ->options(['temperature' => 0.8])
    ->stream(false)
    ->ask();
```


#### Vision Support
    
```php
$response = Ollama::model('llava:13b')
    ->prompt('What is in this picture?')
    ->image(public_path('images/example.jpg')) 
    ->ask();

// "The image features a close-up of a person's hand, wearing bright pink fingernail polish and blue nail polish. In addition to the colorful nails, the hand has two tattoos – one is a cross and the other is an eye."

```

#### Chat Completion

```php
$messages = [
    ['role' => 'user', 'content' => 'My name is Toni Soriano and I live in Spain'],
    ['role' => 'assistant', 'content' => 'Nice to meet you , Toni Soriano'],
    ['role' => 'user', 'content' => 'where I live ?'],
];

$response = Ollama::agent('You know me really well!')
    ->model('llama2')
    ->chat($messages);

// "You mentioned that you live in Spain."

```

#### Show Model Information

```php
$response = Ollama::model('Llama2')->show();
```

#### Copy a Model

```php
Ollama::model('Llama2')->copy('NewModel');
```

#### Delete a Model

```php
Ollama::model('Llama2')->delete();
```

#### Generate Embeddings

```php
$embeddings = Ollama::model('Llama2')->embeddings('Your prompt here');
```

### Testing

```bash
pest
```

### Ollama-Laravel package
https://github.com/cloudstudio/ollama-laravel/tree/main

## Security Vulnerabilities & Collaborations 💌
If you discover a security vulnerability or want to collaborate, please send an email to Xndr via [mymails.xander@gmail.com](mailto:mymails.xander@gmail.com)



