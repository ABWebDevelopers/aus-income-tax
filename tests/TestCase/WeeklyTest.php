<?php
namespace ABWeb\IncomeTax\Tests\TestCase;

use ABWeb\IncomeTax\IncomeTax;
use ABWeb\IncomeTax\Source\TaxTables2015;

class WeeklyTest extends \PHPUnit_Framework_TestCase
{
    // Values taken from https://www.ato.gov.au/uploadedFiles/Content/MEI/downloads/Schedule-1-Calculating-amounts-to-be-withheld-2015-16.pdf
    protected $data = [
        '1' => [ // Scale 1 - No tax-free threshold
            44 => 8,
            45 => 9,
            116 => 25,
            117 => 25,
            249 => 56,
            250 => 56,
            354 => 80,
            355 => 81,
            360 => 82,
            361 => 82,
            394 => 94,
            395 => 94,
            492 => 128,
            493 => 128,
            659 => 186,
            660 => 186,
            710 => 204,
            711 => 204,
            825 => 244,
            826 => 244,
            931 => 280,
            932 => 281,
            1187 => 369,
            1188 => 369,
            1281 => 405,
            1282 => 406,
            1537 => 505,
            1538 => 506,
            1844 => 625,
            1845 => 625,
            2119 => 732,
            2120 => 733,
            2490 => 877,
            2491 => 877,
            2652 => 940,
            2653 => 940,
            2736 => 973,
            2737 => 973,
            2898 => 1036,
            2899 => 1036,
            2913 => 1042,
            2914 => 1042,
            3110 => 1119,
            3111 => 1119,
            3460 => 1290,
            3461 => 1291
        ],
        '2' => [ // Scale 2 - With tax-free threshold
            44 => 0,
            45 => 0,
            116 => 0,
            117 => 0,
            249 => 0,
            250 => 0,
            354 => 0,
            355 => 0,
            360 => 1,
            361 => 1,
            394 => 8,
            395 => 8,
            492 => 36,
            493 => 36,
            659 => 71,
            660 => 71,
            710 => 82,
            711 => 82,
            825 => 122,
            826 => 122,
            931 => 159,
            932 => 159,
            1187 => 248,
            1188 => 248,
            1281 => 280,
            1282 => 281,
            1537 => 369,
            1538 => 369,
            1844 => 488,
            1845 => 489,
            2119 => 596,
            2120 => 596,
            2490 => 740,
            2491 => 741,
            2652 => 803,
            2653 => 804,
            2736 => 836,
            2737 => 837,
            2898 => 899,
            2899 => 900,
            2913 => 905,
            2914 => 906,
            3110 => 982,
            3111 => 982,
            3460 => 1119,
            3461 => 1119
        ]
    ];

    public function setUp()
    {
        $this->IncomeTax = new IncomeTax(TaxTables2015::source());
    }

    public function testScaleOne()
    {
        foreach ($this->data[1] as $earnings => $expectedTax) {
            $tax = $this->IncomeTax->calculateTax($earnings, 1);
            $this->assertEquals($expectedTax, $tax, 'Scale 1 - Weekly Earnings: ' . $earnings);
        }
    }

    public function testScaleTwo()
    {
        foreach ($this->data[2] as $earnings => $expectedTax) {
            $tax = $this->IncomeTax->calculateTax($earnings, 2);
            $this->assertEquals($expectedTax, $tax, 'Scale 2 - Weekly Earnings: ' . $earnings);
        }
    }
}