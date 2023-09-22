<?php

namespace GizraRobo;

use Robo\ResultData;

/**
 * Coding standard checks for Drupal.
 */
trait PhpcsTasks {

  /**
   * Directories to scan.
   *
   * @var string[]
   */
  protected array $directories = [
    'modules/custom',
    'themes/custom',
    'profiles/custom',
    '../RoboFile.php',
    '../robo-components',
    'sites/default/settings.pantheon.php',
  ];

  /**
   * Standards to use.
   *
   * @var string[]
   */
  protected array $standards = [
    'Drupal',
    'DrupalPractice',
  ];

  /**
   * Ignore patterns.
   *
   * @var string
   */
  protected string $ignorePatterns = 'dist,node_modules';

  /**
   * Additional arguments.
   *
   * @var string
   */
  protected string $additionalArguments = "--parallel=8 -p --colors --extensions=php,module,inc,install,test,profile,theme,css,yaml,txt,md";

  /**
   * Perform a Code sniffer test, and fix when applicable.
   *
   * @return \Robo\ResultData|null
   *   If there was an error a result data object is returned. Or null if
   *   successful.
   */
  public function phpcs(): ?ResultData {
    $error_code = null;

    // Include themeName only if it actually exists.
    $ignore = '';
    if (!empty(self::$themeName)) {
      $ignore = "--ignore=" . self::$themeName . "/{$this->ignorePatterns}";
    } else {
      $ignore = "--ignore={$this->ignorePatterns}";
    }

    foreach ($this->directories as $directory) {
      foreach ($this->standards as $standard) {
        $arguments = $this->additionalArguments . " --standard=$standard $ignore";

        $commands = [
          'phpcbf',
          'phpcs',
        ];

        foreach ($commands as $command) {
          $result = $this->_exec("cd web && ../vendor/bin/$command $directory $arguments");
          if ($error_code === null && !$result->wasSuccessful()) {
            $error_code = $result->getExitCode();
          }
        }
      }
    }

    if ($error_code !== null) {
      return new ResultData($error_code, 'PHPCS found some issues');
    }
    return null;
  }
}
