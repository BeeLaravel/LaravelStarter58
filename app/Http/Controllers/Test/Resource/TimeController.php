<?php
namespace App\Http\Controllers\Test\Resource;

use Spatie\OpeningHours\OpeningHours;

class TimeController extends Controller {
    public function opening() {
		$openingHours = OpeningHours::create([
		    'monday' => ['09:00-12:00', '13:00-18:00'],
		    'tuesday' => ['09:00-12:00', '13:00-18:00'],
		    'wednesday' => ['09:00-12:00'],
		    'thursday' => ['09:00-12:00', '13:00-18:00'],
		    'friday' => ['09:00-12:00', '13:00-20:00'],
		    'saturday' => ['09:00-12:00', '13:00-16:00'],
		    'sunday' => [],
		    'exceptions' => [
		        '2016-11-11' => ['09:00-12:00'],
		        '2016-12-25' => [],
		        '01-01' => [],
		        '12-25' => ['09:00-12:00'],
		    ],
		]);
		$openingHours = OpeningHours::create([
		    'overflow' => true,
		    'friday' => ['20:00-03:00'],
		    'saturday' => ['20:00-03:00'],
		], null);

		$now = new \DateTime('now');
		echo $now->format('Y-m-d\TH:i:s.u')."<br>";

		$range = $openingHours->currentOpenRange($now);

		if ( $range ) {
		    echo "It's open since ".$range->start()."\n";
		    echo "It will close at ".$range->end()."\n";
		} else {
		    echo "It's closed since ".$openingHours->previousClose($now)->format('l H:i')."\n";
		    echo "It will re-open at ".$openingHours->nextOpen($now)->format('l H:i')."\n";
		}

		$openingHours->isOpenOn('monday'); // true
		$openingHours->isOpenOn('sunday'); // false

		$openingHours->isOpenAt(new \DateTime('2016-09-26 19:00:00')); // false
		$openingHours->isOpenAt(new \DateTime('2016-12-25')); // false

		$openingHours->forDay('monday');
		$openingHours->forWeek();
		$openingHours->forWeekCombined();
		$openingHours->forDate(new \DateTime('2016-12-25'));
		$openingHours->exceptions();

		$openingHours = OpeningHours::create([
		    'monday' => [
		        'data' => 'Typical Monday',
		        '09:00-12:00',
		        '13:00-18:00',
		    ],
		    'tuesday' => [
		        '09:00-12:00',
		        '13:00-18:00',
		        [
		            '19:00-21:00',
		            'data' => 'Extra on Tuesday evening',
		        ],
		    ],
		    'exceptions' => [
		        '2016-12-25' => [
		            'data' => 'Closed for Christmas',
		        ],
		    ],
		]);

		echo $openingHours->forDay('monday')->getData(); // Typical Monday
		echo $openingHours->forDate(new \DateTime('2016-12-25'))->getData(); // Closed for Christmas
		echo $openingHours->forDay('tuesday')[2]->getData(); // Extra on Tuesday evening

		$openingHours = OpeningHours::create([
		    'monday' => [
		        'hours' => [
		            '09:00-12:00',
		            '13:00-18:00',
		        ],
		        'data' => 'Typical Monday',
		    ],
		    'tuesday' => [
		        ['hours' => '09:00-12:00'],
		        ['hours' => '13:00-18:00'],
		        ['hours' => '19:00-21:00', 'data' => 'Extra on Tuesday evening'],
		    ],
		    // Open by night from Wednesday 22h to Thursday 7h:
		    'wednesday' => ['22:00-24:00'], // use the special "24:00" to reach midnight included
		    'thursday' => ['00:00-07:00'],
		    'exceptions' => [
		        '2016-12-25' => [
		            'hours' => [],
		            'data'  => 'Closed for Christmas',
		        ],
		    ],
		]);

		$openingHours = OpeningHours::create([
		    'monday' => [
		       '09:00-12:00',
		    ],
		    'filters' => [
		        function ($date) {
		            $year = intval($date->format('Y'));
		            $easterMonday = new \DateTimeImmutable($year.'-03-21 +'.(easter_days($year) + 1).'days');
		            if ( $date->format('m-d') === $easterMonday->format('m-d') ) return [];
		        },
		    ],
		]);

		$nextOpen = $openingHours->nextOpen(new \DateTime('2016-12-25 10:00:00')); // 2016-12-26 09:00:00
		$nextOpen = $openingHours->nextOpen(new \DateTime('2016-12-24 11:00:00')); // 2016-12-24 13:00:00
		$nextClose = $openingHours->nextClose(new \DateTime('2016-12-24 10:00:00')); // 2016-12-24 12:00:00
		$nextClose = $openingHours->nextClose(new \DateTime('2016-12-25 15:00:00')); // 2016-12-26 12:00:00

		$ranges = [
		    'monday' => ['08:00-11:00', '10:00-12:00'],
		];
		OpeningHours::createAndMergeOverlappingRanges($ranges);
		$mergedRanges = OpeningHours::mergeOverlappingRanges($ranges); // Monday becomes ['08:00-12:00']
		OpeningHours::create($mergedRanges);

		$openingHours = (new OpeningHours)->fill([
		    'monday' => ['09:00-12:00', '13:00-18:00'],
		]);

		$openingHours->forWeek();
		$openingHours->forWeekCombined();
		$openingHours->forDay('monday');

		$openingHours->forDate(new \DateTime('2016-12-25'));
		$openingHours->exceptions();
		$openingHours->isOpenOn('saturday');
		$openingHours->isClosedOn('sunday');

		$openingHours->isOpenAt(new \DateTime('2016-26-09 20:00'));
		$openingHours->isClosedAt(new \DateTime('2016-26-09 20:00'));
		$openingHours->isOpen();
		$openingHours->isClosed();

		$openingHours->nextOpen(new \DateTime('2016-12-24 11:00:00'));
		$openingHours->nextClose(new \DateTime('2016-12-24 11:00:00'));
		$openingHours->previousOpen(new \DateTime('2016-12-24 11:00:00'));
		$openingHours->nextClose(new \DateTime('2016-12-24 11:00:00'));

		$range = $openingHours->currentOpenRange(new \DateTime('2016-12-24 11:00:00'));
		if ($range) {
		    echo "It's open since ".$range->start()."\n";
		    echo "It will close at ".$range->end()."\n";
		} else {
		    echo "It's closed";
		}

		$date = $openingHours->currentOpenRangeStart(new \DateTime('2016-12-24 11:00:00'));
		if ($date) {
		    echo "It's open since ".$date->format('H:i');
		} else {
		    echo "It's closed";
		}

		$date = $openingHours->currentOpenRangeEnd(new \DateTime('2016-12-24 11:00:00'));
		if ($date) {
		    echo "It will close at ".$date->format('H:i');
		} else {
		    echo "It's closed";
		}

		$openingHours->asStructuredData();
		$openingHours->asStructuredData('H:i:s'); // Customize time format, could be 'h:i a', 'G:i', etc.
		$openingHours->asStructuredData('H:iP', '-05:00'); // Add a timezone
    }
}
