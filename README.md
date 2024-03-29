# Qlog
PHP logger for debugging purposes. Human readable log. Zero configuration. No dependencies. One static class.

## Quick start

**1.** Include the file ```Qlog.php``` in your script. Let's suppose, ```/var/www/htdocs/program.php```:

```php
require_once('Qlog.php');
```

**2.** Call the static method l() or ll()

### Method l() stands for [L]og

```php
$myvar = array(1, 2, 3);

// Log only the variable value.
Qlog::l($myvar);

// Log the variable value and a title for this entry (the title is '$myvar').
Qlog::l($myvar, '$myvar');

// Log the variable value and a title for this entry, and write the logged data to standard output too.
// If the first character of returned value is an *, this means the log file could not be saved.
echo Qlog::l($myvar, '$myvar');
```

**3.** Open the log file in the same directory of your script:

```/var/www/htdocs/program.php_qlog.log```

The ```_qlog``` in the log file name is to easily find the log files generated by this class.

### Log content example:

```
2021-09-29 07:55:50

$myvar : array

    Array
    (
        [0] => 1
        [1] => 2
        [2] => 3
    )

--------------------------------------------------------------------------------

2021-09-29 09:02:25

$records : array

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

2021-09-29 09:02:25

$text : string

    The quick brown fox jumps over the lazy dog.

--------------------------------------------------------------------------------

2021-09-29 09:05:01

$number : integer

    7

--------------------------------------------------------------------------------

2021-09-29 14:45:00

$value : double

    1234.19

--------------------------------------------------------------------------------

2021-09-29 14:45:00

$c : object

    stdClass Object
    (
        [property_A] => any value
        [property_B] => other value
    )

--------------------------------------------------------------------------------
```

### Method ll() stands for [L]og [L]ine

**Log just one line per call**

```php
Qlog::ll('This is a log message.');

Qlog::ll(array('I can write arrays or objects in one line', 'too'));

$i = 100;
Qlog::ll($i);

Qlog::ll(null);
```

Open the log file in the same directory of your script. It has the '_ll_qlog.log' suffix:

```/var/www/htdocs/program.php_ll_qlog.log```

The ```_ll_qlog``` in the log file name is to easily find the log files generated by this class.

Or you can pass the log file name as second parameter:

```php
Qlog::ll('Just a temporary log with full path.', '/tmp/mylog.txt');

Qlog::ll('Write this file in the same directory of script, but with a custom name.', 'mylog.txt');
```

### Log content example:

```
[2019-08-21 14:45:51] This is a log message.
[2019-08-21 17:02:27] Array ( [0] => I can write arrays or objects in one line [1] => too )
[2019-08-21 17:02:27] 100
[2019-08-21 17:03:00] [NULL]
```
