<?php

namespace App\Controllers\Admin;

use App\Models\Contact;
use Core\Viewer;

class ContactController
{


    public function  index()
    {
        $contacts  = Contact::all();
        return Viewer::render(
            'admin/contacts/index',
            ['contacts' => $contacts , 'active' => 'contacts'],
            'admin/layouts/main'
        );
    }



}
