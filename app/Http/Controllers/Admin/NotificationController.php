<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateNotificationRequest;
use App\Repositories\NotificationRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Flash;
use Response;
use Auth;

class NotificationController extends AppBaseController
{
    /** @var NotificationRepository $notificationRepository*/
    private $notificationRepository;

    public function __construct(NotificationRepository $notificationRepo)
    {
        $this->notificationRepository = $notificationRepo;
    }

    /**
     * Display a listing of the Notification.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $notifications = Auth::guard('admin')->user()->getNotifications()->get();

        return view('admin.notifications.index')
            ->with('notifications', $notifications);
    }

    /**
     * Show the form for creating a new Notification.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.notifications.create');
    }

    /**
     * Store a newly created Notification in storage.
     *
     * @param CreateNotificationRequest $request
     *
     * @return Response
     */
    public function store(CreateNotificationRequest $request)
    {
        $input = $request->except('users', 'admins');

        if(!is_null($ids = $request["{$input['to']}s"])) {
            foreach($ids as $id) {
                $input["{$input['to']}_id"] = $id;
                $notification = $this->notificationRepository->create($input);
            }
        }

        Flash::success(__('messages.saved', ['model' => __('models/notifications.singular')]));
        return redirect(route('admin.notifications.index'));
    }

    /**
     * Display the specified Notification.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $notification = $this->notificationRepository->find($id);

        if (empty($notification)) {
            Flash::error(__('messages.not_found', ['model' => __('models/notifications.singular')]));
            return redirect(route('admin.notifications.index'));
        }

        if ($notification->to != 'admin' || (!is_null($notification->admin_id) && $notification->admin_id != Auth::guard('admin')->user()->id)) {
            Flash::error(__('models/notifications.unauthorized'));
            return redirect(route('admin.notifications.index'));
        }

        if(is_null($notification->read_at)) {
            $notification = $this->notificationRepository->update(['read_at' => Carbon::now()], $id);
        }
        return view('admin.notifications.show')->with('notification', $notification);
    }

    /**
     * Update the specified Notification in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update($id)
    {
        $notification = $this->notificationRepository->find($id);

        if (empty($notification)) {
            Flash::error(__('messages.not_found', ['model' => __('models/notifications.singular')]));
            return redirect(route('admin.notifications.index'));
        }

        if ($notification->to != 'admin' || (!is_null($notification->admin_id) && $notification->admin_id != Auth::guard('admin')->user()->id)) {
            Flash::error(__('models/notifications.unauthorized'));
            return redirect(route('admin.notifications.index'));
        }

        $notification = $this->notificationRepository->update(['read_at' => is_null($notification->read_at) ? Carbon::now() : null], $id);

        Flash::success(__('messages.updated', ['model' => __('models/notifications.singular')]));
        return redirect(route('admin.notifications.index'));
    }

    /**
     * Remove the specified Notification from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $notification = $this->notificationRepository->find($id);

        if (empty($notification)) {
            Flash::error(__('messages.not_found', ['model' => __('models/notifications.singular')]));
            return redirect(route('admin.notifications.index'));
        }

        if ($notification->to != 'admin' || (!is_null($notification->admin_id) && $notification->admin_id != Auth::guard('admin')->user()->id)) {
            Flash::error(__('models/notifications.unauthorized'));
            return redirect(route('admin.notifications.index'));
        }

        $this->notificationRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/notifications.singular')]));
        return redirect(route('admin.notifications.index'));
    }
}
