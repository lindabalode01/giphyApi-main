<?php

namespace App;

class View
{
    private string $template;
    private array $gifData;
public function __construct(string $template, array $gifData)
{
    $this->template = $template;
    $this->gifData = $gifData;
}
public function getTemplate():string
{
    return $this->template;
}
public function getGifData():array
{
    return $this->gifData;
}
}