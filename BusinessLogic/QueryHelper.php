<?php 

class QueryHelper {
    public static function SurroundWithQuotes(string $str): string {
        return "'" . $str . "'";
    }

}