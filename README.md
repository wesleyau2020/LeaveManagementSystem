# PaulHypePage_HRLeaveSite

HR Website for Employee Leave Management

# Pages

user homepage -> users/view/{id}
user request leave -> leave-requests/add

admin homepage -> users/index
admin add user -> users/add
admin approve/reject -> leave-requests/display-approved-requests
admin filter leave -> leave-requests/search

admin update workdays -> workdays/update
admin display holidays -> holidays/display

# Debug Kit

To enable Debug Kit, uncomment this statement in Application.php

// if (Configure::read('debug')) {
// $this->addPlugin('DebugKit');
// }
