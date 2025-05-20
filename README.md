# MultiException

MultiException - это простой контейнер для ваших исключений, который сам по себе является исключением

## Требования

- php >= 8.0

## Установка

composer require customer41/multiexception

## Использование

```php
<?php

class Article
{
    public string $title;
    public string $description;
    
    public function __construct(string $title, string $description)
    {
        $errors = new MultiException();
        
        $this->setTitle($title);
        $this->setDescription($description);
        
        if (count($errors) > 0) {
            throw $errors;
        }
    }
    
    private function setTitle(string $title): void
    {
        if (!empty($title)) {
            $this->title = $title;
        } else {
            $errors->add(new \Exception('Пустой заголовок'));
        }
    }
    
    private function setDescription(string $description): void
    {
        if (!empty($description)) {
            $this->description = $description;
        } else {
            $errors->add(new \Exception('Пустое описание'));
        }
    }
}
```

В контроллере:
```php
class ArticleController
{
    public function createArticle(): void
    {
        try {
            $article = new Article($_POST['title'], $_POST['description']);
        } catch (MultiException $errors) {
            ...
        }
    }
}
```

В шаблоне:
```php
<?php foreach ($errors as $error): ?>
    <div class="alert alert-danger">
        <?php echo $error->getMessage(); ?>
    </div>
<?php endforeach; ?>
```
