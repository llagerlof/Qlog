<?php
/**
 * Qlog
 *
 * PHP logger for debugging purposes. Human readable log. Zero configuration. No dependencies. One static class.
 *
 * @package    Qlog
 * @version    2.0.0
 * @author     Lawrence Lagerlof <llagerlof@gmail.com>
 * @copyright  2018 Lawrence Lagerlof
 * @link       http://github.com/llagerlof/Qlog
 * @license    https://opensource.org/licenses/MIT MIT
 */
class Qlog
{
    /**
     * Writes a variable to a log file in the same directory where the l() method was called
     *
     * The name of the log file is the same name of the file where it was called, plus '_qlog.log'
     *
     * @param mixed $variable The variable to be logged
     * @param string $variable_name A text to be the title of the variable in the log file
     *
     * @return string Return the logged data
     */
    public static function l($variable, $variable_name = null)
    {
        $arr_variable = explode("\n", print_r($variable, true));
        foreach($arr_variable as $i => $line) {
            $arr_variable[$i] = '    ' . $line;
        }
        $output_variable = implode("\n", $arr_variable);
        $separator = ((!is_array($variable) && !is_object($variable)) ? "\n" : '') . str_repeat('-', 80) . "\n\n";
        $logged =
            ((!empty($variable_name) && is_string($variable_name)) ? $variable_name . ":\n\n" : '') .
            $output_variable . "\n" .
            $separator;

        $backtrace = debug_backtrace();
        $log_location = $backtrace[0]['file'].'_qlog.log';
        $write_success = is_writable(dirname($log_location)) ? file_put_contents($log_location, $logged, FILE_APPEND) : false;

        $open_html_pre = php_sapi_name() == 'cli' ? '' : '<pre>';
        $close_html_pre = php_sapi_name() == 'cli' ? '' : '</pre>';

        return $open_html_pre . ($write_success ? '' : '* ') . $logged . $close_html_pre;
    }
}
