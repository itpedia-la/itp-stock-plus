<?php

/**
 * Tool Controller
 * ---------------
 * @author Somwang
 *
 */
class Tool {

	/**
	 * Convert Mysql Date/Time to Formal standard format
	 * -------------------------------------------------
	 * @param unknown $mysqldatetime
	 */
	public static function toDate($mysqldatetime)
	{
		return $mysqldatetime != "" ? date('d-M-Y',strtotime($mysqldatetime)) : null;
	}
	
	/**
	 * Convert Mysql Date/Time to Formal standard format
	 * -------------------------------------------------
	 * @param unknown $mysqldatetime
	 */
	public static function toDateTime($mysqldatetime)
	{
		return $mysqldatetime ? date('d-M-Y H:i',strtotime($mysqldatetime)) : null;
	}
	
	/**
	 * Convert Date to mysql Datetime
	 * -------------------------------
	 */
	public static function toMySqlDate($date) {
		
		return $date ? date('Y-m-d',strtotime($date)) : NULL;
		
	}
	
	/**
	 * Convert input date Mysql Date/Time
	 * ----------------------------------
	 * @param unknown $mysqldatetime
	 */
	public static function toMySqlDateTime($date)
	{
		return date('Y-m-d H:i:00',strtotime($date));
	}
	
	
	/**
	 * Get Next Date
	 * -------------
	 * @param $date Date
	 * @param $number_of_date Number of Days
	 */
	public static function getNextDate($date, $number_of_date) {
	
		$next_date = strtotime("+".$number_of_date." days", strtotime($date));
		$next_date = date("Y-m-d",$next_date);
	
		return $next_date;
	}
	
	/**
	 * Next Date by Month
	 * -------------------
	 */
	public static function getNextDateByMonth($date, $number_of_month) {
		
		$next_date = strtotime("+".$number_of_month." months", strtotime($date));
		$next_date = date("Y-m-d",$next_date);
	
		return $next_date;
	}
	/**
	 * Date interval
	 * -------------
	 * @param $startDate Y-m-d
	 * @param $endDate Y-m-d
	 */
	public static function dateInterval($startDate, $endDate) {
		
		$startTimeStamp = strtotime($startDate);
		$endTimeStamp = strtotime($endDate);
		
		$timeDiff = abs($endTimeStamp - $startTimeStamp);
		
		$numberDays = $timeDiff/86400;  // 86400 seconds in one day
		
		// and you might want to convert to integer
		return $numberDays = intval($numberDays);
		
	}
	
	/**
	 * Discount calc
	 * --------------
	 */
	public static function discountCalc($total, $discount = 0) {
		
		$discount_value = ( $total * $discount) / 100;
		$remain_value = $total - $discount_value;
		
		return array('discount'=>$discount_value,'remain'=>$remain_value);
	}

}
