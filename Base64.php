<?php
/**
 * Base64 implementation based on MiGBase64.
 * Note: Line separation has been removed.
 *
 * Made data: 09/01/17
 * Author: captain-redbeard
 */
namespace Redbeard;

class Base64
{
    const BASE_PAD =
    [
        0x0041, 0x0042, 0x0043, 0x0044, 0x0045, 0x0046, 0x0047, 0x0048, 0x0049, 0x004a, 0x004b, 0x004c, 0x004d,
        0x004e, 0x004f, 0x0050, 0x0051, 0x0052, 0x0053, 0x0054, 0x0055, 0x0056, 0x0057, 0x0058, 0x0059, 0x005a,
        0x0061, 0x0062, 0x0063, 0x0064, 0x0065, 0x0066, 0x0067, 0x0068, 0x0069, 0x006a, 0x006b, 0x006c, 0x006d,
        0x006e, 0x006f, 0x0070, 0x0071, 0x0072, 0x0073, 0x0074, 0x0075, 0x0076, 0x0077, 0x0078, 0x0079, 0x007a,
        0x0030, 0x0031, 0x0032, 0x0033, 0x0034, 0x0035, 0x0036, 0x0037, 0x0038, 0x0039, 0x002b, 0x002f, 0x003d
    ];
    
    const SAFE_PAD =
    [
        0x0041, 0x0042, 0x0043, 0x0044, 0x0045, 0x0046, 0x0047, 0x0048, 0x0049, 0x004a, 0x004b, 0x004c, 0x004d,
        0x004e, 0x004f, 0x0050, 0x0051, 0x0052, 0x0053, 0x0054, 0x0055, 0x0056, 0x0057, 0x0058, 0x0059, 0x005a,
        0x0061, 0x0062, 0x0063, 0x0064, 0x0065, 0x0066, 0x0067, 0x0068, 0x0069, 0x006a, 0x006b, 0x006c, 0x006d,
        0x006e, 0x006f, 0x0070, 0x0071, 0x0072, 0x0073, 0x0074, 0x0075, 0x0076, 0x0077, 0x0078, 0x0079, 0x007a,
        0x0030, 0x0031, 0x0032, 0x0033, 0x0034, 0x0035, 0x0036, 0x0037, 0x0038, 0x0039, 0x002d, 0x005f, 0x003d
    ];
    
    const BASE_DECODE_PAD =
    [
        -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
        -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 62, -1, -1, -1, 63, 52, 53, 54, 55,
        56, 57, 58, 59, 60, 61, -1, -1, -1, 0, -1, -1, -1, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15,
        16, 17, 18, 19, 20, 21, 22, 23, 24, 25, -1, -1, -1, -1, -1, -1, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35,
        36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
        -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
        -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
        -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
        -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
        -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1
    ];
    
    const SAFE_DECODE_PAD =
    [
        -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
        -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 62, -1, -1, 52, 53, 54, 55,
        56, 57, 58, 59, 60, 61, -1, -1, -1, 0, -1, -1, -1, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15,
        16, 17, 18, 19, 20, 21, 22, 23, 24, 25, -1, -1, -1, -1, 63, -1, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35,
        36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
        -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
        -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
        -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
        -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
        -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1
    ];

    public static function encode($data)
    {
        return self::encodeRaw($data, self::SAFE_PAD);
    }
    
    public static function decode($data)
    {
        return self::decodeRaw($data, self::SAFE_DECODE_PAD);
    }
    
    public static function encodeRaw($data, $pad)
    {
        $dataLength = strlen($data);
        $data = str_split($data, 1);
        $evenLength = floor($dataLength / 3) * 3;
        $characterCount = (($dataLength - 1) / 3 + 1) << 2;
        $b = 0;
        $baseData = [];
        
        //Encode data
        for ($d = 0; $d < $dataLength;) {
            $c = $d + 1;
            $bits = (ord($data[$d++]) & 0xff) << 16;
            
            if ($c + 1 <= $dataLength) {
                $bits |= (ord($data[$d++]) & 0xff) << 8;
            }
            
            if ($c + 2 <= $dataLength) {
                $bits |= (ord($data[$d++]) & 0xff);
            }
            
            $baseData[$b++] = $pad[self::zeroFill($bits, 18) & 0x3f];
            $baseData[$b++] = $pad[self::zeroFill($bits, 12) & 0x3f];
            
            if ($c + 1 <= $dataLength) {
                $baseData[$b++] = $pad[self::zeroFill($bits, 6) & 0x3f];
            }
            
            if ($c + 2 <= $dataLength) {
                $baseData[$b++] = $pad[$bits & 0x3f];
            }
        }
        
        //Add padding
        $left = $dataLength - $evenLength;
        if ($left > 0) {
            $bits = (ord($data[$evenLength]) & 0xff) << 10;
            $bits |= $left == 2 ? (ord($data[$dataLength - 1]) & 0xff) << 2 : 0;

            //Set last four characters
            $baseData[$characterCount - 4] = $pad[$bits >> 12];
            $baseData[$characterCount - 3] = $pad[self::zeroFill($bits, 6) & 0x3f];
            $baseData[$characterCount - 2] = $left == 2 ? $pad[$bits & 0x3f] : $pad[64];
            $baseData[$characterCount - 1] = $pad[64];
        }
        
        //Return string
        return trim(implode(array_map("chr", $baseData)));
    }
    
    public static function decodeRaw($data, $pad)
    {
        $dataLength = strlen($data);
        $data = str_split($data, 1);
        $startIndex = 0;
        $endIndex = $dataLength - 1;
        $paddingLength = ord($data[$endIndex]) === '=' ? (ord($data[$endIndex -1]) === '=' ? 2 : 1) : 0;
        $evenLength = floor($dataLength / 3) * 3;
        $characterCount = $endIndex - $startIndex + 1;
        $length = ($characterCount * 6 >> 3) - $paddingLength;
        $d = 0;
        $b = 0;
        $rawData = [];
        
        //Decode data
        for ($d = 0; $d < $evenLength;) {
            $bits = $pad[ord($data[$b++])] << 18;
            $bits |= $pad[ord($data[$b++])] << 12;
            $bits |= $pad[ord($data[$b++])] << 6;
            $bits |= $pad[ord($data[$b++])];
            
            $rawData[$d++] = ($bits >> 16);
            $rawData[$d++] = ($bits >> 8);
            $rawData[$d++] = $bits;
        }
        
        //Decode last 1-3 bytes
        if ($d < $length) {
            $i = 0;
            
            for ($j = 0; $b <= $endIndex - $paddingLength; $j++) {
                $i |= $pad[$data[$b++]] << (18 - j * 6);
            }
            
            for ($r = 16; $d < $length; $r -= 8) {
                $rawData[$d++] = ($i >> $r);
            }
        }
        
        //Return string
        return trim(implode(array_map("chr", $rawData)));
    }
    
    public static function zeroFill($a, $b)
    { 
        if ($a >= 0) {
            return $a >> $b;
        }
        
        if ($b === 0) {
            return (($a >> 1) & 0x7fffffff) * 2 +(($a >> $b) &1);
        }
        
        return ((~$a) >> $b) ^ (0x7fffffff >> ($b - 1));
    }
    
}