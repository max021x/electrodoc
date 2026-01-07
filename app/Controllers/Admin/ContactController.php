<?php

namespace App\Controllers\Admin;

use App\Models\Contact;
use App\Services\Authorization;
use Core\Viewer;
use Core\Router;

class ContactController
{


    public function  index()
    {
        Authorization::verify('dashboard');
        $page = $_GET['page'] ?? 1;
        $search = $_GET['search'] ?? "";
        $limit = 1;
        $contacts = Contact::getRecent(limit: $limit, page: $page, search: $search);
        $total = Contact::count();
        return Viewer::render(
            'admin/contacts/index',
            [
                'active' => 'contacts',
                'contacts' => $contacts,
                'currentPage' => $page,
                'totalPages' => ceil($total / $limit)
            ],
            'admin/layouts/main'
        );
    }

    public function delete($id)
    {
        $contact = Contact::find($id);
        if (!$contact) {
            $_SESSION['error'] = 'Contact Message Not Found :(';
            Router::redirect('/admin/contacts');
        }
        $contact->delete($id);
        $_SESSION['success'] = 'Message has deleted successfully :)';
        Router::redirect('/admin/contacts');
    }
}
