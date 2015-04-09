<?php

class NotificationController extends BaseController {

    protected $layout = 'master';

    /**
     * adds a notification to the database
     *
     * @return Response
     */
    public function add($user_id, $object_type, $object_id, $type) {

        $user_id;          // the owener of notification

        $subject_type = 'user';                 // always user, the user who triggered this notification
        $subject_id = Auth::user()->id;         // id of the user who triggered the notification

        $object_type;      // triggerd on a user or a review 
        $object_id;        // id of the triggered user or review

        $type;             // type, follow or liked our review

        if (!$review == "") {

            DB::table('user_notifications')->insert(
                    array(
                        'user_id' => $user_id,
                        'subject_type' => $subject_type,
                        'subject_id' => $subject_id,
                        'object_type' => $object_type,
                        'object_id' => $object_id,
                        'type' => $type,
                        'read' => '0',
                    )
            );
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {

        $noti = DB::table('user_notifications')
                ->where('user_id', Auth::user()->id)
                ->orderBy('date', 'desc')
                ->get();

        $this->layout->content = View::make('notifications.index', compact('noti'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View::make('notifications.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        return View::make('notifications.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        return View::make('notifications.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

    /**
     * Remove a specific notifications.
     *
     * @param  int  $id
     * @return Response
     */
    public function read() {

        $id = Input::get('data_id');

        DB::table('user_notifications')
                ->where('user_id', Auth::user()->id)
                ->where('notification_id', $id)
                ->update(array('read' => 1));
    }

    /**
     * Remove the all notifications.
     *
     * @param  int  $id
     * @return Response
     */
    public function readAll() {

        $id = Input::get('data_id');
        
        DB::table('user_notifications')
                ->where('user_id', Auth::user()->id)
                ->update(array('read' => 1));
    }

}
