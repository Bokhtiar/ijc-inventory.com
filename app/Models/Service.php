<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rakibhstu\Banglanumber\NumberToBangla;

class Service extends Model 
{
    use HasFactory;

    protected $table = 'services';
    protected $primaryKey = 'service_id';

    protected $fillable = [
        'description_service',
        'govt_fees',
        'others_expenses',
        'professional_fees',
        'tax',
        'vat',
        'grand_total'
    ];

    public static function moneyCurrency($number){
        $numto = new NumberToBangla();
        $text = $numto->bnCommaLakh($number);
        $search_array = ['১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০'];
        $replace_array = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];
        $en_number = str_replace($search_array, $replace_array, $text);
        return $en_number;
    }


    public static function numberToWordConvert($num = '')
    {
        $num    = (string) ((int) $num);
        if ((int) ($num) && ctype_digit($num)) {
            $words  = array();
            $num    = str_replace(array(',', ' '), '', trim($num));
            $list1  = array(
                '', 'one', 'two', 'three', 'four', 'five', 'six', 'seven',

                'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen',

                'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
            );

            $list2  = array(
                '', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty',

                'seventy', 'eighty', 'ninety', 'hundred'
            );

            $list3  = array(
                '', 'thousand', 'million', 'billion', 'trillion',

                'quadrillion', 'quintillion', 'sextillion', 'septillion',

                'octillion', 'nonillion', 'decillion', 'undecillion',

                'duodecillion', 'tredecillion', 'quattuordecillion',

                'quindecillion', 'sexdecillion', 'septendecillion',

                'octodecillion', 'novemdecillion', 'vigintillion'
            );

            $num_length = strlen($num);

            $levels = (int) (($num_length + 2) / 3);

            $max_length = $levels * 3;

            $num    = substr('00' . $num, -$max_length);

            $num_levels = str_split($num, 3);

            foreach ($num_levels as $num_part) {

                $levels--;

                $hundreds   = (int) ($num_part / 100);

                $hundreds   = ($hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ($hundreds == 1 ? '' : 's') . ' ' : '');

                $tens       = (int) ($num_part % 100);

                $singles    = '';

                if ($tens < 20) {
                    $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '');
                } else {
                    $tens = (int) ($tens / 10);
                    $tens = ' ' . $list2[$tens] . ' ';
                    $singles = (int) ($num_part % 10);
                    $singles = ' ' . $list1[$singles] . ' ';
                }
                $words[] = $hundreds . $tens . $singles . (($levels && (int) ($num_part)) ? ' ' . $list3[$levels] . ' ' : '');
            }
            $commas = count($words);
            if ($commas > 1) {

                $commas = $commas - 1;
            }

            $words  = implode(', ', $words);

            $words  = trim(str_replace(' ,', ',', ucwords($words)), ', ');

            if ($commas) {

                $words  = str_replace(',', ' and', $words);
            }

            return $words;
        } else if (!((int) $num)) {

            return 'Zero';
        }

        return '';
    }
}
