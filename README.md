# Qlog
PHP logger for debugging purposes. Zero configuration. No dependencies. One static class. Human readable log.

## Quick start

**1.** Include the file ```Qlog.php``` in your script. Let's suppose, ```/var/www/htdocs/program.php```:

```php
require_once('Qlog.php');
```

**2.** Call the static method l():

```php
$myvar = array(1, 2, 3);

Qlog::l($myvar, '$myvar'); // log the variable value and a title for this entry (the title is '$myvar')

// OR

Qlog::l($myvar); // log only the variable value
```

**3.** Open the log file in the same directory of your script:

```/var/www/htdocs/program.php_qlog.log```

### Log content example:

```
$myvar:

    Array
    (
        [0] => 1
        [1] => 2
        [2] => 3
    )
    
-------------------------------------------------------------------------------- 

$records:

    Array
    (
        [0] => Array
            (
                [name] => Pro-Tarr
                [age] => 75
            )
    
        [1] => Array
            (
                [name] => Midgard
                [age] => 42
            )
    
    )
    
--------------------------------------------------------------------------------

$text:

    The quick brown fox jumps over the lazy dog.

--------------------------------------------------------------------------------

$number_int:

    7

--------------------------------------------------------------------------------

$this_is_a_float:

    1234.19

--------------------------------------------------------------------------------

$myobject:

    stdClass Object
    (
        [property_A] => any value
        [property_B] => other value
    )
    
--------------------------------------------------------------------------------
```
