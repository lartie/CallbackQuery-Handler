# CallbackQuery-Handler

```php
<?php

namespace LArtie\Backend\Callbacks;

class PaginateCallback extends CallbackCommand
{
    /**
     * @var string CallbackQuery command
     */
    protected $name = "paginate";

    /**
     * @var string
     */
    protected $description = "Paginate";
    
    /**
     * @var bool
     */
    protected $autoAnswer = true;

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {

    }
}
```
