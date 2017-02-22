<?php

namespace App\Api\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends BaseController
{
    public function index(Request $request)
    {
        $notes = $this->auth->user()->notes;
        return $this->response->array($notes->toArray());
    }
    
    public function store(Request $request)
    {
        try {
            Note::create(array_merge($request->all(), [
                'user_id' => $this->auth->user()->id
            ]));
        } catch (\Exception $e) {
            return $this->response->errorInternal($e->getMessage());
        }
        return $this->response->created();
    }
}
