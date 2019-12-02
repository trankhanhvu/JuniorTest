<?php
namespace Magenest\ChapterEight\Model;

use Magenest\ChapterEight\Api\MyInterface;

class MyClass implements MyInterface
{

    public function foo()
    {
        echo "foo";
    }
}