<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;


class gCalendarController extends Controller
{
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index2(Request $request)

    {
        
        $type = $request->get('type');
        if($type == 'resetdate')
            {
                $startdate = new Carbon($request->get('start'));               
                $enddate = new Carbon($request->get('end'));
                $eventid = $request->get('eventid');     
               
                $event = Event::find($eventid);
                $event->startDateTime = $startdate;
                $event->endDateTime = $enddate;
                $event->save();                
            }
        if($type == 'changetitle')
            {
                $eventid = $request->get('eventid');
                $eventtitle = $request->get('title');     
               
                $event = Event::find($eventid);
                $event->name = $eventtitle;                
                $event->save();
                echo json_encode(array('status'=>'success'));                
            }
        if($type == 'new')
            {
                $event= new Event;
                #dd($event);
                $event->name=$request->get('title');
                $event->startDateTime = Carbon::now();
                $event->endDateTime = Carbon::now()->addHour();
                $event->color=4;
                $event->save();
                $lastid = $event->id;
                $colors='pink';
                echo json_encode(array('status'=>'success','eventid'=>$lastid,'colors'=>$colors));               
            }

        if($type == 'remove')
            {
                $eventid = $request->get('eventid');
                $event = Event::find($eventid);
                $event->delete();
                
                if($event)
                    echo json_encode(array('status'=>'success'));
                else
                    echo json_encode(array('status'=>'failed'));
            }
       

       

    }

    public function oauth()
    {
         $events = Event::get();
       
        $data=[];
        foreach ($events as $event) {
           
            $subArr=[
            'title'=>$event->summary,
            'allDay'=>'true',
            'start'=>$event->modelData["start"]->dateTime,
            
            ];
            array_push($data, $subArr);
        }
        dd($data);
            return $data;


        session_start();

        $rurl = action('gCalendarController@oauth');
        $client = new Google_Client();
        $client->setAuthConfigFile('client_secret.json');
        $client->setRedirectUri($rurl);
        $client->addScope(Google_Service_Calendar::CALENDAR);

        $guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false)));
        $client->setHttpClient($guzzleClient);
        
        if (!isset($_GET['code'])) {
            $auth_url = $client->createAuthUrl();
            $filtered_url = filter_var($auth_url, FILTER_SANITIZE_URL);
            return redirect($filtered_url);
        } else {
            $client->authenticate($_GET['code']);
            $_SESSION['access_token'] = $client->getAccessToken();
            return redirect('/cal');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('calendar.createEvent');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        session_start();
        $startDateTime = $request->start_date;
        $endDateTime = $request->end_date;

        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);
            $service = new Google_Service_Calendar($this->client);

            $calendarId = 'primary';
            $event = new Google_Service_Calendar_Event([
                'summary' => $request->title,
                'description' => $request->description,
                'start' => ['dateTime' => $startDateTime],
                'end' => ['dateTime' => $endDateTime],
                'reminders' => ['useDefault' => true],
            ]);
            $results = $service->events->insert($calendarId, $event);
            if (!$results) {
                return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
            }
            return response()->json(['status' => 'success', 'message' => 'Event Created']);
        } else {
            return redirect()->route('oauthCallback');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $eventId
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show($eventId)
    {
        session_start();
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);

            $service = new Google_Service_Calendar($this->client);
            $event = $service->events->get('primary', $eventId);

            if (!$event) {
                return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
            }
            return response()->json(['status' => 'success', 'data' => $event]);

        } else {
            return redirect()->route('oauthCallback');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $eventId
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request, $eventId)
    {
        session_start();
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);
            $service = new Google_Service_Calendar($this->client);

            $startDateTime = Carbon::parse($request->start_date)->toRfc3339String();

            $eventDuration = 30; //minutes

            if ($request->has('end_date')) {
                $endDateTime = Carbon::parse($request->end_date)->toRfc3339String();

            } else {
                $endDateTime = Carbon::parse($request->start_date)->addMinutes($eventDuration)->toRfc3339String();
            }

            // retrieve the event from the API.
            $event = $service->events->get('primary', $eventId);

            $event->setSummary($request->title);

            $event->setDescription($request->description);

            //start time
            $start = new Google_Service_Calendar_EventDateTime();
            $start->setDateTime($startDateTime);
            $event->setStart($start);

            //end time
            $end = new Google_Service_Calendar_EventDateTime();
            $end->setDateTime($endDateTime);
            $event->setEnd($end);

            $updatedEvent = $service->events->update('primary', $event->getId(), $event);


            if (!$updatedEvent) {
                return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
            }
            return response()->json(['status' => 'success', 'data' => $updatedEvent]);

        } else {
            return redirect()->route('oauthCallback');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $eventId
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy($eventId)
    {
        session_start();
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);
            $service = new Google_Service_Calendar($this->client);

            $service->events->delete('primary', $eventId);

        } else {
            return redirect()->route('oauthCallback');
        }
    }
}