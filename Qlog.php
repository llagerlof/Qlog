<?php
/**
 * Qlog
 *
 * PHP logger for debugging purposes. Human readable log. Zero configuration. No dependencies. One static class.
 *
 * Writes any value of any type to a log file in the same directory where the logging method was called.
 * The name of the log file is the same name of the file where it was called, plus '_qlog.log' or '_ll_qlog.log'
 * (for methods l() and ll() respectively).
 *
 * @package    Qlog
 * @version    2.1.1
 * @author     Lawrence Lagerlof <llagerlof@gmail.com>
 * @copyright  2019 Lawrence Lagerlof
 * @link       http://github.com/llagerlof/Qlog
 * @license    https://opensource.org/licenses/MIT MIT
 */
class Qlog
{
    /**
     * Log some data with a title in the log file. The l() stands for "Log".
     *
     * @param mixed $value The value to be logged.
     * @param string $value_name A text to be the title of the value in the log file.
     *
     * @return string Return the logged data.
     */
    public static function l($value, $value_name = null)
    {
        $arr_value = explode("\n", print_r($value, true));
        foreach($arr_value as $i => $line) {
            $arr_value[$i] = '    ' . $line;
        }
        $output_value = implode("\n", $arr_value);
        $separator = ((!is_array($value) && !is_object($value)) ? "\n" : '') . str_repeat('-', 80) . "\n\n";
        $logged =
            ((!empty($value_name) && is_string($value_name)) ? $value_name . " : " . gettype($value) : ':' . gettype($value)) . "\n\n" .
            $output_value . "\n" .
            $separator;

        $backtrace = debug_backtrace();
        $log_location = $backtrace[0]['file'].'_qlog.log';
        $write_success = is_writable(dirname($log_location)) && !is_dir($log_location) ? file_put_contents($log_location, $logged, FILE_APPEND) : false;

        $open_html_pre = php_sapi_name() == 'cli' ? '' : '<pre>';
        $close_html_pre = php_sapi_name() == 'cli' ? '' : '</pre>';

        return $open_html_pre . ($write_success ? '' : '* ') . $logged . $close_html_pre;
    }

    /**
     * Log a single line of data in the log file. The ll() stands for "Log Line".
     *
     * @param mixed $value The value to be logged.
     *
     * @return string Return the logged data.
     */
    public static function ll($value)
    {
        if (!is_null($value)) {
            if (is_scalar($value)) {
                $parsed = str_replace(array("\r\n", "\n"), array("", ""), (string)$value);
            } else {
                $parsed = trim(print_r($value, true));
                $parsed = trim(preg_replace('/\s+/', ' ', $parsed));
            }
        } else {
            $parsed = '[NULL]';
        }
        $logged = '[' . date('Y-m-d H:i:s') . '] ' . $parsed . "\n";

        $backtrace = debug_backtrace();
        $log_location = $backtrace[0]['file'].'_ll_qlog.log';
        $write_success = is_writable(dirname($log_location)) && !is_dir($log_location) ? file_put_contents($log_location, $logged, FILE_APPEND) : false;

        $open_html_pre = php_sapi_name() == 'cli' ? '' : '<pre>';
        $close_html_pre = php_sapi_name() == 'cli' ? '' : '</pre>';

        return $open_html_pre . ($write_success ? '' : '* ') . $logged . $close_html_pre;
    }
}
