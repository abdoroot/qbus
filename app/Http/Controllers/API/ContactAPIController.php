<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateContactAPIRequest;
use App\Http\Requests\API\UpdateContactAPIRequest;
use App\Models\Contact;
use App\Repositories\ContactRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Response;

/**
 * Class ContactController
 * @package App\Http\Controllers\API
 */

class ContactAPIController extends AppBaseController
{
    /** @var  ContactRepository */
    private $contactRepository;

    public function __construct(ContactRepository $contactRepo)
    {
        $this->contactRepository = $contactRepo;
    }


    public function ReturnJson($message,$data,$code = 1){
        $array = [
            'message' => $message,
            'code' => $code,
        ];

        if($data != ""){
            $array['data'] = $data;
        }else{
            $array['data'] = ['message' => ""] ;
        }
        return $array;
    }

    public function index(Request $request)
    {
        $contacts = $this->contactRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            $contacts->toArray(),
            __('messages.retrieved', ['model' => __('models/contacts.plural')])
        );
    }

    /**
     * Store a newly created Contact in storage.
     * POST /contacts
     *
     * @param CreateContactAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateContactAPIRequest $request)
    {
        $input = $request->all();

        $contact = $this->contactRepository->create($input);

        return $this->sendResponse(
            $contact->toArray(),
            __('messages.saved', ['model' => __('models/contacts.singular')])
        );
    }

    public function storeAPi(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required','string', 'email', 'max:255'],
            'subject' => ['required', 'string', 'min:8'],
            'message' => ['required', 'string', 'max:255']
        ]);


        if ($validator->fails()) {
            $errors = $validator->errors();
            $errors = json_decode(json_encode($errors),true);

            $newErrors = [];
            foreach ($errors as $key => $value){
                array_push($newErrors,[$key => $value[0]]);
            }

            return response()->json( $this->ReturnJson("Please ReCheck the Fields",[
                "validate_errors" => $newErrors
            ],0),400);

        }

        $contact = $this->contactRepository->create($input);

        if($contact->id){
            return response()->json( $this->ReturnJson("success",["message" => "sent successfully "],1),200);
        }

    }

    /**
     * Display the specified Contact.
     * GET|HEAD /contacts/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Contact $contact */
        $contact = $this->contactRepository->find($id);

        if (empty($contact)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/contacts.singular')])
            );
        }

        return $this->sendResponse(
            $contact->toArray(),
            __('messages.retrieved', ['model' => __('models/contacts.singular')])
        );
    }

    /**
     * Update the specified Contact in storage.
     * PUT/PATCH /contacts/{id}
     *
     * @param int $id
     * @param UpdateContactAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateContactAPIRequest $request)
    {
        $input = $request->all();

        /** @var Contact $contact */
        $contact = $this->contactRepository->find($id);

        if (empty($contact)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/contacts.singular')])
            );
        }

        $contact = $this->contactRepository->update($input, $id);

        return $this->sendResponse(
            $contact->toArray(),
            __('messages.updated', ['model' => __('models/contacts.singular')])
        );
    }

    /**
     * Remove the specified Contact from storage.
     * DELETE /contacts/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Contact $contact */
        $contact = $this->contactRepository->find($id);

        if (empty($contact)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/contacts.singular')])
            );
        }

        $contact->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/contacts.singular')])
        );
    }
}
