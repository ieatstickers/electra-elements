<?php

namespace Electra\Elements;

use Electra\Core\Exception\ElectraException;

class Element
{
  /**
   * @return false|string
   * @throws ElectraException
   */
  public function render()
  {
    $reflector = new \ReflectionClass(get_called_class());
    $templatePath = str_replace('.php', '.phtml', $reflector->getFileName());

    if (!file_exists($templatePath))
    {
      throw new ElectraException('Template does not exist');
    }

    ob_start();
    try {
      require_once($templatePath);
      $html = ob_get_contents();
    }
    catch(\Exception $exception)
    {
      $html = $exception;
    }
    ob_end_clean();

    return $html;
  }
}
