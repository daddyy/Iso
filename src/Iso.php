<?php
namespace daddyy\Iso {

    /**
     * Static class for search the iso norm for lang, currency, country
     * @author fiala.pvl@gmail.com
     */
    class Iso
    {
        /**
         * [getConstant description]
         * @param  string $key
         * @return array
         */
        private static function getConstant(string $key): array
        {
            $result = false;
            $type   = false;
            $try    = [
                $key,
                ucfirst($key),
                strtoupper($key),
                strtolower($key),
            ];
            foreach ($try as $key => $type) {
                if (defined('self::' . $type)) {
                    break;
                }

            }
            if ($type) {
                $result = constant('self::' . $type);
            } else {
                throw new \Exception("Constant '" . $key . "' does not exists");
            }
            return $result;
        }

        /**
         * search for exact code by setted buffer
         * @param  string      $code  search value
         * @param  array       $vars  search in
         * @param  string|null $byKey search by exact key
         * @return array
         */
        public static function search(string $code, array $vars, string $byKey = null): array
        {
            $result = [];
            if ($byKey) {
                $tempTest = reset($vars);
                if ($byKey == 'auto') {
                    foreach ($tempTest as $key => $value) {
                        if (is_string($value) || is_numeric($value)) {
                            $result = self::search($code, $vars, $key);
                            if ($result) {
                                break;
                            }
                        }
                    }
                } else {                
                    if (isset($tempTest[$byKey])) {
                        foreach ($vars as $key => $var) {
                            if (isset($var[$byKey]) && $var[$byKey] == $code) {
                                $result = $var;
                                break;
                            }
                        }
                    }
                }
            } elseif (self::isAplha3($code)) {
                $code = strtoupper($code);
                if (isset($vars[$code])) {
                    $result = $vars[$code];
                }
            }
            return $result;
        }

        /**
         * [isAplha3 description]
         * @param  string  $code searched code
         * @return boolean
         */
        private static function isAplha3(string $code): bollean
        {
            $result = true;
            if (ctype_alpha($code) == false) {
                $result = false;
                throw new \Exception("the string '" . $code . "' must be only alphabetical");
            }
            if (strlen($code) <> 3) {
                $result = false;
                throw new \Exception("the string length '" . $code . "' must be 3");
            }
            return $result;
        }

        /**
         * [getCurrency description]
         * @param  string      $code  [description]
         * @param  string|null $byKey [description]
         * @return array              [description]
         */
        public static function getCurrency(string $code, string $byKey = null): array
        {
            $vars   = self::getConstant('currencies');
            $result = self::search($code, $vars, $byKey);
            return $result;
        }

        /**
         * [getCountry description]
         * @param  string      $code  [description]
         * @param  string|null $byKey [description]
         * @return array              [description]
         */
        public static function getCountry(string $code, string $byKey = null): array
        {
            $vars   = self::getConstant('countries');
            $result = self::search($code, $vars, $byKey);
            return $result;
        }

        /**
         * [getLanguage description]
         * @param  string      $code  [description]
         * @param  string|null $byKey [description]
         * @return array              [description]
         */
        public static function getLanguage(string $code, string $byKey = null): array
        {
            $vars   = self::getConstant('languages');
            $result = self::search($code, $vars, $byKey);
            return $result;
        }

        /**
         * array where the key is by ISO alpha3
         */
        const LANGUAGES = [
            'AAR' => [
                'alpha2' => 'AA',
                'alpha3' => 'AAR',
                'name'   => 'Afar',
            ],
            'ABK' => [
                'alpha2' => 'AB',
                'alpha3' => 'ABK',
                'name'   => 'Abkhaz',
            ],
            'AVE' => [
                'alpha2' => 'AE',
                'alpha3' => 'AVE',
                'name'   => 'Avestan',
            ],
            'AFR' => [
                'alpha2' => 'AF',
                'alpha3' => 'AFR',
                'name'   => 'Afrikaans',
            ],
            'AKA' => [
                'alpha2' => 'AK',
                'alpha3' => 'AKA',
                'name'   => 'Akan',
            ],
            'AMH' => [
                'alpha2' => 'AM',
                'alpha3' => 'AMH',
                'name'   => 'Amharic',
            ],
            'ARG' => [
                'alpha2' => 'AN',
                'alpha3' => 'ARG',
                'name'   => 'Aragonese',
            ],
            'ARA' => [
                'alpha2' => 'AR',
                'alpha3' => 'ARA',
                'name'   => 'Arabic',
            ],
            'ASM' => [
                'alpha2' => 'AS',
                'alpha3' => 'ASM',
                'name'   => 'Assamese',
            ],
            'AVA' => [
                'alpha2' => 'AV',
                'alpha3' => 'AVA',
                'name'   => 'Avaric',
            ],
            'AYM' => [
                'alpha2' => 'AY',
                'alpha3' => 'AYM',
                'name'   => 'Aymara',
            ],
            'AZE' => [
                'alpha2' => 'AZ',
                'alpha3' => 'AZE',
                'name'   => 'Azerbaijani',
            ],
            'BAK' => [
                'alpha2' => 'BA',
                'alpha3' => 'BAK',
                'name'   => 'Bashkir',
            ],
            'BEL' => [
                'alpha2' => 'BE',
                'alpha3' => 'BEL',
                'name'   => 'Belarusian',
            ],
            'BUL' => [
                'alpha2' => 'BG',
                'alpha3' => 'BUL',
                'name'   => 'Bulgarian',
            ],
            'BIH' => [
                'alpha2' => 'BH',
                'alpha3' => 'BIH',
                'name'   => 'Bihari',
            ],
            'BIS' => [
                'alpha2' => 'BI',
                'alpha3' => 'BIS',
                'name'   => 'Bislama',
            ],
            'BAM' => [
                'alpha2' => 'BM',
                'alpha3' => 'BAM',
                'name'   => 'Bambara',
            ],
            'BEN' => [
                'alpha2' => 'BN',
                'alpha3' => 'BEN',
                'name'   => 'Bengali, Bangla',
            ],
            'BOD' => [
                'alpha2' => 'BO',
                'alpha3' => 'BOD',
                'name'   => 'Tibetan Standard, Tibetan, Central',
            ],
            'BRE' => [
                'alpha2' => 'BR',
                'alpha3' => 'BRE',
                'name'   => 'Breton',
            ],
            'BOS' => [
                'alpha2' => 'BS',
                'alpha3' => 'BOS',
                'name'   => 'Bosnian',
            ],
            'CAT' => [
                'alpha2' => 'CA',
                'alpha3' => 'CAT',
                'name'   => 'Catalan',
            ],
            'CHE' => [
                'alpha2' => 'CE',
                'alpha3' => 'CHE',
                'name'   => 'Chechen',
            ],
            'CHA' => [
                'alpha2' => 'CH',
                'alpha3' => 'CHA',
                'name'   => 'Chamorro',
            ],
            'COS' => [
                'alpha2' => 'CO',
                'alpha3' => 'COS',
                'name'   => 'Corsican',
            ],
            'CRE' => [
                'alpha2' => 'CR',
                'alpha3' => 'CRE',
                'name'   => 'Cree',
            ],
            'CES' => [
                'alpha2' => 'CS',
                'alpha3' => 'CES',
                'name'   => 'Czech',
            ],
            'CHU' => [
                'alpha2' => 'CU',
                'alpha3' => 'CHU',
                'name'   => 'Old Church Slavonic, Church Slavonic, Old Bulgarian',
            ],
            'CHV' => [
                'alpha2' => 'CV',
                'alpha3' => 'CHV',
                'name'   => 'Chuvash',
            ],
            'CYM' => [
                'alpha2' => 'CY',
                'alpha3' => 'CYM',
                'name'   => 'Welsh',
            ],
            'DAN' => [
                'alpha2' => 'DA',
                'alpha3' => 'DAN',
                'name'   => 'Danish',
            ],
            'DEU' => [
                'alpha2' => 'DE',
                'alpha3' => 'DEU',
                'name'   => 'German',
            ],
            'DIV' => [
                'alpha2' => 'DV',
                'alpha3' => 'DIV',
                'name'   => 'Divehi, Dhivehi, Maldivian',
            ],
            'DZO' => [
                'alpha2' => 'DZ',
                'alpha3' => 'DZO',
                'name'   => 'Dzongkha',
            ],
            'EWE' => [
                'alpha2' => 'EE',
                'alpha3' => 'EWE',
                'name'   => 'Ewe',
            ],
            'ELL' => [
                'alpha2' => 'EL',
                'alpha3' => 'ELL',
                'name'   => 'Greek (modern)',
            ],
            'ENG' => [
                'alpha2' => 'EN',
                'alpha3' => 'ENG',
                'name'   => 'English',
            ],
            'EPO' => [
                'alpha2' => 'EO',
                'alpha3' => 'EPO',
                'name'   => 'Esperanto',
            ],
            'SPA' => [
                'alpha2' => 'ES',
                'alpha3' => 'SPA',
                'name'   => 'Spanish',
            ],
            'EST' => [
                'alpha2' => 'ET',
                'alpha3' => 'EST',
                'name'   => 'Estonian',
            ],
            'EUS' => [
                'alpha2' => 'EU',
                'alpha3' => 'EUS',
                'name'   => 'Basque',
            ],
            'FAS' => [
                'alpha2' => 'FA',
                'alpha3' => 'FAS',
                'name'   => 'Persian (Farsi)',
            ],
            'FUL' => [
                'alpha2' => 'FF',
                'alpha3' => 'FUL',
                'name'   => 'Fula, Fulah, Pulaar, Pular',
            ],
            'FIN' => [
                'alpha2' => 'FI',
                'alpha3' => 'FIN',
                'name'   => 'Finnish',
            ],
            'FIJ' => [
                'alpha2' => 'FJ',
                'alpha3' => 'FIJ',
                'name'   => 'Fijian',
            ],
            'FAO' => [
                'alpha2' => 'FO',
                'alpha3' => 'FAO',
                'name'   => 'Faroese',
            ],
            'FRA' => [
                'alpha2' => 'FR',
                'alpha3' => 'FRA',
                'name'   => 'French',
            ],
            'FRY' => [
                'alpha2' => 'FY',
                'alpha3' => 'FRY',
                'name'   => 'Western Frisian',
            ],
            'GLE' => [
                'alpha2' => 'GA',
                'alpha3' => 'GLE',
                'name'   => 'Irish',
            ],
            'GLA' => [
                'alpha2' => 'GD',
                'alpha3' => 'GLA',
                'name'   => 'Scottish Gaelic, Gaelic',
            ],
            'GLG' => [
                'alpha2' => 'GL',
                'alpha3' => 'GLG',
                'name'   => 'Galician',
            ],
            'GRN' => [
                'alpha2' => 'GN',
                'alpha3' => 'GRN',
                'name'   => 'Guaraní',
            ],
            'GUJ' => [
                'alpha2' => 'GU',
                'alpha3' => 'GUJ',
                'name'   => 'Gujarati',
            ],
            'GLV' => [
                'alpha2' => 'GV',
                'alpha3' => 'GLV',
                'name'   => 'Manx',
            ],
            'HAU' => [
                'alpha2' => 'HA',
                'alpha3' => 'HAU',
                'name'   => 'Hausa',
            ],
            'HEB' => [
                'alpha2' => 'HE',
                'alpha3' => 'HEB',
                'name'   => 'Hebrew (modern)',
            ],
            'HIN' => [
                'alpha2' => 'HI',
                'alpha3' => 'HIN',
                'name'   => 'Hindi',
            ],
            'HMO' => [
                'alpha2' => 'HO',
                'alpha3' => 'HMO',
                'name'   => 'Hiri Motu',
            ],
            'HRV' => [
                'alpha2' => 'HR',
                'alpha3' => 'HRV',
                'name'   => 'Croatian',
            ],
            'HAT' => [
                'alpha2' => 'HT',
                'alpha3' => 'HAT',
                'name'   => 'Haitian, Haitian Creole',
            ],
            'HUN' => [
                'alpha2' => 'HU',
                'alpha3' => 'HUN',
                'name'   => 'Hungarian',
            ],
            'HYE' => [
                'alpha2' => 'HY',
                'alpha3' => 'HYE',
                'name'   => 'Armenian',
            ],
            'HER' => [
                'alpha2' => 'HZ',
                'alpha3' => 'HER',
                'name'   => 'Herero',
            ],
            'INA' => [
                'alpha2' => 'IA',
                'alpha3' => 'INA',
                'name'   => 'Interlingua',
            ],
            'IND' => [
                'alpha2' => 'ID',
                'alpha3' => 'IND',
                'name'   => 'Indonesian',
            ],
            'ILE' => [
                'alpha2' => 'IE',
                'alpha3' => 'ILE',
                'name'   => 'Interlingue',
            ],
            'IBO' => [
                'alpha2' => 'IG',
                'alpha3' => 'IBO',
                'name'   => 'Igbo',
            ],
            'III' => [
                'alpha2' => 'II',
                'alpha3' => 'III',
                'name'   => 'Nuosu',
            ],
            'IPK' => [
                'alpha2' => 'IK',
                'alpha3' => 'IPK',
                'name'   => 'Inupiaq',
            ],
            'IDO' => [
                'alpha2' => 'IO',
                'alpha3' => 'IDO',
                'name'   => 'Ido',
            ],
            'ISL' => [
                'alpha2' => 'IS',
                'alpha3' => 'ISL',
                'name'   => 'Icelandic',
            ],
            'ITA' => [
                'alpha2' => 'IT',
                'alpha3' => 'ITA',
                'name'   => 'Italian',
            ],
            'IKU' => [
                'alpha2' => 'IU',
                'alpha3' => 'IKU',
                'name'   => 'Inuktitut',
            ],
            'JPN' => [
                'alpha2' => 'JA',
                'alpha3' => 'JPN',
                'name'   => 'Japanese',
            ],
            'JAV' => [
                'alpha2' => 'JV',
                'alpha3' => 'JAV',
                'name'   => 'Javanese',
            ],
            'KAT' => [
                'alpha2' => 'KA',
                'alpha3' => 'KAT',
                'name'   => 'Georgian',
            ],
            'KON' => [
                'alpha2' => 'KG',
                'alpha3' => 'KON',
                'name'   => 'Kongo',
            ],
            'KIK' => [
                'alpha2' => 'KI',
                'alpha3' => 'KIK',
                'name'   => 'Kikuyu, Gikuyu',
            ],
            'KUA' => [
                'alpha2' => 'KJ',
                'alpha3' => 'KUA',
                'name'   => 'Kwanyama, Kuanyama',
            ],
            'KAZ' => [
                'alpha2' => 'KK',
                'alpha3' => 'KAZ',
                'name'   => 'Kazakh',
            ],
            'KAL' => [
                'alpha2' => 'KL',
                'alpha3' => 'KAL',
                'name'   => 'Kalaallisut, Greenlandic',
            ],
            'KHM' => [
                'alpha2' => 'KM',
                'alpha3' => 'KHM',
                'name'   => 'Khmer',
            ],
            'KAN' => [
                'alpha2' => 'KN',
                'alpha3' => 'KAN',
                'name'   => 'Kannada',
            ],
            'KOR' => [
                'alpha2' => 'KO',
                'alpha3' => 'KOR',
                'name'   => 'Korean',
            ],
            'KAU' => [
                'alpha2' => 'KR',
                'alpha3' => 'KAU',
                'name'   => 'Kanuri',
            ],
            'KAS' => [
                'alpha2' => 'KS',
                'alpha3' => 'KAS',
                'name'   => 'Kashmiri',
            ],
            'KUR' => [
                'alpha2' => 'KU',
                'alpha3' => 'KUR',
                'name'   => 'Kurdish',
            ],
            'KOM' => [
                'alpha2' => 'KV',
                'alpha3' => 'KOM',
                'name'   => 'Komi',
            ],
            'COR' => [
                'alpha2' => 'KW',
                'alpha3' => 'COR',
                'name'   => 'Cornish',
            ],
            'KIR' => [
                'alpha2' => 'KY',
                'alpha3' => 'KIR',
                'name'   => 'Kyrgyz',
            ],
            'LAT' => [
                'alpha2' => 'LA',
                'alpha3' => 'LAT',
                'name'   => 'Latin',
            ],
            'LTZ' => [
                'alpha2' => 'LB',
                'alpha3' => 'LTZ',
                'name'   => 'Luxembourgish, Letzeburgesch',
            ],
            'LUG' => [
                'alpha2' => 'LG',
                'alpha3' => 'LUG',
                'name'   => 'Ganda',
            ],
            'LIM' => [
                'alpha2' => 'LI',
                'alpha3' => 'LIM',
                'name'   => 'Limburgish, Limburgan, Limburger',
            ],
            'LIN' => [
                'alpha2' => 'LN',
                'alpha3' => 'LIN',
                'name'   => 'Lingala',
            ],
            'LAO' => [
                'alpha2' => 'LO',
                'alpha3' => 'LAO',
                'name'   => 'Lao',
            ],
            'LIT' => [
                'alpha2' => 'LT',
                'alpha3' => 'LIT',
                'name'   => 'Lithuanian',
            ],
            'LUB' => [
                'alpha2' => 'LU',
                'alpha3' => 'LUB',
                'name'   => 'Luba-Katanga',
            ],
            'LAV' => [
                'alpha2' => 'LV',
                'alpha3' => 'LAV',
                'name'   => 'Latvian',
            ],
            'MLG' => [
                'alpha2' => 'MG',
                'alpha3' => 'MLG',
                'name'   => 'Malagasy',
            ],
            'MAH' => [
                'alpha2' => 'MH',
                'alpha3' => 'MAH',
                'name'   => 'Marshallese',
            ],
            'MRI' => [
                'alpha2' => 'MI',
                'alpha3' => 'MRI',
                'name'   => 'Māori',
            ],
            'MKD' => [
                'alpha2' => 'MK',
                'alpha3' => 'MKD',
                'name'   => 'Macedonian',
            ],
            'MAL' => [
                'alpha2' => 'ML',
                'alpha3' => 'MAL',
                'name'   => 'Malayalam',
            ],
            'MON' => [
                'alpha2' => 'MN',
                'alpha3' => 'MON',
                'name'   => 'Mongolian',
            ],
            'MAR' => [
                'alpha2' => 'MR',
                'alpha3' => 'MAR',
                'name'   => 'Marathi (Marāṭhī)',
            ],
            'MSA' => [
                'alpha2' => 'MS',
                'alpha3' => 'MSA',
                'name'   => 'Malay',
            ],
            'MLT' => [
                'alpha2' => 'MT',
                'alpha3' => 'MLT',
                'name'   => 'Maltese',
            ],
            'MYA' => [
                'alpha2' => 'MY',
                'alpha3' => 'MYA',
                'name'   => 'Burmese',
            ],
            'NAU' => [
                'alpha2' => 'NA',
                'alpha3' => 'NAU',
                'name'   => 'Nauruan',
            ],
            'NOB' => [
                'alpha2' => 'NB',
                'alpha3' => 'NOB',
                'name'   => 'Norwegian Bokmål',
            ],
            'NDE' => [
                'alpha2' => 'ND',
                'alpha3' => 'NDE',
                'name'   => 'Northern Ndebele',
            ],
            'NEP' => [
                'alpha2' => 'NE',
                'alpha3' => 'NEP',
                'name'   => 'Nepali',
            ],
            'NDO' => [
                'alpha2' => 'NG',
                'alpha3' => 'NDO',
                'name'   => 'Ndonga',
            ],
            'NLD' => [
                'alpha2' => 'NL',
                'alpha3' => 'NLD',
                'name'   => 'Dutch',
            ],
            'NNO' => [
                'alpha2' => 'NN',
                'alpha3' => 'NNO',
                'name'   => 'Norwegian Nynorsk',
            ],
            'NOR' => [
                'alpha2' => 'NO',
                'alpha3' => 'NOR',
                'name'   => 'Norwegian',
            ],
            'NBL' => [
                'alpha2' => 'NR',
                'alpha3' => 'NBL',
                'name'   => 'Southern Ndebele',
            ],
            'NAV' => [
                'alpha2' => 'NV',
                'alpha3' => 'NAV',
                'name'   => 'Navajo, Navaho',
            ],
            'NYA' => [
                'alpha2' => 'NY',
                'alpha3' => 'NYA',
                'name'   => 'Chichewa, Chewa, Nyanja',
            ],
            'OCI' => [
                'alpha2' => 'OC',
                'alpha3' => 'OCI',
                'name'   => 'Occitan',
            ],
            'OJI' => [
                'alpha2' => 'OJ',
                'alpha3' => 'OJI',
                'name'   => 'Ojibwe, Ojibwa',
            ],
            'ORM' => [
                'alpha2' => 'OM',
                'alpha3' => 'ORM',
                'name'   => 'Oromo',
            ],
            'ORI' => [
                'alpha2' => 'OR',
                'alpha3' => 'ORI',
                'name'   => 'Oriya',
            ],
            'OSS' => [
                'alpha2' => 'OS',
                'alpha3' => 'OSS',
                'name'   => 'Ossetian, Ossetic',
            ],
            'PAN' => [
                'alpha2' => 'PA',
                'alpha3' => 'PAN',
                'name'   => '(Eastern) Punjabi',
            ],
            'PLI' => [
                'alpha2' => 'PI',
                'alpha3' => 'PLI',
                'name'   => 'Pāli',
            ],
            'POL' => [
                'alpha2' => 'PL',
                'alpha3' => 'POL',
                'name'   => 'Polish',
            ],
            'PUS' => [
                'alpha2' => 'PS',
                'alpha3' => 'PUS',
                'name'   => 'Pashto, Pushto',
            ],
            'POR' => [
                'alpha2' => 'PT',
                'alpha3' => 'POR',
                'name'   => 'Portuguese',
            ],
            'QUE' => [
                'alpha2' => 'QU',
                'alpha3' => 'QUE',
                'name'   => 'Quechua',
            ],
            'ROH' => [
                'alpha2' => 'RM',
                'alpha3' => 'ROH',
                'name'   => 'Romansh',
            ],
            'RUN' => [
                'alpha2' => 'RN',
                'alpha3' => 'RUN',
                'name'   => 'Kirundi',
            ],
            'RON' => [
                'alpha2' => 'RO',
                'alpha3' => 'RON',
                'name'   => 'Romanian',
            ],
            'RUS' => [
                'alpha2' => 'RU',
                'alpha3' => 'RUS',
                'name'   => 'Russian',
            ],
            'KIN' => [
                'alpha2' => 'RW',
                'alpha3' => 'KIN',
                'name'   => 'Kinyarwanda',
            ],
            'SAN' => [
                'alpha2' => 'SA',
                'alpha3' => 'SAN',
                'name'   => 'Sanskrit (Saṁskṛta)',
            ],
            'SRD' => [
                'alpha2' => 'SC',
                'alpha3' => 'SRD',
                'name'   => 'Sardinian',
            ],
            'SND' => [
                'alpha2' => 'SD',
                'alpha3' => 'SND',
                'name'   => 'Sindhi',
            ],
            'SME' => [
                'alpha2' => 'SE',
                'alpha3' => 'SME',
                'name'   => 'Northern Sami',
            ],
            'SAG' => [
                'alpha2' => 'SG',
                'alpha3' => 'SAG',
                'name'   => 'Sango',
            ],
            'SIN' => [
                'alpha2' => 'SI',
                'alpha3' => 'SIN',
                'name'   => 'Sinhalese, Sinhala',
            ],
            'SLK' => [
                'alpha2' => 'SK',
                'alpha3' => 'SLK',
                'name'   => 'Slovak',
            ],
            'SLV' => [
                'alpha2' => 'SL',
                'alpha3' => 'SLV',
                'name'   => 'Slovene',
            ],
            'SMO' => [
                'alpha2' => 'SM',
                'alpha3' => 'SMO',
                'name'   => 'Samoan',
            ],
            'SNA' => [
                'alpha2' => 'SN',
                'alpha3' => 'SNA',
                'name'   => 'Shona',
            ],
            'SOM' => [
                'alpha2' => 'SO',
                'alpha3' => 'SOM',
                'name'   => 'Somali',
            ],
            'SQI' => [
                'alpha2' => 'SQ',
                'alpha3' => 'SQI',
                'name'   => 'Albanian',
            ],
            'SRP' => [
                'alpha2' => 'SR',
                'alpha3' => 'SRP',
                'name'   => 'Serbian',
            ],
            'SSW' => [
                'alpha2' => 'SS',
                'alpha3' => 'SSW',
                'name'   => 'Swati',
            ],
            'SOT' => [
                'alpha2' => 'ST',
                'alpha3' => 'SOT',
                'name'   => 'Southern Sotho',
            ],
            'SUN' => [
                'alpha2' => 'SU',
                'alpha3' => 'SUN',
                'name'   => 'Sundanese',
            ],
            'SWE' => [
                'alpha2' => 'SV',
                'alpha3' => 'SWE',
                'name'   => 'Swedish',
            ],
            'SWA' => [
                'alpha2' => 'SW',
                'alpha3' => 'SWA',
                'name'   => 'Swahili',
            ],
            'TAM' => [
                'alpha2' => 'TA',
                'alpha3' => 'TAM',
                'name'   => 'Tamil',
            ],
            'TEL' => [
                'alpha2' => 'TE',
                'alpha3' => 'TEL',
                'name'   => 'Telugu',
            ],
            'TGK' => [
                'alpha2' => 'TG',
                'alpha3' => 'TGK',
                'name'   => 'Tajik',
            ],
            'THA' => [
                'alpha2' => 'TH',
                'alpha3' => 'THA',
                'name'   => 'Thai',
            ],
            'TIR' => [
                'alpha2' => 'TI',
                'alpha3' => 'TIR',
                'name'   => 'Tigrinya',
            ],
            'TUK' => [
                'alpha2' => 'TK',
                'alpha3' => 'TUK',
                'name'   => 'Turkmen',
            ],
            'TGL' => [
                'alpha2' => 'TL',
                'alpha3' => 'TGL',
                'name'   => 'Tagalog',
            ],
            'TSN' => [
                'alpha2' => 'TN',
                'alpha3' => 'TSN',
                'name'   => 'Tswana',
            ],
            'TON' => [
                'alpha2' => 'TO',
                'alpha3' => 'TON',
                'name'   => 'Tonga (Tonga Islands)',
            ],
            'TUR' => [
                'alpha2' => 'TR',
                'alpha3' => 'TUR',
                'name'   => 'Turkish',
            ],
            'TSO' => [
                'alpha2' => 'TS',
                'alpha3' => 'TSO',
                'name'   => 'Tsonga',
            ],
            'TAT' => [
                'alpha2' => 'TT',
                'alpha3' => 'TAT',
                'name'   => 'Tatar',
            ],
            'TWI' => [
                'alpha2' => 'TW',
                'alpha3' => 'TWI',
                'name'   => 'Twi',
            ],
            'TAH' => [
                'alpha2' => 'TY',
                'alpha3' => 'TAH',
                'name'   => 'Tahitian',
            ],
            'UIG' => [
                'alpha2' => 'UG',
                'alpha3' => 'UIG',
                'name'   => 'Uyghur',
            ],
            'UKR' => [
                'alpha2' => 'UK',
                'alpha3' => 'UKR',
                'name'   => 'Ukrainian',
            ],
            'URD' => [
                'alpha2' => 'UR',
                'alpha3' => 'URD',
                'name'   => 'Urdu',
            ],
            'UZB' => [
                'alpha2' => 'UZ',
                'alpha3' => 'UZB',
                'name'   => 'Uzbek',
            ],
            'VEN' => [
                'alpha2' => 'VE',
                'alpha3' => 'VEN',
                'name'   => 'Venda',
            ],
            'VIE' => [
                'alpha2' => 'VI',
                'alpha3' => 'VIE',
                'name'   => 'Vietnamese',
            ],
            'VOL' => [
                'alpha2' => 'VO',
                'alpha3' => 'VOL',
                'name'   => 'Volapük',
            ],
            'WLN' => [
                'alpha2' => 'WA',
                'alpha3' => 'WLN',
                'name'   => 'Walloon',
            ],
            'WOL' => [
                'alpha2' => 'WO',
                'alpha3' => 'WOL',
                'name'   => 'Wolof',
            ],
            'XHO' => [
                'alpha2' => 'XH',
                'alpha3' => 'XHO',
                'name'   => 'Xhosa',
            ],
            'YID' => [
                'alpha2' => 'YI',
                'alpha3' => 'YID',
                'name'   => 'Yiddish',
            ],
            'YOR' => [
                'alpha2' => 'YO',
                'alpha3' => 'YOR',
                'name'   => 'Yoruba',
            ],
            'ZHA' => [
                'alpha2' => 'ZA',
                'alpha3' => 'ZHA',
                'name'   => 'Zhuang, Chuang',
            ],
            'ZHO' => [
                'alpha2' => 'ZH',
                'alpha3' => 'ZHO',
                'name'   => 'Chinese',
            ],
            'ZUL' => [
                'alpha2' => 'ZU',
                'alpha3' => 'ZUL',
                'name'   => 'Zulu',
            ],
        ];

        const CURRENCIES = [
            'AFN' => [
                'alpha3'    => 'AFN',
                'name'      => 'Afghani',
                'minorUnit' => 2,
                'numeric'   => '971',
            ],
            'EUR' => [
                'alpha3'    => 'EUR',
                'name'      => 'Euro',
                'minorUnit' => 2,
                'numeric'   => '978',
            ],
            'ALL' => [
                'alpha3'    => 'ALL',
                'name'      => 'Lek',
                'minorUnit' => 2,
                'numeric'   => '8',
            ],
            'DZD' => [
                'alpha3'    => 'DZD',
                'name'      => 'Algerian Dinar',
                'minorUnit' => 2,
                'numeric'   => '12',
            ],
            'USD' => [
                'alpha3'    => 'USD',
                'name'      => 'US Dollar',
                'minorUnit' => 2,
                'numeric'   => '840',
            ],
            'AOA' => [
                'alpha3'    => 'AOA',
                'name'      => 'Kwanza',
                'minorUnit' => 2,
                'numeric'   => '973',
            ],
            'XCD' => [
                'alpha3'    => 'XCD',
                'name'      => 'East Caribbean Dollar',
                'minorUnit' => 2,
                'numeric'   => '951',
            ],
            'ARS' => [
                'alpha3'    => 'ARS',
                'name'      => 'Argentine Peso',
                'minorUnit' => 2,
                'numeric'   => '32',
            ],
            'AMD' => [
                'alpha3'    => 'AMD',
                'name'      => 'Armenian Dram',
                'minorUnit' => 2,
                'numeric'   => '51',
            ],
            'AWG' => [
                'alpha3'    => 'AWG',
                'name'      => 'Aruban Florin',
                'minorUnit' => 2,
                'numeric'   => '533',
            ],
            'AUD' => [
                'alpha3'    => 'AUD',
                'name'      => 'Australian Dollar',
                'minorUnit' => 2,
                'numeric'   => '36',
            ],
            'AZN' => [
                'alpha3'    => 'AZN',
                'name'      => 'Azerbaijan Manat',
                'minorUnit' => 2,
                'numeric'   => '944',
            ],
            'BSD' => [
                'alpha3'    => 'BSD',
                'name'      => 'Bahamian Dollar',
                'minorUnit' => 2,
                'numeric'   => '44',
            ],
            'BHD' => [
                'alpha3'    => 'BHD',
                'name'      => 'Bahraini Dinar',
                'minorUnit' => 3,
                'numeric'   => '48',
            ],
            'BDT' => [
                'alpha3'    => 'BDT',
                'name'      => 'Taka',
                'minorUnit' => 2,
                'numeric'   => '50',
            ],
            'BBD' => [
                'alpha3'    => 'BBD',
                'name'      => 'Barbados Dollar',
                'minorUnit' => 2,
                'numeric'   => '52',
            ],
            'BYN' => [
                'alpha3'    => 'BYN',
                'name'      => 'Belarusian Ruble',
                'minorUnit' => 2,
                'numeric'   => '933',
            ],
            'BZD' => [
                'alpha3'    => 'BZD',
                'name'      => 'Belize Dollar',
                'minorUnit' => 2,
                'numeric'   => '84',
            ],
            'XOF' => [
                'alpha3'    => 'XOF',
                'name'      => 'CFA Franc BCEAO',
                'minorUnit' => 0,
                'numeric'   => '952',
            ],
            'BMD' => [
                'alpha3'    => 'BMD',
                'name'      => 'Bermudian Dollar',
                'minorUnit' => 2,
                'numeric'   => '60',
            ],
            'INR' => [
                'alpha3'    => 'INR',
                'name'      => 'Indian Rupee',
                'minorUnit' => 2,
                'numeric'   => '356',
            ],
            'BTN' => [
                'alpha3'    => 'BTN',
                'name'      => 'Ngultrum',
                'minorUnit' => 2,
                'numeric'   => '64',
            ],
            'BOB' => [
                'alpha3'    => 'BOB',
                'name'      => 'Boliviano',
                'minorUnit' => 2,
                'numeric'   => '68',
            ],
            'BOV' => [
                'alpha3'    => 'BOV',
                'name'      => 'Mvdol',
                'minorUnit' => 2,
                'numeric'   => '984',
            ],
            'BAM' => [
                'alpha3'    => 'BAM',
                'name'      => 'Convertible Mark',
                'minorUnit' => 2,
                'numeric'   => '977',
            ],
            'BWP' => [
                'alpha3'    => 'BWP',
                'name'      => 'Pula',
                'minorUnit' => 2,
                'numeric'   => '72',
            ],
            'NOK' => [
                'alpha3'    => 'NOK',
                'name'      => 'Norwegian Krone',
                'minorUnit' => 2,
                'numeric'   => '578',
            ],
            'BRL' => [
                'alpha3'    => 'BRL',
                'name'      => 'Brazilian Real',
                'minorUnit' => 2,
                'numeric'   => '986',
            ],
            'BND' => [
                'alpha3'    => 'BND',
                'name'      => 'Brunei Dollar',
                'minorUnit' => 2,
                'numeric'   => '96',
            ],
            'BGN' => [
                'alpha3'    => 'BGN',
                'name'      => 'Bulgarian Lev',
                'minorUnit' => 2,
                'numeric'   => '975',
            ],
            'BIF' => [
                'alpha3'    => 'BIF',
                'name'      => 'Burundi Franc',
                'minorUnit' => 0,
                'numeric'   => '108',
            ],
            'CVE' => [
                'alpha3'    => 'CVE',
                'name'      => 'Cabo Verde Escudo',
                'minorUnit' => 2,
                'numeric'   => '132',
            ],
            'KHR' => [
                'alpha3'    => 'KHR',
                'name'      => 'Riel',
                'minorUnit' => 2,
                'numeric'   => '116',
            ],
            'XAF' => [
                'alpha3'    => 'XAF',
                'name'      => 'CFA Franc BEAC',
                'minorUnit' => 0,
                'numeric'   => '950',
            ],
            'CAD' => [
                'alpha3'    => 'CAD',
                'name'      => 'Canadian Dollar',
                'minorUnit' => 2,
                'numeric'   => '124',
            ],
            'KYD' => [
                'alpha3'    => 'KYD',
                'name'      => 'Cayman Islands Dollar',
                'minorUnit' => 2,
                'numeric'   => '136',
            ],
            'CLP' => [
                'alpha3'    => 'CLP',
                'name'      => 'Chilean Peso',
                'minorUnit' => 0,
                'numeric'   => '152',
            ],
            'CLF' => [
                'alpha3'    => 'CLF',
                'name'      => 'Unidad de Fomento',
                'minorUnit' => 4,
                'numeric'   => '990',
            ],
            'CNY' => [
                'alpha3'    => 'CNY',
                'name'      => 'Yuan Renminbi',
                'minorUnit' => 2,
                'numeric'   => '156',
            ],
            'COP' => [
                'alpha3'    => 'COP',
                'name'      => 'Colombian Peso',
                'minorUnit' => 2,
                'numeric'   => '170',
            ],
            'COU' => [
                'alpha3'    => 'COU',
                'name'      => 'Unidad de Valor Real',
                'minorUnit' => 2,
                'numeric'   => '970',
            ],
            'KMF' => [
                'alpha3'    => 'KMF',
                'name'      => 'Comorian Franc ',
                'minorUnit' => 0,
                'numeric'   => '174',
            ],
            'CDF' => [
                'alpha3'    => 'CDF',
                'name'      => 'Congolese Franc',
                'minorUnit' => 2,
                'numeric'   => '976',
            ],
            'NZD' => [
                'alpha3'    => 'NZD',
                'name'      => 'New Zealand Dollar',
                'minorUnit' => 2,
                'numeric'   => '554',
            ],
            'CRC' => [
                'alpha3'    => 'CRC',
                'name'      => 'Costa Rican Colon',
                'minorUnit' => 2,
                'numeric'   => '188',
            ],
            'HRK' => [
                'alpha3'    => 'HRK',
                'name'      => 'Kuna',
                'minorUnit' => 2,
                'numeric'   => '191',
            ],
            'CUP' => [
                'alpha3'    => 'CUP',
                'name'      => 'Cuban Peso',
                'minorUnit' => 2,
                'numeric'   => '192',
            ],
            'CUC' => [
                'alpha3'    => 'CUC',
                'name'      => 'Peso Convertible',
                'minorUnit' => 2,
                'numeric'   => '931',
            ],
            'ANG' => [
                'alpha3'    => 'ANG',
                'name'      => 'Netherlands Antillean Guilder',
                'minorUnit' => 2,
                'numeric'   => '532',
            ],
            'CZK' => [
                'alpha3'    => 'CZK',
                'name'      => 'Czech Koruna',
                'minorUnit' => 2,
                'numeric'   => '203',
            ],
            'DKK' => [
                'alpha3'    => 'DKK',
                'name'      => 'Danish Krone',
                'minorUnit' => 2,
                'numeric'   => '208',
            ],
            'DJF' => [
                'alpha3'    => 'DJF',
                'name'      => 'Djibouti Franc',
                'minorUnit' => 0,
                'numeric'   => '262',
            ],
            'DOP' => [
                'alpha3'    => 'DOP',
                'name'      => 'Dominican Peso',
                'minorUnit' => 2,
                'numeric'   => '214',
            ],
            'EGP' => [
                'alpha3'    => 'EGP',
                'name'      => 'Egyptian Pound',
                'minorUnit' => 2,
                'numeric'   => '818',
            ],
            'SVC' => [
                'alpha3'    => 'SVC',
                'name'      => 'El Salvador Colon',
                'minorUnit' => 2,
                'numeric'   => '222',
            ],
            'ERN' => [
                'alpha3'    => 'ERN',
                'name'      => 'Nakfa',
                'minorUnit' => 2,
                'numeric'   => '232',
            ],
            'ETB' => [
                'alpha3'    => 'ETB',
                'name'      => 'Ethiopian Birr',
                'minorUnit' => 2,
                'numeric'   => '230',
            ],
            'FKP' => [
                'alpha3'    => 'FKP',
                'name'      => 'Falkland Islands Pound',
                'minorUnit' => 2,
                'numeric'   => '238',
            ],
            'FJD' => [
                'alpha3'    => 'FJD',
                'name'      => 'Fiji Dollar',
                'minorUnit' => 2,
                'numeric'   => '242',
            ],
            'XPF' => [
                'alpha3'    => 'XPF',
                'name'      => 'CFP Franc',
                'minorUnit' => 0,
                'numeric'   => '953',
            ],
            'GMD' => [
                'alpha3'    => 'GMD',
                'name'      => 'Dalasi',
                'minorUnit' => 2,
                'numeric'   => '270',
            ],
            'GEL' => [
                'alpha3'    => 'GEL',
                'name'      => 'Lari',
                'minorUnit' => 2,
                'numeric'   => '981',
            ],
            'GHS' => [
                'alpha3'    => 'GHS',
                'name'      => 'Ghana Cedi',
                'minorUnit' => 2,
                'numeric'   => '936',
            ],
            'GIP' => [
                'alpha3'    => 'GIP',
                'name'      => 'Gibraltar Pound',
                'minorUnit' => 2,
                'numeric'   => '292',
            ],
            'GTQ' => [
                'alpha3'    => 'GTQ',
                'name'      => 'Quetzal',
                'minorUnit' => 2,
                'numeric'   => '320',
            ],
            'GBP' => [
                'alpha3'    => 'GBP',
                'name'      => 'Pound Sterling',
                'minorUnit' => 2,
                'numeric'   => '826',
            ],
            'GNF' => [
                'alpha3'    => 'GNF',
                'name'      => 'Guinean Franc',
                'minorUnit' => 0,
                'numeric'   => '324',
            ],
            'GYD' => [
                'alpha3'    => 'GYD',
                'name'      => 'Guyana Dollar',
                'minorUnit' => 2,
                'numeric'   => '328',
            ],
            'HTG' => [
                'alpha3'    => 'HTG',
                'name'      => 'Gourde',
                'minorUnit' => 2,
                'numeric'   => '332',
            ],
            'HNL' => [
                'alpha3'    => 'HNL',
                'name'      => 'Lempira',
                'minorUnit' => 2,
                'numeric'   => '340',
            ],
            'HKD' => [
                'alpha3'    => 'HKD',
                'name'      => 'Hong Kong Dollar',
                'minorUnit' => 2,
                'numeric'   => '344',
            ],
            'HUF' => [
                'alpha3'    => 'HUF',
                'name'      => 'Forint',
                'minorUnit' => 2,
                'numeric'   => '348',
            ],
            'ISK' => [
                'alpha3'    => 'ISK',
                'name'      => 'Iceland Krona',
                'minorUnit' => 0,
                'numeric'   => '352',
            ],
            'IDR' => [
                'alpha3'    => 'IDR',
                'name'      => 'Rupiah',
                'minorUnit' => 2,
                'numeric'   => '360',
            ],
            'XDR' => [
                'alpha3'    => 'XDR',
                'name'      => 'SDR (Special Drawing Right)',
                'minorUnit' => 0,
                'numeric'   => '960',
            ],
            'IRR' => [
                'alpha3'    => 'IRR',
                'name'      => 'Iranian Rial',
                'minorUnit' => 2,
                'numeric'   => '364',
            ],
            'IQD' => [
                'alpha3'    => 'IQD',
                'name'      => 'Iraqi Dinar',
                'minorUnit' => 3,
                'numeric'   => '368',
            ],
            'ILS' => [
                'alpha3'    => 'ILS',
                'name'      => 'New Israeli Sheqel',
                'minorUnit' => 2,
                'numeric'   => '376',
            ],
            'JMD' => [
                'alpha3'    => 'JMD',
                'name'      => 'Jamaican Dollar',
                'minorUnit' => 2,
                'numeric'   => '388',
            ],
            'JPY' => [
                'alpha3'    => 'JPY',
                'name'      => 'Yen',
                'minorUnit' => 0,
                'numeric'   => '392',
            ],
            'JOD' => [
                'alpha3'    => 'JOD',
                'name'      => 'Jordanian Dinar',
                'minorUnit' => 3,
                'numeric'   => '400',
            ],
            'KZT' => [
                'alpha3'    => 'KZT',
                'name'      => 'Tenge',
                'minorUnit' => 2,
                'numeric'   => '398',
            ],
            'KES' => [
                'alpha3'    => 'KES',
                'name'      => 'Kenyan Shilling',
                'minorUnit' => 2,
                'numeric'   => '404',
            ],
            'KPW' => [
                'alpha3'    => 'KPW',
                'name'      => 'North Korean Won',
                'minorUnit' => 2,
                'numeric'   => '408',
            ],
            'KRW' => [
                'alpha3'    => 'KRW',
                'name'      => 'Won',
                'minorUnit' => 0,
                'numeric'   => '410',
            ],
            'KWD' => [
                'alpha3'    => 'KWD',
                'name'      => 'Kuwaiti Dinar',
                'minorUnit' => 3,
                'numeric'   => '414',
            ],
            'KGS' => [
                'alpha3'    => 'KGS',
                'name'      => 'Som',
                'minorUnit' => 2,
                'numeric'   => '417',
            ],
            'LAK' => [
                'alpha3'    => 'LAK',
                'name'      => 'Lao Kip',
                'minorUnit' => 2,
                'numeric'   => '418',
            ],
            'LBP' => [
                'alpha3'    => 'LBP',
                'name'      => 'Lebanese Pound',
                'minorUnit' => 2,
                'numeric'   => '422',
            ],
            'LSL' => [
                'alpha3'    => 'LSL',
                'name'      => 'Loti',
                'minorUnit' => 2,
                'numeric'   => '426',
            ],
            'ZAR' => [
                'alpha3'    => 'ZAR',
                'name'      => 'Rand',
                'minorUnit' => 2,
                'numeric'   => '710',
            ],
            'LRD' => [
                'alpha3'    => 'LRD',
                'name'      => 'Liberian Dollar',
                'minorUnit' => 2,
                'numeric'   => '430',
            ],
            'LYD' => [
                'alpha3'    => 'LYD',
                'name'      => 'Libyan Dinar',
                'minorUnit' => 3,
                'numeric'   => '434',
            ],
            'CHF' => [
                'alpha3'    => 'CHF',
                'name'      => 'Swiss Franc',
                'minorUnit' => 2,
                'numeric'   => '756',
            ],
            'MOP' => [
                'alpha3'    => 'MOP',
                'name'      => 'Pataca',
                'minorUnit' => 2,
                'numeric'   => '446',
            ],
            'MKD' => [
                'alpha3'    => 'MKD',
                'name'      => 'Denar',
                'minorUnit' => 2,
                'numeric'   => '807',
            ],
            'MGA' => [
                'alpha3'    => 'MGA',
                'name'      => 'Malagasy Ariary',
                'minorUnit' => 2,
                'numeric'   => '969',
            ],
            'MWK' => [
                'alpha3'    => 'MWK',
                'name'      => 'Malawi Kwacha',
                'minorUnit' => 2,
                'numeric'   => '454',
            ],
            'MYR' => [
                'alpha3'    => 'MYR',
                'name'      => 'Malaysian Ringgit',
                'minorUnit' => 2,
                'numeric'   => '458',
            ],
            'MVR' => [
                'alpha3'    => 'MVR',
                'name'      => 'Rufiyaa',
                'minorUnit' => 2,
                'numeric'   => '462',
            ],
            'MRU' => [
                'alpha3'    => 'MRU',
                'name'      => 'Ouguiya',
                'minorUnit' => 2,
                'numeric'   => '929',
            ],
            'MUR' => [
                'alpha3'    => 'MUR',
                'name'      => 'Mauritius Rupee',
                'minorUnit' => 2,
                'numeric'   => '480',
            ],
            'XUA' => [
                'alpha3'    => 'XUA',
                'name'      => 'ADB Unit of Account',
                'minorUnit' => 0,
                'numeric'   => '965',
            ],
            'MXN' => [
                'alpha3'    => 'MXN',
                'name'      => 'Mexican Peso',
                'minorUnit' => 2,
                'numeric'   => '484',
            ],
            'MXV' => [
                'alpha3'    => 'MXV',
                'name'      => 'Mexican Unidad de Inversion (UDI)',
                'minorUnit' => 2,
                'numeric'   => '979',
            ],
            'MDL' => [
                'alpha3'    => 'MDL',
                'name'      => 'Moldovan Leu',
                'minorUnit' => 2,
                'numeric'   => '498',
            ],
            'MNT' => [
                'alpha3'    => 'MNT',
                'name'      => 'Tugrik',
                'minorUnit' => 2,
                'numeric'   => '496',
            ],
            'MAD' => [
                'alpha3'    => 'MAD',
                'name'      => 'Moroccan Dirham',
                'minorUnit' => 2,
                'numeric'   => '504',
            ],
            'MZN' => [
                'alpha3'    => 'MZN',
                'name'      => 'Mozambique Metical',
                'minorUnit' => 2,
                'numeric'   => '943',
            ],
            'MMK' => [
                'alpha3'    => 'MMK',
                'name'      => 'Kyat',
                'minorUnit' => 2,
                'numeric'   => '104',
            ],
            'NAD' => [
                'alpha3'    => 'NAD',
                'name'      => 'Namibia Dollar',
                'minorUnit' => 2,
                'numeric'   => '516',
            ],
            'NPR' => [
                'alpha3'    => 'NPR',
                'name'      => 'Nepalese Rupee',
                'minorUnit' => 2,
                'numeric'   => '524',
            ],
            'NIO' => [
                'alpha3'    => 'NIO',
                'name'      => 'Cordoba Oro',
                'minorUnit' => 2,
                'numeric'   => '558',
            ],
            'NGN' => [
                'alpha3'    => 'NGN',
                'name'      => 'Naira',
                'minorUnit' => 2,
                'numeric'   => '566',
            ],
            'OMR' => [
                'alpha3'    => 'OMR',
                'name'      => 'Rial Omani',
                'minorUnit' => 3,
                'numeric'   => '512',
            ],
            'PKR' => [
                'alpha3'    => 'PKR',
                'name'      => 'Pakistan Rupee',
                'minorUnit' => 2,
                'numeric'   => '586',
            ],
            'PAB' => [
                'alpha3'    => 'PAB',
                'name'      => 'Balboa',
                'minorUnit' => 2,
                'numeric'   => '590',
            ],
            'PGK' => [
                'alpha3'    => 'PGK',
                'name'      => 'Kina',
                'minorUnit' => 2,
                'numeric'   => '598',
            ],
            'PYG' => [
                'alpha3'    => 'PYG',
                'name'      => 'Guarani',
                'minorUnit' => 0,
                'numeric'   => '600',
            ],
            'PEN' => [
                'alpha3'    => 'PEN',
                'name'      => 'Sol',
                'minorUnit' => 2,
                'numeric'   => '604',
            ],
            'PHP' => [
                'alpha3'    => 'PHP',
                'name'      => 'Philippine Peso',
                'minorUnit' => 2,
                'numeric'   => '608',
            ],
            'PLN' => [
                'alpha3'    => 'PLN',
                'name'      => 'Zloty',
                'minorUnit' => 2,
                'numeric'   => '985',
            ],
            'QAR' => [
                'alpha3'    => 'QAR',
                'name'      => 'Qatari Rial',
                'minorUnit' => 2,
                'numeric'   => '634',
            ],
            'RON' => [
                'alpha3'    => 'RON',
                'name'      => 'Romanian Leu',
                'minorUnit' => 2,
                'numeric'   => '946',
            ],
            'RUB' => [
                'alpha3'    => 'RUB',
                'name'      => 'Russian Ruble',
                'minorUnit' => 2,
                'numeric'   => '643',
            ],
            'RWF' => [
                'alpha3'    => 'RWF',
                'name'      => 'Rwanda Franc',
                'minorUnit' => 0,
                'numeric'   => '646',
            ],
            'SHP' => [
                'alpha3'    => 'SHP',
                'name'      => 'Saint Helena Pound',
                'minorUnit' => 2,
                'numeric'   => '654',
            ],
            'WST' => [
                'alpha3'    => 'WST',
                'name'      => 'Tala',
                'minorUnit' => 2,
                'numeric'   => '882',
            ],
            'STN' => [
                'alpha3'    => 'STN',
                'name'      => 'Dobra',
                'minorUnit' => 2,
                'numeric'   => '930',
            ],
            'SAR' => [
                'alpha3'    => 'SAR',
                'name'      => 'Saudi Riyal',
                'minorUnit' => 2,
                'numeric'   => '682',
            ],
            'RSD' => [
                'alpha3'    => 'RSD',
                'name'      => 'Serbian Dinar',
                'minorUnit' => 2,
                'numeric'   => '941',
            ],
            'SCR' => [
                'alpha3'    => 'SCR',
                'name'      => 'Seychelles Rupee',
                'minorUnit' => 2,
                'numeric'   => '690',
            ],
            'SLL' => [
                'alpha3'    => 'SLL',
                'name'      => 'Leone',
                'minorUnit' => 2,
                'numeric'   => '694',
            ],
            'SGD' => [
                'alpha3'    => 'SGD',
                'name'      => 'Singapore Dollar',
                'minorUnit' => 2,
                'numeric'   => '702',
            ],
            'XSU' => [
                'alpha3'    => 'XSU',
                'name'      => 'Sucre',
                'minorUnit' => 0,
                'numeric'   => '994',
            ],
            'SBD' => [
                'alpha3'    => 'SBD',
                'name'      => 'Solomon Islands Dollar',
                'minorUnit' => 2,
                'numeric'   => '90',
            ],
            'SOS' => [
                'alpha3'    => 'SOS',
                'name'      => 'Somali Shilling',
                'minorUnit' => 2,
                'numeric'   => '706',
            ],
            'SSP' => [
                'alpha3'    => 'SSP',
                'name'      => 'South Sudanese Pound',
                'minorUnit' => 2,
                'numeric'   => '728',
            ],
            'LKR' => [
                'alpha3'    => 'LKR',
                'name'      => 'Sri Lanka Rupee',
                'minorUnit' => 2,
                'numeric'   => '144',
            ],
            'SDG' => [
                'alpha3'    => 'SDG',
                'name'      => 'Sudanese Pound',
                'minorUnit' => 2,
                'numeric'   => '938',
            ],
            'SRD' => [
                'alpha3'    => 'SRD',
                'name'      => 'Surinam Dollar',
                'minorUnit' => 2,
                'numeric'   => '968',
            ],
            'SZL' => [
                'alpha3'    => 'SZL',
                'name'      => 'Lilangeni',
                'minorUnit' => 2,
                'numeric'   => '748',
            ],
            'SEK' => [
                'alpha3'    => 'SEK',
                'name'      => 'Swedish Krona',
                'minorUnit' => 2,
                'numeric'   => '752',
            ],
            'CHE' => [
                'alpha3'    => 'CHE',
                'name'      => 'WIR Euro',
                'minorUnit' => 2,
                'numeric'   => '947',
            ],
            'CHW' => [
                'alpha3'    => 'CHW',
                'name'      => 'WIR Franc',
                'minorUnit' => 2,
                'numeric'   => '948',
            ],
            'SYP' => [
                'alpha3'    => 'SYP',
                'name'      => 'Syrian Pound',
                'minorUnit' => 2,
                'numeric'   => '760',
            ],
            'TWD' => [
                'alpha3'    => 'TWD',
                'name'      => 'New Taiwan Dollar',
                'minorUnit' => 2,
                'numeric'   => '901',
            ],
            'TJS' => [
                'alpha3'    => 'TJS',
                'name'      => 'Somoni',
                'minorUnit' => 2,
                'numeric'   => '972',
            ],
            'TZS' => [
                'alpha3'    => 'TZS',
                'name'      => 'Tanzanian Shilling',
                'minorUnit' => 2,
                'numeric'   => '834',
            ],
            'THB' => [
                'alpha3'    => 'THB',
                'name'      => 'Baht',
                'minorUnit' => 2,
                'numeric'   => '764',
            ],
            'TOP' => [
                'alpha3'    => 'TOP',
                'name'      => 'Pa’anga',
                'minorUnit' => 2,
                'numeric'   => '776',
            ],
            'TTD' => [
                'alpha3'    => 'TTD',
                'name'      => 'Trinidad and Tobago Dollar',
                'minorUnit' => 2,
                'numeric'   => '780',
            ],
            'TND' => [
                'alpha3'    => 'TND',
                'name'      => 'Tunisian Dinar',
                'minorUnit' => 3,
                'numeric'   => '788',
            ],
            'TRY' => [
                'alpha3'    => 'TRY',
                'name'      => 'Turkish Lira',
                'minorUnit' => 2,
                'numeric'   => '949',
            ],
            'TMT' => [
                'alpha3'    => 'TMT',
                'name'      => 'Turkmenistan New Manat',
                'minorUnit' => 2,
                'numeric'   => '934',
            ],
            'UGX' => [
                'alpha3'    => 'UGX',
                'name'      => 'Uganda Shilling',
                'minorUnit' => 0,
                'numeric'   => '800',
            ],
            'UAH' => [
                'alpha3'    => 'UAH',
                'name'      => 'Hryvnia',
                'minorUnit' => 2,
                'numeric'   => '980',
            ],
            'AED' => [
                'alpha3'    => 'AED',
                'name'      => 'UAE Dirham',
                'minorUnit' => 2,
                'numeric'   => '784',
            ],
            'USN' => [
                'alpha3'    => 'USN',
                'name'      => 'US Dollar (Next day)',
                'minorUnit' => 2,
                'numeric'   => '997',
            ],
            'UYU' => [
                'alpha3'    => 'UYU',
                'name'      => 'Peso Uruguayo',
                'minorUnit' => 2,
                'numeric'   => '858',
            ],
            'UYI' => [
                'alpha3'    => 'UYI',
                'name'      => 'Uruguay Peso en Unidades Indexadas (UI)',
                'minorUnit' => 0,
                'numeric'   => '940',
            ],
            'UYW' => [
                'alpha3'    => 'UYW',
                'name'      => 'Unidad Previsional',
                'minorUnit' => 4,
                'numeric'   => '927',
            ],
            'UZS' => [
                'alpha3'    => 'UZS',
                'name'      => 'Uzbekistan Sum',
                'minorUnit' => 2,
                'numeric'   => '860',
            ],
            'VUV' => [
                'alpha3'    => 'VUV',
                'name'      => 'Vatu',
                'minorUnit' => 0,
                'numeric'   => '548',
            ],
            'VES' => [
                'alpha3'    => 'VES',
                'name'      => 'Bolívar Soberano',
                'minorUnit' => 2,
                'numeric'   => '928',
            ],
            'VND' => [
                'alpha3'    => 'VND',
                'name'      => 'Dong',
                'minorUnit' => 0,
                'numeric'   => '704',
            ],
            'YER' => [
                'alpha3'    => 'YER',
                'name'      => 'Yemeni Rial',
                'minorUnit' => 2,
                'numeric'   => '886',
            ],
            'ZMW' => [
                'alpha3'    => 'ZMW',
                'name'      => 'Zambian Kwacha',
                'minorUnit' => 2,
                'numeric'   => '967',
            ],
            'ZWL' => [
                'alpha3'    => 'ZWL',
                'name'      => 'Zimbabwe Dollar',
                'minorUnit' => 2,
                'numeric'   => '932',
            ],
            'XBA' => [
                'alpha3'    => 'XBA',
                'name'      => 'Bond Markets Unit European Composite Unit (EURCO)',
                'minorUnit' => 0,
                'numeric'   => '955',
            ],
            'XBB' => [
                'alpha3'    => 'XBB',
                'name'      => 'Bond Markets Unit European Monetary Unit (E.M.U.-6)',
                'minorUnit' => 0,
                'numeric'   => '956',
            ],
            'XBC' => [
                'alpha3'    => 'XBC',
                'name'      => 'Bond Markets Unit European Unit of Account 9 (E.U.A.-9)',
                'minorUnit' => 0,
                'numeric'   => '957',
            ],
            'XBD' => [
                'alpha3'    => 'XBD',
                'name'      => 'Bond Markets Unit European Unit of Account 17 (E.U.A.-17)',
                'minorUnit' => 0,
                'numeric'   => '958',
            ],
            'XTS' => [
                'alpha3'    => 'XTS',
                'name'      => 'Codes specifically reserved for testing purposes',
                'minorUnit' => 0,
                'numeric'   => '963',
            ],
            'XXX' => [
                'alpha3'    => 'XXX',
                'name'      => 'The codes assigned for transactions where no currency is involved',
                'minorUnit' => 0,
                'numeric'   => '999',
            ],
            'XAU' => [
                'alpha3'    => 'XAU',
                'name'      => 'Gold',
                'minorUnit' => 0,
                'numeric'   => '959',
            ],
            'XPD' => [
                'alpha3'    => 'XPD',
                'name'      => 'Palladium',
                'minorUnit' => 0,
                'numeric'   => '964',
            ],
            'XPT' => [
                'alpha3'    => 'XPT',
                'name'      => 'Platinum',
                'minorUnit' => 0,
                'numeric'   => '962',
            ],
            'XAG' => [
                'alpha3'    => 'XAG',
                'name'      => 'Silver',
                'minorUnit' => 0,
                'numeric'   => '961',
            ],
        ];

        const COUNTRIES = [

            'AFG' => [
                'name'     => 'Afghanistan',
                'alpha2'   => 'AF',
                'alpha3'   => 'AFG',
                'numeric'  => '004',
                'currency' => [
                    0 => 'AFN',
                ],
            ],
            'ALA' => [
                'name'     => 'Åland Islands',
                'alpha2'   => 'AX',
                'alpha3'   => 'ALA',
                'numeric'  => '248',
                'currency' => [
                    0 => 'EUR',
                ],
            ],
            'ALB' => [
                'name'     => 'Albania',
                'alpha2'   => 'AL',
                'alpha3'   => 'ALB',
                'numeric'  => '008',
                'currency' => [
                    0 => 'ALL',
                ],
            ],
            'DZA' => [
                'name'     => 'Algeria',
                'alpha2'   => 'DZ',
                'alpha3'   => 'DZA',
                'numeric'  => '012',
                'currency' => [
                    0 => 'DZD',
                ],
            ],
            'ASM' => [
                'name'     => 'American Samoa',
                'alpha2'   => 'AS',
                'alpha3'   => 'ASM',
                'numeric'  => '016',
                'currency' => [
                    0 => 'USD',
                ],
            ],
            'AND' => [
                'name'     => 'Andorra',
                'alpha2'   => 'AD',
                'alpha3'   => 'AND',
                'numeric'  => '020',
                'currency' => [
                    0 => 'EUR',
                ],
            ],
            'AGO' => [
                'name'     => 'Angola',
                'alpha2'   => 'AO',
                'alpha3'   => 'AGO',
                'numeric'  => '024',
                'currency' => [
                    0 => 'AOA',
                ],
            ],
            'AIA' => [
                'name'     => 'Anguilla',
                'alpha2'   => 'AI',
                'alpha3'   => 'AIA',
                'numeric'  => '660',
                'currency' => [
                    0 => 'XCD',
                ],
            ],
            'ATA' => [
                'name'     => 'Antarctica',
                'alpha2'   => 'AQ',
                'alpha3'   => 'ATA',
                'numeric'  => '010',
                'currency' => [
                    0  => 'ARS',
                    1  => 'AUD',
                    2  => 'BGN',
                    3  => 'BRL',
                    4  => 'BYR',
                    5  => 'CLP',
                    6  => 'CNY',
                    7  => 'CZK',
                    8  => 'EUR',
                    9  => 'GBP',
                    10 => 'INR',
                    11 => 'JPY',
                    12 => 'KRW',
                    13 => 'NOK',
                    14 => 'NZD',
                    15 => 'PEN',
                    16 => 'PKR',
                    17 => 'PLN',
                    18 => 'RON',
                    19 => 'RUB',
                    20 => 'SEK',
                    21 => 'UAH',
                    22 => 'USD',
                    23 => 'UYU',
                    24 => 'ZAR',
                ],
            ],
            'ATG' => [
                'name'     => 'Antigua and Barbuda',
                'alpha2'   => 'AG',
                'alpha3'   => 'ATG',
                'numeric'  => '028',
                'currency' => [
                    0 => 'XCD',
                ],
            ],
            'ARG' => [
                'name'     => 'Argentina',
                'alpha2'   => 'AR',
                'alpha3'   => 'ARG',
                'numeric'  => '032',
                'currency' => [
                    0 => 'ARS',
                ],
            ],
            'ARM' => [
                'name'     => 'Armenia',
                'alpha2'   => 'AM',
                'alpha3'   => 'ARM',
                'numeric'  => '051',
                'currency' => [
                    0 => 'AMD',
                ],
            ],
            'ABW' => [
                'name'     => 'Aruba',
                'alpha2'   => 'AW',
                'alpha3'   => 'ABW',
                'numeric'  => '533',
                'currency' => [
                    0 => 'AWG',
                ],
            ],
            'AUS' => [
                'name'     => 'Australia',
                'alpha2'   => 'AU',
                'alpha3'   => 'AUS',
                'numeric'  => '036',
                'currency' => [
                    0 => 'AUD',
                ],
            ],
            'AUT' => [
                'name'     => 'Austria',
                'alpha2'   => 'AT',
                'alpha3'   => 'AUT',
                'numeric'  => '040',
                'currency' => [
                    0 => 'EUR',
                ],
            ],
            'AZE' => [
                'name'     => 'Azerbaijan',
                'alpha2'   => 'AZ',
                'alpha3'   => 'AZE',
                'numeric'  => '031',
                'currency' => [
                    0 => 'AZN',
                ],
            ],
            'BHS' => [
                'name'     => 'Bahamas',
                'alpha2'   => 'BS',
                'alpha3'   => 'BHS',
                'numeric'  => '044',
                'currency' => [
                    0 => 'BSD',
                ],
            ],
            'BHR' => [
                'name'     => 'Bahrain',
                'alpha2'   => 'BH',
                'alpha3'   => 'BHR',
                'numeric'  => '048',
                'currency' => [
                    0 => 'BHD',
                ],
            ],
            'BGD' => [
                'name'     => 'Bangladesh',
                'alpha2'   => 'BD',
                'alpha3'   => 'BGD',
                'numeric'  => '050',
                'currency' => [
                    0 => 'BDT',
                ],
            ],
            'BRB' => [
                'name'     => 'Barbados',
                'alpha2'   => 'BB',
                'alpha3'   => 'BRB',
                'numeric'  => '052',
                'currency' => [
                    0 => 'BBD',
                ],
            ],
            'BLR' => [
                'name'     => 'Belarus',
                'alpha2'   => 'BY',
                'alpha3'   => 'BLR',
                'numeric'  => '112',
                'currency' => [
                    0 => 'BYN',
                ],
            ],
            'BEL' => [
                'name'     => 'Belgium',
                'alpha2'   => 'BE',
                'alpha3'   => 'BEL',
                'numeric'  => '056',
                'currency' => [
                    0 => 'EUR',
                ],
            ],
            'BLZ' => [
                'name'     => 'Belize',
                'alpha2'   => 'BZ',
                'alpha3'   => 'BLZ',
                'numeric'  => '084',
                'currency' => [
                    0 => 'BZD',
                ],
            ],
            'BEN' => [
                'name'     => 'Benin',
                'alpha2'   => 'BJ',
                'alpha3'   => 'BEN',
                'numeric'  => '204',
                'currency' => [
                    0 => 'XOF',
                ],
            ],
            'BMU' => [
                'name'     => 'Bermuda',
                'alpha2'   => 'BM',
                'alpha3'   => 'BMU',
                'numeric'  => '060',
                'currency' => [
                    0 => 'BMD',
                ],
            ],
            'BTN' => [
                'name'     => 'Bhutan',
                'alpha2'   => 'BT',
                'alpha3'   => 'BTN',
                'numeric'  => '064',
                'currency' => [
                    0 => 'BTN',
                ],
            ],
            'BOL' => [
                'name'     => 'Bolivia (Plurinational State of)',
                'alpha2'   => 'BO',
                'alpha3'   => 'BOL',
                'numeric'  => '068',
                'currency' => [
                    0 => 'BOB',
                ],
            ],
            'BES' => [
                'name'     => 'Bonaire, Sint Eustatius and Saba',
                'alpha2'   => 'BQ',
                'alpha3'   => 'BES',
                'numeric'  => '535',
                'currency' => [
                    0 => 'USD',
                ],
            ],
            'BIH' => [
                'name'     => 'Bosnia and Herzegovina',
                'alpha2'   => 'BA',
                'alpha3'   => 'BIH',
                'numeric'  => '070',
                'currency' => [
                    0 => 'BAM',
                ],
            ],
            'BWA' => [
                'name'     => 'Botswana',
                'alpha2'   => 'BW',
                'alpha3'   => 'BWA',
                'numeric'  => '072',
                'currency' => [
                    0 => 'BWP',
                ],
            ],
            'BVT' => [
                'name'     => 'Bouvet Island',
                'alpha2'   => 'BV',
                'alpha3'   => 'BVT',
                'numeric'  => '074',
                'currency' => [
                    0 => 'NOK',
                ],
            ],
            'BRA' => [
                'name'     => 'Brazil',
                'alpha2'   => 'BR',
                'alpha3'   => 'BRA',
                'numeric'  => '076',
                'currency' => [
                    0 => 'BRL',
                ],
            ],
            'IOT' => [
                'name'     => 'British Indian Ocean Territory',
                'alpha2'   => 'IO',
                'alpha3'   => 'IOT',
                'numeric'  => '086',
                'currency' => [
                    0 => 'GBP',
                ],
            ],
            'BRN' => [
                'name'     => 'Brunei Darussalam',
                'alpha2'   => 'BN',
                'alpha3'   => 'BRN',
                'numeric'  => '096',
                'currency' => [
                    0 => 'BND',
                    1 => 'SGD',
                ],
            ],
            'BGR' => [
                'name'     => 'Bulgaria',
                'alpha2'   => 'BG',
                'alpha3'   => 'BGR',
                'numeric'  => '100',
                'currency' => [
                    0 => 'BGN',
                ],
            ],
            'BFA' => [
                'name'     => 'Burkina Faso',
                'alpha2'   => 'BF',
                'alpha3'   => 'BFA',
                'numeric'  => '854',
                'currency' => [
                    0 => 'XOF',
                ],
            ],
            'BDI' => [
                'name'     => 'Burundi',
                'alpha2'   => 'BI',
                'alpha3'   => 'BDI',
                'numeric'  => '108',
                'currency' => [
                    0 => 'BIF',
                ],
            ],
            'CPV' => [
                'name'     => 'Cabo Verde',
                'alpha2'   => 'CV',
                'alpha3'   => 'CPV',
                'numeric'  => '132',
                'currency' => [
                    0 => 'CVE',
                ],
            ],
            'KHM' => [
                'name'     => 'Cambodia',
                'alpha2'   => 'KH',
                'alpha3'   => 'KHM',
                'numeric'  => '116',
                'currency' => [
                    0 => 'KHR',
                ],
            ],
            'CMR' => [
                'name'     => 'Cameroon',
                'alpha2'   => 'CM',
                'alpha3'   => 'CMR',
                'numeric'  => '120',
                'currency' => [
                    0 => 'XAF',
                ],
            ],
            'CAN' => [
                'name'     => 'Canada',
                'alpha2'   => 'CA',
                'alpha3'   => 'CAN',
                'numeric'  => '124',
                'currency' => [
                    0 => 'CAD',
                ],
            ],
            'CYM' => [
                'name'     => 'Cayman Islands',
                'alpha2'   => 'KY',
                'alpha3'   => 'CYM',
                'numeric'  => '136',
                'currency' => [
                    0 => 'KYD',
                ],
            ],
            'CAF' => [
                'name'     => 'Central African Republic',
                'alpha2'   => 'CF',
                'alpha3'   => 'CAF',
                'numeric'  => '140',
                'currency' => [
                    0 => 'XAF',
                ],
            ],
            'TCD' => [
                'name'     => 'Chad',
                'alpha2'   => 'TD',
                'alpha3'   => 'TCD',
                'numeric'  => '148',
                'currency' => [
                    0 => 'XAF',
                ],
            ],
            'CHL' => [
                'name'     => 'Chile',
                'alpha2'   => 'CL',
                'alpha3'   => 'CHL',
                'numeric'  => '152',
                'currency' => [
                    0 => 'CLP',
                ],
            ],
            'CHN' => [
                'name'     => 'China',
                'alpha2'   => 'CN',
                'alpha3'   => 'CHN',
                'numeric'  => '156',
                'currency' => [
                    0 => 'CNY',
                ],
            ],
            'CXR' => [
                'name'     => 'Christmas Island',
                'alpha2'   => 'CX',
                'alpha3'   => 'CXR',
                'numeric'  => '162',
                'currency' => [
                    0 => 'AUD',
                ],
            ],
            'CCK' => [
                'name'     => 'Cocos (Keeling) Islands',
                'alpha2'   => 'CC',
                'alpha3'   => 'CCK',
                'numeric'  => '166',
                'currency' => [
                    0 => 'AUD',
                ],
            ],
            'COL' => [
                'name'     => 'Colombia',
                'alpha2'   => 'CO',
                'alpha3'   => 'COL',
                'numeric'  => '170',
                'currency' => [
                    0 => 'COP',
                ],
            ],
            'COM' => [
                'name'     => 'Comoros',
                'alpha2'   => 'KM',
                'alpha3'   => 'COM',
                'numeric'  => '174',
                'currency' => [
                    0 => 'KMF',
                ],
            ],
            'COG' => [
                'name'     => 'Congo',
                'alpha2'   => 'CG',
                'alpha3'   => 'COG',
                'numeric'  => '178',
                'currency' => [
                    0 => 'XAF',
                ],
            ],
            'COD' => [
                'name'     => 'Congo (Democratic Republic of the)',
                'alpha2'   => 'CD',
                'alpha3'   => 'COD',
                'numeric'  => '180',
                'currency' => [
                    0 => 'CDF',
                ],
            ],
            'COK' => [
                'name'     => 'Cook Islands',
                'alpha2'   => 'CK',
                'alpha3'   => 'COK',
                'numeric'  => '184',
                'currency' => [
                    0 => 'NZD',
                ],
            ],
            'CRI' => [
                'name'     => 'Costa Rica',
                'alpha2'   => 'CR',
                'alpha3'   => 'CRI',
                'numeric'  => '188',
                'currency' => [
                    0 => 'CRC',
                ],
            ],
            'CIV' => [
                'name'     => 'Côte d\'Ivoire',
                'alpha2'   => 'CI',
                'alpha3'   => 'CIV',
                'numeric'  => '384',
                'currency' => [
                    0 => 'XOF',
                ],
            ],
            'HRV' => [
                'name'     => 'Croatia',
                'alpha2'   => 'HR',
                'alpha3'   => 'HRV',
                'numeric'  => '191',
                'currency' => [
                    0 => 'HRK',
                ],
            ],
            'CUB' => [
                'name'     => 'Cuba',
                'alpha2'   => 'CU',
                'alpha3'   => 'CUB',
                'numeric'  => '192',
                'currency' => [
                    0 => 'CUC',
                    1 => 'CUP',
                ],
            ],
            'CUW' => [
                'name'     => 'Curaçao',
                'alpha2'   => 'CW',
                'alpha3'   => 'CUW',
                'numeric'  => '531',
                'currency' => [
                    0 => 'ANG',
                ],
            ],
            'CYP' => [
                'name'     => 'Cyprus',
                'alpha2'   => 'CY',
                'alpha3'   => 'CYP',
                'numeric'  => '196',
                'currency' => [
                    0 => 'EUR',
                ],
            ],
            'CZE' => [
                'name'     => 'Czechia',
                'alpha2'   => 'CZ',
                'alpha3'   => 'CZE',
                'numeric'  => '203',
                'currency' => [
                    0 => 'CZK',
                ],
            ],
            'DNK' => [
                'name'     => 'Denmark',
                'alpha2'   => 'DK',
                'alpha3'   => 'DNK',
                'numeric'  => '208',
                'currency' => [
                    0 => 'DKK',
                ],
            ],
            'DJI' => [
                'name'     => 'Djibouti',
                'alpha2'   => 'DJ',
                'alpha3'   => 'DJI',
                'numeric'  => '262',
                'currency' => [
                    0 => 'DJF',
                ],
            ],
            'DMA' => [
                'name'     => 'Dominica',
                'alpha2'   => 'DM',
                'alpha3'   => 'DMA',
                'numeric'  => '212',
                'currency' => [
                    0 => 'XCD',
                ],
            ],
            'DOM' => [
                'name'     => 'Dominican Republic',
                'alpha2'   => 'DO',
                'alpha3'   => 'DOM',
                'numeric'  => '214',
                'currency' => [
                    0 => 'DOP',
                ],
            ],
            'ECU' => [
                'name'     => 'Ecuador',
                'alpha2'   => 'EC',
                'alpha3'   => 'ECU',
                'numeric'  => '218',
                'currency' => [
                    0 => 'USD',
                ],
            ],
            'EGY' => [
                'name'     => 'Egypt',
                'alpha2'   => 'EG',
                'alpha3'   => 'EGY',
                'numeric'  => '818',
                'currency' => [
                    0 => 'EGP',
                ],
            ],
            'SLV' => [
                'name'     => 'El Salvador',
                'alpha2'   => 'SV',
                'alpha3'   => 'SLV',
                'numeric'  => '222',
                'currency' => [
                    0 => 'USD',
                ],
            ],
            'GNQ' => [
                'name'     => 'Equatorial Guinea',
                'alpha2'   => 'GQ',
                'alpha3'   => 'GNQ',
                'numeric'  => '226',
                'currency' => [
                    0 => 'XAF',
                ],
            ],
            'ERI' => [
                'name'     => 'Eritrea',
                'alpha2'   => 'ER',
                'alpha3'   => 'ERI',
                'numeric'  => '232',
                'currency' => [
                    0 => 'ERN',
                ],
            ],
            'EST' => [
                'name'     => 'Estonia',
                'alpha2'   => 'EE',
                'alpha3'   => 'EST',
                'numeric'  => '233',
                'currency' => [
                    0 => 'EUR',
                ],
            ],
            'ETH' => [
                'name'     => 'Ethiopia',
                'alpha2'   => 'ET',
                'alpha3'   => 'ETH',
                'numeric'  => '231',
                'currency' => [
                    0 => 'ETB',
                ],
            ],
            'SWZ' => [
                'name'     => 'Eswatini',
                'alpha2'   => 'SZ',
                'alpha3'   => 'SWZ',
                'numeric'  => '748',
                'currency' => [
                    0 => 'SZL',
                    1 => 'ZAR',
                ],
            ],
            'FLK' => [
                'name'     => 'Falkland Islands (Malvinas)',
                'alpha2'   => 'FK',
                'alpha3'   => 'FLK',
                'numeric'  => '238',
                'currency' => [
                    0 => 'FKP',
                ],
            ],
            'FRO' => [
                'name'     => 'Faroe Islands',
                'alpha2'   => 'FO',
                'alpha3'   => 'FRO',
                'numeric'  => '234',
                'currency' => [
                    0 => 'DKK',
                ],
            ],
            'FJI' => [
                'name'     => 'Fiji',
                'alpha2'   => 'FJ',
                'alpha3'   => 'FJI',
                'numeric'  => '242',
                'currency' => [
                    0 => 'FJD',
                ],
            ],
            'FIN' => [
                'name'     => 'Finland',
                'alpha2'   => 'FI',
                'alpha3'   => 'FIN',
                'numeric'  => '246',
                'currency' => [
                    0 => 'EUR',
                ],
            ],
            'FRA' => [
                'name'     => 'France',
                'alpha2'   => 'FR',
                'alpha3'   => 'FRA',
                'numeric'  => '250',
                'currency' => [
                    0 => 'EUR',
                ],
            ],
            'GUF' => [
                'name'     => 'French Guiana',
                'alpha2'   => 'GF',
                'alpha3'   => 'GUF',
                'numeric'  => '254',
                'currency' => [
                    0 => 'EUR',
                ],
            ],
            'PYF' => [
                'name'     => 'French Polynesia',
                'alpha2'   => 'PF',
                'alpha3'   => 'PYF',
                'numeric'  => '258',
                'currency' => [
                    0 => 'XPF',
                ],
            ],
            'ATF' => [
                'name'     => 'French Southern Territories',
                'alpha2'   => 'TF',
                'alpha3'   => 'ATF',
                'numeric'  => '260',
                'currency' => [
                    0 => 'EUR',
                ],
            ],
            'GAB' => [
                'name'     => 'Gabon',
                'alpha2'   => 'GA',
                'alpha3'   => 'GAB',
                'numeric'  => '266',
                'currency' => [
                    0 => 'XAF',
                ],
            ],
            'GMB' => [
                'name'     => 'Gambia',
                'alpha2'   => 'GM',
                'alpha3'   => 'GMB',
                'numeric'  => '270',
                'currency' => [
                    0 => 'GMD',
                ],
            ],
            'GEO' => [
                'name'     => 'Georgia',
                'alpha2'   => 'GE',
                'alpha3'   => 'GEO',
                'numeric'  => '268',
                'currency' => [
                    0 => 'GEL',
                ],
            ],
            'DEU' => [
                'name'     => 'Germany',
                'alpha2'   => 'DE',
                'alpha3'   => 'DEU',
                'numeric'  => '276',
                'currency' => [
                    0 => 'EUR',
                ],
            ],
            'GHA' => [
                'name'     => 'Ghana',
                'alpha2'   => 'GH',
                'alpha3'   => 'GHA',
                'numeric'  => '288',
                'currency' => [
                    0 => 'GHS',
                ],
            ],
            'GIB' => [
                'name'     => 'Gibraltar',
                'alpha2'   => 'GI',
                'alpha3'   => 'GIB',
                'numeric'  => '292',
                'currency' => [
                    0 => 'GIP',
                ],
            ],
            'GRC' => [
                'name'     => 'Greece',
                'alpha2'   => 'GR',
                'alpha3'   => 'GRC',
                'numeric'  => '300',
                'currency' => [
                    0 => 'EUR',
                ],
            ],
            'GRL' => [
                'name'     => 'Greenland',
                'alpha2'   => 'GL',
                'alpha3'   => 'GRL',
                'numeric'  => '304',
                'currency' => [
                    0 => 'DKK',
                ],
            ],
            'GRD' => [
                'name'     => 'Grenada',
                'alpha2'   => 'GD',
                'alpha3'   => 'GRD',
                'numeric'  => '308',
                'currency' => [
                    0 => 'XCD',
                ],
            ],
            'GLP' => [
                'name'     => 'Guadeloupe',
                'alpha2'   => 'GP',
                'alpha3'   => 'GLP',
                'numeric'  => '312',
                'currency' => [
                    0 => 'EUR',
                ],
            ],
            'GUM' => [
                'name'     => 'Guam',
                'alpha2'   => 'GU',
                'alpha3'   => 'GUM',
                'numeric'  => '316',
                'currency' => [
                    0 => 'USD',
                ],
            ],
            'GTM' => [
                'name'     => 'Guatemala',
                'alpha2'   => 'GT',
                'alpha3'   => 'GTM',
                'numeric'  => '320',
                'currency' => [
                    0 => 'GTQ',
                ],
            ],
            'GGY' => [
                'name'     => 'Guernsey',
                'alpha2'   => 'GG',
                'alpha3'   => 'GGY',
                'numeric'  => '831',
                'currency' => [
                    0 => 'GBP',
                ],
            ],
            'GIN' => [
                'name'     => 'Guinea',
                'alpha2'   => 'GN',
                'alpha3'   => 'GIN',
                'numeric'  => '324',
                'currency' => [
                    0 => 'GNF',
                ],
            ],
            'GNB' => [
                'name'     => 'Guinea-Bissau',
                'alpha2'   => 'GW',
                'alpha3'   => 'GNB',
                'numeric'  => '624',
                'currency' => [
                    0 => 'XOF',
                ],
            ],
            'GUY' => [
                'name'     => 'Guyana',
                'alpha2'   => 'GY',
                'alpha3'   => 'GUY',
                'numeric'  => '328',
                'currency' => [
                    0 => 'GYD',
                ],
            ],
            'HTI' => [
                'name'     => 'Haiti',
                'alpha2'   => 'HT',
                'alpha3'   => 'HTI',
                'numeric'  => '332',
                'currency' => [
                    0 => 'HTG',
                ],
            ],
            'HMD' => [
                'name'     => 'Heard Island and McDonald Islands',
                'alpha2'   => 'HM',
                'alpha3'   => 'HMD',
                'numeric'  => '334',
                'currency' => [
                    0 => 'AUD',
                ],
            ],
            'VAT' => [
                'name'     => 'Holy See',
                'alpha2'   => 'VA',
                'alpha3'   => 'VAT',
                'numeric'  => '336',
                'currency' => [
                    0 => 'EUR',
                ],
            ],
            'HND' => [
                'name'     => 'Honduras',
                'alpha2'   => 'HN',
                'alpha3'   => 'HND',
                'numeric'  => '340',
                'currency' => [
                    0 => 'HNL',
                ],
            ],
            'HKG' => [
                'name'     => 'Hong Kong',
                'alpha2'   => 'HK',
                'alpha3'   => 'HKG',
                'numeric'  => '344',
                'currency' => [
                    0 => 'HKD',
                ],
            ],
            'HUN' => [
                'name'     => 'Hungary',
                'alpha2'   => 'HU',
                'alpha3'   => 'HUN',
                'numeric'  => '348',
                'currency' => [
                    0 => 'HUF',
                ],
            ],
            'ISL' => [
                'name'     => 'Iceland',
                'alpha2'   => 'IS',
                'alpha3'   => 'ISL',
                'numeric'  => '352',
                'currency' => [
                    0 => 'ISK',
                ],
            ],
            'IND' => [
                'name'     => 'India',
                'alpha2'   => 'IN',
                'alpha3'   => 'IND',
                'numeric'  => '356',
                'currency' => [
                    0 => 'INR',
                ],
            ],
            'IDN' => [
                'name'     => 'Indonesia',
                'alpha2'   => 'ID',
                'alpha3'   => 'IDN',
                'numeric'  => '360',
                'currency' => [
                    0 => 'IDR',
                ],
            ],
            'IRN' => [
                'name'     => 'Iran (Islamic Republic of)',
                'alpha2'   => 'IR',
                'alpha3'   => 'IRN',
                'numeric'  => '364',
                'currency' => [
                    0 => 'IRR',
                ],
            ],
            'IRQ' => [
                'name'     => 'Iraq',
                'alpha2'   => 'IQ',
                'alpha3'   => 'IRQ',
                'numeric'  => '368',
                'currency' => [
                    0 => 'IQD',
                ],
            ],
            'IRL' => [
                'name'     => 'Ireland',
                'alpha2'   => 'IE',
                'alpha3'   => 'IRL',
                'numeric'  => '372',
                'currency' => [
                    0 => 'EUR',
                ],
            ],
            'IMN' => [
                'name'     => 'Isle of Man',
                'alpha2'   => 'IM',
                'alpha3'   => 'IMN',
                'numeric'  => '833',
                'currency' => [
                    0 => 'GBP',
                ],
            ],
            'ISR' => [
                'name'     => 'Israel',
                'alpha2'   => 'IL',
                'alpha3'   => 'ISR',
                'numeric'  => '376',
                'currency' => [
                    0 => 'ILS',
                ],
            ],
            'ITA' => [
                'name'     => 'Italy',
                'alpha2'   => 'IT',
                'alpha3'   => 'ITA',
                'numeric'  => '380',
                'currency' => [
                    0 => 'EUR',
                ],
            ],
            'JAM' => [
                'name'     => 'Jamaica',
                'alpha2'   => 'JM',
                'alpha3'   => 'JAM',
                'numeric'  => '388',
                'currency' => [
                    0 => 'JMD',
                ],
            ],
            'JPN' => [
                'name'     => 'Japan',
                'alpha2'   => 'JP',
                'alpha3'   => 'JPN',
                'numeric'  => '392',
                'currency' => [
                    0 => 'JPY',
                ],
            ],
            'JEY' => [
                'name'     => 'Jersey',
                'alpha2'   => 'JE',
                'alpha3'   => 'JEY',
                'numeric'  => '832',
                'currency' => [
                    0 => 'GBP',
                ],
            ],
            'JOR' => [
                'name'     => 'Jordan',
                'alpha2'   => 'JO',
                'alpha3'   => 'JOR',
                'numeric'  => '400',
                'currency' => [
                    0 => 'JOD',
                ],
            ],
            'KAZ' => [
                'name'     => 'Kazakhstan',
                'alpha2'   => 'KZ',
                'alpha3'   => 'KAZ',
                'numeric'  => '398',
                'currency' => [
                    0 => 'KZT',
                ],
            ],
            'KEN' => [
                'name'     => 'Kenya',
                'alpha2'   => 'KE',
                'alpha3'   => 'KEN',
                'numeric'  => '404',
                'currency' => [
                    0 => 'KES',
                ],
            ],
            'KIR' => [
                'name'     => 'Kiribati',
                'alpha2'   => 'KI',
                'alpha3'   => 'KIR',
                'numeric'  => '296',
                'currency' => [
                    0 => 'AUD',
                ],
            ],
            'PRK' => [
                'name'     => 'Korea (Democratic People\'s Republic of)',
                'alpha2'   => 'KP',
                'alpha3'   => 'PRK',
                'numeric'  => '408',
                'currency' => [
                    0 => 'KPW',
                ],
            ],
            'KOR' => [
                'name'     => 'Korea (Republic of)',
                'alpha2'   => 'KR',
                'alpha3'   => 'KOR',
                'numeric'  => '410',
                'currency' => [
                    0 => 'KRW',
                ],
            ],
            'KWT' => [
                'name'     => 'Kuwait',
                'alpha2'   => 'KW',
                'alpha3'   => 'KWT',
                'numeric'  => '414',
                'currency' => [
                    0 => 'KWD',
                ],
            ],
            'KGZ' => [
                'name'     => 'Kyrgyzstan',
                'alpha2'   => 'KG',
                'alpha3'   => 'KGZ',
                'numeric'  => '417',
                'currency' => [
                    0 => 'KGS',
                ],
            ],
            'LAO' => [
                'name'     => 'Lao People\'s Democratic Republic',
                'alpha2'   => 'LA',
                'alpha3'   => 'LAO',
                'numeric'  => '418',
                'currency' => [
                    0 => 'LAK',
                ],
            ],
            'LVA' => [
                'name'     => 'Latvia',
                'alpha2'   => 'LV',
                'alpha3'   => 'LVA',
                'numeric'  => '428',
                'currency' => [
                    0 => 'EUR',
                ],
            ],
            'LBN' => [
                'name'     => 'Lebanon',
                'alpha2'   => 'LB',
                'alpha3'   => 'LBN',
                'numeric'  => '422',
                'currency' => [
                    0 => 'LBP',
                ],
            ],
            'LSO' => [
                'name'     => 'Lesotho',
                'alpha2'   => 'LS',
                'alpha3'   => 'LSO',
                'numeric'  => '426',
                'currency' => [
                    0 => 'LSL',
                    1 => 'ZAR',
                ],
            ],
            'LBR' => [
                'name'     => 'Liberia',
                'alpha2'   => 'LR',
                'alpha3'   => 'LBR',
                'numeric'  => '430',
                'currency' => [
                    0 => 'LRD',
                ],
            ],
            'LBY' => [
                'name'     => 'Libya',
                'alpha2'   => 'LY',
                'alpha3'   => 'LBY',
                'numeric'  => '434',
                'currency' => [
                    0 => 'LYD',
                ],
            ],
            'LIE' => [
                'name'     => 'Liechtenstein',
                'alpha2'   => 'LI',
                'alpha3'   => 'LIE',
                'numeric'  => '438',
                'currency' => [
                    0 => 'CHF',
                ],
            ],
            'LTU' => [
                'name'     => 'Lithuania',
                'alpha2'   => 'LT',
                'alpha3'   => 'LTU',
                'numeric'  => '440',
                'currency' => [
                    0 => 'EUR',
                ],
            ],
            'LUX' => [
                'name'     => 'Luxembourg',
                'alpha2'   => 'LU',
                'alpha3'   => 'LUX',
                'numeric'  => '442',
                'currency' => [
                    0 => 'EUR',
                ],
            ],
            'MAC' => [
                'name'     => 'Macao',
                'alpha2'   => 'MO',
                'alpha3'   => 'MAC',
                'numeric'  => '446',
                'currency' => [
                    0 => 'MOP',
                ],
            ],
            'MKD' => [
                'name'     => 'North Macedonia',
                'alpha2'   => 'MK',
                'alpha3'   => 'MKD',
                'numeric'  => '807',
                'currency' => [
                    0 => 'MKD',
                ],
            ],
            'MDG' => [
                'name'     => 'Madagascar',
                'alpha2'   => 'MG',
                'alpha3'   => 'MDG',
                'numeric'  => '450',
                'currency' => [
                    0 => 'MGA',
                ],
            ],
            'MWI' => [
                'name'     => 'Malawi',
                'alpha2'   => 'MW',
                'alpha3'   => 'MWI',
                'numeric'  => '454',
                'currency' => [
                    0 => 'MWK',
                ],
            ],
            'MYS' => [
                'name'     => 'Malaysia',
                'alpha2'   => 'MY',
                'alpha3'   => 'MYS',
                'numeric'  => '458',
                'currency' => [
                    0 => 'MYR',
                ],
            ],
            'MDV' => [
                'name'     => 'Maldives',
                'alpha2'   => 'MV',
                'alpha3'   => 'MDV',
                'numeric'  => '462',
                'currency' => [
                    0 => 'MVR',
                ],
            ],
            'MLI' => [
                'name'     => 'Mali',
                'alpha2'   => 'ML',
                'alpha3'   => 'MLI',
                'numeric'  => '466',
                'currency' => [
                    0 => 'XOF',
                ],
            ],
            'MLT' => [
                'name'     => 'Malta',
                'alpha2'   => 'MT',
                'alpha3'   => 'MLT',
                'numeric'  => '470',
                'currency' => [
                    0 => 'EUR',
                ],
            ],
            'MHL' => [
                'name'     => 'Marshall Islands',
                'alpha2'   => 'MH',
                'alpha3'   => 'MHL',
                'numeric'  => '584',
                'currency' => [
                    0 => 'USD',
                ],
            ],
            'MTQ' => [
                'name'     => 'Martinique',
                'alpha2'   => 'MQ',
                'alpha3'   => 'MTQ',
                'numeric'  => '474',
                'currency' => [
                    0 => 'EUR',
                ],
            ],
            'MRT' => [
                'name'     => 'Mauritania',
                'alpha2'   => 'MR',
                'alpha3'   => 'MRT',
                'numeric'  => '478',
                'currency' => [
                    0 => 'MRO',
                ],
            ],
            'MUS' => [
                'name'     => 'Mauritius',
                'alpha2'   => 'MU',
                'alpha3'   => 'MUS',
                'numeric'  => '480',
                'currency' => [
                    0 => 'MUR',
                ],
            ],
            'MYT' => [
                'name'     => 'Mayotte',
                'alpha2'   => 'YT',
                'alpha3'   => 'MYT',
                'numeric'  => '175',
                'currency' => [
                    0 => 'EUR',
                ],
            ],
            'MEX' => [
                'name'     => 'Mexico',
                'alpha2'   => 'MX',
                'alpha3'   => 'MEX',
                'numeric'  => '484',
                'currency' => [
                    0 => 'MXN',
                ],
            ],
            'FSM' => [
                'name'     => 'Micronesia (Federated States of)',
                'alpha2'   => 'FM',
                'alpha3'   => 'FSM',
                'numeric'  => '583',
                'currency' => [
                    0 => 'USD',
                ],
            ],
            'MDA' => [
                'name'     => 'Moldova (Republic of)',
                'alpha2'   => 'MD',
                'alpha3'   => 'MDA',
                'numeric'  => '498',
                'currency' => [
                    0 => 'MDL',
                ],
            ],
            'MCO' => [
                'name'     => 'Monaco',
                'alpha2'   => 'MC',
                'alpha3'   => 'MCO',
                'numeric'  => '492',
                'currency' => [
                    0 => 'EUR',
                ],
            ],
            'MNG' => [
                'name'     => 'Mongolia',
                'alpha2'   => 'MN',
                'alpha3'   => 'MNG',
                'numeric'  => '496',
                'currency' => [
                    0 => 'MNT',
                ],
            ],
            'MNE' => [
                'name'     => 'Montenegro',
                'alpha2'   => 'ME',
                'alpha3'   => 'MNE',
                'numeric'  => '499',
                'currency' => [
                    0 => 'EUR',
                ],
            ],
            'MSR' => [
                'name'     => 'Montserrat',
                'alpha2'   => 'MS',
                'alpha3'   => 'MSR',
                'numeric'  => '500',
                'currency' => [
                    0 => 'XCD',
                ],
            ],
            'MAR' => [
                'name'     => 'Morocco',
                'alpha2'   => 'MA',
                'alpha3'   => 'MAR',
                'numeric'  => '504',
                'currency' => [
                    0 => 'MAD',
                ],
            ],
            'MOZ' => [
                'name'     => 'Mozambique',
                'alpha2'   => 'MZ',
                'alpha3'   => 'MOZ',
                'numeric'  => '508',
                'currency' => [
                    0 => 'MZN',
                ],
            ],
            'MMR' => [
                'name'     => 'Myanmar',
                'alpha2'   => 'MM',
                'alpha3'   => 'MMR',
                'numeric'  => '104',
                'currency' => [
                    0 => 'MMK',
                ],
            ],
            'NAM' => [
                'name'     => 'Namibia',
                'alpha2'   => 'NA',
                'alpha3'   => 'NAM',
                'numeric'  => '516',
                'currency' => [
                    0 => 'NAD',
                    1 => 'ZAR',
                ],
            ],
            'NRU' => [
                'name'     => 'Nauru',
                'alpha2'   => 'NR',
                'alpha3'   => 'NRU',
                'numeric'  => '520',
                'currency' => [
                    0 => 'AUD',
                ],
            ],
            'NPL' => [
                'name'     => 'Nepal',
                'alpha2'   => 'NP',
                'alpha3'   => 'NPL',
                'numeric'  => '524',
                'currency' => [
                    0 => 'NPR',
                ],
            ],
            'NLD' => [
                'name'     => 'Netherlands',
                'alpha2'   => 'NL',
                'alpha3'   => 'NLD',
                'numeric'  => '528',
                'currency' => [
                    0 => 'EUR',
                ],
            ],
            'NCL' => [
                'name'     => 'New Caledonia',
                'alpha2'   => 'NC',
                'alpha3'   => 'NCL',
                'numeric'  => '540',
                'currency' => [
                    0 => 'XPF',
                ],
            ],
            'NZL' => [
                'name'     => 'New Zealand',
                'alpha2'   => 'NZ',
                'alpha3'   => 'NZL',
                'numeric'  => '554',
                'currency' => [
                    0 => 'NZD',
                ],
            ],
            'NIC' => [
                'name'     => 'Nicaragua',
                'alpha2'   => 'NI',
                'alpha3'   => 'NIC',
                'numeric'  => '558',
                'currency' => [
                    0 => 'NIO',
                ],
            ],
            'NER' => [
                'name'     => 'Niger',
                'alpha2'   => 'NE',
                'alpha3'   => 'NER',
                'numeric'  => '562',
                'currency' => [
                    0 => 'XOF',
                ],
            ],
            'NGA' => [
                'name'     => 'Nigeria',
                'alpha2'   => 'NG',
                'alpha3'   => 'NGA',
                'numeric'  => '566',
                'currency' => [
                    0 => 'NGN',
                ],
            ],
            'NIU' => [
                'name'     => 'Niue',
                'alpha2'   => 'NU',
                'alpha3'   => 'NIU',
                'numeric'  => '570',
                'currency' => [
                    0 => 'NZD',
                ],
            ],
            'NFK' => [
                'name'     => 'Norfolk Island',
                'alpha2'   => 'NF',
                'alpha3'   => 'NFK',
                'numeric'  => '574',
                'currency' => [
                    0 => 'AUD',
                ],
            ],
            'MNP' => [
                'name'     => 'Northern Mariana Islands',
                'alpha2'   => 'MP',
                'alpha3'   => 'MNP',
                'numeric'  => '580',
                'currency' => [
                    0 => 'USD',
                ],
            ],
            'NOR' => [
                'name'     => 'Norway',
                'alpha2'   => 'NO',
                'alpha3'   => 'NOR',
                'numeric'  => '578',
                'currency' => [
                    0 => 'NOK',
                ],
            ],
            'OMN' => [
                'name'     => 'Oman',
                'alpha2'   => 'OM',
                'alpha3'   => 'OMN',
                'numeric'  => '512',
                'currency' => [
                    0 => 'OMR',
                ],
            ],
            'PAK' => [
                'name'     => 'Pakistan',
                'alpha2'   => 'PK',
                'alpha3'   => 'PAK',
                'numeric'  => '586',
                'currency' => [
                    0 => 'PKR',
                ],
            ],
            'PLW' => [
                'name'     => 'Palau',
                'alpha2'   => 'PW',
                'alpha3'   => 'PLW',
                'numeric'  => '585',
                'currency' => [
                    0 => 'USD',
                ],
            ],
            'PSE' => [
                'name'     => 'Palestine, State of',
                'alpha2'   => 'PS',
                'alpha3'   => 'PSE',
                'numeric'  => '275',
                'currency' => [
                    0 => 'ILS',
                ],
            ],
            'PAN' => [
                'name'     => 'Panama',
                'alpha2'   => 'PA',
                'alpha3'   => 'PAN',
                'numeric'  => '591',
                'currency' => [
                    0 => 'PAB',
                ],
            ],
            'PNG' => [
                'name'     => 'Papua New Guinea',
                'alpha2'   => 'PG',
                'alpha3'   => 'PNG',
                'numeric'  => '598',
                'currency' => [
                    0 => 'PGK',
                ],
            ],
            'PRY' => [
                'name'     => 'Paraguay',
                'alpha2'   => 'PY',
                'alpha3'   => 'PRY',
                'numeric'  => '600',
                'currency' => [
                    0 => 'PYG',
                ],
            ],
            'PER' => [
                'name'     => 'Peru',
                'alpha2'   => 'PE',
                'alpha3'   => 'PER',
                'numeric'  => '604',
                'currency' => [
                    0 => 'PEN',
                ],
            ],
            'PHL' => [
                'name'     => 'Philippines',
                'alpha2'   => 'PH',
                'alpha3'   => 'PHL',
                'numeric'  => '608',
                'currency' => [
                    0 => 'PHP',
                ],
            ],
            'PCN' => [
                'name'     => 'Pitcairn',
                'alpha2'   => 'PN',
                'alpha3'   => 'PCN',
                'numeric'  => '612',
                'currency' => [
                    0 => 'NZD',
                ],
            ],
            'POL' => [
                'name'     => 'Poland',
                'alpha2'   => 'PL',
                'alpha3'   => 'POL',
                'numeric'  => '616',
                'currency' => [
                    0 => 'PLN',
                ],
            ],
            'PRT' => [
                'name'     => 'Portugal',
                'alpha2'   => 'PT',
                'alpha3'   => 'PRT',
                'numeric'  => '620',
                'currency' => [
                    0 => 'EUR',
                ],
            ],
            'PRI' => [
                'name'     => 'Puerto Rico',
                'alpha2'   => 'PR',
                'alpha3'   => 'PRI',
                'numeric'  => '630',
                'currency' => [
                    0 => 'USD',
                ],
            ],
            'QAT' => [
                'name'     => 'Qatar',
                'alpha2'   => 'QA',
                'alpha3'   => 'QAT',
                'numeric'  => '634',
                'currency' => [
                    0 => 'QAR',
                ],
            ],
            'REU' => [
                'name'     => 'Réunion',
                'alpha2'   => 'RE',
                'alpha3'   => 'REU',
                'numeric'  => '638',
                'currency' => [
                    0 => 'EUR',
                ],
            ],
            'ROU' => [
                'name'     => 'Romania',
                'alpha2'   => 'RO',
                'alpha3'   => 'ROU',
                'numeric'  => '642',
                'currency' => [
                    0 => 'RON',
                ],
            ],
            'RUS' => [
                'name'     => 'Russian Federation',
                'alpha2'   => 'RU',
                'alpha3'   => 'RUS',
                'numeric'  => '643',
                'currency' => [
                    0 => 'RUB',
                ],
            ],
            'RWA' => [
                'name'     => 'Rwanda',
                'alpha2'   => 'RW',
                'alpha3'   => 'RWA',
                'numeric'  => '646',
                'currency' => [
                    0 => 'RWF',
                ],
            ],
            'BLM' => [
                'name'     => 'Saint Barthélemy',
                'alpha2'   => 'BL',
                'alpha3'   => 'BLM',
                'numeric'  => '652',
                'currency' => [
                    0 => 'EUR',
                ],
            ],
            'SHN' => [
                'name'     => 'Saint Helena, Ascension and Tristan da Cunha',
                'alpha2'   => 'SH',
                'alpha3'   => 'SHN',
                'numeric'  => '654',
                'currency' => [
                    0 => 'SHP',
                ],
            ],
            'KNA' => [
                'name'     => 'Saint Kitts and Nevis',
                'alpha2'   => 'KN',
                'alpha3'   => 'KNA',
                'numeric'  => '659',
                'currency' => [
                    0 => 'XCD',
                ],
            ],
            'LCA' => [
                'name'     => 'Saint Lucia',
                'alpha2'   => 'LC',
                'alpha3'   => 'LCA',
                'numeric'  => '662',
                'currency' => [
                    0 => 'XCD',
                ],
            ],
            'MAF' => [
                'name'     => 'Saint Martin (French part)',
                'alpha2'   => 'MF',
                'alpha3'   => 'MAF',
                'numeric'  => '663',
                'currency' => [
                    0 => 'EUR',
                    1 => 'USD',
                ],
            ],
            'SPM' => [
                'name'     => 'Saint Pierre and Miquelon',
                'alpha2'   => 'PM',
                'alpha3'   => 'SPM',
                'numeric'  => '666',
                'currency' => [
                    0 => 'EUR',
                ],
            ],
            'VCT' => [
                'name'     => 'Saint Vincent and the Grenadines',
                'alpha2'   => 'VC',
                'alpha3'   => 'VCT',
                'numeric'  => '670',
                'currency' => [
                    0 => 'XCD',
                ],
            ],
            'WSM' => [
                'name'     => 'Samoa',
                'alpha2'   => 'WS',
                'alpha3'   => 'WSM',
                'numeric'  => '882',
                'currency' => [
                    0 => 'WST',
                ],
            ],
            'SMR' => [
                'name'     => 'San Marino',
                'alpha2'   => 'SM',
                'alpha3'   => 'SMR',
                'numeric'  => '674',
                'currency' => [
                    0 => 'EUR',
                ],
            ],
            'STP' => [
                'name'     => 'Sao Tome and Principe',
                'alpha2'   => 'ST',
                'alpha3'   => 'STP',
                'numeric'  => '678',
                'currency' => [
                    0 => 'STD',
                ],
            ],
            'SAU' => [
                'name'     => 'Saudi Arabia',
                'alpha2'   => 'SA',
                'alpha3'   => 'SAU',
                'numeric'  => '682',
                'currency' => [
                    0 => 'SAR',
                ],
            ],
            'SEN' => [
                'name'     => 'Senegal',
                'alpha2'   => 'SN',
                'alpha3'   => 'SEN',
                'numeric'  => '686',
                'currency' => [
                    0 => 'XOF',
                ],
            ],
            'SRB' => [
                'name'     => 'Serbia',
                'alpha2'   => 'RS',
                'alpha3'   => 'SRB',
                'numeric'  => '688',
                'currency' => [
                    0 => 'RSD',
                ],
            ],
            'SYC' => [
                'name'     => 'Seychelles',
                'alpha2'   => 'SC',
                'alpha3'   => 'SYC',
                'numeric'  => '690',
                'currency' => [
                    0 => 'SCR',
                ],
            ],
            'SLE' => [
                'name'     => 'Sierra Leone',
                'alpha2'   => 'SL',
                'alpha3'   => 'SLE',
                'numeric'  => '694',
                'currency' => [
                    0 => 'SLL',
                ],
            ],
            'SGP' => [
                'name'     => 'Singapore',
                'alpha2'   => 'SG',
                'alpha3'   => 'SGP',
                'numeric'  => '702',
                'currency' => [
                    0 => 'SGD',
                ],
            ],
            'SXM' => [
                'name'     => 'Sint Maarten (Dutch part)',
                'alpha2'   => 'SX',
                'alpha3'   => 'SXM',
                'numeric'  => '534',
                'currency' => [
                    0 => 'ANG',
                ],
            ],
            'SVK' => [
                'name'     => 'Slovakia',
                'alpha2'   => 'SK',
                'alpha3'   => 'SVK',
                'numeric'  => '703',
                'currency' => [
                    0 => 'EUR',
                ],
            ],
            'SVN' => [
                'name'     => 'Slovenia',
                'alpha2'   => 'SI',
                'alpha3'   => 'SVN',
                'numeric'  => '705',
                'currency' => [
                    0 => 'EUR',
                ],
            ],
            'SLB' => [
                'name'     => 'Solomon Islands',
                'alpha2'   => 'SB',
                'alpha3'   => 'SLB',
                'numeric'  => '090',
                'currency' => [
                    0 => 'SBD',
                ],
            ],
            'SOM' => [
                'name'     => 'Somalia',
                'alpha2'   => 'SO',
                'alpha3'   => 'SOM',
                'numeric'  => '706',
                'currency' => [
                    0 => 'SOS',
                ],
            ],
            'ZAF' => [
                'name'     => 'South Africa',
                'alpha2'   => 'ZA',
                'alpha3'   => 'ZAF',
                'numeric'  => '710',
                'currency' => [
                    0 => 'ZAR',
                ],
            ],
            'SGS' => [
                'name'     => 'South Georgia and the South Sandwich Islands',
                'alpha2'   => 'GS',
                'alpha3'   => 'SGS',
                'numeric'  => '239',
                'currency' => [
                    0 => 'GBP',
                ],
            ],
            'SSD' => [
                'name'     => 'South Sudan',
                'alpha2'   => 'SS',
                'alpha3'   => 'SSD',
                'numeric'  => '728',
                'currency' => [
                    0 => 'SSP',
                ],
            ],
            'ESP' => [
                'name'     => 'Spain',
                'alpha2'   => 'ES',
                'alpha3'   => 'ESP',
                'numeric'  => '724',
                'currency' => [
                    0 => 'EUR',
                ],
            ],
            'LKA' => [
                'name'     => 'Sri Lanka',
                'alpha2'   => 'LK',
                'alpha3'   => 'LKA',
                'numeric'  => '144',
                'currency' => [
                    0 => 'LKR',
                ],
            ],
            'SDN' => [
                'name'     => 'Sudan',
                'alpha2'   => 'SD',
                'alpha3'   => 'SDN',
                'numeric'  => '729',
                'currency' => [
                    0 => 'SDG',
                ],
            ],
            'SUR' => [
                'name'     => 'Suriname',
                'alpha2'   => 'SR',
                'alpha3'   => 'SUR',
                'numeric'  => '740',
                'currency' => [
                    0 => 'SRD',
                ],
            ],
            'SJM' => [
                'name'     => 'Svalbard and Jan Mayen',
                'alpha2'   => 'SJ',
                'alpha3'   => 'SJM',
                'numeric'  => '744',
                'currency' => [
                    0 => 'NOK',
                ],
            ],
            'SWE' => [
                'name'     => 'Sweden',
                'alpha2'   => 'SE',
                'alpha3'   => 'SWE',
                'numeric'  => '752',
                'currency' => [
                    0 => 'SEK',
                ],
            ],
            'CHE' => [
                'name'     => 'Switzerland',
                'alpha2'   => 'CH',
                'alpha3'   => 'CHE',
                'numeric'  => '756',
                'currency' => [
                    0 => 'CHF',
                ],
            ],
            'SYR' => [
                'name'     => 'Syrian Arab Republic',
                'alpha2'   => 'SY',
                'alpha3'   => 'SYR',
                'numeric'  => '760',
                'currency' => [
                    0 => 'SYP',
                ],
            ],
            'TWN' => [
                'name'     => 'Taiwan (Province of China)',
                'alpha2'   => 'TW',
                'alpha3'   => 'TWN',
                'numeric'  => '158',
                'currency' => [
                    0 => 'TWD',
                ],
            ],
            'TJK' => [
                'name'     => 'Tajikistan',
                'alpha2'   => 'TJ',
                'alpha3'   => 'TJK',
                'numeric'  => '762',
                'currency' => [
                    0 => 'TJS',
                ],
            ],
            'TZA' => [
                'name'     => 'Tanzania, United Republic of',
                'alpha2'   => 'TZ',
                'alpha3'   => 'TZA',
                'numeric'  => '834',
                'currency' => [
                    0 => 'TZS',
                ],
            ],
            'THA' => [
                'name'     => 'Thailand',
                'alpha2'   => 'TH',
                'alpha3'   => 'THA',
                'numeric'  => '764',
                'currency' => [
                    0 => 'THB',
                ],
            ],
            'TLS' => [
                'name'     => 'Timor-Leste',
                'alpha2'   => 'TL',
                'alpha3'   => 'TLS',
                'numeric'  => '626',
                'currency' => [
                    0 => 'USD',
                ],
            ],
            'TGO' => [
                'name'     => 'Togo',
                'alpha2'   => 'TG',
                'alpha3'   => 'TGO',
                'numeric'  => '768',
                'currency' => [
                    0 => 'XOF',
                ],
            ],
            'TKL' => [
                'name'     => 'Tokelau',
                'alpha2'   => 'TK',
                'alpha3'   => 'TKL',
                'numeric'  => '772',
                'currency' => [
                    0 => 'NZD',
                ],
            ],
            'TON' => [
                'name'     => 'Tonga',
                'alpha2'   => 'TO',
                'alpha3'   => 'TON',
                'numeric'  => '776',
                'currency' => [
                    0 => 'TOP',
                ],
            ],
            'TTO' => [
                'name'     => 'Trinidad and Tobago',
                'alpha2'   => 'TT',
                'alpha3'   => 'TTO',
                'numeric'  => '780',
                'currency' => [
                    0 => 'TTD',
                ],
            ],
            'TUN' => [
                'name'     => 'Tunisia',
                'alpha2'   => 'TN',
                'alpha3'   => 'TUN',
                'numeric'  => '788',
                'currency' => [
                    0 => 'TND',
                ],
            ],
            'TUR' => [
                'name'     => 'Turkey',
                'alpha2'   => 'TR',
                'alpha3'   => 'TUR',
                'numeric'  => '792',
                'currency' => [
                    0 => 'TRY',
                ],
            ],
            'TKM' => [
                'name'     => 'Turkmenistan',
                'alpha2'   => 'TM',
                'alpha3'   => 'TKM',
                'numeric'  => '795',
                'currency' => [
                    0 => 'TMT',
                ],
            ],
            'TCA' => [
                'name'     => 'Turks and Caicos Islands',
                'alpha2'   => 'TC',
                'alpha3'   => 'TCA',
                'numeric'  => '796',
                'currency' => [
                    0 => 'USD',
                ],
            ],
            'TUV' => [
                'name'     => 'Tuvalu',
                'alpha2'   => 'TV',
                'alpha3'   => 'TUV',
                'numeric'  => '798',
                'currency' => [
                    0 => 'AUD',
                ],
            ],
            'UGA' => [
                'name'     => 'Uganda',
                'alpha2'   => 'UG',
                'alpha3'   => 'UGA',
                'numeric'  => '800',
                'currency' => [
                    0 => 'UGX',
                ],
            ],
            'UKR' => [
                'name'     => 'Ukraine',
                'alpha2'   => 'UA',
                'alpha3'   => 'UKR',
                'numeric'  => '804',
                'currency' => [
                    0 => 'UAH',
                ],
            ],
            'ARE' => [
                'name'     => 'United Arab Emirates',
                'alpha2'   => 'AE',
                'alpha3'   => 'ARE',
                'numeric'  => '784',
                'currency' => [
                    0 => 'AED',
                ],
            ],
            'GBR' => [
                'name'     => 'United Kingdom of Great Britain and Northern Ireland',
                'alpha2'   => 'GB',
                'alpha3'   => 'GBR',
                'numeric'  => '826',
                'currency' => [
                    0 => 'GBP',
                ],
            ],
            'USA' => [
                'name'     => 'United States of America',
                'alpha2'   => 'US',
                'alpha3'   => 'USA',
                'numeric'  => '840',
                'currency' => [
                    0 => 'USD',
                ],
            ],
            'UMI' => [
                'name'     => 'United States Minor Outlying Islands',
                'alpha2'   => 'UM',
                'alpha3'   => 'UMI',
                'numeric'  => '581',
                'currency' => [
                    0 => 'USD',
                ],
            ],
            'URY' => [
                'name'     => 'Uruguay',
                'alpha2'   => 'UY',
                'alpha3'   => 'URY',
                'numeric'  => '858',
                'currency' => [
                    0 => 'UYU',
                ],
            ],
            'UZB' => [
                'name'     => 'Uzbekistan',
                'alpha2'   => 'UZ',
                'alpha3'   => 'UZB',
                'numeric'  => '860',
                'currency' => [
                    0 => 'UZS',
                ],
            ],
            'VUT' => [
                'name'     => 'Vanuatu',
                'alpha2'   => 'VU',
                'alpha3'   => 'VUT',
                'numeric'  => '548',
                'currency' => [
                    0 => 'VUV',
                ],
            ],
            'VEN' => [
                'name'     => 'Venezuela (Bolivarian Republic of)',
                'alpha2'   => 'VE',
                'alpha3'   => 'VEN',
                'numeric'  => '862',
                'currency' => [
                    0 => 'VEF',
                ],
            ],
            'VNM' => [
                'name'     => 'Viet Nam',
                'alpha2'   => 'VN',
                'alpha3'   => 'VNM',
                'numeric'  => '704',
                'currency' => [
                    0 => 'VND',
                ],
            ],
            'VGB' => [
                'name'     => 'Virgin Islands (British)',
                'alpha2'   => 'VG',
                'alpha3'   => 'VGB',
                'numeric'  => '092',
                'currency' => [
                    0 => 'USD',
                ],
            ],
            'VIR' => [
                'name'     => 'Virgin Islands (U.S.)',
                'alpha2'   => 'VI',
                'alpha3'   => 'VIR',
                'numeric'  => '850',
                'currency' => [
                    0 => 'USD',
                ],
            ],
            'WLF' => [
                'name'     => 'Wallis and Futuna',
                'alpha2'   => 'WF',
                'alpha3'   => 'WLF',
                'numeric'  => '876',
                'currency' => [
                    0 => 'XPF',
                ],
            ],
            'ESH' => [
                'name'     => 'Western Sahara',
                'alpha2'   => 'EH',
                'alpha3'   => 'ESH',
                'numeric'  => '732',
                'currency' => [
                    0 => 'MAD',
                ],
            ],
            'YEM' => [
                'name'     => 'Yemen',
                'alpha2'   => 'YE',
                'alpha3'   => 'YEM',
                'numeric'  => '887',
                'currency' => [
                    0 => 'YER',
                ],
            ],
            'ZMB' => [
                'name'     => 'Zambia',
                'alpha2'   => 'ZM',
                'alpha3'   => 'ZMB',
                'numeric'  => '894',
                'currency' => [
                    0 => 'ZMW',
                ],
            ],
            'ZWE' => [
                'name'     => 'Zimbabwe',
                'alpha2'   => 'ZW',
                'alpha3'   => 'ZWE',
                'numeric'  => '716',
                'currency' => [
                    0 => 'BWP',
                    1 => 'EUR',
                    2 => 'GBP',
                    3 => 'USD',
                    4 => 'ZAR',
                ],
            ],
        ];
    }
}