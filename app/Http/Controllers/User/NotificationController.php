<?php

namespace App\Http\Controllers\User;

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
        $notifications = Auth::user()->getNotifications()->orderBy('id', 'desc')->paginate(30);

        return view('user.notifications.index')
            ->with('notifications', $notifications);
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
            return redirect(route('notifications.index'));
        }

        if ($notification->to != 'user' || (!is_null($notification->user_id) && $notification->user_id != Auth::user()->id)) {
            Flash::error(__('models/notifications.unauthorized'));
            return redirect(route('notifications.index'));
        }

        if(is_null($notification->read_at)) {
            $notification = $this->notificationRepository->update(['read_at' => Carbon::now()], $id);
        }
        return view('user.notifications.show')->with('notification', $notification);
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
            return redirect(route('notifications.index'));
        }

        if ($notification->to != 'user' || (!is_null($notification->user_id) && $notification->user_id != Auth::user()->id)) {
            Flash::error(__('models/notifications.unauthorized'));
            return redirect(route('notifications.index'));
        }

        $notification = $this->notificationRepository->update(['read_at' => is_null($notification->read_at) ? Carbon::now() : null], $id);

        Flash::success(__('messages.updated', ['model' => __('models/notifications.singular')]));
        return redirect(route('notifications.index'));
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
            return redirect(route('notifications.index'));
        }

        if ($notification->to != 'user' || (!is_null($notification->user_id) && $notification->user_id != Auth::user()->id)) {
            Flash::error(__('models/notifications.unauthorized'));
            return redirect(route('notifications.index'));
        }

        $this->notificationRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/notifications.singular')]));
        return redirect(route('notifications.index'));
    }
}
