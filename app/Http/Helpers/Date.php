<?php

namespace Ajifatur\Helpers;

/**
 * @method static change(string $date)
 * @method static split(string $date)
 * @method static merge(array $date)
 * @method static object diff(string $from, string $to)
 */
class Date
{
    const DATESEPARATOR = ' - ';
    const TIMESEPARATOR = ' ';

    /**
     * Change date format.
     *
     * @param  string $date
     * @return string|null
     */
    public static function change($date)
    {
        // If the date format is YYYY-MM-DD
        if(is_int(strpos($date, '-'))) {
            $explode = explode('-', $date);
            return count($explode) == 3 ? $explode[2].'/'.$explode[1].'/'.$explode[0] : null;
        }
        // If the date format is DD/MM/YYYY
        elseif(is_int(strpos($date, '/'))){
            $explode = explode('/', $date);
            return count($explode) == 3 ? $explode[2].'-'.$explode[1].'-'.$explode[0] : null;
        }
        else return null;
    }

    /**
     * Split date from daterangepicker format.
     *
     * @param  string $date
     * @return array|null
     */
    public static function split($date)
    {
        // Split date by separator
        $times = explode(self::DATESEPARATOR, $date);

        // Set start time and end time
        if(count($times) == 2) {
            // Start time
            $start_time = explode(self::TIMESEPARATOR, $times[0]);
            $start_at = count($start_time) == 2 ? format_date($start_time[0], 'y-m-d').' '.$start_time[1].':00' : null;

            // End time
            $end_time = explode(self::TIMESEPARATOR, $times[1]);
            $end_at = count($end_time) == 2 ? format_date($end_time[0], 'y-m-d').' '.$end_time[1].':00' : null;
        }

        // Return
        return [$start_at, $end_at];
    }

    /**
     * Merge date to be daterangepicker format.
     *
     * @param  array $date
     * @return string
     */
    public static function merge($date)
    {
        // Validate date format
        if(count(array_filter($date)) == 2) {
            return date('d/m/Y H:i', strtotime($date[0])) . self::DATESEPARATOR . date('d/m/Y H:i', strtotime($date[1]));
        }
        else return '';
    }

    /**
     * Get the difference between two dates.
     *
     * @param  string $from
     * @param  string $to
     * @return int
     */
    public static function diff($from, $to = null)
    {
        $dateFrom = new \DateTime($from);
        $dateTo = $to == null ? new \DateTime('today') : new \DateTime($to);
        $diff = $dateTo->diff($dateFrom);
        return (array)$diff;
    }
}