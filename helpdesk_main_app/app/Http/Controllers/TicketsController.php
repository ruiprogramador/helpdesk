<?php

namespace App\Http\Controllers;

use App\Models\Tickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Helpers\GlobalHelper;
use App\Models\Tickets as Ticket;
use App\Http\Requests\TicketRequest;
use App\Models\TicketTypes;
use App\Models\StatusTickets;
use App\Models\CategoriesTickets;
use App\Models\PrioritiesTickets;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
class TicketsController extends Controller
{

    private $ticketAction;
    private $globalHelper;
    private $ticketRequest;
    private $ticketTypes;
    private $statusTickets;
    private $categoriesTickets;
    private $prioritiesTickets;

    private $currentDate;

    public function __construct()
    {
        $this->globalHelper = new GlobalHelper();

        $this->globalHelper->clearSession();

        $this->currentDate = Carbon::now();

        $this->ticketRequest = new TicketRequest();

        /**
         * Preparing the data for the form
         */
        $this->prioritiesTickets = DB::select(
            '
                SELECT
                    id              AS priority_id
                    , priority      AS priority
                FROM
                    priorities_tickets
                WHERE
                    1 = 1
                ORDER BY
                    priority ASC
            '
        );

        $this->ticketTypes = DB::select(
            '
                SELECT
                    id              AS type_id
                    , type          AS type
                FROM
                    ticket_types
                WHERE
                    1 = 1
                ORDER BY
                    type ASC
            '
        );

        $this->statusTickets = DB::select(
            '
                SELECT
                    id              AS status_id
                    , status        AS status
                FROM
                    status_tickets
                WHERE
                    1 = 1
                ORDER BY
                    status ASC
            '
        );

        $this->categoriesTickets = DB::select(
            '
                SELECT
                    id          AS category_id
                    , category  AS category_name
                FROM
                    categories_tickets
                WHERE
                    1 = 1
                ORDER BY
                    category ASC
            '
        );
    }

    private function getTickets(int $id = 0)
    {
        if(
            1 == 1
            && !empty($id)
        )
        {
            if(
                1 == 1
                && Ticket::where('id', $id)->exists()
            )
            {
                return DB::select(
                    '
                        SELECT
                            tkt.id AS ticket_id
                            , tkt.title
                            , tkt.description
                            , tkt.created_at
                            , tkt.updated_at
                            , tkt.user_id
                            , usr.first_name
                            , usr.last_name
                            , tkt.priority_id
                            , prt.priority
                            , tkt.type_id
                            , ttp.type
                            , tkt.status_id
                            , stt.status
                            , tkt.category_id
                            , ctt.category
                            , LAST_VALUE(att.assigned_by) OVER(PARTITION BY att.ticket_id ORDER BY att.UPDATED_at DESC) AS assigned_by
                            , COUNT(att.id) AS activities_count
                            , COUNT(cmt.id) AS comments_count
                        FROM
                            tickets tkt
                        INNER JOIN
                            users               usr ON  1 = 1
                                                    AND tkt.user_id = usr.id
                        LEFT JOIN
                            activities_tickets  att ON 1 = 1
                                                    AND tkt.id = att.ticket_id
                        LEFT JOIN
                            comments_tickets    cmt ON 1 = 1
                                                    AND tkt.id = cmt.ticket_id
                        INNER JOIN
                            priorities_tickets  prt ON 1 = 1
                                                    AND tkt.priority_id = prt.id
                        INNER JOIN
                            ticket_types        ttp ON 1 = 1
                                                    AND tkt.type_id = ttp.id
                        INNER JOIN
                            status_tickets      stt ON 1 = 1
                                                    AND tkt.status_id = stt.id
                        INNER JOIN
                            categories_tickets  ctt ON 1 = 1
                                                    AND tkt.category_id = ctt.id
                        WHERE
                            1 = 1
                            AND tkt.id = :id
                        GROUP BY
                            tkt.id
                            , tkt.title
                            , tkt.description
                            , tkt.created_at
                            , tkt.updated_at
                            , tkt.user_id
                            , usr.first_name
                            , usr.last_name
                            , tkt.priority_id
                            , prt.priority
                            , tkt.type_id
                            , ttp.type
                            , tkt.status_id
                            , stt.status
                            , tkt.category_id
                            , ctt.category
                            , att.id
                            , att.assigned_by
                            , att.updated_at
                    '
                    , [
                        'id' => $id
                    ]
                );
            }else{
                return [];
            }
        }else{
            return DB::select(
                '
                    SELECT
                        tkt.id AS ticket_id
                        , tkt.title
                        , tkt.description
                        , tkt.created_at
                        , tkt.updated_at
                        , tkt.user_id
                        , usr.first_name
                        , usr.last_name
                        , tkt.priority_id
                        , prt.priority
                        , tkt.type_id
                        , ttp.type
                        , tkt.status_id
                        , stt.status
                        , tkt.category_id
                        , ctt.category
                        , COUNT(att.id) AS activities_count
                        , COUNT(cmt.id) AS comments_count
                    FROM
                        tickets tkt
                    INNER JOIN
                        users               usr ON  1 = 1
                                                AND tkt.user_id = usr.id
                    LEFT JOIN
                        activities_tickets  att ON 1 = 1
                                                AND tkt.id = att.ticket_id
                    LEFT JOIN
                        comments_tickets    cmt ON 1 = 1
                                                AND tkt.id = cmt.ticket_id
                    INNER JOIN
                        priorities_tickets  prt ON 1 = 1
                                                AND tkt.priority_id = prt.id
                    INNER JOIN
                        ticket_types        ttp ON 1 = 1
                                                AND tkt.type_id = ttp.id
                    INNER JOIN
                        status_tickets      stt ON 1 = 1
                                                AND tkt.status_id = stt.id
                    INNER JOIN
                        categories_tickets  ctt ON 1 = 1
                                                AND tkt.category_id = ctt.id
                    WHERE
                        1 = 1
                    GROUP BY
                        tkt.id
                        , tkt.title
                        , tkt.description
                        , tkt.created_at
                        , tkt.updated_at
                        , tkt.user_id
                        , usr.first_name
                        , usr.last_name
                        , tkt.priority_id
                        , prt.priority
                        , tkt.type_id
                        , ttp.type
                        , tkt.status_id
                        , stt.status
                        , tkt.category_id
                        , ctt.category
                        , att.id
                        , att.assigned_by
                        , att.updated_at
                '
            );
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $this->ticketAction = 'index';

        $tickets = $this->getTickets();
        $ticket_types = $this->ticketTypes;

        return view('tickets.index', compact('tickets', 'ticket_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request_type)
    {
        /**
         * Get the Type of Ticket
         */
        // dd($request_type->all());

        if(
            1 == 1
            && !empty($request_type->type)
        ){
            /**
             * Check if the type of ticket is valid
             */
            if(
                1 == 1
                && TicketTypes::where('id', $request_type->type)->exists()
            ){
                // dd("Valid Ticket Type");

                $ticketAction = $this->ticketAction = 'create';
                $ticket_type = $request_type->type;
                $priorities_list = $this->prioritiesTickets;
                $types_list = $this->ticketTypes;
                $status_list = $this->statusTickets;
                $categories_list = $this->categoriesTickets;
                $users_list = DB::select(
                    '
                        SELECT
                            id          AS user_id
                            , first_name
                            , last_name
                        FROM
                            users
                        WHERE
                            1 = 1
                        ORDER BY
                            first_name ASC
                            , last_name ASC
                    '
                );

                return view('tickets.ticket', compact('ticketAction', 'ticket_type', 'priorities_list', 'types_list', 'status_list', 'categories_list', 'users_list'));

            }else{
                return redirect()->route('tickets.index');
            }
        }else{
            return redirect()->route('tickets.index');
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd("TicketsController@store");

        $valid = false;
        $feedback = '';

        if(
            1 == 1
            && $request->ticketAction == 'create'
        ){
            $valid = true;
        }else{
            $valid = false;
            $feedback = '<li>Invalid Arguments</li>';
        }

        /**
         * Run validation
         */
        if(
            1 == 1
            && $valid == true
        ){
            $valid = true;

            $validateRequest = $this->ticketRequest->validate(
                [
                    'id' => Ticket::max('id') + 1
                    , 'title' => $request->title
                    ,'description' => $request->description
                    ,'status_id' => $request->status_id
                    ,'priority_id' => $request->priority_id
                    ,'category_id' => $request->category_id
                    ,'type_id' => $request->type_id
                    ,'assigned_by' => Auth::user()->id
                    ,'created_by' => Auth::user()->id
                    ,'updated_by' => Auth::user()->id
                    , 'user_id' => Auth::user()->id
                ]
            );

            if(
                1 == 1
                && $validateRequest->fails()
            ){
                $feedback = '<ul>';

                foreach($validateRequest->errors()->all() as $error){
                    $feedback .= '<li>' . $error . '</li>';
                }

                $feedback .= '</ul>';

                $valid = false;
            }

        }else{
            $valid = false;
            $feedback != ' ' ? $feedback : '<li>Invalid Ticket</li>';
        }

        if(
            1 == 1
            && $valid
        ){
            $ticket = new Ticket();

            $ticket->id = Ticket::max('id') + 1;
            $ticket->title = $request->title;
            $ticket->description = $request->description;
            $ticket->priority_id = $request->priority_id;
            $ticket->type_id = $request->type_id;
            $ticket->status_id = $request->status_id;
            $ticket->category_id = $request->category_id;
            $ticket->user_id = Auth::user()->id;
            $ticket->save();

            return redirect()->route('tickets.show', $ticket->id);
        }
        else{
            return $this->globalHelper->displayErrorsMessage($feedback);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {

        $ticketAction = $this->ticketAction = 'show';

        if(
            1 == 1
            && Ticket::where('id', $id)->exists()
        ){

            $ticket = $this->getTickets($id);

            if(
                1 == 1
                && !empty($ticket)
            ){
                if(
                    1 == 1
                    // && $ticket[0]->comments_count == 0
                    && $ticket[0]->comments_count > 0
                ){
                    $ticket[0]->comments = DB::select(
                        '
                            SELECT
                                cmt.id AS comment_id
                                , cmt.comment
                                , cmt.created_at
                                , cmt.updated_at
                                , cmt.user_id
                                , usr.first_name
                                , usr.last_name
                            FROM
                                comments_tickets cmt
                            INNER JOIN
                                users           usr ON  1 = 1
                                                    AND cmt.user_id = usr.id
                            WHERE
                                1 = 1
                                AND cmt.ticket_id = :ticket_id
                            ORDER BY
                                cmt.created_at DESC
                        '
                        , [
                            'ticket_id' => $id
                        ]
                    );
                }

                return view('tickets.ticket', compact('ticket', 'ticketAction'));
            }

        }else{
            return redirect()->route('tickets.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $ticketAction = $this->ticketAction = 'edit';

        if(
            1 == 1
            && Ticket::where('id', $id)->exists()
        ){
            $ticket = $this->getTickets($id);
            $priorities_list = $this->prioritiesTickets;
            $types_list = $this->ticketTypes;
            $status_list = $this->statusTickets;
            $categories_list = $this->categoriesTickets;
            $users_list = DB::select(
                '
                    SELECT
                        id          AS user_id
                        , first_name
                        , last_name
                    FROM
                        users
                    WHERE
                        1 = 1
                    ORDER BY
                        first_name ASC
                        , last_name ASC
                '
            );

            return view('tickets.ticket', compact('ticket', 'ticketAction', 'priorities_list', 'types_list', 'status_list', 'categories_list', 'users_list'));
        }else{
            return redirect()->route('tickets.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tickets $tickets)
    {
        // dd("TicketsController@update");

        // dd($request->all());

        $ticket = Ticket::find($request->ticket_id);

        $valid = false;
        $feedback = '';

        if(
            1 == 1
            && $request->ticketAction == 'edit'
        ){
            $valid = true;
        }else{
            $valid = false;
            $feedback = '<li>Invalid Arguments</li>';
        }

        /**
         * Run validation
         */
        if(
            1 == 1
            && !empty($ticket)
            && $valid == true
        ){
            $valid = true;
            /**
             * Check if user is authorized to update the ticket
             */
            if(
                1 == 1
                && $ticket->user_id == auth()->user()->id
            ){
                $valid = true;

                /**
                 *
                 */
                // dd($ticket);

                $validateRequest = $this->ticketRequest->validate(
                    [
                        'id' => $request->ticket_id
                        ,'user_id' => Auth::user()->id
                        ,'title' => $request->title
                        ,'description' => $request->description
                        ,'status_id' => $request->status_id
                        ,'priority_id' => $request->priority_id
                        ,'category_id' => $request->category_id
                        ,'type_id' => $request->type_id
                        ,'assigned_by' => Auth::user()->id
                        ,'created_by' => Auth::user()->id
                        ,'updated_by' => Auth::user()->id
                    ]
                );

                if(
                    1 == 1
                    && $validateRequest->fails()
                ){

                    $feedback = '<ul>';

                    foreach($validateRequest->errors()->all() as $error){
                        $feedback .= '<li>' . $error . '</li>';
                    }

                    $feedback .= '</ul>';

                    $valid = false;
                }

            }else{
                $valid = false;
                $feedback != ' ' ? $feedback : '<li>You are not authorized to update this ticket.</li>';
            }
        }else{
            $valid = false;
            $feedback != ' ' ? $feedback : '<li>Invalid Ticket</li>';
        }

        if(
            1 == 1
            && $valid
        ){
            $ticket->title = $request->title;
            $ticket->description = $request->description;
            $ticket->priority_id = $request->priority_id;
            $ticket->type_id = $request->type_id;
            $ticket->status_id = $request->status_id;
            $ticket->category_id = $request->category_id;
            $ticket->user_id = Auth::user()->id;
            $ticket->save();

            return redirect()->route('tickets.show', $request->ticket_id);
        }

        if(
            1 == 1
            && $valid
        ){
            return redirect()->route('tickets.show', ['id' => $request->ticket_id]);
        }else{
            return $this->globalHelper->displayErrorsMessage($feedback);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tickets $tickets)
    {
        dd("TicketsController@destroy");
    }
}
