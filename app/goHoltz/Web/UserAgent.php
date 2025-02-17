<?php

namespace App\goHoltz\Web;

/**
 * UserAgent class for controlling the User Agent of the web crawler.
 * 
 * @author Kleber Holtz <kleber.holtz@goholtz.com>
 * @version 1.0.2
 * 
 * @package goHoltz\Web
 */
class UserAgent
{
    /**
     * Windows Operating System list with dynamic versioning
     * 
     * @var array
     */
    private array $windows_os = [
        '[Windows; |Windows; U; |]Windows NT 6.:number0-3:;[ Win64; x64| WOW64| x64|]',
        '[Windows; |Windows; U; |]Windows NT 10.:number0-5:;[ Win64; x64| WOW64| x64|]',
        '[Windows; |Windows; U; |]Windows NT 5.:number0-2:;[ Win64; x64| WOW64| x64|]',
    ];

    /**
     * Linux Operating Systems [limited]
     * 
     * @var array
     */
    private array $linux_os = [
        '[Linux; |][U; |]Linux x86_64',
        '[Linux; |][U; |]Linux i:number5-6::number4-8::number0-6: [x86_64|]',
        '[Linux; |][U; |]Linux i:number5-6::number4-8::number0-6: [x86_64|] [rv:number0-9:.]',

    ];

    /**
     * Mac Operating System (OS X) with dynamic versioning
     * 
     * @var array
     */
    private array $mac_os = [
        'Macintosh; [U; |]Intel Mac OS X :number7-9:_:number0-9:_:number0-9:',
        'Macintosh; [U; |]Intel Mac OS X 10_:number0-12:_:number0-9:'
    ];

    /**
     * Versions of Android to be used
     * 
     * @var array
     */
    private array $androidVersions = [
        '4.3.1',
        '4.4',
        '4.4.1',
        '4.4.4',
        '5.0',
        '5.0.1',
        '5.0.2',
        '5.1',
        '5.1.1',
        '6.0',
        '6.0.1',
        '7.0',
        '7.1',
        '7.1.1',
        '7.1.2',
        '8.0',
        '8.1',
        '9.0',
        '10.0',
        '11.0'
    ];

    /**
     * Holds the version of android for the User Agent being generated
     * 
     * @var string
     */
    private string $androidVersion;

    /**
     * Android devices and for specific android versions
     * 
     * @var array
     */
    private array $androidDevices = [
        '4.3' => [
            'GT-I9:number2-5:00 Build/JDQ39',
            'Nokia 3:number1-3:[10|15] Build/IMM76D',
            '[SAMSUNG |]SM-G3:number1-5:0[R5|I|V|A|T|S] Build/JLS36C',
            'Ascend G3:number0-3:0 Build/JLS36I',
            '[SAMSUNG |]SM-G3:number3-6::number1-8::number0-9:[V|A|T|S|I|R5] Build/JLS36C',
            'HUAWEI G6-L:number10-11: Build/HuaweiG6-L:number10-11:',
            '[SAMSUNG |]SM-[G|N]:number7-9:1:number0-8:[S|A|V|T] Build/[JLS36C|JSS15J]',
            '[SAMSUNG |]SGH-N0:number6-9:5[T|V|A|S] Build/JSS15J',
            'Samsung Galaxy S[4|IV] Mega GT-I:number89-95:00 Build/JDQ39',
            'SAMSUNG SM-T:number24-28:5[s|a|t|v] Build/[JLS36C|JSS15J]',
            'HP :number63-73:5 Notebook PC Build/[JLS36C|JSS15J]',
            'HP Compaq 2:number1-3:10b Build/[JLS36C|JSS15J]',
            'HTC One 801[s|e] Build/[JLS36C|JSS15J]',
            'HTC One max Build/[JLS36C|JSS15J]',
            'HTC Xplorer A:number28-34:0[e|s] Build/GRJ90',
        ],
        '4.4' => [
            'XT10:number5-8:0 Build/SU6-7.3',
            'XT10:number12-52: Build/[KXB20.9|KXC21.5]',
            'Nokia :number30-34:10 Build/IMM76D',
            'E:number:20-23::number0-3::number0-4: Build/24.0.[A|B].1.34',
            '[SAMSUNG |]SM-E500[F|L] Build/KTU84P',
            'LG Optimus G Build/KRT16M',
            'LG-E98:number7-9: Build/KOT49I',
            'Elephone P:number2-6:000 Build/KTU84P',
            'IQ450:number0-4: Quad Build/KOT49H',
            'LG-F:number2-5:00[K|S|L] Build/KOT49[I|H]',
            'LG-V:number3-7::number0-1:0 Build/KOT49I',
            '[SAMSUNG |]SM-J:number1-2::number0-1:0[G|F] Build/KTU84P',
            '[SAMSUNG |]SM-N80:number0-1:0 Build/[KVT49L|JZO54K]',
            '[SAMSUNG |]SM-N900:number5-8: Build/KOT49H',
            '[SAMSUNG-|]SGH-I337[|M] Build/[JSS15J|KOT49H]',
            '[SAMSUNG |]SM-G900[W8|9D|FD|H|V|FG|A|T] Build/KOT49H',
            '[SAMSUNG |]SM-T5:number30-35: Build/[KOT49H|KTU84P]',
            '[Google |]Nexus :number5-7: Build/KOT49H',
            'LG-H2:number0-2:0 Build/KOT49[I|H]',
            'HTC One[_M8|_M9|0P6B|801e|809d|0P8B2|mini 2|S][ dual sim|] Build/[KOT49H|KTU84L]',
            '[SAMSUNG |]GT-I9:number3-5:0:number0-6:[V|I|T|N] Build/KOT49H',
            'Lenovo P7:number7-8::number1-6: Build/[Lenovo|JRO03C]',
            'LG-D95:number1-8: Build/KOT49[I|H]',
            'LG-D:number1-8::number0-8:0 Build/KOT49[I|H]',
            'Nexus5 V:number6-7:.1 Build/KOT49H',
            'Nexus[_|] :number4-10: Build/[KOT49H|KTU84P]',
            'Nexus[_S_| S ][4G |]Build/GRJ22',
            '[HM NOTE|NOTE-III|NOTE2 1LTE[TD|W|T]',
            'ALCATEL ONE[| ]TOUCH 70:number2-4::number0-9:[X|D|E|A] Build/KOT49H',
            'MOTOROLA [MOTOG|MSM8960|RAZR] Build/KVT49L'
        ],
        '5.0' => [
            'Nokia :number10-11:00 [wifi|4G|LTE] Build/GRK39F',
            'HTC 80:number1-2[s|w|e|t] Build/[LRX22G|JSS15J]',
            'Lenovo A7000-a Build/LRX21M;',
            'HTC Butterfly S [901|919][s|d|] Build/LRX22G',
            'HTC [M8|M9|M8 Pro Build/LRX22G',
            'LG-D3:number25-37: Build/LRX22G',
            'LG-D72:number0-9: Build/LRX22G',
            '[SAMSUNG |]SM-G4:number0-9:0 Build/LRX22[G|C]',
            '[|SAMSUNG ]SM-G9[00|25|20][FD|8|F|F-ORANGE|FG|FQ|H|I|L|M|S|T] Build/[LRX21T|KTU84F|KOT49H]',
            '[SAMSUNG |]SM-A:number7-8:00[F|I|T|H|] Build/[LRX22G|LMY47X]',
            '[SAMSUNG-|]SM-N91[0|5][A|V|F|G|FY] Build/LRX22C',
            '[SAMSUNG |]SM-[T|P][350|550|555|355|805|800|710|810|815] Build/LRX22G',
            'LG-D7:number0-2::number0-9: Build/LRX22G',
            '[LG|SM]-[D|G]:number8-9::number0-5::number0-9:[|P|K|T|I|F|T1] Build/[LRX22G|KOT49I|KVT49L|LMY47X]'
        ],
        '5.1' => [
            'Nexus :number5-9: Build/[LMY48B|LRX22C]',
            '[|SAMSUNG ]SM-G9[28|25|20][X|FD|8|F|F-ORANGE|FG|FQ|H|I|L|M|S|T] Build/[LRX22G|LMY47X]',
            '[|SAMSUNG ]SM-G9[35|350][X|FD|8|F|F-ORANGE|FG|FQ|H|I|L|M|S|T] Build/[MMB29M|LMY47X]',
            '[MOTOROLA |][MOTO G|MOTO G XT1068|XT1021|MOTO E XT1021|MOTO XT1580|MOTO X FORCE XT1580|MOTO X PLAY XT1562|MOTO XT1562|MOTO XT1575|MOTO X PURE XT1575|MOTO XT1570 MOTO X STYLE] Build/[LXB22|LMY47Z|LPC23|LPK23|LPD23|LPH223]'
        ],
        '6.0' => [
            '[SAMSUNG |]SM-[G|D][920|925|928|9350][V|F|I|L|M|S|8|I] Build/[MMB29K|MMB29V|MDB08I|MDB08L]',
            'Nexus :number5-7:[P|X|] Build/[MMB29K|MMB29V|MDB08I|MDB08L]',
            'HTC One[_| ][M9|M8|M8 Pro] Build/MRA58K',
            'HTC One[_M8|_M9|0P6B|801e|809d|0P8B2|mini 2|S][ dual sim|] Build/MRA58K'
        ],
        '7.0' => [
            'Pixel [XL|C] Build/[NRD90M|NME91E]',
            'Nexus :number5-9:[X|P|] Build/[NPD90G|NME91E]',
            '[SAMSUNG |]GT-I:number91-98:00 Build/KTU84P',
            'Xperia [V |]Build/NDE63X',
            'LG-H:number90-93:0 Build/NRD90[C|M]'
        ],
        '7.1' => [
            'Pixel [XL|C] Build/[NRD90M|NME91E]',
            'Nexus :number5-9:[X|P|] Build/[NPD90G|NME91E]',
            '[SAMSUNG |]GT-I:number91-98:00 Build/KTU84P',
            'Xperia [V |]Build/NDE63X',
            'LG-H:number90-93:0 Build/NRD90[C|M]'
        ],
        '8.0' => [
            'Pixel [XL|C] Build/[OPR3|OPR4].number1-2:.number0-9:',
            'Nexus :number5-9:[X|P|] Build/[OPR3|OPR4].number1-2:.number0-9:',
            'SM-[G|N|J|A|T|S|C|P|L|W|Z|X|E|F|B|V|Y|G|N|A|T|S|C|P|L|W|Z|X|E|F|B|V|Y]:number10-11:0 Build/[OPR3|OPR4].number1-2:.number0-9:',
            'SM-[G|N|J|A|T|S|C|P|L|W|Z|X|E|F|B|V|Y|G|N|A|T|S|C|P|L|W|Z|X|E|F|B|V|Y]:number10-11:0 Build/[OPR3|OPR4].number1-2:.number0-9:',
            'SM-[G|N|J|A|T|S|C|P|L|W|Z|X|E|F|B|V|Y|G|N|A|T|S|C|P|L|W|Z|X|E|F|B|V|Y]:number10-11:0 Build/[OPR3|OPR4].number1-2:.number0-9:',
            'SM-[G|N|J|A|T|S|C|P|L|W|Z|X|E|F|B|V|Y|G|N|A|T|S|C|P|L|W|Z|X|E|F|B|V|Y]:number10-11:0 Build/[OPR3|OPR4].number1-2:.number0-9:',
            'SM-[G|N|J|A|T|S|C|P|L|W|Z|X|E|F|B|V|Y|G|N|A|T|S|C|P|L|W|Z|X|E|F|B|V|Y]:number10-11:0 Build/[OPR3|OPR4].number1-2:.number0-9:',
            'Xperia [V |]Build/[OPR3|OPR4].number1-2:.number0-9:',
            'LG-H:number90-93:0 Build/[OPR3|OPR4].number1-2:.number0-9:',
            'LG-[F|H|K|L|S|V|Y|G|N|A|T|S|C|P|L|W|Z|X|E|F|B|V|Y]:number10-11:0 Build/[OPR3|OPR4].number1-2:.number0-9:'
        ],
        '8.1' => [
            'Pixel [XL|C] Build/[OPM1|OPM2].number1-2:.number0-9:',
            'Nexus :number5-9:[X|P|] Build/[OPM1|OPM2].number1-2:.number0-9:',
            'SM-[G|N|J|A|T|S|C|P|L|W|Z|X|E|F|B|V|Y|G|N|A|T|S|C|P|L|W|Z|X|E|F|B|V|Y]:number10-11:0 Build/[OPM1|OPM2].number1-2:.number0-9:',
            'Xperia [V |]Build/[OPM1|OPM2].number1-2:.number0-9:',
            'LG-H:number90-93:0 Build/[OPM1|OPM2].number1-2:.number0-9:',
            'LG-[F|H|K|L|S|V|Y|G|N|A|T|S|C|P|L|W|Z|X|E|F|B|V|Y]:number10-11:0 Build/[OPM1|OPM2].number1-2:.number0-9:'
        ],
        '9.0' => [
            'Pixel [XL|C] Build/[PPP1|PPR1].number1-2:.number0-9:',
            'Nexus :number5-9:[X|P|] Build/[PPP1|PPR1].number1-2:.number0-9:',
            'SM-[G|N|J|A|T|S|C|P|L|W|Z|X|E|F|B|V|Y|G|N|A|T|S|C|P|L|W|Z|X|E|F|B|V|Y]:number10-11:0 Build/[PPP1|PPR1].number1-2:.number0-9:',
            'Xperia [V |]Build/[PPP1|PPR1].number1-2:.number0-9:',
            'LG-H:number90-93:0 Build/[PPP1|PPR1].number1-2:.number0-9:',
            'LG-[F|H|K|L|S|V|Y|G|N|A|T|S|C|P|L|W|Z|X|E|F|B|V|Y]:number10-11:0 Build/[PPP1|PPR1].number1-2:.number0-9:'
        ],
        '10.0' => [
            'Pixel [XL|C] Build/[QQ1|QP1].number1-2:.number0-9:',
            'Nexus :number5-9:[X|P|] Build/[QQ1|QP1].number1-2:.number0-9:',
            'SM-[G|N|J|A|T|S|C|P|L|W|Z|X|E|F|B|V|Y|G|N|A|T|S|C|P|L|W|Z|X|E|F|B|V|Y]:number10-11:0 Build/[QQ1|QP1].number1-2:.number0-9:',
            'Xperia [V |]Build/[QQ1|QP1].number1-2:.number0-9:',
            'LG-H:number90-93:0 Build/[QQ1|QP1].number1-2:.number0-9:',
            'LG-[F|H|K|L|S|V|Y|G|N|A|T|S|C|P|L|W|Z|X|E|F|B|V|Y]:number10-11:0 Build/[QQ1|QP1].number1-2:.number0-9:'
        ],
        '11.0' => [
            'Pixel [XL|C] Build/[RQ1|RP1].number1-2:.number0-9:',
            'Nexus :number5-9:[X|P|] Build/[RQ1|RP1].number1-2:.number0-9:',
            'SM-[G|N|J|A|T|S|C|P|L|W|Z|X|E|F|B|V|Y|G|N|A|T|S|C|P|L|W|Z|X|E|F|B|V|Y]:number10-11:0 Build/[RQ1|RP1].number1-2:.number0-9:',
            'Xperia [V |]Build/[RQ1|RP1].number1-2:.number0-9:',
            'LG-H:number90-93:0 Build/[RQ1|RP1].number1-2:.number0-9:',
            'LG-[F|H|K|L|S|V|Y|G|N|A|T|S|C|P|L|W|Z|X|E|F|B|V|Y]:number10-11:0 Build/[RQ1|RP1].number1-2:.number0-9:'
        ]
    ];

    /**
     * List of "OS" strings used for android
     * 
     * @var array
     */
    public array $android_os = [
        'Linux; Android :androidVersion:; :androidDevice:',
        //TODO: Add a $windowsDevices variable that does the same as androidDevice
        //'Windows Phone 10.0; Android :androidVersion:; :windowsDevice:',
        'Linux; U; Android :androidVersion:; :androidDevice:',
        'Android; Android :androidVersion:; :androidDevice:',
        'Linux; Android :androidVersion:; :androidDevice: Build/:androidBuild:',
        'Linux; U; Android :androidVersion:; :androidDevice: Build/:androidBuild:',
        'Android; Android :androidVersion:; :androidDevice: Build/:androidBuild:',
        'Linux; Android :androidVersion:; :androidDevice: Build/:androidBuild:; wv',
    ];

    /**
     * List of "OS" strings used for iOS
     * 
     * @var array
     */
    public array $mobile_ios = [
        'iphone' => 'iPhone; CPU iPhone OS :number7-11:_:number0-9:_:number0-9:; like Mac OS X;',
        'ipad' => 'iPad; CPU iPad OS :number7-11:_:number0-9:_:number0-9: like Mac OS X;',
        'ipod' => 'iPod; CPU iPod OS :number7-11:_:number0-9:_:number0-9:; like Mac OS X;',
    ];

    /**
     * Get a random operating system
     * 
     * @param ?string $os
     * 
     * @return string
     */
    public function getOS(?string $os = null): string
    {
        $os = mb_strtolower($os);

        if ($os === 'android') {
            $selected_os = array_rand($this->android_os);
        } else {
            $_os = [];

            if ($os === null || in_array($os, ['chrome', 'firefox', 'explorer'])) {
                $_os = $os === 'explorer' ? $this->windows_os : array_merge($this->windows_os, $this->linux_os, $this->mac_os);
            } else {
                $_os = $this->{$os . '_os'};
            }

            $selected_os = rtrim($_os[array_rand($_os)], ';');

            if (str_contains($selected_os, '[')) {
                $selected_os = self::processSpinSyntax($selected_os);
            }

            if (str_contains($selected_os, ':number')) {
                $selected_os = self::processRandomNumbers($selected_os);
            }

            if (random_int(1, 100) > 50) {
                $selected_os .= '; en-US';
            }
        }

        return $selected_os;
    }

    /**
     * Get Mobile OS
     * 
     * * Can specifiy android, iphone, ipad, ipod, or null/blank for random
     * 
     * @param ?string $os
     * 
     * @return string
     */
    public function getMobileOS(?string $os = null): string
    {
        $os = mb_strtolower($os);

        $selected_os = match ($os) {
            'android' => array_rand($this->android_os),
            'iphone', 'ipad', 'ipod' => $this->mobile_ios[$os],
            default => array_rand(array_merge($this->android_os, array_values($this->mobile_ios))),
        };

        $selected_os = rtrim($selected_os, ';');

        if (str_contains($selected_os, ':androidVersion:')) {
            $selected_os = $this->processAndroidVersion($selected_os);
        }

        if (str_contains($selected_os, ':androidDevice:')) {
            $selected_os = $this->addAndroidDevice($selected_os);
        }

        if (str_contains($selected_os, ':number')) {
            $selected_os = self::processRandomNumbers($selected_os);
        }

        return $selected_os;
    }

    /**
     * 
     * 
     * @param array|string $selected_os
     * 
     * @return mixed
     */
    public static function processRandomNumbers(array|string $selected_os): mixed
    {
        return preg_replace_callback('/:number(\d+)-(\d+):/i', function ($matches) {
            return random_int($matches[1], $matches[2]);
        }, $selected_os);
    }

    /**
     * 
     * 
     * @param array|string $selected_os
     * 
     * @return mixed
     */
    public static function processSpinSyntax(array|string $selected_os): mixed
    {
        return preg_replace_callback('/\[([\w\-\s|;]*?)\]/i', function ($matches) {
            $options = explode('|', $matches[1]);
            if (!empty($options)) {
                return $options[array_rand($options)];
            }

            return $matches[0];
        }, $selected_os);
    }

    /**
     * 
     * 
     * @param array|string $selected_os
     * 
     * @return mixed
     */
    public function processAndroidVersion(array|string $selected_os): mixed
    {
        $version = $this->androidVersions[array_rand($this->androidVersions)];
        return preg_replace_callback('/:androidVersion:/i', function () use ($version) {
            return $version;
        }, $selected_os);
    }

    /**
     * Add a random android device
     * 
     * @param array|string $selected_os
     * 
     * @return mixed
     */
    public function addAndroidDevice(array|string $selected_os): mixed
    {
        $devices = $this->androidDevices[substr($this->androidVersion, 0, 3)];
        $device = $devices[array_rand($devices)];

        $device = self::processSpinSyntax($device);
        return preg_replace_callback('/:androidDevice:/i', fn () => $device, $selected_os);
    }

    /**
     * Determine the chrome version
     * 
     * @param array $version
     * 
     * @return string
     */
    public static function chromeVersion(array $version): string
    {
        $randomVersion = random_int($version['min'], $version['max']);
        $randomNumber1 = random_int(1000, 4000);
        $randomNumber2 = random_int(100, 400);

        return "{$randomVersion}.0.{$randomNumber1}.{$randomNumber2}";
    }

    /**
     * Determine the firefox version
     * 
     * @param array $version
     * 
     * @return string
     */
    public static function firefoxVersion(array $version): string
    {
        $randomVersion = random_int($version['min'], $version['max']);
        $randomNumber = random_int(0, 9);

        return "{$randomVersion}.{$randomNumber}";
    }

    /**
     * Determine the explorer version
     * 
     * @param array $version
     * 
     * @return string
     */
    public static function windows(array $version): string
    {
        $randomVersion = random_int($version['min'], $version['max']);
        $randomNumber = random_int(0, 9);

        return "{$randomVersion}.{$randomNumber}";
    }

    /**
     * Generate a random user agent
     * 
     * @param ?string $userAgent
     * 
     * @return string
     */
    public function generate(?string $userAgent = null): string
    {
        if ($userAgent === null) {
            $r = random_int(0, 100);
            $userAgent = match (true) {
                $r >= 44 => array_rand(['firefox' => 1, 'chrome' => 1, 'explorer' => 1]),
                default => array_rand(['iphone' => 1, 'android' => 1, 'mobile' => 1]),
            };
        } elseif (in_array($userAgent, ['windows', 'mac', 'linux'])) {
            $agents = ['firefox' => 1, 'chrome' => 1];
            if ($userAgent === 'windows') {
                $agents['explorer'] = 1;
            }
            $userAgent = array_rand($agents);
        }

        $_SESSION['agent'] = $userAgent;

        return match ($userAgent) {
            'chrome' => $this->generateChromeUserAgent(),
            'firefox' => $this->generateFirefoxUserAgent(),
            'explorer' => $this->generateExplorerUserAgent(),
            'mobile', 'android', 'iphone', 'ipad', 'ipod' => $this->generateMobileUserAgent(),
            default => throw new \Exception('Unable to determine user agent to generate'),
        };
    }

    private function generateChromeUserAgent(): string
    {
        $os = $this->getOS('chrome');
        $webkitVersion = random_int(1, 100) > 50 ? random_int(533, 537) : random_int(600, 603);
        $safariVersion = random_int(1, 100) > 50 ? random_int(533, 537) : random_int(600, 603);
        $chromeVersion = self::chromeVersion(['min' => 47, 'max' => 55]);

        return "Mozilla/5.0 ($os) AppleWebKit/$webkitVersion.0 (KHTML, like Gecko) Chrome/$chromeVersion Safari/$safariVersion";
    }

    private function generateFirefoxUserAgent(): string
    {
        $os = $this->getOS('firefox');
        $geckoVersion = random_int(1, 100) > 30 ? '20100101' : '20130401';
        $firefoxVersion = self::firefoxVersion(['min' => 45, 'max' => 74]);

        return "Mozilla/5.0 ($os) Gecko/$geckoVersion Firefox/$firefoxVersion";
    }

    private function generateExplorerUserAgent(): string
    {
        $os = $this->getOS('windows');
        $int = random_int(7, 11);
        $tridentVersion = match ($int) {
            7, 8 => '4',
            9 => '5',
            10 => '6',
            default => '7',
        };

        return "Mozilla/5.0 (compatible; MSIE $int.0; $os Trident/$tridentVersion.0)";
    }

    private function generateMobileUserAgent(): string
    {
        $os = $this->getMobileOS($_SESSION['agent']);
        $webkitVersion = random_int(1, 100) > 50 ? random_int(533, 537) : random_int(600, 603);
        $safariVersion = random_int(1, 100) > 50 ? random_int(533, 537) : random_int(600, 603);
        $chromeVersion = self::chromeVersion(['min' => 47, 'max' => 55]);
        $mobileSafariVersion = random_int(1, 100) > 50 ? random_int(533, 537) : random_int(600, 603);
        $randomDigit = random_int(0, 9);

        return "Mozilla/5.0 ($os) AppleWebKit/$webkitVersion.0 (KHTML, like Gecko) Chrome/$chromeVersion Mobile Safari/$mobileSafariVersion.$randomDigit";
    }
}
